<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeAttendanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'staff_id' => $this->staff_id,
            'name' => $this->staff->firstname . ' ' . $this->staff->lastname,
            'gender' => $this->staff->gender,
            'contact_no' => $this->staff->contact_no,
            'email' => $this->staff->email,
            'date' => $this->date,
            'in' => $this->in ? $this->in->format('H:m:s') : null, // Corrected time format
            'out' => $this->out ? $this->out->format('H:m:s') : null, // Corrected time format
        ];
    }
}
