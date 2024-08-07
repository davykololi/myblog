<?php

namespace App\Http\Requests\Auth;

use App\Rules\CapitalLetter;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
        if(request()->isMethod('post')){

            return [
                //
                'name' => 'required','string','max:100',new CapitalLetter(),
                'email' => 'required|string|email|max:255|unique:users',
                'password'=>['required','string','confirmed',Password::min(8)->mixedCase()->letters()->numbers()->symbols()->uncompromised()],
                'password_confirmation' => ['required'],
            ];
        } else {
            return [
                'name' => 'required','string','max:100',new CapitalLetter(),
                'email' => 'required|string|email|max:255',
            ];
        }
    }

    public function messages()
    {
        if(request()->isMethod('post')){

            return [
                //
                'name.required' => 'The name is required',
                'email.required' => 'The email address is required',
            ];
        } else {
            return [
                //
                'name.required' => 'The name is required',
                'email.required' => 'The email address is required',
            ];
        }
    }
}
