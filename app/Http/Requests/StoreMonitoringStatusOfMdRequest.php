<?php

namespace App\Http\Requests;

use App\MonitoringStatusOfMd;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMonitoringStatusOfMdRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('monitoring_status_of_md_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'quarter_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
