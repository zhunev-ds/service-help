@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.aiisDataCompleteness.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.aiis-data-completenesses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.aiisDataCompleteness.fields.id') }}
                        </th>
                        <td>
                            {{ $aiisDataCompleteness->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aiisDataCompleteness.fields.date') }}
                        </th>
                        <td>
                            {{ $aiisDataCompleteness->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aiisDataCompleteness.fields.state') }}
                        </th>
                        <td>
                            {{ $aiisDataCompleteness->state }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aiisDataCompleteness.fields.description') }}
                        </th>
                        <td>
                            {{ $aiisDataCompleteness->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aiisDataCompleteness.fields.file') }}
                        </th>
                        <td>
                            @if($aiisDataCompleteness->file)
                                <a href="{{ $aiisDataCompleteness->file->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.aiis-data-completenesses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection