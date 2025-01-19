<?php

namespace App\Services;

use App\Dto\PetDto;
use App\Enums\Status;
use App\Models\Category;
use App\Models\Tag;
use Exception;
use Illuminate\Support\Facades\Http;

class PetService
{
    public const API_URL = 'https://petstore.swagger.io/v2/';
    public const RESOURCE_PATH = 'pet';

    public function getById(int $id): PetDto
    {
        $response = Http::get(self::API_URL . self::RESOURCE_PATH . '/' . $id)->json();
        $this->checkResponse($response);

        return new PetDto($response);
    }

    public function create(PetDto $pet): int
    {
        $response = Http::post(self::API_URL . self::RESOURCE_PATH, $pet->toArray())->json();
        $this->checkResponse($response);

        return (int)$response['id'];
    }

    public function update(PetDto $pet): int
    {
        $response = Http::put(self::API_URL . self::RESOURCE_PATH, $pet->toArray())->json();
        $this->checkResponse($response);

        return (int)$response['id'];
    }

    public function delete(int $id): void
    {
        $response = Http::delete(self::API_URL . self::RESOURCE_PATH . '/' . $id)->json();
        $this->checkResponse($response);
    }

    public function getMergedCategories(?PetDto $pet = null): array
    {
        $categories = Category::all()->pluck('name', 'id')->toArray();

        if (!empty($pet?->category)) {
            $categories[$pet->category->id] = $pet->category->name;
        }

        return $categories;
    }

    public function getMergedTags(?PetDto $pet = null): array
    {
        $tags = Tag::all()->pluck('name', 'id')->toArray();

        foreach ($pet?->tags ?? [] as $tag) {
            $tags[$tag->id] = $tag->name;
        }

        return $tags;
    }

    public function getStatuses(): array
    {
        return array_column(Status::cases(), 'name', 'value');
    }

    public function getFormData(?PetDto $pet = null): array
    {
        $data = [
            'categories' => $this->getMergedCategories($pet),
            'tags' => $this->getMergedTags($pet),
            'statuses' => $this->getStatuses(),
        ];

        if (!is_null($pet)) {
            $data['pet'] = $pet;
        }

        return $data;
    }

    private function checkResponse(array $response): void
    {
        if ((int)($response['code'] ?? 0) === 1 && ($response['type'] ?? '') === 'error') {
            throw new Exception($response['message']);
        }
    }
}
