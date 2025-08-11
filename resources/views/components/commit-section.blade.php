<section id="commitment" class="py-5">
    <div class="container">
        <div class="commit-title">
            {!! checkValue($arrSetups, 'commit_title') !!}
        </div>
        <div class="mb-5 text-muted">
            {!! checkValue($arrSetups, 'commit_description') !!}
        </div>

        @if(!empty($commits) && count($commits) > 0)
            <div class="row text-start">
                @foreach ($commits as $commit)
                    <div class="col-md-3 col-12 mb-4">
                        <div class="mb-3">
                            <div class="circle-icon">
                                <img src="{{ Storage::url($commit['icon']) }}" alt="Arrow" class="icon-img">
                            </div>
                        </div>
                        <h5 class="fw-bold main-color">{{ checkValue($commit, 'name') }}</h5>
                        <p class="text-muted">
                            {{ checkValue($commit, 'description') }}
                        </p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-muted">Hiện chưa có nội dung cam kết được đăng.</p>
        @endif
    
    </div>
</section>
