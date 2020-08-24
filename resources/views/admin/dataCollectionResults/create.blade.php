@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.dataCollectionResult.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.data-collection-results.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.dataCollectionResult.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}" required>
                @if($errors->has('date'))
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dataCollectionResult.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="change_character">{{ trans('cruds.dataCollectionResult.fields.change_character') }}</label>
                <textarea class="form-control {{ $errors->has('change_character') ? 'is-invalid' : '' }}" name="change_character" id="change_character">{{ old('change_character') }}</textarea>
                @if($errors->has('change_character'))
                    <span class="text-danger">{{ $errors->first('change_character') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dataCollectionResult.fields.change_character_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.dataCollectionResult.fields.considered_metrological') }}</label>
                @foreach(App\DataCollectionResult::CONSIDERED_METROLOGICAL_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('considered_metrological') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="considered_metrological_{{ $key }}" name="considered_metrological" value="{{ $key }}" {{ old('considered_metrological', 'false') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="considered_metrological_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('considered_metrological'))
                    <span class="text-danger">{{ $errors->first('considered_metrological') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dataCollectionResult.fields.considered_metrological_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="files">{{ trans('cruds.dataCollectionResult.fields.files') }}</label>
                <div class="needsclick dropzone {{ $errors->has('files') ? 'is-invalid' : '' }}" id="files-dropzone">
                </div>
                @if($errors->has('files'))
                    <span class="text-danger">{{ $errors->first('files') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dataCollectionResult.fields.files_helper') }}</span>
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
    url: '{{ route('admin.data-collection-results.storeMedia') }}',
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
@if(isset($dataCollectionResult) && $dataCollectionResult->files)
          var files =
            {!! json_encode($dataCollectionResult->files) !!}
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