@if ($errors->any())
    <div class="alert alert-danger mb-0 alert-dismissible col-md-12 mb-4 mb-md-0 dayone-alert-page" role="alert">
        <h5 class="alert-heading mb-2">
            <i class="ti ti-ban"></i> Thất bại!
        </h5>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success mb-0 alert-dismissible col-md-12 mb-4 mb-md-0 dayone-alert-page" role="alert">
        <h5 class="alert-heading mb-2">
            <i class="ti ti-check"></i>
            Thành công!
        </h5>
        <p class="mb-0">
            {{ session('success') }}
        </p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
