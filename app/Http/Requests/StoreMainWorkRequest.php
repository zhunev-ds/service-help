<?php

namespace App\Http\Requests;

use App\MainWork;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMainWorkRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('main_work_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'comment' => [
                'string',
                'nullable',
            ],
        ];
    }
}
