<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectsRequest extends FormRequest
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
            'client_id' => ['required', 'exists:clients,id'],
            // 'unique_number' => ['required', 'string', 'max:255', 'unique:projects,unique_number'],
            'contract_number' => ['required', 'string', 'max:255', 'unique:projects,contract_number'],
            'name' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'street' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'scope' => ['required', new Enum(ProjectScope::class)],
            'sector' => ['required', new Enum(ProjectSector::class)],
            'status' => ['required', new Enum(ProjectStatus::class)],
            'installation_scheduled_at' => ['nullable', 'date'],
            'installation_completed_at' => ['nullable', 'date', 'after_or_equal:installation_scheduled_at'],
        ];
    }
}
