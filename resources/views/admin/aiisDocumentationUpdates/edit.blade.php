@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.aiisDocumentationUpdate.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.aiis-documentation-updates.update", [$aiisDocumentationUpdate->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="year">{{ trans('cruds.aiisDocumentationUpdate.fields.year') }}</label>
                <input class="form-control {{ $errors->has('year') ? 'is-invalid' : '' }}" type="text" name="year" id="year" value="{{ old('year', $aiisDocumentationUpdate->year) }}">
                @if($errors->has('year'))
                    <span class="text-danger">{{ $errors->first('year') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aiisDocumentationUpdate.fields.year_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="verification_si">{{ trans('cruds.aiisDocumentationUpdate.fields.verification_si') }}</label>
                <div class="needsclick dropzone {{ $errors->has('verification_si') ? 'is-invalid' : '' }}" id="verification_si-dropzone">
                </div>
                @if($errors->has('verification_si'))
                    <span class="text-danger">{{ $errors->first('verification_si') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aiisDocumentationUpdate.fields.verification_si_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="verification_aiis">{{ trans('cruds.aiisDocumentationUpdate.fields.verification_aiis') }}</label>
                <div class="needsclick dropzone {{ $errors->has('verification_aiis') ? 'is-invalid' : '' }}" id="verification_aiis-dropzone">
                </div>
                @if($errors->has('verification_aiis'))
                    <span class="text-danger">{{ $errors->first('verification_aiis') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aiisDocumentationUpdate.fields.verification_aiis_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="actual_metr_data">{{ trans('cruds.aiisDocumentationUpdate.fields.actual_metr_data') }}</label>
                <textarea class="form-control {{ $errors->has('actual_metr_data') ? 'is-invalid' : '' }}" name="actual_metr_data" id="actual_metr_data">{{ old('actual_metr_data', $aiisDocumentationUpdate->actual_metr_data) }}</textarea>
                @if($errors->has('actual_metr_data'))
                    <span class="text-danger">{{ $errors->first('actual_metr_data') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aiisDocumentationUpdate.fields.actual_metr_data_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mapping">{{ trans('cruds.aiisDocumentationUpdate.fields.mapping') }}</label>
                <textarea class="form-control {{ $errors->has('mapping') ? 'is-invalid' : '' }}" name="mapping" id="mapping">{{ old('mapping', $aiisDocumentationUpdate->mapping) }}</textarea>
                @if($errors->has('mapping'))
                    <span class="text-danger">{{ $errors->first('mapping') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aiisDocumentationUpdate.fields.mapping_helper') }}</span>
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
    var uploadedVerificationSiMap = {}
Dropzone.options.verificationSiDropzone = {
    url: '{{ route('admin.aiis-documentation-updates.storeMedia') }}',
    maxFilesize: 256, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 256
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="verification_si[]" value="' + response.name + '">')
      uploadedVerificationSiMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedVerificationSiMap[file.name]
      }
      $('form').find('input[name="verification_si[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($aiisDocumentationUpdate) && $aiisDocumentationUpdate->verification_si)
          var files =
            {!! json_encode($aiisDocumentationUpdate->verification_si) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="verification_si[]" value="' + file.file_name + '">')
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
<script>
    var uploadedVerificationAiisMap = {}
Dropzone.options.verificationAiisDropzone = {
    url: '{{ route('admin.aiis-documentation-updates.storeMedia') }}',
    maxFilesize: 256, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 256
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="verification_aiis[]" value="' + response.name + '">')
      uploadedVerificationAiisMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedVerificationAiisMap[file.name]
      }
      $('form').find('input[name="verification_aiis[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($aiisDocumentationUpdate) && $aiisDocumentationUpdate->verification_aiis)
          var files =
            {!! json_encode($aiisDocumentationUpdate->verification_aiis) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="verification_aiis[]" value="' + file.file_name + '">')
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