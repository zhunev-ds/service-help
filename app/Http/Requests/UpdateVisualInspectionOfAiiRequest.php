<?php

namespace App\Http\Requests;

use App\VisualInspectionOfAii;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateVisualInspectionOfAiiRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('visual_inspection_of_aii_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
