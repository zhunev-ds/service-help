<?php

namespace App\Http\Requests;

use App\VisualInspectionOfAii;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyVisualInspectionOfAiiRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('visual_inspection_of_aii_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:visual_inspection_of_aiis,id',
        ];
    }
}
