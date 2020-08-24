<?php

namespace App\Http\Requests;

use App\ServerAnalysi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateServerAnalysiRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('server_analysi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [];
    }
}
