<?php

namespace App\Http\Requests;

use App\AiisDataCompleteness;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAiisDataCompletenessRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('aiis_data_completeness_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:aiis_data_completenesses,id',
        ];
    }
}
