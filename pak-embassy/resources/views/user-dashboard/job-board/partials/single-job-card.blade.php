<div class="col-md-6 col-lg-4 col-sm-12 mb-2">
    <a href="{{ url('/user/detail-job/' . $job->id)}}" class="text-decoration-none">
        <div class="job-card d-flex flex-column justify-content-between position-relative">
            @if($job->status)
            @php
                $statusName = strtolower($job->status->name);
                $badgeClass = match($statusName) {
                    'active' => 'bg-success',
                    'approved' => 'bg-success',
                    'verified' => 'bg-success',
                    'closed' => 'bg-danger',
                    'rejected' => 'bg-danger',
                    'cancelled' => 'bg-danger',
                    'expired' => 'bg-danger',
                    'suspended' => 'bg-danger',
                    'pending' => 'bg-warning text-dark',
                    'in review' => 'bg-warning text-dark',
                    'draft' => 'bg-secondary',
                    'archived' => 'bg-secondary',
                    'inactive' => 'bg-secondary',
                    'on hold' => 'bg-info',
                    'in progress' => 'bg-info',
                    'completed' => 'bg-primary',
                    default => 'bg-info'
                };
            @endphp
            <span class="badge {{ $badgeClass }} position-absolute top-0 end-0 m-2" style="font-size: 0.7rem; z-index: 10;">
                {{ $job->status->name }}
            </span>
            @endif
            <div class="border-bottom pb-3">
                <div class="d-flex align-items-center mb-2">
                    <img src="{{ $job->organization?->images?->first()?->path 
                    ? asset('storage/' . $job->organization->images->first()->path) 
                    : asset('user-dash-img/event-date.svg') }}"
                    width="96" height="56"
                        alt="{{ $job->organization?->name ?? 'Default Job Image' }}"
                        class="job-logo">
                    <div>
                        <div class="job-title">{{$job->title}}</div>
                        <div class="job-meta">{{$job->organization?->name ?? '-'}}</div>
                    </div>
                </div>
                <div class="job-description">
                    {!!Str::limit($job->description, 100, '...') !!}
                </div>
                <div class="d-flex gap-3 text-muted mb-2 small">
                    <div><img src="{{ asset('user-dash-img/uil_calender.svg')}}" class="pe-1" alt="calender"></i>{{ $job->created_at->format('M d, Y') }}</div>
                    <div><img src="{{ asset('user-dash-img/uil_calender.svg')}}" class="pe-1" alt="calender">
                        @if($job->min_experience && $job->max_experience)
                        {{ $job->min_experience }} - {{ $job->max_experience }} Years
                        @elseif($job->min_experience)
                        Minimum {{ $job->min_experience }} Years
                        @elseif($job->max_experience)
                        Up to {{ $job->max_experience }} Years
                        @endif
                    </div>
                    <div><img src="{{ asset('user-dash-img/tabler_cash.svg')}}" class="pe-1" alt="Cash">SAR {{$job->min_salary}} - {{$job->max_salary}}</div>
                </div>
                <div class="d-flex flex-wrap">
                    <span class="tag">React</span>
                    <span class="tag">Android</span>
                    <span class="tag">IOS</span>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <span class="posted-time">{{ $job->created_at->diffForHumans() }}</span>
                @if(hasAppliedForJob(auth()->user(), $job))
                <button class="btn btn-secondary" disabled>Applied</button>
                @else
                <button class="btn btn-outline-success apply-btn"><a class="text-decoration-none" href="{{ url('/user/job-apply/'.$job->id) }}">Apply Now →</a></button>
                @endif
            </div>
        </div>
    </a>
</div>