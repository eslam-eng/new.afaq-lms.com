@extends('layouts.admin')
@section('content')
<style>

</style>
<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.blog.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.blogs.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="editor_id">{{ trans('cruds.blog.fields.editor') }}</label>
                <select class="form-control select2 {{ $errors->has('editor') ? 'is-invalid' : '' }}" name="editor_id" id="editor_id" required>
                    @foreach($editors as $id => $entry)
                    <option value="{{ $id }}" {{ old('editor_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('editor'))
                <div class="invalid-feedback">
                    {{ $errors->first('editor') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.blog.fields.editor_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.blog.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                <div class="invalid-feedback">
                    {{ $errors->first('title') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.blog.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="title_ar">{{ trans('cruds.blog.fields.title_ar') }}</label>
                <input class="form-control {{ $errors->has('title_ar') ? 'is-invalid' : '' }}" type="text" name="title_ar" id="title_ar" value="{{ old('title_ar', '') }}" required>
                @if($errors->has('title_ar'))
                <div class="invalid-feedback">
                    {{ $errors->first('title_ar') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.blog.fields.title_ar_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="categories">{{ trans('cruds.blog.fields.category') }}</label>
                <!-- <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div> -->
                <select style="max-width: 100% !important;" class="form-control select2 {{ $errors->has('categories') ? 'is-invalid' : '' }}" name="categories[]" id="categories" multiple>
                    @foreach($categories as $id => $category)
                    <option value="{{ $id }}" {{ in_array($id, old('categories', [])) ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @if($errors->has('categories'))
                <div class="invalid-feedback">
                    {{ $errors->first('categories') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.blog.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tags">{{ trans('cruds.blog.fields.tag') }}</label>
                <!-- <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div> -->
                <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple>
                    @foreach($tags as $id => $tag)
                    <option value="{{ $id }}" {{ in_array($id, old('tags', [])) ? 'selected' : '' }}>{{ $tag }}</option>
                    @endforeach
                </select>
                @if($errors->has('tags'))
                <div class="invalid-feedback">
                    {{ $errors->first('tags') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.blog.fields.tag_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="page_text">{{ trans('cruds.blog.fields.page_text') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('page_text') ? 'is-invalid' : '' }}" name="page_text" id="page_text">{!! old('page_text') !!}</textarea>
                @if($errors->has('page_text'))
                <div class="invalid-feedback">
                    {{ $errors->first('page_text') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.blog.fields.page_text_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="page_text_ar">{{ trans('cruds.blog.fields.page_text_ar') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('page_text_ar') ? 'is-invalid' : '' }}" name="page_text_ar" id="page_text_ar">{{ old('page_text_ar') }}</textarea>
                @if($errors->has('page_text_ar'))
                <div class="invalid-feedback">
                    {{ $errors->first('page_text_ar') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.blog.fields.page_text_ar_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="excerpt">{{ trans('cruds.blog.fields.excerpt') }}</label>
                <textarea class="form-control {{ $errors->has('excerpt') ? 'is-invalid' : '' }}" name="excerpt" id="excerpt">{{ old('excerpt') }}</textarea>
                @if($errors->has('excerpt'))
                <div class="invalid-feedback">
                    {{ $errors->first('excerpt') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.blog.fields.excerpt_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="excerpt_ar">{{ trans('cruds.blog.fields.excerpt_ar') }}</label>
                <textarea class="form-control {{ $errors->has('excerpt_ar') ? 'is-invalid' : '' }}" name="excerpt_ar" id="excerpt_ar">{{ old('excerpt_ar') }}</textarea>
                @if($errors->has('excerpt_ar'))
                <div class="invalid-feedback">
                    {{ $errors->first('excerpt_ar') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.blog.fields.excerpt_ar_helper') }}</span>
            </div>


            <div class="form-group">
                <label for="featured_image">{{ trans('cruds.blog.fields.featured_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('featured_image') ? 'is-invalid' : '' }}" id="featured_image-dropzone">
                </div>
                @if($errors->has('featured_image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('featured_image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.blog.fields.featured_image_helper') }}</span>
            </div>

            @if(false)
            <div class="form-group">
                <label class="required" for="author">{{ trans('cruds.blog.fields.author') }}</label>
                <input class="form-control {{ $errors->has('author') ? 'is-invalid' : '' }}" type="text" name="author" id="author" value="{{ old('author', '') }}" required>
                @if($errors->has('author'))
                <div class="invalid-feedback">
                    {{ $errors->first('author') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.blog.fields.author_helper') }}</span>
            </div>
            @endif
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
     $('input[type="file"]').each(function() {
        // Refs
        var $file = $(this),
            $label = $file.next('label'),
            $labelText = $label.find('span'),
            labelDefault = $labelText.text();

        // When a new file is selected
        $file.on('change', function(event) {
            var fileName = $file.val().split('\\').pop(),
                tmppath = URL.createObjectURL(event.target.files[0]);
            //Check successfully selection
            if (fileName) {
                $label.addClass('file-ok').css('background-image', 'url(' + tmppath + ')');
                $labelText.text(fileName);
            } else {
                $label.removeClass('file-ok');
                $labelText.text(labelDefault);
            }
        });

        // End loop of file input elements
    });
</script>
<script>
    Dropzone.options.featuredImageDropzone = {
        url: '{{ route('admin.blogs.storeMedia') }}',
        maxFilesize: 4, // MB
        acceptedFiles: '.jpeg,.jpg,.png,.gif',
        maxFiles: 1,
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
            size: 2,
            width: 4096,
            height: 4096
        },
        success: function (file, response) {
            $('form').find('input[name="featured_image"]').remove()
            $('form').append('<input type="hidden" name="featured_image" value="' + response.name + '">')
        },
        removedfile: function (file) {
            file.previewElement.remove()
            if (file.status !== 'error') {
                $('form').find('input[name="featured_image"]').remove()
                this.options.maxFiles = this.options.maxFiles + 1
            }
        },
        init: function () {
            @if(isset($blog) && $blog->featured_image)
            var file = {!! json_encode($blog->featured_image) !!}
            this.options.addedfile.call(this, file)
            this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
            file.previewElement.classList.add('dz-complete')
            $('form').append('<input type="hidden" name="featured_image" value="' + file.file_name + '">')
            this.options.maxFiles = this.options.maxFiles - 1
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
