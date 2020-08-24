@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.resultVisualServer.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.result-visual-servers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.resultVisualServer.fields.id') }}
                        </th>
                        <td>
                            {{ $resultVisualServer->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.resultVisualServer.fields.quarter') }}
                        </th>
                        <td>
                            {{ $resultVisualServer->quarter->quarter ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.resultVisualServer.fields.resut') }}
                        </th>
                        <td>
                            {{ $resultVisualServer->resut }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.resultVisualServer.fields.photo') }}
                        </th>
                        <td>
                            @foreach($resultVisualServer->photo as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.result-visual-servers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection