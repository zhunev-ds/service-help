<?php

namespace App\Http\Requests;

use App\ServerAnalysi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyServerAnalysiRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('server_analysi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:server_analysis,id',
        ];
    }
}
