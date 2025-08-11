@foreach ($images as $image)
                    <div class="col-md-3 mb-4 " data-category="bao-tri">
                        <div class="gallery-item">
                            <img src="{{ Storage::url($image->url) }}" class="" alt="Ảnh">
                            <div class="gallery-content">
                                <h6 class="image-name">{{ $image->name }}</h6>
                            </div>
                        </div>
                    </div>
                @endforeach