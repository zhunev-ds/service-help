<?php

namespace App\Http\Requests;

use App\MonitoringStatusOfMd;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMonitoringStatusOfMdRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('monitoring_status_of_md_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:monitoring_status_of_mds,id',
        ];
    }
}
