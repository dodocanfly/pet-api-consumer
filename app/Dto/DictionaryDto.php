<?php

namespace App\Dto;

abstract class DictionaryDto
{
    public readonly int $id;
    public readonly string $name;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
