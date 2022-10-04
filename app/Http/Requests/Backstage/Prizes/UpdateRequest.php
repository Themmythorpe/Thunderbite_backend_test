<?php

namespace App\Http\Requests\Backstage\Prizes;

    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Validation\Rule;


    class UpdateRequest extends FormRequest
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
           return  [
                    'name' => 'required|max:255',
                    'description' => 'sometimes',
                    'weight' => 'required|numeric|between:0.01,99.99',
                    'level' => 'required|in:low,med,high',
                    'starts_at' => 'required|date',
                    'ends_at' => 'required|date',
            ];

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
