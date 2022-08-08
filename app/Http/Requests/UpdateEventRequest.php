<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can("discord-admin");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "scheduled_date" => "required|date|after:yesterday",
            "event_title" => "required",
            "item_level" => "nullable|numeric|min:0",
            "player_limit" => "nullable|numeric|min:0",
        ];
    }
}
