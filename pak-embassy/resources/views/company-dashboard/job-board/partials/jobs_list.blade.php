  @forelse ($jobs as $job)
   @include('company-dashboard.job-board.partials.single-job-card', ['job' => $job])
  @empty
  <div class="col-12">
      <div class="single-card text-center p-5 shadow-sm rounded">
          <!-- <img src="{{ asset('images/no-events.png') }}"
                                alt="No Events"
                                class="img-fluid mb-3"
                                style="max-width:150px;"> -->
          <h4 class="mb-2">No Jobs Posted</h4>
          <p class="text-muted">Stay tuned! We’ll be posting new jobs soon.</p>
      </div>
  </div>
  @endforelse