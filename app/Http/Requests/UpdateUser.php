<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdateUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'profile' => 'nullable|max:1999',
            'Fname'=>'nullable|max:190',
            'Lname'=>'nullable|max:190',
            'old-password'=>'nullable',
            'password'     => 'nullable|min:6|max:190|required_with:old-password|confirmed',
        ];
    }


     /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        // checks user current password
        // before making changes
        $validator->after(function ($validator) {

            if ($this->{'old-password'} && !Hash::check($this->{'old-password'}, $this->user()->password) ) {
                $validator->errors()->add('old-password', 'Your password is incorrect.');
            }
        });
        return;
    }

}
