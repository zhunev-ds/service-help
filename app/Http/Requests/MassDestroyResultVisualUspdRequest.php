<?php

namespace App\Http\Requests;

use App\ResultVisualUspd;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyResultVisualUspdRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('result_visual_uspd_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:result_visual_uspds,id',
        ];
    }
}
