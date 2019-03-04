<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnquiryFormRequest extends FormRequest
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
    'firstname' => 'required',
    'lastname' => 'required',
    'phone' => 'required',
    'email' => 'required|email',
    'nationality' => 'required',
    'location' => 'required',
    'destination' => 'required',
    'pathway' => 'required',
    'subject' => 'required',
    'source' => 'required'
     ];
    }

    public static  $messages=array(
         'email.unique'=>'There is already an enquiry with this email id ',
         'phone.unique'=>'There is already an enquiry with this mobile number',
        );

}
