<?php

namespace App\Http\Requests;

use App\DataCollectionResult;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDataCollectionResultRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('data_collection_result_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:data_collection_results,id',
        ];
    }
}
