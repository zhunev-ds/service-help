<?php

namespace App\Http\Requests;

use App\AiisDocumentationUpdate;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAiisDocumentationUpdateRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('aiis_documentation_update_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:aiis_documentation_updates,id',
        ];
    }
}
