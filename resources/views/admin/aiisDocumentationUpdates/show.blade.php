@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.aiisDocumentationUpdate.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.aiis-documentation-updates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.aiisDocumentationUpdate.fields.id') }}
                        </th>
                        <td>
                            {{ $aiisDocumentationUpdate->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aiisDocumentationUpdate.fields.year') }}
                        </th>
                        <td>
                            {{ $aiisDocumentationUpdate->year }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aiisDocumentationUpdate.fields.verification_si') }}
                        </th>
                        <td>
                            @foreach($aiisDocumentationUpdate->verification_si as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aiisDocumentationUpdate.fields.verification_aiis') }}
                        </th>
                        <td>
                            @foreach($aiisDocumentationUpdate->verification_aiis as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aiisDocumentationUpdate.fields.actual_metr_data') }}
                        </th>
                        <td>
                            {{ $aiisDocumentationUpdate->actual_metr_data }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aiisDocumentationUpdate.fields.mapping') }}
                        </th>
                        <td>
                            {{ $aiisDocumentationUpdate->mapping }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.aiis-documentation-updates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection