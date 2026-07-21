@extends("layouts.master")
@section('content')
@include('super-admin.template.template-css')
<div class="container-fluid container-custom">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header align-items-center d-flex justify-content-between">
                <h3 class="welcome-heading">Template Management</h3>
                <a href="{{ route('preview-template') }}" class="btn btn-theme" style="background-color: #198754; color:white">Preview Home Page</a>
            </div>
            <div class="row">
                @if(isset($templates) && $templates->count() > 0)
                    @foreach($templates as $template)
                        @foreach($template->settings as $setting)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="py-2">
                                <div class="p-relative">
                                    <img src="{{ asset('assets/' . ($setting->template_image ?? 'default-template.jpg')) }}"
                                        class="img-fluid img-theme w-100"
                                        alt="{{ $template->name ?? 'Template' }}"
                                        style="height: 600px">

                                    <div class="template-defult {{ optional($setting)->template_id === $template->id ? '' : 'd-none' }}">
                                        <input class="form-check-input" type="checkbox" checked disabled>
                                    </div>

                                    <div class="middle">
                                        <div class="flex-100">
                                            <form action="{{ route('template-setting', ['id' => $setting->template_id, 'page' => $setting->name]) }}" method="GET">
                                                <button type="submit" class="btn btn-theme bg-success text-white">
                                                    {{ optional($setting)->template_id === $template->id ? 'Edit Template' : 'Use This Template' }}
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endforeach
                @else
                    <p class="text-center">No Template available</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection