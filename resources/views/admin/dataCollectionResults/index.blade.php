@extends('layouts.admin')
@section('content')
@can('data_collection_result_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.data-collection-results.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.dataCollectionResult.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.dataCollectionResult.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-DataCollectionResult">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <!--<th>-->
                    <!--    {{ trans('cruds.dataCollectionResult.fields.id') }}-->
                    <!--</th>-->
                    <th>
                        {{ trans('cruds.dataCollectionResult.fields.date') }}
                    </th>
                    <th>
                        {{ trans('cruds.dataCollectionResult.fields.change_character') }}
                    </th>
                    <th>
                        {{ trans('cruds.dataCollectionResult.fields.considered_metrological') }}
                    </th>
                    <th>
                        {{ trans('cruds.dataCollectionResult.fields.files') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
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
@can('data_collection_result_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.data-collection-results.massDestroy') }}",
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
    ajax: "{{ route('admin.data-collection-results.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
// { data: 'id', name: 'id' },
{ data: 'date', name: 'date' },
{ data: 'change_character', name: 'change_character' },
{ data: 'considered_metrological', name: 'considered_metrological' },
{ data: 'files', name: 'files', sortable: false, searchable: false },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-DataCollectionResult').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection