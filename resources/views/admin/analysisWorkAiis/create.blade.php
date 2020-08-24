@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.analysisWorkAii.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.analysis-work-aiis.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="quarter_id">{{ trans('cruds.analysisWorkAii.fields.quarter') }}</label>
                <select class="form-control select2 {{ $errors->has('quarter') ? 'is-invalid' : '' }}" name="quarter_id" id="quarter_id">
                    @foreach($quarters as $id => $quarter)
                        <option value="{{ $id }}" {{ old('quarter_id') == $id ? 'selected' : '' }}>{{ $quarter }}</option>
                    @endforeach
                </select>
                @if($errors->has('quarter'))
                    <span class="text-danger">{{ $errors->first('quarter') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.analysisWorkAii.fields.quarter_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="diagnostic">{{ trans('cruds.analysisWorkAii.fields.diagnostic') }}</label>
                <div class="needsclick dropzone {{ $errors->has('diagnostic') ? 'is-invalid' : '' }}" id="diagnostic-dropzone">
                </div>
                @if($errors->has('diagnostic'))
                    <span class="text-danger">{{ $errors->first('diagnostic') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.analysisWorkAii.fields.diagnostic_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    var uploadedDiagnosticMap = {}
Dropzone.options.diagnosticDropzone = {
    url: '{{ route('admin.analysis-work-aiis.storeMedia') }}',
    maxFilesize: 150, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 150
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="diagnostic[]" value="' + response.name + '">')
      uploadedDiagnosticMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedDiagnosticMap[file.name]
      }
      $('form').find('input[name="diagnostic[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($analysisWorkAii) && $analysisWorkAii->diagnostic)
          var files =
            {!! json_encode($analysisWorkAii->diagnostic) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="diagnostic[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection