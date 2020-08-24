<?php

namespace App\Http\Requests;

use App\UspdAnalysi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyUspdAnalysiRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('uspd_analysi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:uspd_analysis,id',
        ];
    }
}
