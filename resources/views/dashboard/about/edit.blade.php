@extends('layouts.dashboard-main')
@section('content')


<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title"> Form elements </h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Forms</a></li>
            <li class="breadcrumb-item active" aria-current="page">Form elements</li>
          </ol>
        </nav>
      </div>
      <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Create Data Book</h4>
              <p class="card-description"> Basic form elements </p>

              <form class="forms-sample" action="/about-update/{{ $abouts->id }}" method="POST">
                @csrf
                @method('put')

                <div class="form-group">
                  <label for="exampleInputName1">Sub</label>
                  <input type="text" class="form-control" id="exampleInputName1" name="sub" value="{{ old('sub', $abouts->sub) }}" placeholder="Name">
                </div>

                <div class="form-group">
                  <label for="exampleInputName1">Text 1</label>
                  <input type="text" class="form-control" id="exampleInputName1" name="imgtext1" value="{{ old('imgtext1', $abouts->imgtext1) }}" placeholder="Quantity">
                </div>

                <div class="form-group">
                  <label for="exampleInputName1">Text 2</label>
                  <input type="text" class="form-control" id="exampleInputName1" name="imgtext2" value="{{ old('imgtext2', $abouts->imgtext2) }}" placeholder="Quantity">
                </div>

                <div class="form-group">
                  <label for="exampleInputName1">Text 3</label>
                  <input type="text" class="form-control" id="exampleInputName1" name="imgtext3" value="{{ old('imgtext3', $abouts->imgtext3) }}" placeholder="Quantity">
                </div>


                <div class="form-group">
                    <label for="exampleInputName1">Header</label>
                    <input type="text" class="form-control" id="exampleInputName1" name="header" value="{{ old('header', $abouts->header) }}" placeholder="Author">
                  </div>


                <div class="form-group">
                    <label for="exampleTextarea1">Desc 1</label>
                    <textarea class="form-control" id="exampleTextarea1" name="desc1" rows="4">{{ old('desc1', $abouts->desc1) }}</textarea>
                  </div>

                <div class="form-group">
                    <label for="exampleInputName1">Header 2</label>
                    <input type="text" class="form-control" id="exampleInputName1" name="header2" value="{{ old('header2', $abouts->header2) }}" placeholder="Author">
                  </div>


                <div class="form-group">
                    <label for="exampleTextarea1">Desc 2</label>
                    <textarea class="form-control" id="exampleTextarea1" name="desc2" rows="4">{{ old('desc2', $abouts->desc2) }}</textarea>
                  </div>

                <div class="form-group">
                    <label for="gallery"> Image </label>
                    <div class="needsclick dropzone" id="gallery-dropzone"></div>
                    </div>


                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection
@push('style-alt')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush
@push('js-alt')
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

<script>
    var uploadedGalleryMap = {}
 Dropzone.options.galleryDropzone = {
     url: "{{ route('storeImages-about') }}",
     maxFilesize: 10, // MB
     maxFiles: 1,
     acceptedFiles: '.jpeg,.jpg,.png,.gif',
     addRemoveLinks: true,
     headers: {
       'X-CSRF-TOKEN': "{{ csrf_token() }}"
     },
     success: function (file, response) {
       $('form').append('<input type="hidden" name="gallery[]" value="' + response.name + '">')
       uploadedGalleryMap[file.name] = response.name
     },
     removedfile: function (file) {
       file.previewElement.remove()
       var name = ''
       if (typeof file.file_name !== 'undefined') {
         name = file.file_name
       } else {
         name = uploadedGalleryMap[file.name]
       }
       $('form').find('input[name="gallery[]"][value="' + name + '"]').remove()
     },
     init: function () {

 @if(isset($books) && $books->gallery)
       var files =
         {!! json_encode($books->gallery) !!}
           for (var i in files) {
           var file = files[i]
           this.options.addedfile.call(this, file)
           this.options.thumbnail.call(this, file, file.original_url)
           file.previewElement.classList.add('dz-complete')
           $('form').append('<input type="hidden" name="gallery[]" value="' + file.file_name + '">')
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


    @endpush

