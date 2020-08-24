@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.tasksCalendar.title') }}
    </div>

    <div class="card-body">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css" />
        <div id="calendar"></div>

    </div>
</div>



@endsection

@section('scripts')
@parent
<link href='/js/fullcalendar/fullcalendar.css' rel='stylesheet'/>
<script src='/js/fullcalendar/fullcalendar.js'></script>
<script src='/js/fullcalendar/locale/ru.js'></script>
<script>
    $(document).ready(function() {
            // page is now ready, initialize the calendar...
            locale: 'ru'
            $('#calendar').fullCalendar({
                // put your options and callbacks here
                events : [
                        @foreach($events as $event)
                        @if($event->due_date && $event->type == "pto")
                    {
                        title : '{{ $event->name }}',
                        start : '{{ \Carbon\Carbon::createFromFormat(config('panel.date_format'),$event->due_date)->format('Y-m-d') }}',
                        end : '{{ \Carbon\Carbon::createFromFormat(config('panel.date_format'),$event->end_date)->modify('+1 day')->format('Y-m-d') }}',
                        url : '{{ url('admin/tasks').'/'.$event->id.'/' }}',
                        color: '#257e4a'
                    },
                        @endif
                        @if($event->due_date && $event->type == "void")
                    {
                        title : '{{ $event->name }}',
                        start : '{{ \Carbon\Carbon::createFromFormat(config('panel.date_format'),$event->due_date)->format('Y-m-d') }}',
                        end : '{{ \Carbon\Carbon::createFromFormat(config('panel.date_format'),$event->end_date)->modify('+1 day')->format('Y-m-d') }}',
                        url : '{{ url('admin/tasks').'/'.$event->id.'/' }}',
                        color: '#911e1e'
                    },
                    @endif
                    @endforeach
                ]
            })
        });
</script>

@stop
