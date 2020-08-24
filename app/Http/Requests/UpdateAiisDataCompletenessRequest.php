<?php

namespace App\Http\Requests;

use App\AiisDataCompleteness;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateAiisDataCompletenessRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('aiis_data_completeness_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'date'  => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'state' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
