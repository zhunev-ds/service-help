<?php

namespace App\Http\Requests;

use App\AiisWithOremRequirement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAiisWithOremRequirementRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('aiis_with_orem_requirement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:aiis_with_orem_requirements,id',
        ];
    }
}
