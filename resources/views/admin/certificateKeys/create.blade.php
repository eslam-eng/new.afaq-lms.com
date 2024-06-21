@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.certificateKey.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.certificate-keys.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="key">{{ trans('cruds.certificateKey.fields.key') }}</label>
                <input class="form-control {{ $errors->has('key') ? 'is-invalid' : '' }}" type="text" name="key" id="key" value="{{ old('key', '') }}" required>
                @if($errors->has('key'))
                <div class="invalid-feedback">
                    {{ $errors->first('key') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.certificateKey.fields.key_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required">{{ trans('cruds.bankList.fields.type') }}</label>
                <select class="form-control select2 {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" onchange="get_type_data()">
                    <option value="">select-one</option>
                    @foreach(App\Models\CertificateKey::TYPES as $key => $label)
                    <option value="{{ $label }}" {{ old('type', '') === (string) $label ? 'selected' : '' }}>{{ $key }}</option>
                    @endforeach
                    <option value="other">Other</option>
                </select>
                @if($errors->has('type'))
                <div class="invalid-feedback">
                    {{ $errors->first('type') }}
                </div>
                @endif
            </div>

            <div class="form-group" id="related_coulmns" style="display: none;">
                <label class="required">{{ trans('cruds.bankList.fields.related_coulmn') }}</label>
                <select style="width: 100%;" class="form-control select2 {{ $errors->has('related_coulmn') ? 'is-invalid' : '' }}" name="related_coulmn" id="related_coulmn">
                    <option value="">select-one</option>
                </select>
            </div>

            <div class="form-group" id="others" style="display: none;">
                <label for="description">{{ trans('cruds.certificateKey.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description') }}">

                @if($errors->has('description'))
                <div class="invalid-feedback">
                    {{ $errors->first('description') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.certificateKey.fields.description_helper') }}</span>
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
    function get_type_data() {
        let type = $('#type').val();
        let related_coulmn = "{{old('related_coulmn' , '')}}"
        if (type == 'other') {
            $('#related_coulmns').hide();
            $('#others').show();
        } else if (type) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('admin.certificate-keys.data_type') }}",
                data: {
                    type: type
                },
                type: 'GET',
                beforeSend: function(xhr) {
                    var token = $('meta[name="csrf_token"]').attr('content');
                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                success: function(response) {
                    if (response) {
                        console.log(response);
                        let result = '';
                        for (let index = 0; index < response.length; index++) {
                            const element = response[index];
                            result += `<option value="${element}" ${(related_coulmn == element) ? 'selected' : ''}>${element}</option>`
                        }
                        $('#related_coulmn').html(result);
                        $('#others').hide();
                        $('#related_coulmns').show();
                    } else {
                        console.log('fail');
                    }
                }
            });
        }
    }
</script>
@endsection