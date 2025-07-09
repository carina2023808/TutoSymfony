<?php
// src/Model/SearchData.php

namespace App\Model;

use App\Entity\User;

class SearchData
{
    private $title;
    private $slug;
    private $content;
    private $duration;
    private $imageName;
    private $imageSize;
    private $createdAt;
    private $updatedAt;
    private $user;

    public function getTitle(): ?string { return $this->title; }
    public function setTitle(?string $title): void { $this->title = $title; }

    public function getSlug(): ?string { return $this->slug; }
    public function setSlug(?string $slug): void { $this->slug = $slug; }

    public function getContent(): ?string { return $this->content; }
    public function setContent(?string $content): void { $this->content = $content; }

    public function getDuration(): ?int { return $this->duration; }
    public function setDuration(?int $duration): void { $this->duration = $duration; }

    public function getImageName(): ?string { return $this->imageName; }
    public function setImageName(?string $imageName): void { $this->imageName = $imageName; }

    public function getImageSize(): ?int { return $this->imageSize; }
    public function setImageSize(?int $imageSize): void { $this->imageSize = $imageSize; }

    public function getCreatedAt(): ?\DateTimeInterface { return $this->createdAt; }
    public function setCreatedAt(?\DateTimeInterface $createdAt): void { $this->createdAt = $createdAt; }

    public function getUpdatedAt(): ?\DateTimeInterface { return $this->updatedAt; }
    public function setUpdatedAt(?\DateTimeInterface $updatedAt): void { $this->updatedAt = $updatedAt; }

    public function getUser(): ?User { return $this->user; }
    public function setUser(?User $user): void { $this->user = $user; }
}
