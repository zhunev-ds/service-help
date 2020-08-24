@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('cruds.aiisDocumentationUpdateU.title') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-AiisDocumentationUpdate">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <!--<th>-->
                    <!--    {{ trans('cruds.aiisDocumentationUpdate.fields.id') }}-->
                    <!--</th>-->
                    <th>
                        {{ trans('cruds.aiisDocumentationUpdate.fields.year') }}
                    </th>
                    <th>
                        {{ trans('cruds.aiisDocumentationUpdate.fields.verification_si') }}
                    </th>
                    <th>
                        {{ trans('cruds.aiisDocumentationUpdate.fields.verification_aiis') }}
                    </th>
                    <th>
                        {{ trans('cruds.aiisDocumentationUpdate.fields.actual_metr_data') }}
                    </th>
                    <th>
                        {{ trans('cruds.aiisDocumentationUpdate.fields.mapping') }}
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
@can('aiis_documentation_update_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.aiis-documentation-updates.massDestroy') }}",
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
    ajax: "{{ route('admin.aiis-documentation-updates.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
// { data: 'id', name: 'id' },
{ data: 'year', name: 'year' },
{ data: 'verification_si', name: 'verification_si', sortable: false, searchable: false },
{ data: 'verification_aiis', name: 'verification_aiis', sortable: false, searchable: false },
{ data: 'actual_metr_data', name: 'actual_metr_data' },
{ data: 'mapping', name: 'mapping' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-AiisDocumentationUpdate').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection
