<?php

namespace App\Http\Requests\Employer;

use App\Models\Job;
use Illuminate\Foundation\Http\FormRequest;

class CreateJobRequest extends FormRequest
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
        $rules = Job::$rules;

        $rules['skills'] = 'required|array';
        $rules['skills.*'] = 'required|exists:skills,id';
        $rules['branch_id'] = 'nullable|exists:branches,id';
        $rules['country_id'] = 'required_if:branch_id,null|exists:countries,id';
        $rules['city_id'] = 'required_if:branch_id,null|exists:cities,id';
        $rules['address'] = 'required_if:branch_id,null|string';
        
        return $rules;
    }
}
