@props([
    'primary_button' => false,
    'secondary_button' => false,
    'lang' => 'en',
    'data' => null,
    'editable' => false
])

@php
    // Null-safe retrieval with defaults
    $bannerTitle = $data['BannerSection']['Title'] ?? 'Banner Section Title';
    $bannerDescription = $data['BannerSection']['Description'] ?? 'Banner Section Description';

    // Register Now button text & URL
    $registerNowText = $data['BannerSection']['Register Now Button']['Text'] ?? 'Register Now';
    $registerNowUrl  = $data['BannerSection']['Register Now Button']['Url'] ?? '#';

    // Learn More button text & URL
    $learnMoreText = $data['BannerSection']['Learn More Button']['Text'] ?? 'Learn More';
    $learnMoreUrl  = $data['BannerSection']['Learn More Button']['Url'] ?? '#';
@endphp

<section class="embassay-common-banner">
    <div class="embassay-common-banner-box">
        <div class="container h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-md-8">
                    <div class="embassay-frame-content">

                        <!-- Banner Title -->
                        @if($editable)
                            <h2 class="ms-2 title-input"
                                id="content[{{ $lang }}][BannerSection][Title]"
                                contenteditable="true">{{ $bannerTitle }}</h2>

                            <input type="text"
                                   id="BannerSection_title"
                                   name="content[{{ $lang }}][BannerSection][Title]"
                                   value="{{ $bannerTitle }}" hidden>
                        @else
                            <h2>{{ $bannerTitle }}</h2>
                        @endif

                        <!-- Banner Description -->
                        @if($editable)
                            <div class="description-input"
                                id="content[{{ $lang }}][BannerSection][Description]"
                                data-text="content[{{ $lang }}][BannerSection][Description]">
                                {!! $bannerDescription !!}
                            </div>

                            <input type="text" hidden
                                   id="BannerSection_description"
                                   name="content[{{ $lang }}][BannerSection][Description]"
                                   value="{{ $bannerDescription }}" />
                        @else
                            <p>{!! $bannerDescription !!}</p>
                        @endif

                        <!-- Buttons -->
                        @if($primary_button || $secondary_button)
                            <div>
                                <!-- Register Now Button -->
                                @isset($primary_button)
                                    @if($editable)
                                        <a type="button"
                                           class="btn embassay-register-btn button-input"
                                           data-aos="fade-up"
                                           data-aos-duration="1000"
                                           data-text="content[{{ $lang }}][BannerSection][Register Now Button][Text]"
                                           data-href="{{ $registerNowUrl }}"
                                           data-url="content[{{ $lang }}][BannerSection][Register Now Button][Url]">
                                           {{ $registerNowText }}
                                        </a>

                                        <input type="text" hidden
                                               id="register_now_btn_text"
                                               name="content[{{ $lang }}][BannerSection][Register Now Button][Text]"
                                               value="{{ $registerNowText }}" />

                                        <input type="text" hidden
                                               id="register_now_btn_url"
                                               name="content[{{ $lang }}][BannerSection][Register Now Button][Url]"
                                               value="{{ $registerNowUrl }}" />
                                    @else
                                        <a href="{{ $registerNowUrl }}" class="btn embassay-register-btn">
                                            {{ $registerNowText }}
                                        </a>
                                    @endif
                                @endisset

                                <!-- Learn More Button -->
                                @isset($secondary_button)
                                    @if($editable)
                                        <a type="button"
                                           class="btn embassay-learn-more pe-3 button-input"
                                           data-text="content[{{ $lang }}][BannerSection][Learn More Button][Text]"
                                           data-href="{{ $learnMoreUrl }}"
                                           data-url="content[{{ $lang }}][BannerSection][Learn More Button][Url]">
                                            {{ $learnMoreText }}
                                            <img src="{{ asset('assets/images/templates/right-arrow.svg') }}"
                                                 alt="right-arrow" class="img-fluid">
                                        </a>

                                        <input type="text" hidden
                                               id="hero_learn_more_btn_text"
                                               name="content[{{ $lang }}][BannerSection][Learn More Button][Text]"
                                               value="{{ $learnMoreText }}" />

                                        <input type="text" hidden
                                               id="hero_learn_more_url"
                                               name="content[{{ $lang }}][BannerSection][Learn More Button][Url]"
                                               value="{{ $learnMoreUrl }}" />
                                    @else
                                        <a href="{{ $learnMoreUrl }}" class="btn embassay-learn-more pe-3">
                                            {{ $learnMoreText }} <i class="fa-solid fa-arrow-right"></i>
                                        </a>
                                    @endif
                                @endisset
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
