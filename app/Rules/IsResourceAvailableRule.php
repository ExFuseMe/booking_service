<?php

namespace App\Rules;

use App\Http\Repositories\BookingRepository;
use Closure;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\ValidationException;

class IsResourceAvailableRule implements Rule
{
    private $start_time;
    private int $resource_id;
    private BookingRepository $bookingRepository;

    public function __construct($start_time, int $resource_id)
    {
        $this->start_time = $start_time ?? now();
        $this->resource_id = $resource_id;
        $this->bookingRepository = new BookingRepository();
    }

    public function passes($attribute, $value): bool
    {
        if ($this->start_time > $value){
            throw ValidationException::withMessages(['Время начала должно быть меньше времени окончания аренды']);
        }
        $result = $this->bookingRepository->isBookingAvailable($this->resource_id, $this->start_time, $value);
        return $result;
    }

    public function message(): string
    {
        return "Ресурс занят в данные временные промежутки";
    }
}
