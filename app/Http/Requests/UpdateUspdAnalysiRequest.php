<?php

namespace App\Http\Requests;

use App\UspdAnalysi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUspdAnalysiRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('uspd_analysi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [];
    }
}
