@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.monitoringStatusOfMd.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.monitoring-status-of-mds.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.monitoringStatusOfMd.fields.id') }}
                        </th>
                        <td>
                            {{ $monitoringStatusOfMd->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.monitoringStatusOfMd.fields.quarter') }}
                        </th>
                        <td>
                            {{ $monitoringStatusOfMd->quarter->quarter ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.monitoringStatusOfMd.fields.point') }}
                        </th>
                        <td>
                            {{ $monitoringStatusOfMd->point->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.monitoringStatusOfMd.fields.result') }}
                        </th>
                        <td>
                            {{ $monitoringStatusOfMd->result }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.monitoringStatusOfMd.fields.files') }}
                        </th>
                        <td>
                            @foreach($monitoringStatusOfMd->files as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.monitoring-status-of-mds.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection