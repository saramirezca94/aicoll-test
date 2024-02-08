<?php

namespace App\Http\Requests;

use App\Services\EntityService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class GetEntityRequest extends FormRequest
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

        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function($validator){
            
            $entityService = new EntityService();

            $entity = $entityService->getEntity(request()->route('id'));

            if(is_null($entity))
            {
                $validator->errors()->add('id', 'Entity not found');             
            }

        });
    }

    protected function failedValidation(Validator $validator) {
        $response = [
            'message' => $validator->errors()->first(),
        ];
        throw new HttpResponseException(response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
