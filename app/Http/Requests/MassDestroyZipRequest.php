<?php

namespace App\Http\Requests;

use App\Zip;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyZipRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('zip_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:zips,id',
        ];
    }
}
