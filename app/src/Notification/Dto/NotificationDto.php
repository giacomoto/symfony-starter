<?php

namespace App\Notification\Dto;

use App\Notification\Interface\INotificationDto;

class NotificationDto implements INotificationDto
{
    protected string $title;

    protected ?string $body;

    protected ?string $imageUrl;

    protected array $data = [];

    protected string $deviceToken;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;
        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data): self
    {
        $this->data = $data;
        return $this;
    }

    public function getDeviceToken(): string
    {
        return $this->deviceToken;
    }

    public function setDeviceToken(string $deviceToken): self
    {
        $this->deviceToken = $deviceToken;
        return $this;
    }
}
