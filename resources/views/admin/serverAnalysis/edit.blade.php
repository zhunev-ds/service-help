@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.serverAnalysi.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.server-analysis.update", [$serverAnalysi->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="quarter_id">{{ trans('cruds.serverAnalysi.fields.quarter') }}</label>
                <select class="form-control select2 {{ $errors->has('quarter') ? 'is-invalid' : '' }}" name="quarter_id" id="quarter_id">
                    @foreach($quarters as $id => $quarter)
                        <option value="{{ $id }}" {{ ($serverAnalysi->quarter ? $serverAnalysi->quarter->id : old('quarter_id')) == $id ? 'selected' : '' }}>{{ $quarter }}</option>
                    @endforeach
                </select>
                @if($errors->has('quarter'))
                    <span class="text-danger">{{ $errors->first('quarter') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.serverAnalysi.fields.quarter_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="result">{{ trans('cruds.serverAnalysi.fields.result') }}</label>
                <textarea class="form-control {{ $errors->has('result') ? 'is-invalid' : '' }}" name="result" id="result">{{ old('result', $serverAnalysi->result) }}</textarea>
                @if($errors->has('result'))
                    <span class="text-danger">{{ $errors->first('result') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.serverAnalysi.fields.result_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="files">{{ trans('cruds.serverAnalysi.fields.files') }}</label>
                <div class="needsclick dropzone {{ $errors->has('files') ? 'is-invalid' : '' }}" id="files-dropzone">
                </div>
                @if($errors->has('files'))
                    <span class="text-danger">{{ $errors->first('files') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.serverAnalysi.fields.files_helper') }}</span>
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
    var uploadedFilesMap = {}
Dropzone.options.filesDropzone = {
    url: '{{ route('admin.server-analysis.storeMedia') }}',
    maxFilesize: 256, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 256
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="files[]" value="' + response.name + '">')
      uploadedFilesMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedFilesMap[file.name]
      }
      $('form').find('input[name="files[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($serverAnalysi) && $serverAnalysi->files)
          var files =
            {!! json_encode($serverAnalysi->files) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="files[]" value="' + file.file_name + '">')
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