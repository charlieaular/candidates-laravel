<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Src\Shared\Domain\ValueObjects\Role;

class CreateLeadRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {

        $currentUser = auth()->user();
        $isCurrentUserManager = Role::from($currentUser->role) == Role::Manager;

        return $isCurrentUserManager;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() {
        return [
            "name" => "required",
            "source" => "required",
            "owner" => "required|exists:users,id",
        ];
    }

    public function messages() {
        return [
            "owner.exists" => "Owner does not exists"
        ];
    }
}
