<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class login extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|password',
            'is_active' => 'required|1',
        ];
    }
    public function messages()
    {
      return [
        'email.required' => 'мэйл хаягаа оруулна уу',
        'email.email' => 'мэйл хаяг буруу байна',
        'password.required' => 'нууц үгээ оруулна уу',
        'password.password' => 'нууц үгээ оруулна',
        'is_active.0' => 'Тань эрх идэвхжээгүй байна. Менежерт хандана уу.' 

      ];
    }
}
