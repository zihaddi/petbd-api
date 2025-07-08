<?php

namespace App\Http\Requests\Admin\Appointment;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pet_id' => 'required|exists:pets,id',
            'groomer_profile_id' => 'required|exists:groomer_profiles,id',
            'service_id' => 'required|exists:services,id',
            'scheduled_datetime' => 'required|date|after:now',
            'duration_minutes' => 'required|integer|min:15|max:480',
            'location_type' => 'required|in:in_house,at_organization',
            'customer_notes' => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'pet_id.required' => 'Pet selection is required.',
            'pet_id.exists' => 'Selected pet does not exist.',
            'groomer_profile_id.required' => 'Groomer selection is required.',
            'groomer_profile_id.exists' => 'Selected groomer does not exist.',
            'service_id.required' => 'Service selection is required.',
            'service_id.exists' => 'Selected service does not exist.',
            'scheduled_datetime.required' => 'Appointment date and time is required.',
            'scheduled_datetime.after' => 'Appointment must be scheduled for a future date and time.',
            'duration_minutes.required' => 'Duration is required.',
            'duration_minutes.min' => 'Duration must be at least 15 minutes.',
            'duration_minutes.max' => 'Duration cannot exceed 8 hours.',
            'location_type.required' => 'Location type is required.',
            'location_type.in' => 'Location type must be either in-house or at-organization.',
        ];
    }
}
