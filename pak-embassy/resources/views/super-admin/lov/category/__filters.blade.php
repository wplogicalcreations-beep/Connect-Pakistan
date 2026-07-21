<div class="row">
    <div class="col-lg-7 col-md-12 px-2">
    <div class="input-group mb-3 drop-buttons">
        <button class="btn btn-outline-secondary dropdown-toggle filter-button" type="button"
                data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{asset('images/filter-icon.svg')}}" alt="Filter Icon">Filters
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ request()->url() }}#">Action</a></li>
            <li><a class="dropdown-item" href="{{ request()->url() }}#">Another action</a></li>
            <li><a class="dropdown-item" href="{{ request()->url() }}#">Something else here</a></li>
        </ul>
        <input type="text" id="searchInput" name="name" class="form-control search-input" placeholder="Search"
               aria-label="Text input with dropdown button">
    </div>
</div>
<div class="col-lg-5 col-md-12  my-3 mt-md-0  btn-resp gap-2 d-flex flex-wrap">
    <button type="button" class="btn btn-outline-secondary border-2 button-style flex-fill btn-excel">Excel</button>
    <button type="button" class="btn btn-outline-secondary border-2 button-style flex-fill btn-pdf">PDF</button>
    <button type="button" class="btn btn-outline-secondary border-2 button-style flex-fill btn-print">Print</button>
    @if(isset($isSkills) && $isSkills)
        <button type="button" class="btn btn-common-bg flex-fill me-2" data-bs-toggle="modal"
                data-bs-target="#staticBackdropAdd" data-category="{{$category}}">+ Add New Skill
        </button>
    @else
        <button type="button" class="btn btn-common-bg flex-fill me-2" data-bs-toggle="modal"
                data-bs-target="#lovModal" data-type="{{$type}}">+ Add New {{ Str::of($type)->replace('-', ' ')->title() }}
        </button>
    @endif
</div>
</div>

