@extends('layouts.admin')
@section('content')
@can('aiis_with_orem_requirement_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.aiis-with-orem-requirements.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.aiisWithOremRequirement.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.aiisWithOremRequirement.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-AiisWithOremRequirement">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <!--<th>-->
                    <!--    {{ trans('cruds.aiisWithOremRequirement.fields.id') }}-->
                    <!--</th>-->
                    <th>
                        {{ trans('cruds.aiisWithOremRequirement.fields.data') }}
                    </th>
                    <th>
                        {{ trans('cruds.aiisWithOremRequirement.fields.state_p_313') }}
                    </th>
                    <th>
                        {{ trans('cruds.aiisWithOremRequirement.fields.state_p_314') }}
                    </th>
                    <th>
                        {{ trans('cruds.aiisWithOremRequirement.fields.state_p_315') }}
                    </th>
                    <th>
                        {{ trans('cruds.aiisWithOremRequirement.fields.state_pf_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.aiisWithOremRequirement.fields.state_pf_4') }}
                    </th>
                    <th>
                        {{ trans('cruds.aiisWithOremRequirement.fields.state_pf_7') }}
                    </th>
                    <th>
                        {{ trans('cruds.aiisWithOremRequirement.fields.state_pf_8') }}
                    </th>
                    <th>
                        {{ trans('cruds.aiisWithOremRequirement.fields.state_pf_9') }}
                    </th>
                    <th>
                        {{ trans('cruds.aiisWithOremRequirement.fields.state_pf_10') }}
                    </th>
                    <th>
                        {{ trans('cruds.aiisWithOremRequirement.fields.state_pf_11') }}
                    </th>
                    <th>
                        {{ trans('cruds.aiisWithOremRequirement.fields.state_pf_13') }}
                    </th>
                    <th>
                        {{ trans('cruds.aiisWithOremRequirement.fields.state_pf_16') }}
                    </th>
                    <th>
                        {{ trans('cruds.aiisWithOremRequirement.fields.state_pf_24') }}
                    </th>
                    <th>
                        {{ trans('cruds.aiisWithOremRequirement.fields.state_pf_28') }}
                    </th>
                    <th>
                        {{ trans('cruds.aiisWithOremRequirement.fields.state_pf_32') }}
                    </th>
                    <th>
                        {{ trans('cruds.aiisWithOremRequirement.fields.state_pf_40') }}
                    </th>
                    <th>
                        {{ trans('cruds.aiisWithOremRequirement.fields.state_pf_41') }}
                    </th>
                    <th>
                        {{ trans('cruds.aiisWithOremRequirement.fields.state_pf_42') }}
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
@can('aiis_with_orem_requirement_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.aiis-with-orem-requirements.massDestroy') }}",
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
    ajax: "{{ route('admin.aiis-with-orem-requirements.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
// { data: 'id', name: 'id' },
{ data: 'data', name: 'data' },
{ data: 'state_p_313', name: 'state_p_313' },
{ data: 'state_p_314', name: 'state_p_314' },
{ data: 'state_p_315', name: 'state_p_315' },
{ data: 'state_pf_2', name: 'state_pf_2' },
{ data: 'state_pf_4', name: 'state_pf_4' },
{ data: 'state_pf_7', name: 'state_pf_7' },
{ data: 'state_pf_8', name: 'state_pf_8' },
{ data: 'state_pf_9', name: 'state_pf_9' },
{ data: 'state_pf_10', name: 'state_pf_10' },
{ data: 'state_pf_11', name: 'state_pf_11' },
{ data: 'state_pf_13', name: 'state_pf_13' },
{ data: 'state_pf_16', name: 'state_pf_16' },
{ data: 'state_pf_24', name: 'state_pf_24' },
{ data: 'state_pf_28', name: 'state_pf_28' },
{ data: 'state_pf_32', name: 'state_pf_32' },
{ data: 'state_pf_40', name: 'state_pf_40' },
{ data: 'state_pf_41', name: 'state_pf_41' },
{ data: 'state_pf_42', name: 'state_pf_42' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-AiisWithOremRequirement').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection