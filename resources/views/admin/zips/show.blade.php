@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.zip.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.zips.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.zip.fields.id') }}
                        </th>
                        <td>
                            {{ $zip->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.zip.fields.name') }}
                        </th>
                        <td>
                            {{ $zip->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.zip.fields.count') }}
                        </th>
                        <td>
                            {{ $zip->count }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.zips.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection