@if (count($workUnits) > 0)
    @if ($workUnits->contains(function ($workUnit) {
        return $workUnit->jobTypes->contains(function ($jobType) {
            return count($jobType->activeCareers) > 0;
        });
    }))
        @foreach ($workUnits as $workUnit)
            @if ($workUnit->jobTypes->contains(function ($jobType) {
                return count($jobType->activeCareers) > 0;
            }))
                <div class="work-unit">
                    <div class="work-unit-title-block">
                        <div class="work-unit-title">
                            {{ checkValue($workUnit, 'name', 'Khối Văn phòng') }}
                        </div>
                        <a class="view-more-work-unit">
                            {{ checkValue($workUnit, 'totalCareers', '0') }} vị trí tuyển dụng
                        </a>
                    </div>
                    <div class="job-types-block">
                        @foreach ($workUnit->jobTypes as $jobType)
                            @if (count($jobType->activeCareers) > 0)
                                <div class="job-type">
                                    <div class="job-type-title">{{ $jobType->name }} </div>
                                    <div class="job-list row">
                                        @foreach ($jobType->activeCareers as $kCareer => $vCareer)
                                            <a href="{{ route('career.detail', ['slug' => $vCareer->slug]) }}" class="col-xl-12 col-md-12">
                                                <div class="{{ $vCareer->is_expired ? 'job-item-expired' : 'job-item' }}">
                                                    <div class="job-item-info">
                                                        <div class="{{ $vCareer->is_expired ? 'job-name-block-expired' : 'job-name-block' }}">
                                                            <i class="ti ti-briefcase job-name-icon"></i>
                                                            <div class="{{ $vCareer->is_expired ? 'job-name-expired' : 'job-name' }}">
                                                                {{ checkValue($vCareer, 'job_position', 'Đang cập nhật ...') }}
                                                            </div>
                                                        </div>
                                                        @if (!$vCareer->is_expired)
                                                            <div class="job-status-block">
                                                                <i class="fa-solid fa-check job-status-icon"></i>
                                                                <div class="job-status">Đang mở tuyển</div>
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <div class="tags d-flex">
                                                        <span class="tag-item tag-item-hidden">
                                                            {{ checkValue($vCareer->branch, 'name', 'Nhiều địa điểm làm việc tại HCM') }}
                                                        </span>
                                                        <span class="tag-item tag-item-salary">
                                                            {{ checkValue($vCareer, 'salary_text', 'Đang cập nhật ...') }}
                                                        </span>
                                                        <span class="tag-item">
                                                            {{ checkValue($vCareer->form, 'name', 'Đang cập nhật ...') }}
                                                        </span>
                                                        <span class="tag-item d-flex align-items-center">
                                                            <i class="icon-expired fas fa-history"></i>
                                                            Hạn nộp hồ sơ:
                                                            {{ checkValue($vCareer, 'apply_expired_formatted', 'Đang cập nhật ...') }}
                                                        </span>
                                                        <span class="tag-item">
                                                            {{ checkValue($vCareer->jobType->workUnit, 'name', 'Đang cập nhật ...') }}
                                                        </span>
                                                        <span class="tag-item">
                                                            {{ checkValue($vCareer->jobType, 'name', 'Đang cập nhật ...') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    @else
        <div class="row">
            <div class="col-sm-12">
                <div class="not-job" style="">Chưa có việc làm phù hợp ...</div>
            </div>
        </div>
    @endif
@endif
