<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReqest extends FormRequest
{
    /*

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'nullable|string',
            'content' => 'nullable|string',
            'image_id'=>'nullable|int|exists:post_images,id',
        ];
    }
    protected function passedValidation()
    {
        $this->merge([
            'user_id' => auth()->id(),
        ]);
    }
}
