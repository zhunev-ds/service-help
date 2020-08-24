@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.journalVoiar.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" onclick="javascript:history.back();">
                    Назад
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
{{--                    <tr>--}}
{{--                        <th>--}}
{{--                            {{ trans('cruds.task.fields.id') }}--}}
{{--                        </th>--}}
{{--                        <td>--}}
{{--                            {{ $task->id }}--}}
{{--                        </td>--}}
{{--                    </tr>--}}
                    <tr>
                        <th>
                            {{ trans('cruds.task.fields.name') }}
                        </th>
                        <td>
                            {{ $task->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.task.fields.description') }}
                        </th>
                        <td>
                            {{ $task->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.task.fields.assigned_to') }}
                        </th>
                        <td>
                            {{ $task->assigned_to->surname ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.task.fields.due_date') }}
                        </th>
                        <td>
                            {{ $task->due_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.task.fields.end_date') }}
                        </th>
                        <td>
                            {{ $task->end_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.task.fields.type') }}
                        </th>
                        <td>
                            {{ App\Task::TYPE_SELECT[$task->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.task.fields.tag') }}
                        </th>
                        <td>
                            @foreach($task->tags as $key => $tag)
                                <span class="label label-info">{{ $tag->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.task.fields.status') }}
                        </th>
                        <td>
                            {{ $task->status->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.task.fields.attachment') }}
                        </th>
                        <td>
                            @foreach($task->attachment as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" onclick="javascript:history.back();">
                    Назад
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
