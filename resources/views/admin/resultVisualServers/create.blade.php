@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.resultVisualServer.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.result-visual-servers.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="quarter_id">{{ trans('cruds.resultVisualServer.fields.quarter') }}</label>
                <select class="form-control select2 {{ $errors->has('quarter') ? 'is-invalid' : '' }}" name="quarter_id" id="quarter_id">
                    @foreach($quarters as $id => $quarter)
                        <option value="{{ $id }}" {{ old('quarter_id') == $id ? 'selected' : '' }}>{{ $quarter }}</option>
                    @endforeach
                </select>
                @if($errors->has('quarter'))
                    <span class="text-danger">{{ $errors->first('quarter') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.resultVisualServer.fields.quarter_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="resut">{{ trans('cruds.resultVisualServer.fields.resut') }}</label>
                <textarea class="form-control {{ $errors->has('resut') ? 'is-invalid' : '' }}" name="resut" id="resut">{{ old('resut') }}</textarea>
                @if($errors->has('resut'))
                    <span class="text-danger">{{ $errors->first('resut') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.resultVisualServer.fields.resut_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="photo">{{ trans('cruds.resultVisualServer.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                </div>
                @if($errors->has('photo'))
                    <span class="text-danger">{{ $errors->first('photo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.resultVisualServer.fields.photo_helper') }}</span>
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
    var uploadedPhotoMap = {}
Dropzone.options.photoDropzone = {
    url: '{{ route('admin.result-visual-servers.storeMedia') }}',
    maxFilesize: 256, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 256,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="photo[]" value="' + response.name + '">')
      uploadedPhotoMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedPhotoMap[file.name]
      }
      $('form').find('input[name="photo[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($resultVisualServer) && $resultVisualServer->photo)
      var files = {!! json_encode($resultVisualServer->photo) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="photo[]" value="' + file.file_name + '">')
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