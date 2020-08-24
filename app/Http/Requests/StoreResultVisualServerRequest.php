<?php

namespace App\Http\Requests;

use App\ResultVisualServer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreResultVisualServerRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('result_visual_server_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [];
    }
}
