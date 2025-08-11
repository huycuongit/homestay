@if (count($blogs) > 0)
	<div class="row blog-block">
		@foreach ($blogs as $blog)
			<div class="blog-item col-xl-4 col-md-6">
				<div>
					<img class="blog-img" width="333" height="240" src="{{ checkValue($blog, 'avatar', 'Đang cập nhật ...') }}"
						alt="">
				</div>
				<div class="blog-content">
					<div class="blog-date">{{ checkValue($blog, 'formatted_publish_time') }}</div>
					<div class="blog-title">
						{{ checkValue($blog, 'title', 'Đang cập nhật ...') }}
					</div>
					<div class="blog-description">
						{{ checkValue($blog, 'description', 'Đang cập nhật ...') }}
					</div>
					<div class="">
						@switch($type)
							@case('news')
								<a class="blog-view-more" href="{{ route('news.detail', ['slug' => $blog->slug ]) }}" >Xem thêm</a>
								@break

							@case('blogs')
								<a class="blog-view-more" href="{{ route('blog.detail', ['slug' => $blog->slug ]) }}">Xem thêm</a>
								@break

						@endswitch
					</div>
				</div>
			</div>
		@endforeach
	</div>
	<div class="pagination-wrapper">
		{{ $blogs->links('components.pagination') }}
	</div>
@else
	<div class="clearfix"></div>
	<h5 class="text-center text-uppercase" style="color: #FF9900;">Không có bài viết nào phù hợp ! </h5>
@endif
