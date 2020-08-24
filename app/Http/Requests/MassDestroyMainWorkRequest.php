<?php

namespace App\Http\Requests;

use App\MainWork;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMainWorkRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('main_work_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:main_works,id',
        ];
    }
}
