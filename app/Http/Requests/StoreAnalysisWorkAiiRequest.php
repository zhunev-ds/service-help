<?php

namespace App\Http\Requests;

use App\AnalysisWorkAii;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAnalysisWorkAiiRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('analysis_work_aii_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [];
    }
}
