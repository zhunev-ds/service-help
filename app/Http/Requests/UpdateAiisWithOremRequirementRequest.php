<?php

namespace App\Http\Requests;

use App\AiisWithOremRequirement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateAiisWithOremRequirementRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('aiis_with_orem_requirement_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'data' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
