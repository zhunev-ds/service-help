<?php

namespace App\Http\Requests;

use App\Mpoint;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMpointRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('mpoint_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
