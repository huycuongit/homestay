<div class="row">
    <div class="col-md-6 border-end rating-component">
        <div class="modal-body rating-detail-body">
            <div id="rating-detail-content" style="font-size: 1rem; line-height: 1.5;">
                <div class="title">Thông tin học viên</div>
                <div class="info-section">
                    <div class="row group">
                        <div class="col-md-6 label">Mã học viên</div>
                        <div class="col-md-6 content">{{ $reply->rating->student->student_code }}</div>
                    </div>
                    <div class="row group">
                        <div class="col-md-6 label">Họ tên học viên</div>
                        <div class="col-md-6 content">{{ $reply->rating->student->name }}</div>
                    </div>
                    <div class="row group">
                        <div class="col-md-6 label">Chi nhánh</div>
                        <div class="col-md-6 content">{{ $reply->rating->classLesson->branch->name }}</div>
                    </div>
                    <div class="row group">
                        <div class="col-md-6 label">Số điện thoại học viên</div>
                        <div class="col-md-6 content">{{ $reply->rating->student->phone }}</div>
                    </div>
                </div>

                <div class="title">Đánh giá từ học viên</div>
                <div class="info-section">
                    <div class="row group">
                        <div class="col-md-6 label">Thời gian</div>
                        <div class="col-md-6 content">{{ $reply->created_at }}</div>
                    </div>
                    <div class="row group">
                        <div class="col-md-6 label">Mức độ đánh giá</div>
                        <div class="col-md-6 content">
                            @if ($ratingLevel->icon_type == 0)
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < $ratingLevel->name)
                                        <svg xmlns="http://www.w3.org/2000/svg" color="#FF8B00" width="24"
                                            height="24" viewBox="0 0 24 24" fill="currentColor"
                                            class="icon icon-tabler icons-tabler-filled icon-tabler-star">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" color="#FF8B00" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-star">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                                        </svg>
                                    @endif
                                @endfor
                            @else
                                {{ $ratingLevel->name }}
                            @endif
                        </div>
                    </div>
                    <div class="row group">
                        <div class="col-md-6 label">Danh mục</div>
                        <div class="col-md-6 content">{{ $ratingCategoryNames }}</div>
                    </div>
                    <div class="row group">
                        <div class="col-md-6 label">Nội dung đánh giá</div>
                        <div class="col-md-6 content">{{ $reply->rating->note }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 rating-component">
        <!-- Chat History -->
        <div class="sub-title">Phản hồi</div>
        <div class="col app-chat-history">
            <div class="chat-history-wrapper">
                <div class="chat-history-body">
                    <ul class="list-unstyled chat-history">
                        @foreach ($ratingContent as $chat)
                            @if ($chat->admin_id == auth()->id())
                                <li class="chat-message chat-message-right">
                                    <div class="d-flex overflow-hidden">
                                        <div class="chat-message-wrapper flex-grow-1">
                                            <div class="text-end chat-message-text">
                                                <p class="mb-0">{{ $chat->content }}</p>
                                            </div>
                                            <div class="text-end text-muted mt-1">
                                                <small>{{ $chat->created_at->format('H:i d/m/Y') }}</small>
                                            </div>
                                        </div>
                                        <div class="user-avatar flex-shrink-0 ms-4">
                                            <div class="avatar avatar-sm">
                                                <img src="{{ asset('assets/admin/img/avatars/1.png') }}" alt="Avatar"
                                                    class="rounded-circle" />
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @else
                                <!-- Hiển thị tin nhắn của học viên bên trái -->
                                <li class="chat-message">
                                    <div class="d-flex overflow-hidden">
                                        <div class="user-avatar flex-shrink-0 me-4">
                                            <div class="avatar avatar-sm">
                                                <img src="{{ asset('assets/admin/img/avatars/4.png') }}" alt="Avatar"
                                                    class="rounded-circle" />
                                            </div>
                                        </div>
                                        <div class="chat-message-wrapper flex-grow-1">
                                            <div class="chat-message-text mt-2">
                                                <p class="mb-0">{{ $chat->content }}</p>
                                            </div>
                                            <div class="text-muted mt-1">
                                                <small>{{ $chat->created_at->format('H:i d/m/Y') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Chat message form -->
        <div class="feedback-form-container mt-4">
            <form method="POST" id="reply-form" action="{!! route('admin.chattings.store') !!}">
                @csrf
                <input type="hidden" class="form-control" id="rating_id" name="rating_id"
                    value="{{ $reply->rating->id }}" />
                <div class="mb-3">
                    <textarea class="form-control" id="content" name="content" rows="3"
                        placeholder="Nhập thông tin phản hồi học viên"></textarea>
                </div>
                <div class="text-end">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Gửi<i class="ti ti-send"></i></button>
                </div>
            </form>
        </div>
        <!-- /. Chat History -->
    </div>
</div>
