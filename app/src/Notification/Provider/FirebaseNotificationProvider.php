<?php

namespace App\Notification\Provider;

use App\Notification\Exception\DeviceNotFoundNotificationException;
use App\Notification\Exception\InvalidMessageNotificationException;
use App\Notification\Exception\MessagingErrorNotificationException;
use App\Notification\Exception\ProviderNotificationException;
use App\Notification\Exception\ServerErrorNotificationException;
use App\Notification\Exception\ServerUnavailableNotificationException;
use App\Notification\Interface\INotificationDto;
use App\Notification\Interface\INotificationProviderInterface;
use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Exception\Messaging\InvalidMessage;
use Kreait\Firebase\Exception\Messaging\NotFound;
use Kreait\Firebase\Exception\Messaging\ServerError;
use Kreait\Firebase\Exception\Messaging\ServerUnavailable;
use Kreait\Firebase\Exception\MessagingException;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\AndroidConfig;
use Kreait\Firebase\Messaging\ApnsConfig;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class FirebaseNotificationProvider implements INotificationProviderInterface
{
    private Messaging $messaging;

//    private array $template = [
//        "android" => [
//            "priority" => "high",
//        ],
//        "apns" => [
//            "payload" => [
//                "aps" => [
//                    "contentAvailable" => true,
//                ],
//            ],
//            "headers" => [
//                "apns-push-type" => "background",
//                "apns-priority" => "5", // Must be `5` when `contentAvailable` is set to true.
//                "apns-topic" => "io.flutter.plugins.firebase.messaging", // bundle identifier
//            ],
//        ],
//    ];

    public function __construct(string $credentialsPath)
    {
        $factory = (new Factory())->withServiceAccount($credentialsPath);
        $this->messaging = $factory->createMessaging();
    }

    /**
     * @throws InvalidMessageNotificationException
     * @throws MessagingErrorNotificationException
     * @throws ProviderNotificationException
     * @throws ServerUnavailableNotificationException
     * @throws DeviceNotFoundNotificationException
     * @throws ServerErrorNotificationException
     */
    public function send(INotificationDto $notificationDto): void
    {
        $notification = $this->buildMessage($notificationDto);

        try {
            $this->messaging->send($notification);
        } catch (NotFound $e) {
            throw new DeviceNotFoundNotificationException($e->getMessage());
        } catch (InvalidMessage $e) {
            throw new InvalidMessageNotificationException($e->getMessage());
        } catch (ServerUnavailable $e) {
            throw new ServerUnavailableNotificationException($e->getMessage(), $e->retryAfter());
        } catch (ServerError $e) {
            throw new ServerErrorNotificationException($e->getMessage());
        } catch (MessagingException $e) {
            throw new MessagingErrorNotificationException($e->getMessage());
        } catch (FirebaseException $e) {
            throw new ProviderNotificationException($e->getMessage());
        }
    }

    private function buildMessage(INotificationDto $notificationDto): CloudMessage
    {
        $message = CloudMessage::withTarget('token', $notificationDto->getDeviceToken());

        $message
            ->withNotification(Notification::create(
                $notificationDto->getTitle(),
                $notificationDto->getBody(),
                $notificationDto->getImageUrl()
            ))
            ->withData($notificationDto->getData())
            ->withHighestPossiblePriority()
            ->withApnsConfig(
                ApnsConfig::new()
                    ->withHeader("apns-push-type", "background")
                    ->withHeader("apns-priority", "5") // Must be `5` when `contentAvailable` is set to true.
                    ->withHeader("apns-topic", "io.flutter.plugins.firebase.messaging") // bundle identifier
            )
            ->withAndroidConfig(
                AndroidConfig::new()->withHighMessagePriority()
            );

        return $message;
    }
}
