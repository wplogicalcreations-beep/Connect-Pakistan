@extends("layouts.master")
@section("content")
    <div class="page-content general-setting">
        <div class="page-title">
            <h3>General Settings</h3>
        </div>
        <div class="row g-3">
            {{-- Site Logo --}}
                <div class="col-md-8">
                <h4 class="my-3 fw-bold">Site Logo</h4>
                <div class="card border-0 p-3">
                    <form action="{{ route('settings.general.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="img-chose-input">
                            <label class="picture" for="site_logo" tabindex="0">
                                <span class="picture__image">
                                    <img id="preview_site_logo"
                                        src="{{ $settings?->site_logo ? asset('storage/' . $settings->site_logo) : '/images/logo-2.svg' }}"
                                        alt="Site Logo"
                                        class="img-thumbnail"
                                        style="width:200px; height:100px; object-fit:contain;">
                                </span>
                                <input type="file" class="form-control mt-2" name="site_logo" id="site_logo"
                                    onchange="previewImage(this, 'preview_site_logo')">
                            </label>
                        </div>
                        <div class="chose-btn mt-2 d-flex justify-content-end align-items-center">
                            <button type="submit" class="btn btn-common-bg">Update</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Favicon --}}
            <div class="col-md-4">
                <h4 class="my-3 fw-bold">Favicon</h4>
                <div class="card border-0 p-3">
                    <form action="{{ route('settings.general.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="img-chose-input text-center">
                            <img id="preview_favicon"
                                src="{{ $settings?->favicon ? asset('storage/' . $settings->favicon) : '/images/logo-2-2.svg' }}"
                                alt="Favicon"
                                class="img-thumbnail"
                                style="width:90px; height:90px; object-fit:contain;">
                            
                            <!-- File input below image -->
                            <input type="file" class="form-control mt-2"
                                name="favicon" id="favicon"
                                onchange="previewImage(this, 'preview_favicon')">
                        </div>

                        <div class="chose-btn mt-2 d-flex justify-content-end align-items-center">
                            <button type="submit" class="btn btn-common-bg">Update</button>
                        </div>
                    </form>
                </div>
            </div>

            <hr class="my-5">

            {{-- Social Links --}}
            <div class="col-md-10">
                <h4 class="fw-bold">Social Links</h4>
                <div class="social-links-setting">
                    <form action="{{ route('settings.general.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="social_links" value="1">
                        <div class="row g-3">

                            <div class="col-md-6">
                                <div class="form-floating floating-custom">
                                    <input type="text" class="form-control" name="linkedin"
                                           value="{{ old('linkedin', $settings->linkedin ?? '') }}"
                                           id="linkedIn" placeholder="LinkedIn">
                                    <label for="linkedIn">LinkedIn</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating floating-custom">
                                    <input type="text" class="form-control" name="facebook"
                                           value="{{ old('facebook', $settings->facebook ?? '') }}"
                                           id="facebook" placeholder="Facebook">
                                    <label for="facebook">Facebook</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating floating-custom">
                                    <input type="text" class="form-control" name="twitter"
                                           value="{{ old('twitter', $settings->twitter ?? '') }}"
                                           id="twitter" placeholder="Twitter">
                                    <label for="twitter">X (Twitter)</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating floating-custom">
                                    <input type="text" class="form-control" name="instagram"
                                           value="{{ old('instagram', $settings->instagram ?? '') }}"
                                           id="instagram" placeholder="Instagram">
                                    <label for="instagram">Instagram</label>
                                </div>
                            </div>

                            <div class="upload-btns">
                                <button type="submit" class="btn btn-common-bg">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('js-file')
<script>
    @if(session('success'))
        showToast("{{ session('success') }}");
    @endif

    @if(session('error'))
        showToast("{{ session('error') }}");
    @endif

    function previewImage(input, previewId) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(previewId).src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection