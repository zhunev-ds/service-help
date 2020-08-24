<?php

namespace App\Http\Requests;

use App\AiisDocumentationUpdate;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAiisDocumentationUpdateRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('aiis_documentation_update_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'date'             => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'actual_metr_data' => [
                'string',
                'nullable',
            ],
            'mapping'          => [
                'string',
                'nullable',
            ],
        ];
    }
}
