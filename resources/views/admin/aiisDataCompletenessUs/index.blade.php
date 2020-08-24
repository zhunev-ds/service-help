@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-12 col-1">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Информация о полноте сбора данных в АИИС</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row" style="margin-bottom: 10px;">
                        @foreach($aiisDatas as $aiisData)
                            <div class="col-lg-4 col-6">
                                <!-- small box -->
                                @if ($aiisData->state == 100)
                                    <div class="small-box bg-success">
                                        <div class="inner">
                                            <h3>{{$aiisData->state}}<sup style="font-size: 20px">%</sup></h3>
                                            <p>Сбор данных в АИИС за {{$aiisData->date}}</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-stats-bars"></i>
                                        </div>
                                    </div>
                                @else
                                    <div class="small-box bg-warning">
                                        <div class="inner">
                                            <h3>{{$aiisData->state}}<sup style="font-size: 20px">%</sup></h3>
                                            <p>Сбор данных в АИИС за {{$aiisData->date}}</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-stats-bars"></i>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <!-- ./col bg-warning -->
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.aiisDataCompletenessU.title') }}
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-AiisDataCompleteness">
                <thead>
                <tr>
                    <th width="10">

                    </th>
                    <!--<th>-->
                    <!--    {{ trans('cruds.aiisDataCompleteness.fields.id') }}-->
                    <!--</th>-->
                    <th>
                        {{ trans('cruds.aiisDataCompleteness.fields.date') }}
                    </th>
                    <th>
                        {{ trans('cruds.aiisDataCompleteness.fields.state') }}
                    </th>
                    <th>
                        {{ trans('cruds.aiisDataCompleteness.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.aiisDataCompleteness.fields.file') }}
                    </th>
{{--                    <th>--}}
{{--                        &nbsp;--}}
{{--                    </th>--}}
                </tr>
                </thead>
            </table>
        </div>
    </div>



@endsection
@section('scripts')
    @parent
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('aiis_data_completeness_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.aiis-data-completenesses.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
                        return entry.id
                    });

                    if (ids.length === 0) {
                        alert('{{ trans('global.datatables.zero_selected') }}')

                        return
                    }

                    if (confirm('{{ trans('global.areYouSure') }}')) {
                        $.ajax({
                            headers: {'x-csrf-token': _token},
                            method: 'POST',
                            url: config.url,
                            data: { ids: ids, _method: 'DELETE' }})
                            .done(function () { location.reload() })
                    }
                }
            }
            dtButtons.push(deleteButton)
            @endcan

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.aiis-data-completenesses.index') }}",
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    // { data: 'id', name: 'id' },
                    { data: 'date', name: 'date' },
                    { data: 'state', name: 'state' },
                    { data: 'description', name: 'description' },
                    { data: 'file', name: 'file', sortable: false, searchable: false },
                    {{--{ data: 'actions', name: '{{ trans('global.actions') }}' }--}}
                ],
                orderCellsTop: true,
                order: [[ 1, 'desc' ]],
                pageLength: 100,
            };
            let table = $('.datatable-AiisDataCompleteness').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        });

    </script>
@endsection
