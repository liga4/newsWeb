<?php

namespace App\Models;

class Article
{
    private ?string $title;
    private ?string $description;
    private ?string $image;
    private ?string $publishedAt;
    private ?string $url;

    public function __construct(
        ?string $title,
        ?string $description,
        ?string $image,
        ?string $publishedAt,
        ?string $url
    )
    {
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->publishedAt = $publishedAt;
        $this->url = $url;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getPublishedAt(): ?string
    {
        return $this->publishedAt;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }
}