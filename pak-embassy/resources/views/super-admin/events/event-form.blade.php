@extends("layouts.master")
@section("content")
    <div class="page-content page-content-ck">
        <div class="page-title">
        <h3 class="go-back" style="cursor: pointer; display: inline;" onclick="window.history.back()">
            <- Go Back
        </h3>
    </div>
        <div class="card border-0 p-3">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <!-- Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form id="eventForm" action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf   
                        <div class="row g-3">
                            <input type="hidden" name="event_type" value="{{ request()->route('type') }}">
                            <input type="hidden" name="status_id" value="{{ $status }}">
                            <h1>1- Basic Details</h1>
                            <div class="col-md-12">
                                <div class="form-floating floating-custom">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="event-name" name="name" placeholder=""
                                        value="{{ old('name') }}">
                                    <label for="pageName">Event Name <span class="text-danger">*</span></label>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating floating-custom">
                                    <input type="text" id="from" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date', date('d-m-Y')) }}" readonly/>
                                    <label for="from">Start Date <span class="text-danger">*</span></label>
                                    <img src="./images/Calendar.svg" alt="">
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating floating-custom">
                                    <input type="text" id="to" name="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date', date('d-m-Y')) }}" readonly/>
                                    <label for="from">End Date <span class="text-danger">*</span></label>
                                    <img src="./images/Calendar.svg" alt="">
                                    @error('end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating floating-custom" id="openTime1">
                                    <input type="text" class="form-control @error('start_time') is-invalid @enderror" name="start_time" id="time1" value="{{ old('start_time') }}" readonly>
                                    <label for="from">Start Time <span class="text-danger">*</span></label>
                                    <img src="./images/Clock.svg" alt="">
                                    @error('start_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating floating-custom" id="openTime2">
                                    <input type="text" class="form-control @error('start_time') is-invalid @enderror" name="end_time" value="{{ old('end_time') }}" id="time2" readonly>
                                    <label for="from">End Time <span class="text-danger">*</span></label>
                                    <img src="./images/Clock.svg" alt="">
                                    @error('end_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating floating-custom">
                                    <select class="form-select @error('domain_id') is-invalid @enderror" id="event-domain" name="domain_id" aria-label="Floating label select example">
                                        <option value="" disabled selected hidden>Select Event Domain</option>
                                        @foreach($domains as $domain)
                                            <option value="{{ $domain->id }}" {{ old('domain_id') == $domain->id ? 'selected' : '' }}>{{ $domain->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="d-flex">Event Domain <span class="text-danger">*</span></label>
                                    @error('domain_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating floating-custom">
                                    <select class="form-select @error('event_mode') is-invalid @enderror" id="event-mode" name="event_mode" aria-label="Floating label select example">
                                        <option value="" disabled {{ old('event_mode') ? '' : 'selected' }}>Select Event Mode</option>
                                        <option value="onsite" {{ old('event_mode') == 'onsite' ? 'selected' : '' }}>Onsite</option>
                                        <option value="virtual" {{ old('event_mode') == 'virtual' ? 'selected' : '' }}>Virtual</option>
                                    </select>
                                    <label for="event-mode">Event Mode <span class="text-danger">*</span></label>
                                    @error('event_mode')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6" id="location-wrapper">
                                <div class="form-floating floating-custom">
                                    <div class="form-floating floating-custom">
                                        <input type="text" class="form-control @error('location') is-invalid @enderror" 
                                            id="event-location" name="location" placeholder="" value="{{ old('location') }}">
                                        <img src="/images/location_on.svg" alt="">
                                        <label for="location">Location</label>
                                        @error('location')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6" id="city-wrapper">
                                <div class="form-floating floating-custom">
                                    <div class="form-floating floating-custom">
                                        <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                            id="event-city" name="city" placeholder="" value="{{ old('city') }}">
                                        <label for="city">City</label>
                                        @error('city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6" id="meeting-link-wrapper" style="display:none;">
                                <div class="form-floating floating-custom">
                                    <div class="form-floating floating-custom">
                                        <input type="text" class="form-control @error('meeting_link') is-invalid @enderror" 
                                            id="meeting-link" name="meeting_link" placeholder="" value="{{ old('meeting_link') }}">
                                        <label for="meeting-link">Meeting Link <span class="text-danger">*</span></label>
                                        @error('meeting_link')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-floating floating-custom">
                                    <div class="form-floating floating-custom">
                                    <input type="text" class="form-control @error('city') is-invalid @enderror" id="event-city" name="city" placeholder="" value="{{ old('city') }}">
                                    <label for="location">City</label>
                                    @error('city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="form-floating floating-custom">
                                    <div class="form-radio">
                                        <div class="form-check form-switch radio-costum">
                                            <p class="my-2">Active</p>
                                            <!-- hidden fallback -->
                                            <input type="hidden" name="event_mom" value="1">
                                            <input class="form-check-input @error('event_mom') is-invalid @enderror" type="checkbox" id="event-mom" name="event_mom" value="1" {{ old('event_mom') ? 'checked' : '' }} checked disabled>
                                        </div>
                                        <label class="form-check-label" for="event-mom">Event MoM</label>
                                        @error('event_mom')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-floating floating-custom">
                                    <div class="form-radio">
                                        <div class="form-check form-switch radio-costum">
                                            <p class="my-2">Active</p>
                                            <!-- hidden fallback -->
                                            <input type="hidden" name="event_activities" value="0">
                                            <input class="form-check-input @error('event_activities') is-invalid @enderror" type="checkbox" id="event-activities" name="event_activities" value="1" {{ old('event_activities') ? 'checked' : '' }}>
                                        </div>
                                        <label class="form-check-label" for="event-activities">Event Activities</label>
                                        @error('event_activities')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div> --}}
                            <h1 class="mt-5">2- Add Some More Info</h1>
                            <div class="col-md-12">
                                <div class="floating-custom-common">
                                    <div class="common-design">

                                        <textarea class="form-control ckeditor @error('event_overview') is-invalid @enderror" id="event-overview" name="event_overview" rows="5" placeholder="">{{ old('event_overview') }}</textarea>
                                        <label for="text-area1">Event Overview <span class="text-danger">*</span></label>
                                        @error('event_overview')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="floating-custom-common">
                                    <div class="common-design">
                                        <textarea class="form-control ckeditor @error('event_agenda') is-invalid @enderror" id="event-agenda" name="event_agenda" rows="5" placeholder="">{{ old('event_agenda') }}</textarea>
                                        <label for="text-area2">Agenda <span class="text-danger">*</span></label>
                                        @error('event_agenda')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="floating-custom-common">
                                    <div class="common-design">
                                        <textarea class="form-control ckeditor @error('event_format') is-invalid @enderror" id="event-format" name="event_format" rows="5" placeholder="">{{ old('event_format') }}</textarea>
                                        <label for="text-area3">Event Format <span class="text-danger">*</span></label>
                                        @error('event_format')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <h1 class="mt-3">3- Who's Attending?</h1>
                            
                            <!-- Individual Field -->
                            <div class="mb-4">
                                <label class="form-label">
                                    Individual <span class="text-danger">*</span>
                                </label>
                                <div class="tags-input-container" id="individual-container" style="border: 1px solid #ced4da; border-radius: 0.375rem; padding: 8px; min-height: 50px; background-color: #f8f9fa; display: flex; flex-wrap: wrap; align-items: center; gap: 8px;">
                                    @php
                                        $oldIndividuals = old('individual', []);
                                    @endphp
                                    @foreach($oldIndividuals as $userId)
                                        @php
                                            $user = $individuals->firstWhere('id', $userId);
                                        @endphp
                                        @if($user)
                                            <span class="badge bg-secondary d-inline-flex align-items-center" style="padding: 6px 12px; font-size: 0.875rem;">
                                                {{ $user->name }}
                                                <span class="remove-tag ms-2" style="cursor: pointer; font-weight: bold;">&times;</span>
                                                <input type="hidden" name="individual[]" value="{{ $user->id }}">
                                            </span>
                                        @endif
                                    @endforeach
                                    <select class="form-select border-0 bg-transparent" id="individual-select" style="flex: 1; min-width: 150px; outline: none;">
                                        <option value="">Select Individual...</option>
                                        @foreach($individuals as $user)
                                            <option value="{{ $user->id }}" data-name="{{ $user->name }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('individual')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Organization Field -->
                            <div class="mb-4">
                                <label class="form-label">
                                    Organization <span class="text-danger">*</span>
                                </label>
                                <div class="tags-input-container" id="organization-container" style="border: 1px solid #ced4da; border-radius: 0.375rem; padding: 8px; min-height: 50px; background-color: #f8f9fa; display: flex; flex-wrap: wrap; align-items: center; gap: 8px;">
                                    @php
                                        $oldOrganizations = old('organization', []);
                                    @endphp
                                    @foreach($oldOrganizations as $userId)
                                        @php
                                            $user = $organizations->firstWhere('id', $userId);
                                        @endphp
                                        @if($user)
                                            <span class="badge bg-secondary d-inline-flex align-items-center" style="padding: 6px 12px; font-size: 0.875rem;">
                                                {{ $user->name }}
                                                <span class="remove-tag ms-2" style="cursor: pointer; font-weight: bold;">&times;</span>
                                                <input type="hidden" name="organization[]" value="{{ $user->id }}">
                                            </span>
                                        @endif
                                    @endforeach
                                    <select class="form-select border-0 bg-transparent" id="organization-select" style="flex: 1; min-width: 150px; outline: none;">
                                        <option value="">Select Organization...</option>
                                        @foreach($organizations as $user)
                                            <option value="{{ $user->id }}" data-name="{{ $user->name }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('organization')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Embassy Field -->
                            <div class="mb-4">
                                <label class="form-label">
                                    Embassy <span class="text-danger">*</span>
                                </label>
                                <div class="tags-input-container" id="embassy-container" style="border: 1px solid #ced4da; border-radius: 0.375rem; padding: 8px; min-height: 50px; background-color: #f8f9fa; display: flex; flex-wrap: wrap; align-items: center; gap: 8px;">
                                    @php
                                        $oldEmbassies = old('embassy', []);
                                    @endphp
                                    @foreach($oldEmbassies as $userId)
                                        @php
                                            $user = $embassies->firstWhere('id', $userId);
                                        @endphp
                                        @if($user)
                                            <span class="badge bg-secondary d-inline-flex align-items-center" style="padding: 6px 12px; font-size: 0.875rem;">
                                                {{ $user->name }}
                                                <span class="remove-tag ms-2" style="cursor: pointer; font-weight: bold;">&times;</span>
                                                <input type="hidden" name="embassy[]" value="{{ $user->id }}">
                                            </span>
                                        @endif
                                    @endforeach
                                    <select class="form-select border-0 bg-transparent" id="embassy-select" style="flex: 1; min-width: 150px; outline: none;">
                                        <option value="">Select Embassy...</option>
                                        @foreach($embassies as $user)
                                            <option value="{{ $user->id }}" data-name="{{ $user->name }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('embassy')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            @if(request()->route('type') == 'private' && isset($usersWithImages) && $usersWithImages->isNotEmpty())
                                <h3 class="mt-5 fw-bold">Recommended Invites</h3>
                                <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach($usersWithImages->chunk(3) as $chunkIndex => $chunk)
                                            <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                                                <div class="row">
                                                    @foreach($chunk as $user)
                                                        <div class="col-md-4">
                                                            <div class="slide-common select-match">
                                                                <img src="{{ asset('storage/' . $user['image']) }}" class="d-block w-100" alt="{{ $user['name'] }}">
                                                                <p>{{ $user['name'] }}</p>
                                                                <span class="badge bg-success"><i class="fa-solid fa-check text-light"></i></span>
                                                                <input type="hidden" name="selected_emails[]" value="{{ $user['email'] }}">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev custom-arrow" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                                        <span class="custom-prev-icon">
                                            <img src="images/Left-Arrow.svg" alt="Prev" class="arrow-img">
                                        </span>
                                    </button>
                                    <button class="carousel-control-next custom-arrow" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                                        <span class="custom-next-icon">
                                            <img src="images/right-arrow.svg" alt="Next" class="arrow-img">
                                        </span>
                                    </button>
                                </div>
                            @endif
                            <h1 class="mt-5">4- Upload Event Picture</h1>
                            <div class="img-chose-input">
                                <label class="picture" for="picture__input" tabindex="0">
                                    <span class="picture__image">
                                        <img id="previewImage" src="{{ old('image_preview', '/images/majesticons_image-line.svg') }}" alt="Preview" style="max-width: 100px; max-height: 100px;">
                                    </span>
                                    Upload Image
                                </label>

                                <input type="file" name="image" id="picture__input" accept="image/*">
                                <p>Photos should be in “ jpeg, jpg, png, gif format only</p>
                                @error('image')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="upload-btns">
                                <button type="button" class="btn btn-outline-secondary button-style" onclick="window.history.back()">Cancel</button>
                                <button type="submit" class="btn btn-common-bg">Create Event</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("js-file")
    <script src="js/jQuery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/font-awesome.js"></script>
    <script src="js/jQuery-ui.js"></script>
    <script src="js/apex-chart.js"></script>
    <script src="js/jquery-clockpicker.min.js"></script>
    <script src="js/main.js"></script>
    <link rel="stylesheet" href="css/jquery-clockpicker.min.css">
    <script src="{{asset('js/jquery/ckeditor.js')}}"></script>
    <script src="{{ asset('js/SuperAdmin/form-ckeditor.js') }}"></script>
    <script>
        $(document).ready(function () {
            function getCurrentTime(offsetHours = 0) {
                let now = new Date();
                now.setHours(now.getHours() + offsetHours);

                let hours = now.getHours();
                let minutes = now.getMinutes();
                let ampm = hours >= 12 ? "PM" : "AM";

                hours = hours % 12 || 12; // convert 0 → 12
                minutes = minutes < 10 ? "0" + minutes : minutes;

                return `${hours}:${minutes} ${ampm}`;
            }

            function initClockpicker(inputId, wrapperId, offsetHours = 0) {
                let $input = $(inputId);

                // Set initial value if empty
                if (!$input.val()) {
                    $input.val(getCurrentTime(offsetHours));
                }

                $input.clockpicker({
                    placement: 'bottom',
                    align: 'left',
                    autoclose: true,
                    twelvehour: true,
                    afterDone: function() {
                        let val = $input.val(); // e.g., "2:30 PM"
                        let parts = val.match(/(\d+):(\d+)\s*(AM|PM)/i);

                        if (parts) {
                            let hours = parseInt(parts[1], 10);
                            let minutes = parseInt(parts[2], 10);
                            let ampm = parts[3].toUpperCase();

                            // Convert to 24-hour internally
                            if (ampm === "PM" && hours < 12) hours += 12;
                            if (ampm === "AM" && hours === 12) hours = 0;

                            // Convert back to 12-hour format for display
                            let displayHours = hours % 12 || 12;
                            let displayMinutes = minutes < 10 ? "0" + minutes : minutes;
                            let displayAmPm = hours >= 12 ? "PM" : "AM";

                            $input.val(`${displayHours}:${displayMinutes} ${displayAmPm}`);
                        }
                    }
                });

                // Open clockpicker when wrapper is clicked
                $(wrapperId).on('click', function () {
                    $input.clockpicker('show');
                });
            }

            // Initialize start and end time
            initClockpicker('#time1', '#openTime1');
            initClockpicker('#time2', '#openTime2', 1); // offset 1 hour for end time
        });

        // Tag Input Functionality for Individual, Organization, and Embassy
        function initTagInput(selectId, containerId) {
            const select = document.getElementById(selectId);
            const container = document.getElementById(containerId);
            
            if (!select || !container) return;

            // Get selected user IDs to prevent duplicates
            function getSelectedIds() {
                return Array.from(container.querySelectorAll('input[type="hidden"]')).map(input => input.value);
            }

            // Handle select change
            select.addEventListener('change', function() {
                const selectedValue = this.value;
                const selectedName = this.options[this.selectedIndex]?.dataset.name;
                
                if (selectedValue && selectedName) {
                    const selectedIds = getSelectedIds();
                    
                    // Check if already selected
                    if (selectedIds.includes(selectedValue)) {
                        this.value = '';
                        return;
                    }

                    // Determine field name based on selectId
                    let fieldName = '';
                    if (selectId === 'individual-select') {
                        fieldName = 'individual[]';
                    } else if (selectId === 'organization-select') {
                        fieldName = 'organization[]';
                    } else if (selectId === 'embassy-select') {
                        fieldName = 'embassy[]';
                    }
                    
                    // Create tag
                    const tag = document.createElement('span');
                    tag.className = 'badge bg-secondary d-inline-flex align-items-center';
                    tag.style.cssText = 'padding: 6px 12px; font-size: 0.875rem;';
                    tag.innerHTML = `
                        ${selectedName}
                        <span class="remove-tag ms-2" style="cursor: pointer; font-weight: bold;">&times;</span>
                        <input type="hidden" name="${fieldName}" value="${selectedValue}">
                    `;

                    // Remove functionality
                    tag.querySelector('.remove-tag').addEventListener('click', function() {
                        container.removeChild(tag);
                    });

                    // Insert tag before select
                    container.insertBefore(tag, select);
                    
                    // Reset select
                    this.value = '';
                }
            });

            // Remove existing tags on click
            container.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-tag')) {
                    e.target.closest('.badge').remove();
                }
            });
        }

        // Initialize all three tag inputs
        initTagInput('individual-select', 'individual-container');
        initTagInput('organization-select', 'organization-container');
        initTagInput('embassy-select', 'embassy-container');

        document.getElementById('picture__input').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImage').setAttribute('src', e.target.result);
                };
                reader.readAsDataURL(file);
            }
        });

        setTimeout(() => {
            document.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
            document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        }, 5000);

    document.addEventListener('DOMContentLoaded', function () {
        const eventMode = document.getElementById('event-mode');
        const locationWrapper = document.getElementById('location-wrapper');
        const cityWrapper = document.getElementById('city-wrapper');
        const meetingLinkWrapper = document.getElementById('meeting-link-wrapper');

        function toggleFields() {
            if(eventMode.value === 'onsite' || eventMode.value === '') {
                locationWrapper.style.display = 'block';
                cityWrapper.style.display = 'block';
                meetingLinkWrapper.style.display = 'none';
            } else if(eventMode.value === 'virtual') {
                locationWrapper.style.display = 'none';
                cityWrapper.style.display = 'none';
                meetingLinkWrapper.style.display = 'block';
            }
        }

        if(eventMode){ // safeguard
            eventMode.addEventListener('change', toggleFields);
            toggleFields(); // run on page load to respect old value
        }
    });
    </script>
@endsection