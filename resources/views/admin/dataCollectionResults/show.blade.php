@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.dataCollectionResult.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.data-collection-results.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.dataCollectionResult.fields.id') }}
                        </th>
                        <td>
                            {{ $dataCollectionResult->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataCollectionResult.fields.date') }}
                        </th>
                        <td>
                            {{ $dataCollectionResult->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataCollectionResult.fields.change_character') }}
                        </th>
                        <td>
                            {{ $dataCollectionResult->change_character }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataCollectionResult.fields.considered_metrological') }}
                        </th>
                        <td>
                            {{ App\DataCollectionResult::CONSIDERED_METROLOGICAL_RADIO[$dataCollectionResult->considered_metrological] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataCollectionResult.fields.files') }}
                        </th>
                        <td>
                            @foreach($dataCollectionResult->files as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.data-collection-results.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection