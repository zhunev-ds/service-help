@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.aiisWithOremRequirement.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.aiis-with-orem-requirements.update", [$aiisWithOremRequirement->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="data">{{ trans('cruds.aiisWithOremRequirement.fields.data') }}</label>
                <input class="form-control date {{ $errors->has('data') ? 'is-invalid' : '' }}" type="text" name="data" id="data" value="{{ old('data', $aiisWithOremRequirement->data) }}" required>
                @if($errors->has('data'))
                    <span class="text-danger">{{ $errors->first('data') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aiisWithOremRequirement.fields.data_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.aiisWithOremRequirement.fields.state_p_313') }}</label>
                <select class="form-control {{ $errors->has('state_p_313') ? 'is-invalid' : '' }}" name="state_p_313" id="state_p_313">
                    <option value disabled {{ old('state_p_313', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\AiisWithOremRequirement::STATE_P_313_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('state_p_313', $aiisWithOremRequirement->state_p_313) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('state_p_313'))
                    <span class="text-danger">{{ $errors->first('state_p_313') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aiisWithOremRequirement.fields.state_p_313_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.aiisWithOremRequirement.fields.state_p_314') }}</label>
                <select class="form-control {{ $errors->has('state_p_314') ? 'is-invalid' : '' }}" name="state_p_314" id="state_p_314">
                    <option value disabled {{ old('state_p_314', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\AiisWithOremRequirement::STATE_P_314_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('state_p_314', $aiisWithOremRequirement->state_p_314) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('state_p_314'))
                    <span class="text-danger">{{ $errors->first('state_p_314') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aiisWithOremRequirement.fields.state_p_314_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.aiisWithOremRequirement.fields.state_p_315') }}</label>
                <select class="form-control {{ $errors->has('state_p_315') ? 'is-invalid' : '' }}" name="state_p_315" id="state_p_315">
                    <option value disabled {{ old('state_p_315', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\AiisWithOremRequirement::STATE_P_315_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('state_p_315', $aiisWithOremRequirement->state_p_315) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('state_p_315'))
                    <span class="text-danger">{{ $errors->first('state_p_315') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aiisWithOremRequirement.fields.state_p_315_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.aiisWithOremRequirement.fields.state_pf_2') }}</label>
                <select class="form-control {{ $errors->has('state_pf_2') ? 'is-invalid' : '' }}" name="state_pf_2" id="state_pf_2">
                    <option value disabled {{ old('state_pf_2', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\AiisWithOremRequirement::STATE_PF_2_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('state_pf_2', $aiisWithOremRequirement->state_pf_2) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('state_pf_2'))
                    <span class="text-danger">{{ $errors->first('state_pf_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aiisWithOremRequirement.fields.state_pf_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.aiisWithOremRequirement.fields.state_pf_4') }}</label>
                <select class="form-control {{ $errors->has('state_pf_4') ? 'is-invalid' : '' }}" name="state_pf_4" id="state_pf_4">
                    <option value disabled {{ old('state_pf_4', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\AiisWithOremRequirement::STATE_PF_4_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('state_pf_4', $aiisWithOremRequirement->state_pf_4) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('state_pf_4'))
                    <span class="text-danger">{{ $errors->first('state_pf_4') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aiisWithOremRequirement.fields.state_pf_4_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.aiisWithOremRequirement.fields.state_pf_7') }}</label>
                <select class="form-control {{ $errors->has('state_pf_7') ? 'is-invalid' : '' }}" name="state_pf_7" id="state_pf_7">
                    <option value disabled {{ old('state_pf_7', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\AiisWithOremRequirement::STATE_PF_7_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('state_pf_7', $aiisWithOremRequirement->state_pf_7) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('state_pf_7'))
                    <span class="text-danger">{{ $errors->first('state_pf_7') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aiisWithOremRequirement.fields.state_pf_7_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.aiisWithOremRequirement.fields.state_pf_8') }}</label>
                <select class="form-control {{ $errors->has('state_pf_8') ? 'is-invalid' : '' }}" name="state_pf_8" id="state_pf_8">
                    <option value disabled {{ old('state_pf_8', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\AiisWithOremRequirement::STATE_PF_8_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('state_pf_8', $aiisWithOremRequirement->state_pf_8) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('state_pf_8'))
                    <span class="text-danger">{{ $errors->first('state_pf_8') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aiisWithOremRequirement.fields.state_pf_8_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.aiisWithOremRequirement.fields.state_pf_9') }}</label>
                <select class="form-control {{ $errors->has('state_pf_9') ? 'is-invalid' : '' }}" name="state_pf_9" id="state_pf_9">
                    <option value disabled {{ old('state_pf_9', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\AiisWithOremRequirement::STATE_PF_9_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('state_pf_9', $aiisWithOremRequirement->state_pf_9) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('state_pf_9'))
                    <span class="text-danger">{{ $errors->first('state_pf_9') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aiisWithOremRequirement.fields.state_pf_9_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.aiisWithOremRequirement.fields.state_pf_10') }}</label>
                <select class="form-control {{ $errors->has('state_pf_10') ? 'is-invalid' : '' }}" name="state_pf_10" id="state_pf_10">
                    <option value disabled {{ old('state_pf_10', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\AiisWithOremRequirement::STATE_PF_10_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('state_pf_10', $aiisWithOremRequirement->state_pf_10) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('state_pf_10'))
                    <span class="text-danger">{{ $errors->first('state_pf_10') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aiisWithOremRequirement.fields.state_pf_10_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.aiisWithOremRequirement.fields.state_pf_11') }}</label>
                <select class="form-control {{ $errors->has('state_pf_11') ? 'is-invalid' : '' }}" name="state_pf_11" id="state_pf_11">
                    <option value disabled {{ old('state_pf_11', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\AiisWithOremRequirement::STATE_PF_11_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('state_pf_11', $aiisWithOremRequirement->state_pf_11) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('state_pf_11'))
                    <span class="text-danger">{{ $errors->first('state_pf_11') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aiisWithOremRequirement.fields.state_pf_11_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.aiisWithOremRequirement.fields.state_pf_13') }}</label>
                <select class="form-control {{ $errors->has('state_pf_13') ? 'is-invalid' : '' }}" name="state_pf_13" id="state_pf_13">
                    <option value disabled {{ old('state_pf_13', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\AiisWithOremRequirement::STATE_PF_13_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('state_pf_13', $aiisWithOremRequirement->state_pf_13) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('state_pf_13'))
                    <span class="text-danger">{{ $errors->first('state_pf_13') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aiisWithOremRequirement.fields.state_pf_13_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.aiisWithOremRequirement.fields.state_pf_16') }}</label>
                <select class="form-control {{ $errors->has('state_pf_16') ? 'is-invalid' : '' }}" name="state_pf_16" id="state_pf_16">
                    <option value disabled {{ old('state_pf_16', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\AiisWithOremRequirement::STATE_PF_16_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('state_pf_16', $aiisWithOremRequirement->state_pf_16) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('state_pf_16'))
                    <span class="text-danger">{{ $errors->first('state_pf_16') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aiisWithOremRequirement.fields.state_pf_16_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.aiisWithOremRequirement.fields.state_pf_24') }}</label>
                <select class="form-control {{ $errors->has('state_pf_24') ? 'is-invalid' : '' }}" name="state_pf_24" id="state_pf_24">
                    <option value disabled {{ old('state_pf_24', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\AiisWithOremRequirement::STATE_PF_24_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('state_pf_24', $aiisWithOremRequirement->state_pf_24) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('state_pf_24'))
                    <span class="text-danger">{{ $errors->first('state_pf_24') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aiisWithOremRequirement.fields.state_pf_24_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.aiisWithOremRequirement.fields.state_pf_28') }}</label>
                <select class="form-control {{ $errors->has('state_pf_28') ? 'is-invalid' : '' }}" name="state_pf_28" id="state_pf_28">
                    <option value disabled {{ old('state_pf_28', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\AiisWithOremRequirement::STATE_PF_28_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('state_pf_28', $aiisWithOremRequirement->state_pf_28) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('state_pf_28'))
                    <span class="text-danger">{{ $errors->first('state_pf_28') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aiisWithOremRequirement.fields.state_pf_28_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.aiisWithOremRequirement.fields.state_pf_32') }}</label>
                <select class="form-control {{ $errors->has('state_pf_32') ? 'is-invalid' : '' }}" name="state_pf_32" id="state_pf_32">
                    <option value disabled {{ old('state_pf_32', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\AiisWithOremRequirement::STATE_PF_32_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('state_pf_32', $aiisWithOremRequirement->state_pf_32) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('state_pf_32'))
                    <span class="text-danger">{{ $errors->first('state_pf_32') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aiisWithOremRequirement.fields.state_pf_32_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.aiisWithOremRequirement.fields.state_pf_40') }}</label>
                <select class="form-control {{ $errors->has('state_pf_40') ? 'is-invalid' : '' }}" name="state_pf_40" id="state_pf_40">
                    <option value disabled {{ old('state_pf_40', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\AiisWithOremRequirement::STATE_PF_40_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('state_pf_40', $aiisWithOremRequirement->state_pf_40) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('state_pf_40'))
                    <span class="text-danger">{{ $errors->first('state_pf_40') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aiisWithOremRequirement.fields.state_pf_40_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.aiisWithOremRequirement.fields.state_pf_41') }}</label>
                <select class="form-control {{ $errors->has('state_pf_41') ? 'is-invalid' : '' }}" name="state_pf_41" id="state_pf_41">
                    <option value disabled {{ old('state_pf_41', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\AiisWithOremRequirement::STATE_PF_41_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('state_pf_41', $aiisWithOremRequirement->state_pf_41) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('state_pf_41'))
                    <span class="text-danger">{{ $errors->first('state_pf_41') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aiisWithOremRequirement.fields.state_pf_41_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.aiisWithOremRequirement.fields.state_pf_42') }}</label>
                <select class="form-control {{ $errors->has('state_pf_42') ? 'is-invalid' : '' }}" name="state_pf_42" id="state_pf_42">
                    <option value disabled {{ old('state_pf_42', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\AiisWithOremRequirement::STATE_PF_42_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('state_pf_42', $aiisWithOremRequirement->state_pf_42) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('state_pf_42'))
                    <span class="text-danger">{{ $errors->first('state_pf_42') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aiisWithOremRequirement.fields.state_pf_42_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection