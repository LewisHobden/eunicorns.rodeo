<?php

namespace App\Http\Requests;

use App\Enum\CharacterClassEnum;
use App\Enum\EventTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can("manage-discord");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "event_title" => "required",
            "event_type" => ["required", new Enum(EventTypeEnum::class)],
            "item_level" => "nullable|numeric|min:0",
            "player_limit" => "nullable|numeric|min:0",
        ];
    }
}
