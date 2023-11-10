<?php

namespace App\Models;

class Article{
    private ?string $title;
    private ?string $description;
    private ?string $image;
    public function __construct(
        ?string $title,
        ?string $description,
        ?string $image
    )
    {
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
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
}