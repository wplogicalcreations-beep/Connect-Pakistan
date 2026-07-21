<x-common-banner
    primary_button=true
    :data="$data"
    editable=true
/>

<section class="common-base-main">
    <div class="container">
        <h3 class="section-heading">Jobs in KSA</h3>

        <div class="row g-3">
        @if(isset($jobs) && $jobs->count() > 0)
            @foreach($jobs as $job)
                <x-website-job-card :job="$job" />
            @endforeach
        @endif
        </div>
    </div>
</section>