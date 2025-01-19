<?php

namespace App\Http\Requests;

use App\Dto\PetDto;
use App\Enums\Status;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'nullable|integer',
            'name' => 'required|string',
            'photoUrls' => 'required|string',
            'status' => ['required', Rule::in(array_column(Status::cases(), 'value'))],
            'category' => 'required|integer',
            'tags' => 'required|array',
        ];
    }

    public function toDto(): PetDto
    {
        $data = $this->validated();

        $categoryId = (int)$data['category'];
        $data['category'] = [
            'id' => $categoryId,
            'name' => Category::find($categoryId)->name,
        ];

        $tags = Tag::whereIn('id', $data['tags'])->get()->pluck('name', 'id')->toArray();
        $data['tags'] = [];
        foreach ($tags as $tagId => $tagName) {
            $data['tags'][] = [
                'id' => $tagId,
                'name' => $tagName,
            ];
        }

        $data['photoUrls'] = explode("\n", str_replace("\r", '', $data['photoUrls']));

        return new PetDto($data);
    }
}
