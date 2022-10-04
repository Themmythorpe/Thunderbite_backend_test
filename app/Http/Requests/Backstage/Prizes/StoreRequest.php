<?php

namespace App\Http\Requests\Backstage\Prizes;

    use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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

            $rules =  [
                'name' => 'required|max:255',
                'description' => 'sometimes',
                'weight' => 'required|numeric|between:0.01,99.99',
                'starts_at' => 'required|date_format:d-m-Y H:i:s',
                'ends_at' => 'required|date_format:d-m-Y H:i:s',
                'level' => 'required|in:low,med,high',
            ];

            return $rules;
        }

         /**
         * Get Custom Validation Messages
         *
         * @return array Custom Validation Messages
         */
        public function messages(){
            return [

            ];
        }
    }
