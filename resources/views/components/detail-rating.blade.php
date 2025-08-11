<input type="hidden" value="{{ route('admin.class-lessons.edit', ['id' => '_id']) }}" id="url-class-lesson" />
<div class="row">
    <div class="col-md-6 border-end rating-component">
        <div class="modal-body rating-detail-body">
            <div id="rating-detail-content" style="font-size: 1rem; line-height: 1.5;">
                <div class="title">Thông tin buổi học</div>
                <div class="info-section">
                    <div class="row group">
                        <div class="col-md-6 label">Mã buổi học</div>
                        <div class="col-md-6 content">
                            <a href="#" id="class-lesson-link">{{ $classLesson->class_lesson_code }}</a>
                        </div>
                    </div>
                    <div class="row group">
                        <div class="col-md-6 label">Tên buổi học</div>
                        <div class="col-md-6 content">{{ $classLesson->name }}</div>
                    </div>
                    <div class="row group">
                        <div class="col-md-6 label">Thời gian</div>
                        <div class="col-md-6 content">{{ $classLesson->class_start_time }} -
                            {{ $classLesson->class_end_time }} - {{ $classLesson->class_end_date }}
                        </div>
                    </div>
                    <div class="row group">
                        <div class="col-md-6 label">Chi nhánh</div>
                        <div class="col-md-6 content">{{ $branch->name }}</div>
                    </div>
                    <div class="row group">
                        <div class="col-md-6 label">HLV đứng lớp</div>
                        <div class="col-md-6 content">{{ $coachName }}</div>
                    </div>
                    <div class="row group">
                        <div class="col-md-6 label">Phòng</div>
                        <div class="col-md-6 content">{{ $classRoom }}</div>
                    </div>
                </div>

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
                        <div class="col-md-6 label">Số điện thoại học viên</div>
                        <div class="col-md-6 content">{{ $reply->rating->student->phone }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 rating-component">
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
                                <svg xmlns="http://www.w3.org/2000/svg" color="#FF8B00" width="24" height="24"
                                    viewBox="0 0 24 24" fill="currentColor"
                                    class="icon icon-tabler icons-tabler-filled icon-tabler-star">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" color="#FF8B00" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
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
            <div class="row group">
                <div class="col-md-6 label">Thời gian phản hồi</div>
                <div class="col-md-6 content">{{ $reply->created_at }}</div>
            </div>
            <div class="row group">
                <div class="col-md-6 label">Nội dung phản hồi</div>
                <div class="col-md-6 content">{{ $reply->content }}</div>
            </div>
        </div>
    </div>
</div>

<script>
    function getData() {
        var _actionClassLessonURL = $('#url-class-lesson').val();
        var classLessonURL = _actionClassLessonURL.replace('_id', '{{ $classLesson->id }}') + '?is_view';
        $('#class-lesson-link').attr('href', classLessonURL);
    };

    $(function() {
        getData();
    });
</script>
