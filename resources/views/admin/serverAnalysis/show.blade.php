@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.serverAnalysi.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.server-analysis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.serverAnalysi.fields.id') }}
                        </th>
                        <td>
                            {{ $serverAnalysi->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.serverAnalysi.fields.quarter') }}
                        </th>
                        <td>
                            {{ $serverAnalysi->quarter->quarter ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.serverAnalysi.fields.result') }}
                        </th>
                        <td>
                            {{ $serverAnalysi->result }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.serverAnalysi.fields.files') }}
                        </th>
                        <td>
                            @foreach($serverAnalysi->files as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.server-analysis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection