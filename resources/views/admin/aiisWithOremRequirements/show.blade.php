@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.aiisWithOremRequirement.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.aiis-with-orem-requirements.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.aiisWithOremRequirement.fields.id') }}
                        </th>
                        <td>
                            {{ $aiisWithOremRequirement->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aiisWithOremRequirement.fields.data') }}
                        </th>
                        <td>
                            {{ $aiisWithOremRequirement->data }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aiisWithOremRequirement.fields.state_p_313') }}
                        </th>
                        <td>
                            {{ App\AiisWithOremRequirement::STATE_P_313_SELECT[$aiisWithOremRequirement->state_p_313] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aiisWithOremRequirement.fields.state_p_314') }}
                        </th>
                        <td>
                            {{ App\AiisWithOremRequirement::STATE_P_314_SELECT[$aiisWithOremRequirement->state_p_314] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aiisWithOremRequirement.fields.state_p_315') }}
                        </th>
                        <td>
                            {{ App\AiisWithOremRequirement::STATE_P_315_SELECT[$aiisWithOremRequirement->state_p_315] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aiisWithOremRequirement.fields.state_pf_2') }}
                        </th>
                        <td>
                            {{ App\AiisWithOremRequirement::STATE_PF_2_SELECT[$aiisWithOremRequirement->state_pf_2] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aiisWithOremRequirement.fields.state_pf_4') }}
                        </th>
                        <td>
                            {{ App\AiisWithOremRequirement::STATE_PF_4_SELECT[$aiisWithOremRequirement->state_pf_4] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aiisWithOremRequirement.fields.state_pf_7') }}
                        </th>
                        <td>
                            {{ App\AiisWithOremRequirement::STATE_PF_7_SELECT[$aiisWithOremRequirement->state_pf_7] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aiisWithOremRequirement.fields.state_pf_8') }}
                        </th>
                        <td>
                            {{ App\AiisWithOremRequirement::STATE_PF_8_SELECT[$aiisWithOremRequirement->state_pf_8] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aiisWithOremRequirement.fields.state_pf_9') }}
                        </th>
                        <td>
                            {{ App\AiisWithOremRequirement::STATE_PF_9_SELECT[$aiisWithOremRequirement->state_pf_9] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aiisWithOremRequirement.fields.state_pf_10') }}
                        </th>
                        <td>
                            {{ App\AiisWithOremRequirement::STATE_PF_10_SELECT[$aiisWithOremRequirement->state_pf_10] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aiisWithOremRequirement.fields.state_pf_11') }}
                        </th>
                        <td>
                            {{ App\AiisWithOremRequirement::STATE_PF_11_SELECT[$aiisWithOremRequirement->state_pf_11] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aiisWithOremRequirement.fields.state_pf_13') }}
                        </th>
                        <td>
                            {{ App\AiisWithOremRequirement::STATE_PF_13_SELECT[$aiisWithOremRequirement->state_pf_13] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aiisWithOremRequirement.fields.state_pf_16') }}
                        </th>
                        <td>
                            {{ App\AiisWithOremRequirement::STATE_PF_16_SELECT[$aiisWithOremRequirement->state_pf_16] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aiisWithOremRequirement.fields.state_pf_24') }}
                        </th>
                        <td>
                            {{ App\AiisWithOremRequirement::STATE_PF_24_SELECT[$aiisWithOremRequirement->state_pf_24] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aiisWithOremRequirement.fields.state_pf_28') }}
                        </th>
                        <td>
                            {{ App\AiisWithOremRequirement::STATE_PF_28_SELECT[$aiisWithOremRequirement->state_pf_28] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aiisWithOremRequirement.fields.state_pf_32') }}
                        </th>
                        <td>
                            {{ App\AiisWithOremRequirement::STATE_PF_32_SELECT[$aiisWithOremRequirement->state_pf_32] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aiisWithOremRequirement.fields.state_pf_40') }}
                        </th>
                        <td>
                            {{ App\AiisWithOremRequirement::STATE_PF_40_SELECT[$aiisWithOremRequirement->state_pf_40] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aiisWithOremRequirement.fields.state_pf_41') }}
                        </th>
                        <td>
                            {{ App\AiisWithOremRequirement::STATE_PF_41_SELECT[$aiisWithOremRequirement->state_pf_41] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aiisWithOremRequirement.fields.state_pf_42') }}
                        </th>
                        <td>
                            {{ App\AiisWithOremRequirement::STATE_PF_42_SELECT[$aiisWithOremRequirement->state_pf_42] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.aiis-with-orem-requirements.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection