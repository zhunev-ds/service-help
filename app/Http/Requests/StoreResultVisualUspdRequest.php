<?php

namespace App\Http\Requests;

use App\ResultVisualUspd;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreResultVisualUspdRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('result_visual_uspd_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [];
    }
}
