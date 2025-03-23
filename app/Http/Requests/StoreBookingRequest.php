<?php

namespace App\Http\Requests;

use App\Rules\IsResourceAvailableRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'resource_id' => ['required', 'exists:resources,id'],
            'start_time' => ['required', 'date', 'after_or_equal:today'],
            'end_time' => ['required', 'date',
                new IsResourceAvailableRule($this->input('start_time'), $this->input('resource_id'))
                ],
        ];
    }
}
