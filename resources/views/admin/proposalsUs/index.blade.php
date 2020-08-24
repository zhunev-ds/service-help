@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.proposalsU.title') }}
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Proposal">
                <thead>
                <tr>
                    <th width="10">

                    </th>
                    <!--<th>-->
                    <!--    {{ trans('cruds.proposal.fields.id') }}-->
                    <!--</th>-->
                    <th>
                        {{ trans('cruds.proposal.fields.title') }}
                    </th>
                    <th>
                        {{ trans('cruds.proposal.fields.date') }}
                    </th>
                    <th>
                        {{ trans('cruds.proposal.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.proposal.fields.files') }}
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
            @can('proposal_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.proposals.massDestroy') }}",
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
                ajax: "{{ route('admin.proposals.index') }}",
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    // { data: 'id', name: 'id' },
                    { data: 'title', name: 'title' },
                    { data: 'date', name: 'date' },
                    { data: 'description', name: 'description' },
                    { data: 'files', name: 'files', sortable: false, searchable: false },
                    {{--{ data: 'actions', name: '{{ trans('global.actions') }}' }--}}
                ],
                orderCellsTop: true,
                order: [[ 1, 'desc' ]],
                pageLength: 100,
            };
            let table = $('.datatable-Proposal').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        });

    </script>
@endsection
