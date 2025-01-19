<?php

namespace App\Dto;

readonly class PetDto
{
    public ?int $id;
    public string $name;
    public ?PetCategoryDto $category;
    public ?string $status;
    /** @var PetTagDto[] */
    public array $tags;
    /** @var string[] */
    public array $photoUrls;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'];
        $this->category = isset($data['category']) ? new PetCategoryDto($data['category']) : null;
        $this->status = $data['status'] ?? null;
        $this->photoUrls = $data['photoUrls'];
        $tags = [];
        foreach ($data['tags'] ?? [] as $tag) {
            $tags[] = new PetTagDto($tag);
        }
        $this->tags = $tags;
    }

    public function photoUrlsString(): string
    {
        return implode("\n", $this->photoUrls);
    }

    public function tagsIds(): array
    {
        return array_column($this->tags, 'id');
    }

    public function toArray(): array
    {
        $data = [
            'id' => $this->id,
            'category' => $this->category?->toArray(),
            'name' => $this->name,
            'photoUrls' => $this->photoUrls,
            'tags' => [],
            'status' => $this->status,
        ];
        foreach ($this->tags as $tag) {
            $data['tags'][] = $tag->toArray();
        }

        return $data;
    }
}
