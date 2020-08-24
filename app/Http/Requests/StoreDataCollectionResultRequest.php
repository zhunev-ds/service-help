<?php

namespace App\Http\Requests;

use App\DataCollectionResult;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDataCollectionResultRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('data_collection_result_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'date' => [
                [
                    'required',
                    'date_format:' . config('panel.date_format'),
                ],
            ],
        ];
    }
}
