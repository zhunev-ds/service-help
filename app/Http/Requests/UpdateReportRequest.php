<?php

namespace App\Http\Requests;

use App\Report;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateReportRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('report_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'quarter'    => [
                'string',
                'required',
            ],
            'brigades.*' => [
                'integer',
            ],
            'brigades'   => [
                'array',
            ],
        ];
    }
}
