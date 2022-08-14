<?php

namespace App\Http\Requests;

use App\Enum\CharacterClassEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreCharacterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "in_game_name" => "required|unique:characters|max:255",
            "item_level" => "required|numeric|min:50",
            "class" => ["required", new Enum(CharacterClassEnum::class)]
        ];
    }
}
