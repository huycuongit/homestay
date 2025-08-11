<label for="{{ $key }}">{{ $title }}</label>
<div class="form-group btn-ckfinder">
    <div class="image-container">
        <img id="displayImage" src="{{ $value ?? asset('assets/imgs/upload.png') }}" alt="Display Image">
        <input value="{{ $value ?? ''}}" type="text" class="file-input" id="{{ $key }}" name="{{ $key }}">
        <i class="fas fa-times-circle" onclick="clearImageAndInput(event)" style="display: {{ $value ? 'block' : 'none' }}"></i>
    </div>
</div> 