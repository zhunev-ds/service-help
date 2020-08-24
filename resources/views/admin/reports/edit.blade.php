@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.report.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.reports.update", [$report->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="quarter">{{ trans('cruds.report.fields.quarter') }}</label>
                <input class="form-control {{ $errors->has('quarter') ? 'is-invalid' : '' }}" type="text" name="quarter" id="quarter" value="{{ old('quarter', $report->quarter) }}" required>
                @if($errors->has('quarter'))
                    <span class="text-danger">{{ $errors->first('quarter') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.quarter_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="responsible_id">{{ trans('cruds.report.fields.responsible') }}</label>
                <select class="form-control select2 {{ $errors->has('responsible') ? 'is-invalid' : '' }}" name="responsible_id" id="responsible_id">
                    @foreach($responsibles as $id => $responsible)
                        <option value="{{ $id }}" {{ ($report->responsible ? $report->responsible->id : old('responsible_id')) == $id ? 'selected' : '' }}>{{ $responsible }}</option>
                    @endforeach
                </select>
                @if($errors->has('responsible'))
                    <span class="text-danger">{{ $errors->first('responsible') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.responsible_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="brigades">{{ trans('cruds.report.fields.brigade') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('brigades') ? 'is-invalid' : '' }}" name="brigades[]" id="brigades" multiple>
                    @foreach($brigades as $id => $brigade)
                        <option value="{{ $id }}" {{ (in_array($id, old('brigades', [])) || $report->brigades->contains($id)) ? 'selected' : '' }}>{{ $brigade }}</option>
                    @endforeach
                </select>
                @if($errors->has('brigades'))
                    <span class="text-danger">{{ $errors->first('brigades') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.brigade_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="recommendations">{{ trans('cruds.report.fields.recommendations') }}</label>
                <textarea class="form-control {{ $errors->has('recommendations') ? 'is-invalid' : '' }}" name="recommendations" id="recommendations">{{ old('recommendations', $report->recommendations) }}</textarea>
                @if($errors->has('recommendations'))
                    <span class="text-danger">{{ $errors->first('recommendations') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.recommendations_helper') }}</span>
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