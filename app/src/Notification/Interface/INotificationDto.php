<?php

namespace App\Notification\Interface;

interface INotificationDto
{
    public function getTitle(): string;

    public function setTitle(string $title): self;

    public function getBody(): ?string;

    public function setBody(string $body): self;

    public function getImageUrl(): ?string;

    public function setImageUrl(string $imageUrl): self;

    public function getData(): array;

    public function setData(array $data): self;

    public function getDeviceToken(): string;

    public function setDeviceToken(string $deviceToken): self;
}