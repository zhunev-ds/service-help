@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.uspdAnalysi.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.uspd-analysis.update", [$uspdAnalysi->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="quarter_id">{{ trans('cruds.uspdAnalysi.fields.quarter') }}</label>
                <select class="form-control select2 {{ $errors->has('quarter') ? 'is-invalid' : '' }}" name="quarter_id" id="quarter_id">
                    @foreach($quarters as $id => $quarter)
                        <option value="{{ $id }}" {{ ($uspdAnalysi->quarter ? $uspdAnalysi->quarter->id : old('quarter_id')) == $id ? 'selected' : '' }}>{{ $quarter }}</option>
                    @endforeach
                </select>
                @if($errors->has('quarter'))
                    <span class="text-danger">{{ $errors->first('quarter') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.uspdAnalysi.fields.quarter_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="location_id">{{ trans('cruds.uspdAnalysi.fields.location') }}</label>
                <select class="form-control select2 {{ $errors->has('location') ? 'is-invalid' : '' }}" name="location_id" id="location_id">
                    @foreach($locations as $id => $location)
                        <option value="{{ $id }}" {{ ($uspdAnalysi->location ? $uspdAnalysi->location->id : old('location_id')) == $id ? 'selected' : '' }}>{{ $location }}</option>
                    @endforeach
                </select>
                @if($errors->has('location'))
                    <span class="text-danger">{{ $errors->first('location') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.uspdAnalysi.fields.location_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="result">{{ trans('cruds.uspdAnalysi.fields.result') }}</label>
                <textarea class="form-control {{ $errors->has('result') ? 'is-invalid' : '' }}" name="result" id="result">{{ old('result', $uspdAnalysi->result) }}</textarea>
                @if($errors->has('result'))
                    <span class="text-danger">{{ $errors->first('result') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.uspdAnalysi.fields.result_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="files">{{ trans('cruds.uspdAnalysi.fields.files') }}</label>
                <div class="needsclick dropzone {{ $errors->has('files') ? 'is-invalid' : '' }}" id="files-dropzone">
                </div>
                @if($errors->has('files'))
                    <span class="text-danger">{{ $errors->first('files') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.uspdAnalysi.fields.files_helper') }}</span>
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
    url: '{{ route('admin.uspd-analysis.storeMedia') }}',
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
@if(isset($uspdAnalysi) && $uspdAnalysi->files)
          var files =
            {!! json_encode($uspdAnalysi->files) !!}
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