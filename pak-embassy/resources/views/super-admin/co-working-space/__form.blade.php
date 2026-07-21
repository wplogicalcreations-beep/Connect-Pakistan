<div class="page-content page-content-ck">
    <div class="page-title">
        <h5 class="go-back" style="cursor: pointer;" onclick="window.history.back();">
            <- Go Back</h5>
    </div>

    <div class="card border-0 p-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form id="coworkingSpaceForm" action="{{ url('co-working-space') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">

                        <!-- 1- Basic Details -->
                        <h1>1- Basic Details</h1>
                        <div class="col-md-12">
                            <div class="form-floating floating-custom">
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       id="spaceName"
                                       name="name"
                                       placeholder="Space Name"
                                       value="{{ old('name') }}">
                                <label for="spaceName">Space Name</label>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating floating-custom">
                                <input type="tel"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       id="phone"
                                       name="phone"
                                       placeholder="+96612345678"
                                       value="{{ old('phone') }}">
                                <label for="phone">Phone No.</label>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating floating-custom">
                                <input type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       id="email"
                                       name="email"
                                       placeholder="coworkspace@email.com"
                                       value="{{ old('email') }}">
                                <label for="email">Email</label>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating floating-custom">
                                <input type="text"
                                       class="form-control @error('starting_price') is-invalid @enderror"
                                       id="startingPrice"
                                       name="starting_price"
                                       placeholder="SAR 25000"
                                       value="{{ old('starting_price') }}">
                                <label for="startingPrice">Starting Price</label>
                                @error('starting_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating floating-custom">
                                <input type="number"
                                       class="form-control @error('month_rentals') is-invalid @enderror"
                                       id="monthRentals"
                                       name="month_rentals"
                                       placeholder="3"
                                       value="{{ old('month_rentals') }}">
                                <label for="monthRentals">Month Rentals</label>
                                @error('month_rentals')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating floating-custom">
                                <input type="number"
                                       class="form-control @error('people') is-invalid @enderror"
                                       id="people"
                                       name="people"
                                       placeholder="50"
                                       value="{{ old('people') }}">
                                <label for="people">No. of Seats</label>
                                @error('people')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating floating-custom">
                                <select class="form-select @error('space_type') is-invalid @enderror" id="spaceType" name="space_type">
                                    <option value="" disabled {{ old('space_type') ? '' : 'selected' }}>Select Space Type</option>
                                    <option value="Hot Desk" {{ old('space_type') == 'Hot Desk' ? 'selected' : '' }}>Hot Desk</option>
                                    <option value="Dedicated Desk" {{ old('space_type') == 'Dedicated Desk' ? 'selected' : '' }}>Dedicated Desk</option>
                                    <option value="Meeting Room" {{ old('space_type') == 'Meeting Room' ? 'selected' : '' }}>Meeting Room</option>
                                </select>
                                <label for="spaceType">Space Type</label>
                                @error('space_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating floating-custom">
                                <input type="text"
                                       class="form-control @error('location') is-invalid @enderror"
                                       id="location"
                                       name="location"
                                       placeholder="Al Badeia'ah Dist., Riyadh"
                                       value="{{ old('location') }}">
                                <label for="location">Location</label>
                                <img src="/images/location_on.svg">
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating floating-custom">
                                <select class="form-select @error('is_active') is-invalid @enderror" id="status" name="is_active">
                                    <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Pending</option>
                                </select>
                                <label for="status">Status</label>
                                @error('is_active')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- 2- Space Info -->
                        <h1 class="mt-5">2- Space Info</h1>
                        <div class="col-md-12">
                            <div class="floating-custom-common">
                                <div class="common-design">
                                    <textarea class="form-control ckeditor @error('space_overview') is-invalid @enderror"
                                              id="spaceOverview"
                                              name="space_overview">{{ old('space_overview') }}</textarea>
                                    <label for="spaceOverview">Space Overview</label>
                                    @error('space_overview')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="floating-custom-common">
                                <div class="common-design">
                                    <textarea class="form-control ckeditor @error('space_description') is-invalid @enderror"
                                              id="spaceDescription"
                                              name="space_description">{{ old('space_description') }}</textarea>
                                    <label for="spaceDescription">Description</label>
                                    @error('space_description')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="floating-custom-common">
                                <div class="common-design">
                                    <textarea class="form-control ckeditor @error('space_amenities') is-invalid @enderror"
                                              id="spaceAmenities"
                                              name="space_amenities">{{ old('space_amenities') }}</textarea>
                                    <label for="spaceAmenities">Amenities</label>
                                    @error('space_amenities')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- 3- Upload Space Pictures -->
                        <h1 class="mt-5">3- Upload Space Pictures</h1>
                        <div class="col-md-12">
                            <div class="img-chose-input">
                                <label class="picture" for="picture__input" tabindex="0">
                                    <span class="picture__image" id="picturePreview">
                                        <img src="/images/majesticons_image-line.svg" alt="Preview">
                                    </span>
                                    Upload Image
                                </label>
                                <input type="file" name="image" id="picture__input" accept="image/*">
                                <p>Photos should be in “jpeg, jpg, png, gif” format only</p>
                                 @error('image')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="col-md-12 upload-btns">
                            <button type="reset" class="btn btn-outline-secondary button-style">Cancel</button>
                            <button type="submit" class="btn btn-common-bg">Add Space</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/jquery/ckeditor.js') }}"></script>
<script src="{{ asset('js/SuperAdmin/form-ckeditor.js') }}"></script>
<script>
document.getElementById('picture__input').addEventListener('change', function(event) {
    const preview = document.getElementById('picturePreview');
    preview.innerHTML = '';
    const file = event.target.files[0];
    if (file) {
        const img = document.createElement('img');
        img.src = URL.createObjectURL(file);
        img.style.maxWidth = "150px";
        img.style.maxHeight = "150px";
        preview.appendChild(img);
    }
});

setTimeout(() => {
    document.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
    document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
}, 5000);
</script>