<section>
    <!-- File Inputs (unchanged) -->
    <input type="file" accept="image/*" id="bgImage3"
        name="content[{{ $lang }}][HeroSection1][Background Image]" class="form-control" hidden>
    @if ($data)
        <input type="hidden" name="content[{{ $lang }}][HeroSection1][old_Background Image]"
            value="{{ $data['HeroSection1'] ? $data['HeroSection1']['Background Image'] : 'assets/images/templates/banner-bg.png' }}">
    @else
        <input type="hidden" name="content[{{ $lang }}][HeroSection1][old_Background Image]"
            value="assets/images/templates/banner-bg.png">
    @endif

    <input type="file" accept="image/*" id="bgImage4"
        name="content[{{ $lang }}][HeroSection2][Background Image]" class="form-control" hidden>
    @if ($data)
        <input type="hidden" name="content[{{ $lang }}][HeroSection2][old_Background Image]"
            value="{{ $data['HeroSection2'] ? $data['HeroSection2']['Background Image'] : 'assets/images/templates/banner-bg.png' }}">
    @else
        <input type="hidden" name="content[{{ $lang }}][HeroSection2][old_Background Image]"
            value="assets/images/templates/banner-bg.png">
    @endif

    <input type="file" accept="image/*" id="bgImage5"
        name="content[{{ $lang }}][HeroSection3][Background Image]" class="form-control" hidden>
    @if ($data)
        <input type="hidden" name="content[{{ $lang }}][HeroSection3][old_Background Image]"
            value="{{ $data['HeroSection3'] ? $data['HeroSection3']['Background Image'] : 'assets/images/templates/banner-bg.png' }}">
    @else
        <input type="hidden" name="content[{{ $lang }}][HeroSection3][old_Background Image]"
            value="assets/images/templates/banner-bg.png">
    @endif

    <input type="file" accept="image/*" id="attachmentImage1"
        name="content[{{ $lang }}][HeroSection1][Image]" hidden>
    @if ($data)
        <input type="hidden" name="content[{{ $lang }}][HeroSection1][old_Image]"
            value="{{ $data['HeroSection1'] ? $data['HeroSection1']['Image'] : 'assets/images/templates/banner-frame-right.png' }}">
    @else
        <input type="hidden" name="content[{{ $lang }}][HeroSection1][old_Image]"
            value="assets/images/templates/banner-frame-right.png">
    @endif

    <input type="file" accept="image/*" id="attachmentImage2"
        name="content[{{ $lang }}][HeroSection2][Image]" hidden>
    @if ($data)
        <input type="hidden" name="content[{{ $lang }}][HeroSection2][old_Image]"
            value="{{ $data['HeroSection2'] ? $data['HeroSection2']['Image'] : 'assets/images/templates/banner-frame-right.png' }}">
    @else
        <input type="hidden" name="content[{{ $lang }}][HeroSection2][old_Image]"
            value="assets/images/templates/banner-frame-right.png">
    @endif

    <input type="file" accept="image/*" id="attachmentImage3"
        name="content[{{ $lang }}][HeroSection3][Image]" hidden>
    @if ($data)
        <input type="hidden" name="content[{{ $lang }}][HeroSection3][old_Image]"
            value="{{ $data['HeroSection3'] ? $data['HeroSection3']['Image'] : 'assets/images/templates/banner-frame-right.png' }}">
    @else
        <input type="hidden" name="content[{{ $lang }}][HeroSection3][old_Image]"
            value="assets/images/templates/banner-frame-right.png">
    @endif

    <!-- Bootstrap Carousel -->
    <div id="heroCarousel" class="carousel slide strengh-ties" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
        <div class="carousel-inner">

            <!-- Hero Section 1 -->
            <div class="carousel-item active">
                @if ($data && $data['HeroSection1']['Background Image'])
                    <div id="output_bgImage3" class="strengh-ties-box"
                        style="background-image: url({{ asset($data['HeroSection1']['Background Image']) }})">
                    @else
                        <div class="strengh-ties-box" id="output_bgImage3">
                @endif

                <div class="text-center">
                    <label for="bgImage3" class="pointer mb-0">
                        <a style="background-color: #198754; color:white" type="button"
                            class="btn btn-theme btn-hover">Change Background Image</a>
                    </label>
                </div>

                <!-- Content -->
                <div class="container">
                    <div class="row g-5">
                        <div class="col-md-6" data-aos="fade-right" data-aos-duration="1000">
                            <div class="frame-left-content">
                                <h2 class="title-input"
                                    id="content[{{ $lang }}][HeroSection1][Title]"
                                    contenteditable="true">
                                    {{ $data ? $data['HeroSection1']['Title'] : 'Strengthening Ties, Enabling Success' }}
                                </h2>
                                <input type="text" hidden id="HeroSection1_title"
                                    name="content[{{ $lang }}][HeroSection1][Title]"
                                    value="{{ $data ? $data['HeroSection1']['Title'] : 'Strengthening Ties, Enabling Success' }}" />
                                <div class="description-input"
                                    id="content[{{ $lang }}][HeroSection1][Description]"
                                    data-text="content[{{ $lang }}][HeroSection1][Description]">
                                    {!! $data
                                        ? $data['HeroSection1']['Description']
                                        : "Strengthen bilateral trade and economic cooperation through strategic networking,
                                                                                                                                                                                business
                                                                                                                                                                                meetups, and embassy-supported collaborations" !!}</div>
                                <input type="text" hidden id="HeroSection1_description"
                                    name="content[{{ $lang }}][HeroSection1][Description]"
                                    value="{{ $data
                                        ? $data['HeroSection1']['Description']
                                        : "Strengthen bilateral trade and economic cooperation through strategic networking,
                                                                                                                                                                                business
                                                                                                                                                                                meetups, and embassy-supported collaborations" }}" />
                                <div>
                                    <a type="button" class="btn register-btn button-input"
                                        id=""
                                        data-text="content[{{ $lang }}][HeroSection1][Register Now Button][Text]"
                                        data-href="{{ $data ? $data['HeroSection1']['Register Now Button']['Url'] : '#' }}"
                                        data-url="content[{{ $lang }}][HeroSection1][Register Now Button][Url]">
                                        {{ $data ? $data['HeroSection1']['Register Now Button']['Text'] : 'Register Now' }}</a>
                                    <input type="text" hidden id="hero_register_now_btn_text"
                                        name="content[{{ $lang }}][HeroSection1][Register Now Button][Text]"
                                        value="{{ $data ? $data['HeroSection1']['Register Now Button']['Text'] : 'Register Now' }}" />
                                    <input type="text" hidden id="hero_register_now_btn_url"
                                        name="content[{{ $lang }}][HeroSection1][Register Now Button][Url]"
                                        value="{{ $data ? $data['HeroSection1']['Register Now Button']['Url'] : '#' }}" />

                                    <a type="button" class="btn learn-more button-input" id=""
                                        data-text="content[{{ $lang }}][HeroSection1][Learn More Button][Text]"
                                        data-href="{{ $data ? $data['HeroSection1']['Learn More Button']['Url'] : '#' }}"
                                        data-url="content[{{ $lang }}][HeroSection1][Learn More Button][Url]">
                                        {{ $data ? $data['HeroSection1']['Learn More Button']['Text'] : 'Learn More' }}
                                        <img src="{{ asset('assets/images/templates/right-arrow.svg') }}"
                                            alt="right-arrow" class="img-fluid ">
                                    </a>
                                    <input type="text" hidden id="hero_learn_more_btn_text"
                                        name="content[{{ $lang }}][HeroSection1][Learn More Button][Text]"
                                        value="{{ $data ? $data['HeroSection1']['Learn More Button']['Text'] : 'Learn More' }}" />
                                    <input type="text" hidden id="hero_learn_more_url"
                                        name="content[{{ $lang }}][HeroSection1][Learn More Button][Url]"
                                        value="{{ $data ? $data['HeroSection1']['Learn More Button']['Url'] : '#' }}" />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6" data-aos="fade-left" data-aos-duration="1000">
                            <div class="right-frame-main">
                                <label for="attachmentImage1" class="pointer">
                                    <div id="preimageImage1" style="display:block">
                                        <img alt="right-frame" class="img-fluid" id='output_image1'
                                            src="{{ $data ? asset($data['HeroSection1']['Image']) : asset('assets/images/templates/banner-frame-right.png') }}">
                                    </div>

                                </label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Hero Section 2 -->
        <div class="carousel-item">
            @if ($data && $data['HeroSection2']['Background Image'])
                <div id="output_bgImage4" class="strengh-ties-box"
                    style="background-image: url({{ asset($data['HeroSection2']['Background Image']) }})">
                @else
                    <div class="strengh-ties-box" id="output_bgImage4">
            @endif

            <div class="text-center">
                <label for="bgImage4" class="pointer mb-0">
                    <a style="background-color: #198754; color:white" type="button"
                        class="btn btn-theme btn-hover">Change Background Image</a>
                </label>
            </div>

            <!-- Content -->
            <div class="container">
                <div class="row g-5">
                    <div class="col-md-6" data-aos="fade-right" data-aos-duration="1000">
                        <div class="frame-left-content">

                            <h2 class="title-input"
                                id="content[{{ $lang }}][HeroSection2][Title]"
                                contenteditable="true">
                                {{ $data ? $data['HeroSection2']['Title'] : 'Strengthening Ties, Enabling Success' }}
                            </h2>
                            <input type="text" hidden id="HeroSection2_title"
                                name="content[{{ $lang }}][HeroSection2][Title]"
                                value="{{ $data ? $data['HeroSection2']['Title'] : 'Strengthening Ties, Enabling Success' }}" />

                            <div class="description-input"
                                id="content[{{ $lang }}][HeroSection2][Description]"
                                data-text="content[{{ $lang }}][HeroSection2][Description]">
                                {!! $data
                                    ? $data['HeroSection2']['Description']
                                    : "Strengthen bilateral trade and economic cooperation through strategic networking,
                                                                                                                                                                    business
                                                                                                                                                                    meetups, and embassy-supported collaborations" !!}</div>
                            <input type="text" hidden id="HeroSection2_description"
                                name="content[{{ $lang }}][HeroSection2][Description]"
                                value="{{ $data
                                    ? $data['HeroSection2']['Description']
                                    : "Strengthen bilateral trade and economic cooperation through strategic networking,
                                                                                                                                                                    business
                                                                                                                                                                    meetups, and embassy-supported collaborations" }}" />
                            <div>
                                <a type="button" class="btn register-btn button-input" id=""
                                    data-text="content[{{ $lang }}][HeroSection2][Register Now Button][Text]"
                                    data-href="{{ $data ? $data['HeroSection2']['Register Now Button']['Url'] : '#' }}"
                                    data-url="content[{{ $lang }}][HeroSection2][Register Now Button][Url]">
                                    {{ $data ? $data['HeroSection2']['Register Now Button']['Text'] : 'Register Now' }}</a>
                                <input type="text" hidden id="hero2_register_now_btn_text"
                                    name="content[{{ $lang }}][HeroSection2][Register Now Button][Text]"
                                    value="{{ $data ? $data['HeroSection2']['Register Now Button']['Text'] : 'Register Now' }}" />
                                <input type="text" hidden id="hero2_register_now_btn_url"
                                    name="content[{{ $lang }}][HeroSection2][Register Now Button][Url]"
                                    value="{{ $data ? $data['HeroSection2']['Register Now Button']['Url'] : '#' }}" />
                                <a type="button" class="btn learn-more button-input" id=""
                                    data-text="content[{{ $lang }}][HeroSection2][Learn More Button][Text]"
                                    data-href="{{ $data ? $data['HeroSection2']['Learn More Button']['Url'] : '#' }}"
                                    data-url="content[{{ $lang }}][HeroSection2][Learn More Button][Url]">
                                    {{ $data ? $data['HeroSection2']['Learn More Button']['Text'] : 'Learn More' }}
                                    <img src="{{ asset('assets/images/templates/right-arrow.svg') }}"
                                        alt="right-arrow" class="img-fluid ">
                                </a>
                                <input type="text" hidden id="hero_learn_more_btn_text"
                                    name="content[{{ $lang }}][HeroSection2][Learn More Button][Text]"
                                    value="{{ $data ? $data['HeroSection2']['Learn More Button']['Text'] : 'Learn More' }}" />
                                <input type="text" hidden id="hero_learn_more_url"
                                    name="content[{{ $lang }}][HeroSection2][Learn More Button][Url]"
                                    value="{{ $data ? $data['HeroSection2']['Learn More Button']['Url'] : '#' }}" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" data-aos="fade-left" data-aos-duration="1000">
                        <div class="right-frame-main">
                            <label for="attachmentImage2" class="pointer">
                                <div id="preimageImage2" style="display:block">
                                    <img alt="right-frame" class="img-fluid" id='output_image2'
                                        src="{{ $data ? asset($data['HeroSection2']['Image']) : asset('assets/images/templates/banner-frame-right.png') }}">
                                </div>

                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Section 3 -->
    <div class="carousel-item">
        @if ($data && $data['HeroSection3']['Background Image'])
            <div id="output_bgImage5" class="strengh-ties-box"
                style="background-image: url({{ asset($data['HeroSection3']['Background Image']) }})">
            @else
                <div class="strengh-ties-box" id="output_bgImage5">
        @endif

        <div class="text-center">
            <label for="bgImage5" class="pointer mb-0">
                <a style="background-color: #198754; color:white" type="button"
                    class="btn btn-theme btn-hover">Change Background Image</a>
            </label>
        </div>

        <!-- Content -->
        <div class="container">
            <div class="row g-5">
                <div class="col-md-6" data-aos="fade-right" data-aos-duration="1000">
                    <div class="frame-left-content">

                        <h2 class="title-input" id="content[{{ $lang }}][HeroSection3][Title]"
                            contenteditable="true">
                            {{ $data ? $data['HeroSection3']['Title'] : 'Strengthening Ties, Enabling Success' }}
                        </h2>
                        <input type="text" hidden id="HeroSection3_title"
                            name="content[{{ $lang }}][HeroSection3][Title]"
                            value="{{ $data ? $data['HeroSection3']['Title'] : 'Strengthening Ties, Enabling Success' }}" />

                        <div class="description-input"
                            id="content[{{ $lang }}][HeroSection3][Description]"
                            data-text="content[{{ $lang }}][HeroSection3][Description]">
                            {!! $data
                                ? $data['HeroSection3']['Description']
                                : "Strengthen bilateral trade and economic cooperation through strategic networking,
                                                                                                                                                            business
                                                                                                                                                            meetups, and embassy-supported collaborations" !!}</div>
                        <input type="text" hidden id="HeroSection3_description"
                            name="content[{{ $lang }}][HeroSection3][Description]"
                            value="{{ $data
                                ? $data['HeroSection3']['Description']
                                : "Strengthen bilateral trade and economic cooperation through strategic networking,
                                                                                                                                                            business
                                                                                                                                                            meetups, and embassy-supported collaborations" }}" />
                        <div>
                            <a type="button" class="btn register-btn button-input" id=""
                                data-text="content[{{ $lang }}][HeroSection3][Register Now Button][Text]"
                                data-href="{{ $data ? $data['HeroSection3']['Register Now Button']['Url'] : '#' }}"
                                data-url="content[{{ $lang }}][HeroSection3][Register Now Button][Url]">
                                {{ $data ? $data['HeroSection3']['Register Now Button']['Text'] : 'Register Now' }}</a>
                            <input type="text" hidden id="hero3_register_now_btn_text"
                                name="content[{{ $lang }}][HeroSection3][Register Now Button][Text]"
                                value="{{ $data ? $data['HeroSection3']['Register Now Button']['Text'] : 'Register Now' }}" />
                            <input type="text" hidden id="hero3_register_now_btn_url"
                                name="content[{{ $lang }}][HeroSection3][Register Now Button][Url]"
                                value="{{ $data ? $data['HeroSection3']['Register Now Button']['Url'] : '#' }}" />
                            <a type="button" class="btn learn-more button-input" id=""
                                data-text="content[{{ $lang }}][HeroSection3][Learn More Button][Text]"
                                data-href="{{ $data ? $data['HeroSection3']['Learn More Button']['Url'] : '#' }}"
                                data-url="content[{{ $lang }}][HeroSection3][Learn More Button][Url]">
                                {{ $data ? $data['HeroSection3']['Learn More Button']['Text'] : 'Learn More' }}
                                <img src="{{ asset('assets/images/templates/right-arrow.svg') }}"
                                    alt="right-arrow" class="img-fluid ">
                            </a>
                            <input type="text" hidden id="hero_learn_more_btn_text"
                                name="content[{{ $lang }}][HeroSection3][Learn More Button][Text]"
                                value="{{ $data ? $data['HeroSection3']['Learn More Button']['Text'] : 'Learn More' }}" />
                            <input type="text" hidden id="hero_learn_more_url"
                                name="content[{{ $lang }}][HeroSection3][Learn More Button][Url]"
                                value="{{ $data ? $data['HeroSection3']['Learn More Button']['Url'] : '#' }}" />
                        </div>

                    </div>
                </div>
                <div class="col-md-6" data-aos="fade-left" data-aos-duration="1000">
                    <div class="right-frame-main">
                        <label for="attachmentImage3" class="pointer">
                            <div id="preimageImage3" style="display:block">
                                <img alt="right-frame" class="img-fluid" id='output_image3'
                                    src="{{ $data ? asset($data['HeroSection3']['Image']) : asset('assets/images/templates/banner-frame-right.png') }}">
                            </div>

                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <!-- Carousel Controls -->
    {{-- <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button> --}}
    </div>
</section>

<section class="ambassador-vision">
    <div class="container">
        <div class="row">
            <div class="col-lg-4" data-aos="fade-right" data-aos-duration="1000">
                <div class="ambassador-img">
                    <label for="attachmentImage4" class="pointer">
                        <div id="preimageImage4" style="display:block">
                            <img alt="ambasodor" class="img-fluid w-100" id='output_image4'
                                src="{{ $data ? asset($data['AmbassadorMessageSection']['Image']) : asset('assets/images/templates/ambasodor.png') }}">
                        </div>
                        <input type="file" accept="image/*" id="attachmentImage4"
                            name="content[{{ $lang }}][AmbassadorMessageSection][Image]" hidden>
                        @if ($data)
                            <input type="hidden"
                                name="content[{{ $lang }}][AmbassadorMessageSection][old_Image]"
                                value="{{ $data['AmbassadorMessageSection'] ? $data['AmbassadorMessageSection']['Image'] : 'assets/images/templates/ambasodor.png' }}">
                        @else
                            <input type="hidden"
                                name="content[{{ $lang }}][AmbassadorMessageSection][old_Image]"
                                value="assets/images/templates/ambasodor.png">
                        @endif
                    </label>
                </div>
            </div>
            <div class="col-lg-8" data-aos="fade-left" data-aos-duration="1000">
                <div class="ambasodor-vision-right-content">
                    <div>
                        <label for="attachmentIcon8" class="pointer">
                            <div id="preimageIcon8" style="display:block">
                                <img id='output_icon8'
                                    src="{{ $data ? asset($data['AmbassadorMessageSection']['Title Icon']) : asset('assets/images/templates/ambsdr-icons-Group.svg') }}"
                                    alt="">
                            </div>
                            <input type="file" accept="image/*" id="attachmentIcon8"
                                name="content[{{ $lang }}][AmbassadorMessageSection][Title Icon]"
                                value="" hidden>
                            <input type="text"
                                name="content[{{ $lang }}][AmbassadorMessageSection][old_Icon]"
                                value="assets/images/templates/ambsdr-icons-Group.svg" hidden>
                        </label>
                        <span class="ms-2 title-input"
                            id="content[{{ $lang }}][AmbassadorMessageSection][Title]"
                            contenteditable="true">{{ $data ? $data['AmbassadorMessageSection']['Title'] : 'Ambassador Vision' }}</span>
                        <input type="text" id="AmbassadorMessageSection_title"
                            value="{{ $data ? $data['AmbassadorMessageSection']['Title'] : 'Ambassador Vision' }}"
                            name="content[{{ $lang }}][AmbassadorMessageSection][Title]" hidden>
                    </div>

                    <h3 class="title-input"
                        id="content[{{ $lang }}][AmbassadorMessageSection][Subtitle]"
                        contenteditable="true">{!! $data
                            ? $data['AmbassadorMessageSection']['Subtitle']
                            : '<span>H.E. Ahmad Farooq</span> Ambassador of Pakistan to Kingdom of Saudi Arabia' !!}</h3>
                    <input type="text" id="AmbassadorMessageSection_subtitle"
                        value="{!! $data
                            ? $data['AmbassadorMessageSection']['Subtitle']
                            : '<span>H.E. Ahmad Farooq</span> Ambassador of Pakistan to Kingdom of Saudi Arabia' !!}"
                        name="content[{{ $lang }}][AmbassadorMessageSection][Subtitle]" hidden>
                    <div class="ambasodor-text">
                        <img src="{{asset('assets/images/templates/carbon_quotes.svg')}}" alt="" class="img-fluid">
                        <div class="description-input"
                            id="content[{{$lang}}][AmbassadorMessageSection][Description]"
                            data-text="content[{{$lang}}][AmbassadorMessageSection][Description]">{!! $data ? $data['AmbassadorMessageSection']['Description'] : '<p>
                            To enhance the integration and success of Pakistani talent and businesses in the
                            Kingdom of Saudi Arabia by fostering strategic partnerships, facilitating knowledge
                            exchange, encouraging entrepreneurship, enabling workforce development, supporting
                            innovation, strengthening trade relations, promoting cultural synergy, and advancing
                            bilateral economic collaboration that drives sustainable growth, mutual prosperity,
                            and long-term regional impact.
                            <img src="assets/images/templates/carbon_quotes.svg" alt="" class="img-fluid">
                            </p>' !!}</div>
                            <input type="text" hidden
                                    id="AmbassadorMessageSection_description"
                                    name="content[{{$lang}}][AmbassadorMessageSection][Description]"
                                    value="{{ $data ? $data['AmbassadorMessageSection']['Description'] : '<p>
                            To enhance the integration and success of Pakistani talent and businesses in the
                            Kingdom of Saudi Arabia by fostering strategic partnerships, facilitating knowledge
                            exchange, encouraging entrepreneurship, enabling workforce development, supporting
                            innovation, strengthening trade relations, promoting cultural synergy, and advancing
                            bilateral economic collaboration that drives sustainable growth, mutual prosperity,
                            and long-term regional impact.
                            <img src="assets/images/templates/carbon_quotes.svg" alt="" class="img-fluid">
                            </p>' }}"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pak-ksa-main">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8" data-aos="fade-right" data-aos-duration="1000">
                <div class="pak-ksa-content">
                    <div>
                        <label for="attachmentIcon9" class="pointer">
                            <div id="preimageIcon9" style="display:block">
                                <img class="img-fluid" id='output_icon9'
                                    src="{{ $data ? asset($data['WhyNeedUsSection']['Title Icon']) : asset('assets/images/templates/ambsdr-icons-Group.svg') }}"
                                    alt="">
                            </div>
                            <input type="file" accept="image/*" id="attachmentIcon9"
                                name="content[{{ $lang }}][WhyNeedUsSection][Title Icon]"
                                value="" hidden>
                            <input type="text"
                                name="content[{{ $lang }}][WhyNeedUsSection][old_Icon]"
                                value="assets/images/templates/ambsdr-icons-Group.svg" hidden>
                        </label>
                        <span class="ms-2 title-input"
                            id="content[{{ $lang }}][WhyNeedUsSection][Title]"
                            contenteditable="true">{{ $data ? $data['WhyNeedUsSection']['Title'] : 'Why NEED Us' }}</span>
                        <input type="text" id="WhyNeedUsSection_title"
                            value="{{ $data ? $data['WhyNeedUsSection']['Title'] : 'Why NEED Us' }}"
                            name="content[{{ $lang }}][WhyNeedUsSection][Title]" hidden>
                    </div>
                    <h3 class="title-input"
                        id="content[{{ $lang }}][WhyNeedUsSection][Subtitle]"
                        contenteditable="true">{!! $data
                            ? $data['WhyNeedUsSection']['Subtitle']
                            : 'Empowering Pakistanis in KSA through <span>Trusted Embassy Connections.' !!}</h3>
                    <input type="text" id="WhyNeedUsSection_subtitle" value="{!! $data
                        ? $data['WhyNeedUsSection']['Subtitle']
                        : 'Empowering Pakistanis in KSA through <span>Trusted Embassy Connections.' !!}"
                        name="content[{{ $lang }}][WhyNeedUsSection][Subtitle]" hidden>

                    <div class="description-input"
                        id="content[{{ $lang }}][WhyNeedUsSection][Description]"
                        data-text="content[{{ $lang }}][WhyNeedUsSection][Description]">
                        {!! $data
                            ? $data['WhyNeedUsSection']['Description']
                            : '<p class="pak-ksa-text">An official platform by the Embassy of Pakistan to connect, verify,
                                                                                                                                                                                    and support Pakistani professionals and businesses in Saudi Arabia.</p>' !!}</div>
                    <input type="text" hidden id="WhyNeedUsSection_description"
                        name="content[{{ $lang }}][WhyNeedUsSection][Description]"
                        value="{{ $data
                            ? $data['WhyNeedUsSection']['Description']
                            : '<p class="pak-ksa-text">An official platform by the Embassy of Pakistan to connect, verify,
                                                                                                                                                                                    and support Pakistani professionals and businesses in Saudi Arabia.</p>' }}" />
                    <div class="card-main">
                        <div class="card-single">
                            <div class="icon-area">
                                <label for="attachmentIcon10" class="pointer">
                                    <div id="preimageIcon10" style="display:block">
                                        <img id='output_icon10'
                                            src="{{ $data ? asset($data['WhyNeedUsSection']['Business Growth']['Icon']) : asset('assets/images/templates/business-growth.svg') }}"
                                            alt="">
                                    </div>
                                    <input type="file" accept="image/*" id="attachmentIcon10"
                                        name="content[{{ $lang }}][WhyNeedUsSection][Business Growth][Icon]"
                                        value="" hidden>
                                    <input type="text"
                                        name="content[{{ $lang }}][WhyNeedUsSection][Business Growth][old_Icon]"
                                        value="assets/images/templates/business-growth.svg" hidden>
                                </label>

                                <p class="title-input"
                                    id="content[{{ $lang }}][WhyNeedUsSection][Business Growth][Title]"
                                    contenteditable="true">{!! $data ? $data['WhyNeedUsSection']['Business Growth']['Title'] : 'Business Growth' !!}</p>
                                <input type="text" id="WhyNeedUsSection_business_title"
                                    value="{!! $data ? $data['WhyNeedUsSection']['Business Growth']['Title'] : 'Business Growth' !!}"
                                    name="content[{{ $lang }}][WhyNeedUsSection][Business Growth][Title]"
                                    hidden>
                            </div>
                            <div class="card-text">
                                <img src="{{ asset('assets/images/templates/small-tick.svg') }}"
                                    alt="" class="img-fluid">
                                <span class="title-input"
                                    id="content[{{ $lang }}][WhyNeedUsSection][Business Growth][Description][One]"
                                    contenteditable="true">{{ $data ? $data['WhyNeedUsSection']['Business Growth']['Description']['One'] : 'Expand market reach' }}</span>
                                <input type="text" id="WhyNeedUsSection_business_description_one_title"
                                    value="{{ $data ? $data['WhyNeedUsSection']['Business Growth']['Description']['One'] : 'Expand market reach' }}"
                                    name="content[{{ $lang }}][WhyNeedUsSection][Business Growth][Description][One]"
                                    hidden>
                            </div>
                            <div class="card-text">
                                <img src="{{ asset('assets/images/templates/small-tick.svg') }}"
                                    alt="" class="img-fluid">
                                <span class="title-input"
                                    id="content[{{ $lang }}][WhyNeedUsSection][Business Growth][Description][Two]"
                                    contenteditable="true">{{ $data ? $data['WhyNeedUsSection']['Business Growth']['Description']['Two'] : 'Innovate through feedback' }}</span>
                                <input type="text" id="WhyNeedUsSection_business_description_Two_title"
                                    value="{{ $data ? $data['WhyNeedUsSection']['Business Growth']['Description']['Two'] : 'Innovate through feedback' }}"
                                    name="content[{{ $lang }}][WhyNeedUsSection][Business Growth][Description][Two]"
                                    hidden>
                            </div>
                        </div>
                        <div class="card-single">
                            <div class="icon-area">
                                <label for="attachmentIcon11" class="pointer">
                                    <div id="preimageIcon11" style="display:block">
                                        <img class="icon-area-2" id='output_icon11'
                                            src="{{ $data ? asset($data['WhyNeedUsSection']['Talent Discovery']['Icon']) : asset('assets/images/templates/talent-discovery.svg') }}"
                                            alt="">
                                    </div>
                                    <input type="file" accept="image/*" id="attachmentIcon11"
                                        name="content[{{ $lang }}][WhyNeedUsSection][Talent Discovery][Icon]"
                                        value="" hidden>
                                    <input type="text"
                                        name="content[{{ $lang }}][WhyNeedUsSection][Talent Discovery][old_Icon]"
                                        value="assets/images/templates/talent-discovery.svg" hidden>
                                </label>
                                <p class="title-input"
                                    id="content[{{ $lang }}][WhyNeedUsSection][Talent Discovery][Title]"
                                    contenteditable="true">{!! $data ? $data['WhyNeedUsSection']['Talent Discovery']['Title'] : 'Talent Discovery' !!}</p>
                                <input type="text" id="WhyNeedUsSection_talent_title"
                                    value="{!! $data ? $data['WhyNeedUsSection']['Talent Discovery']['Title'] : 'Talent Discovery' !!}"
                                    name="content[{{ $lang }}][WhyNeedUsSection][Talent Discovery][Title]"
                                    hidden>
                            </div>
                            <div class="card-text">
                                <img src="{{ asset('assets/images/templates/small-tick.svg') }}"
                                    alt="" class="img-fluid">
                                <span class="title-input"
                                    id="content[{{ $lang }}][WhyNeedUsSection][Talent Discovery][Description][One]"
                                    contenteditable="true">{{ $data ? $data['WhyNeedUsSection']['Talent Discovery']['Description']['One'] : 'Identify skilled individuals' }}</span>
                                <input type="text" id="WhyNeedUsSection_talent_description_one_title"
                                    value="{{ $data ? $data['WhyNeedUsSection']['Talent Discovery']['Description']['One'] : 'Identify skilled individuals' }}"
                                    name="content[{{ $lang }}][WhyNeedUsSection][Talent Discovery][Description][One]"
                                    hidden>
                            </div>
                            <div class="card-text">
                                <img src="{{ asset('assets/images/templates/small-tick.svg') }}"
                                    alt="" class="img-fluid">
                                <span class="title-input"
                                    id="content[{{ $lang }}][WhyNeedUsSection][Talent Discovery][Description][Two]"
                                    contenteditable="true">{{ $data ? $data['WhyNeedUsSection']['Talent Discovery']['Description']['Two'] : 'Nurture emerging talent' }}</span>
                                <input type="text" id="WhyNeedUsSection_talent_description_Two_title"
                                    value="{{ $data ? $data['WhyNeedUsSection']['Talent Discovery']['Description']['Two'] : 'Nurture emerging talent' }}"
                                    name="content[{{ $lang }}][WhyNeedUsSection][Talent Discovery][Description][Two]"
                                    hidden>
                            </div>
                        </div>
                    </div>
                    <a type="button" class="btn btn-rgstr button-input" data-aos="fade-up"
                        data-aos-duration="1000"
                        data-text="content[{{ $lang }}][WhyNeedUsSection][Register Now Button][Text]"
                        data-href="{{ $data ? $data['WhyNeedUsSection']['Register Now Button']['Url'] : '#' }}"
                        data-url="content[{{ $lang }}][WhyNeedUsSection][Register Now Button][Url]">{{ $data ? $data['WhyNeedUsSection']['Register Now Button']['Text'] : 'Register Now' }}
                        <img src="{{ asset('assets/images/templates/right-arrow.svg') }}"
                            alt="right-arrow" class="img-fluid"></a>
                    <input type="text" hidden id="register_now_btn_text"
                        name="content[{{ $lang }}][WhyNeedUsSection][Register Now Button][Text]"
                        value="{{ $data ? $data['WhyNeedUsSection']['Register Now Button']['Text'] : 'Register Now' }}" />
                    <input type="text" hidden id="register_now_btn_url"
                        name="content[{{ $lang }}][WhyNeedUsSection][Register Now Button][Url]"
                        value="{{ $data ? $data['WhyNeedUsSection']['Register Now Button']['Url'] : '#' }}" />
                </div>
            </div>
            <div class="col-lg-4" data-aos="fade-left" data-aos-duration="1000">
                <div class="pak-ksa-img">
                    <label for="attachmentImage5" class="pointer">
                        <div id="preimageImage5" style="display:block">
                            <img alt="ambasodor" class="img-fluid w-100" id='output_image5'
                                src="{{ $data ? asset($data['WhyNeedUsSection']['Image']) : asset('assets/images/templates/pak-ksa.png') }}">
                        </div>
                        <input type="file" accept="image/*" id="attachmentImage5"
                            name="content[{{ $lang }}][WhyNeedUsSection][Image]" hidden>
                        @if ($data)
                            <input type="hidden"
                                name="content[{{ $lang }}][WhyNeedUsSection][old_Image]"
                                value="{{ $data['WhyNeedUsSection'] ? $data['WhyNeedUsSection']['Image'] : 'assets/images/templates/pak-ksa.png' }}">
                        @else
                            <input type="hidden"
                                name="content[{{ $lang }}][WhyNeedUsSection][old_Image]"
                                value="assets/images/templates/pak-ksa.png">
                        @endif
                    </label>
                </div>
            </div>
        </div>
    </div>

</section>

<section class="benefits">
    <div class="container">
        <div class="benefit-top" data-aos="fade-down" data-aos-duration="1000">
            <label for="attachmentIcon12" class="pointer">
                <div id="preimageIcon12" style="display:block">
                    <img class="img-fluid" id='output_icon12'
                        src="{{ $data ? asset($data['BenefitsSection']['Title Icon']) : asset('assets/images/templates/ambsdr-icons-Group.svg') }}"
                        alt="">
                </div>
                <input type="file" accept="image/*" id="attachmentIcon12"
                    name="content[{{ $lang }}][BenefitsSection][Title Icon]" value=""
                    hidden>
                <input type="text" name="content[{{ $lang }}][BenefitsSection][old_Icon]"
                    value="assets/images/templates/ambsdr-icons-Group.svg" hidden>
            </label>
            <span class="ms-2 title-input" id="content[{{ $lang }}][BenefitsSection][Title]"
                contenteditable="true">{{ $data ? $data['BenefitsSection']['Title'] : 'Benefits' }}</span>
            <input type="text" id="BenefitsSection_title"
                value="{{ $data ? $data['BenefitsSection']['Title'] : 'Benefits' }}"
                name="content[{{ $lang }}][BenefitsSection][Title]" hidden>

            <h3 class="title-input" id="content[{{ $lang }}][BenefitsSection][Subtitle]"
                contenteditable="true">{!! $data ? $data['BenefitsSection']['Subtitle'] : 'Benefits for <span>Professionals, Businesses, & the Nation.' !!}</h3>
            <input type="text" id="BenefitsSection_subtitle" value="{!! $data ? $data['BenefitsSection']['Subtitle'] : 'Benefits for <span>Professionals, Businesses, & the Nation.' !!}"
                name="content[{{ $lang }}][BenefitsSection][Subtitle]" hidden>
        </div>
        <div class="card-main-benefits">
            <div class="row g-4">
                <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1000">
                    <div class="card-single">
                        <label for="attachmentImage6" class="pointer">
                            <div id="preimageImage6" style="display:block">
                                <img id='output_image6'
                                    src="{{ $data ? asset($data['BenefitsSection']['Cards']['For All User']['Image']) : asset('assets/images/templates/card-img-1.png') }}">
                            </div>
                            <input type="file" accept="image/*" id="attachmentImage6"
                                name="content[{{ $lang }}][BenefitsSection][Cards][For All User][Image]"
                                hidden>
                            @if ($data)
                                <input type="hidden"
                                    name="content[{{ $lang }}][BenefitsSection][Cards][For All User][old_Image]"
                                    value="{{ $data['BenefitsSection'] ? $data['BenefitsSection']['Cards']['For All User']['Image'] : 'assets/images/templates/card-img-1.png' }}">
                            @else
                                <input type="hidden"
                                    name="content[{{ $lang }}][BenefitsSection][Cards][For All User][old_Image]"
                                    value="assets/images/templates/card-img-1.png">
                            @endif
                        </label>
                        <div>
                            <div>
                                <h5 class="title-input"
                                    id="content[{{ $lang }}][BenefitsSection][Cards][For All User][Title]"
                                    contenteditable="true">{!! $data ? $data['BenefitsSection']['Cards']['For All User']['Title'] : 'For All User' !!}</h5>
                                <input type="text" id="BenefitsSection_subtitle"
                                    value="{!! $data ? $data['BenefitsSection']['Cards']['For All User']['Title'] : 'For All User' !!}"
                                    name="content[{{ $lang }}][BenefitsSection][Cards][For All User][Title]"
                                    hidden>
                                <div class="description-input"
                                    id="content[{{ $lang }}][BenefitsSection][Cards][For All User][description]"
                                    data-text="content[{{ $lang }}][BenefitsSection][Cards][For All User][description]">
                                    {!! $data
                                        ? $data['BenefitsSection']['Cards']['For All User']['description']
                                        : '<ul>
                                                                                                                                                                                                                                        <li>Easy access anytime</li>
                                                                                                                                                                                                                                        <li>Improved overall user experience</li>
                                                                                                                                                                                                                                        <li>Equal value for everyone</li>
                                                                                                                                                                                                                                        </ul>' !!}</div>
                                <input type="text" hidden id="benifit_card_all_users_description"
                                    name="content[{{ $lang }}][BenefitsSection][Cards][For All User][description]"
                                    value="{{ $data
                                        ? $data['BenefitsSection']['Cards']['For All User']['description']
                                        : '<ul>
                                                                                                                                                                                                                                                <li>Easy access anytime</li>
                                                                                                                                                                                                                                                <li>Improved overall user experience</li>
                                                                                                                                                                                                                                                <li>Equal value for everyone</li>
                                                                                                                                                                                                                                                </ul>' }}" />
                            </div>
                            <img src="{{ asset('assets/images/templates/card-inactive.svg') }}"
                                alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-duration="1000">
                    <div class="card-single">
                        <label for="attachmentImage7" class="pointer">
                            <div id="preimageImage7" style="display:block">
                                <img id='output_image7'
                                    src="{{ $data ? asset($data['BenefitsSection']['Cards']['For Diaspora']['Image']) : asset('assets/images/templates/card-img-2.png') }}">
                            </div>
                            <input type="file" accept="image/*" id="attachmentImage7"
                                name="content[{{ $lang }}][BenefitsSection][Cards][For Diaspora][Image]"
                                hidden>
                            @if ($data)
                                <input type="hidden"
                                    name="content[{{ $lang }}][BenefitsSection][Cards][For Diaspora][old_Image]"
                                    value="{{ $data['BenefitsSection'] ? $data['BenefitsSection']['Cards']['For Diaspora']['Image'] : 'assets/images/templates/card-img-2.png' }}">
                            @else
                                <input type="hidden"
                                    name="content[{{ $lang }}][BenefitsSection][Cards][For Diaspora][old_Image]"
                                    value="assets/images/templates/card-img-2.png">
                            @endif
                        </label>
                        <div>
                            <div>
                                <h5 class="title-input"
                                    id="content[{{ $lang }}][BenefitsSection][Cards][For Diaspora][Title]"
                                    contenteditable="true">{!! $data ? $data['BenefitsSection']['Cards']['For Diaspora']['Title'] : 'For Diaspora' !!}</h5>
                                <input type="text" id="BenefitsSection_subtitle"
                                    value="{!! $data ? $data['BenefitsSection']['Cards']['For Diaspora']['Title'] : 'For Diaspora' !!}"
                                    name="content[{{ $lang }}][BenefitsSection][Cards][For Diaspora][Title]"
                                    hidden>
                                <div class="description-input"
                                    id="content[{{ $lang }}][BenefitsSection][Cards][For Diaspora][description]"
                                    data-text="content[{{ $lang }}][BenefitsSection][Cards][For Diaspora][description]">
                                    {!! $data
                                        ? $data['BenefitsSection']['Cards']['For Diaspora']['description']
                                        : '<ul>
                                                                                                                                                                                                                                        <li>Connect globally with diaspora</li>
                                                                                                                                                                                                                                        <li>Share culture and experiences</li>
                                                                                                                                                                                                                                        <li>Empower communities through unity</li>
                                                                                                                                                                                                                                        </ul>' !!}</div>
                                <input type="text" hidden id="benifit_card_for_dispora_description"
                                    name="content[{{ $lang }}][BenefitsSection][Cards][For Diaspora][description]"
                                    value="{{ $data
                                        ? $data['BenefitsSection']['Cards']['For Diaspora']['description']
                                        : '<ul>
                                                                                                                                                                                                                                                <li>Connect globally with diaspora</li>
                                                                                                                                                                                                                                                <li>Share culture and experiences</li>
                                                                                                                                                                                                                                                <li>Empower communities through unity</li>
                                                                                                                                                                                                                                                </ul>' }}" />
                            </div>
                            <img src="{{ asset('assets/images/templates/card-active.svg') }}"
                                alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-up" data-aos-duration="1000">
                    <div class="card-single">
                        <label for="attachmentImage8" class="pointer">
                            <div id="preimageImage8" style="display:block">
                                <img id='output_image8'
                                    src="{{ $data ? asset($data['BenefitsSection']['Cards']['For Non-Diaspora']['Image']) : asset('assets/images/templates/card-img-3.png') }}">
                            </div>
                            <input type="file" accept="image/*" id="attachmentImage8"
                                name="content[{{ $lang }}][BenefitsSection][Cards][For Non-Diaspora][Image]"
                                hidden>
                            @if ($data)
                                <input type="hidden"
                                    name="content[{{ $lang }}][BenefitsSection][Cards][For Non-Diaspora][old_Image]"
                                    value="{{ $data['BenefitsSection'] ? $data['BenefitsSection']['Cards']['For Non-Diaspora']['Image'] : 'assets/images/templates/card-img-3.png' }}">
                            @else
                                <input type="hidden"
                                    name="content[{{ $lang }}][BenefitsSection][Cards][For Non-Diaspora][old_Image]"
                                    value="assets/images/templates/card-img-3.png">
                            @endif
                        </label>
                        <div>
                            <div>
                                <h5 class="title-input"
                                    id="content[{{ $lang }}][BenefitsSection][Cards][For Non-Diaspora][Title]"
                                    contenteditable="true">{!! $data ? $data['BenefitsSection']['Cards']['For Non-Diaspora']['Title'] : 'For Non-Diaspora' !!}</h5>
                                <input type="text" id="BenefitsSection_subtitle"
                                    value="{!! $data ? $data['BenefitsSection']['Cards']['For Non-Diaspora']['Title'] : 'For Non-Diaspora' !!}"
                                    name="content[{{ $lang }}][BenefitsSection][Cards][For Non-Diaspora][Title]"
                                    hidden>
                                <div class="description-input"
                                    id="content[{{ $lang }}][BenefitsSection][Cards][For Non-Diaspora][description]"
                                    data-text="content[{{ $lang }}][BenefitsSection][Cards][For Non-Diaspora][description]">
                                    {!! $data
                                        ? $data['BenefitsSection']['Cards']['For Non-Diaspora']['description']
                                        : '<ul>
                                                                                                                                                                                                                                        <li>Learn about diverse cultures</li>
                                                                                                                                                                                                                                        <li>Connect with global communities</li>
                                                                                                                                                                                                                                        <li>Support inclusion and unity</li>
                                                                                                                                                                                                                                        </ul>' !!}</div>
                                <input type="text" hidden id="benifit_card_for_non_dispora_description"
                                    name="content[{{ $lang }}][BenefitsSection][Cards][For Non-Diaspora][description]"
                                    value="{{ $data
                                        ? $data['BenefitsSection']['Cards']['For Non-Diaspora']['description']
                                        : '<ul>
                                                                                                                                                                                                                                                <li>Learn about diverse cultures</li>
                                                                                                                                                                                                                                                <li>Connect with global communities</li>
                                                                                                                                                                                                                                                <li>Support inclusion and unity</li>
                                                                                                                                                                                                                                                </ul>' }}" />
                            </div>
                            <img src="{{ asset('assets/images/templates/card-inactive.svg') }}"
                                alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-up" data-aos-duration="1000">
                    <div class="card-single">
                        <label for="attachmentImage9" class="pointer">
                            <div id="preimageImage9" style="display:block">
                                <img id='output_image9'
                                    src="{{ $data ? asset($data['BenefitsSection']['Cards']['For Embassy']['Image']) : asset('assets/images/templates/card-img-4.png') }}">
                            </div>
                            <input type="file" accept="image/*" id="attachmentImage9"
                                name="content[{{ $lang }}][BenefitsSection][Cards][For Embassy][Image]"
                                hidden>
                            @if ($data)
                                <input type="hidden"
                                    name="content[{{ $lang }}][BenefitsSection][Cards][For Embassy][old_Image]"
                                    value="{{ $data['BenefitsSection'] ? $data['BenefitsSection']['Cards']['For Embassy']['Image'] : 'assets/images/templates/card-img-4.png' }}">
                            @else
                                <input type="hidden"
                                    name="content[{{ $lang }}][BenefitsSection][Cards][For Embassy][old_Image]"
                                    value="assets/images/templates/card-img-4.png">
                            @endif
                        </label>
                        <div>
                            <div>
                                <h5 class="title-input"
                                    id="content[{{ $lang }}][BenefitsSection][Cards][For Embassy][Title]"
                                    contenteditable="true">{!! $data ? $data['BenefitsSection']['Cards']['For Embassy']['Title'] : 'For Embassy' !!}</h5>
                                <input type="text" id="BenefitsSection_subtitle"
                                    value="{!! $data ? $data['BenefitsSection']['Cards']['For Embassy']['Title'] : 'For Embassy' !!}"
                                    name="content[{{ $lang }}][BenefitsSection][Cards][For Embassy][Title]"
                                    hidden>
                                <div class="description-input"
                                    id="content[{{ $lang }}][BenefitsSection][Cards][For Embassy][description]"
                                    data-text="content[{{ $lang }}][BenefitsSection][Cards][For Embassy][description]">
                                    {!! $data
                                        ? $data['BenefitsSection']['Cards']['For Embassy']['description']
                                        : '<ul>
                                                                                                                                                                                                                                        <li>Explore global cultures</li>
                                                                                                                                                                                                                                        <li>Build strong connections</li>
                                                                                                                                                                                                                                        <li>Foster lasting unity</li>
                                                                                                                                                                                                                                        </ul>' !!}</div>
                                <input type="text" hidden id="benifit_card_for_embassy_description"
                                    name="content[{{ $lang }}][BenefitsSection][Cards][For Embassy][description]"
                                    value="{{ $data
                                        ? $data['BenefitsSection']['Cards']['For Embassy']['description']
                                        : '<ul>
                                                                                                                                                                                                                                                <li>Learn about diverse cultures</li>
                                                                                                                                                                                                                                                <li>Build strong connections</li>
                                                                                                                                                                                                                                                <li>Foster lasting unity</li>
                                                                                                                                                                                                                                                </ul>' }}" />
                            </div>
                            <img src="{{ asset('assets/images/templates/card-inactive.svg') }}"
                                alt="" class="img-fluid">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<section>
    <div class="text-center">
        <label for="bgImage1" class="pointer mb-0">
            <a style="background-color: #198754; color:white" type="button"
                class="btn btn-theme btn-hover">Change Background Image</a>
            <input type="file" accept="image/*" id="bgImage1"
                name="content[{{ $lang }}][HowItWorksSection][Background Image]"
                class="form-control" hidden>
            @if ($data)
                <input type="hidden"
                    name="content[{{ $lang }}][HowItWorksSection][old_Background Image]"
                    value="{{ $data['HowItWorksSection'] ? $data['HowItWorksSection']['Background Image'] : 'assets/images/templates/card-img-5.svg' }}">
            @else
                <input type="hidden"
                    name="content[{{ $lang }}][HowItWorksSection][old_Background Image]"
                    value="assets/images/templates/card-img-5.svg">
            @endif
        </label>
    </div>
    <div class="container">
        <div class="journey-begins">
            <div data-aos="fade-down" data-aos-duration="1000">
                <label for="attachmentIcon7" class="pointer">
                    <div id="preimageIcon7" style="display:block">
                        <img class="img-fluid invert-img" id='output_icon7'
                            src="{{ $data ? asset($data['HowItWorksSection']['Title Icon']) : asset('assets/images/templates/ambsdr-icons-Group.svg') }}"
                            alt="">
                    </div>
                    <input type="file" accept="image/*" id="attachmentIcon7"
                        name="content[{{ $lang }}][HowItWorksSection][Title Icon]"
                        value="" hidden>
                    <input type="text"
                        name="content[{{ $lang }}][HowItWorksSection][old_Icon]"
                        value="assets/images/templates/ambsdr-icons-Group.svg" hidden>
                </label>
                <span class="ms-2 title-input"
                    id="content[{{ $lang }}][HowItWorksSection][Title]"
                    contenteditable="true">{{ $data ? $data['HowItWorksSection']['Title'] : 'How it works' }}</span>
                <input type="text" id="howitworks_title"
                    value="{{ $data ? $data['HowItWorksSection']['Title'] : 'How it works' }}"
                    name="content[{{ $lang }}][HowItWorksSection][Title]" hidden>
            </div>
            <h4 class="title-input" data-aos="fade-down" data-aos-duration="1000"
                id="content[{{ $lang }}][HowItWorksSection][Subtitle]" contenteditable="true">
                {{ $data ? $data['HowItWorksSection']['Subtitle'] : 'Your Journey Begins in Just a Few Steps.' }}
            </h4>
            <input type="text" id="howitworks_subtitle"
                value="{{ $data ? $data['HowItWorksSection']['Subtitle'] : 'Your Journey Begins in Just a Few Steps.' }}"
                name="content[{{ $lang }}][HowItWorksSection][Subtitle]" hidden>
            <div class="row g-5">
                <div class="col-lg-8" data-aos="fade-right" data-aos-duration="1000">
                    <div class="points-main">
                        <div class="single-point">
                            <div>
                                <span>01</span>
                            </div>
                            <div class="single-point-text">
                                <h5 class="title-input"
                                    id="content[{{ $lang }}][HowItWorksSection][Steps][Step 1][Title]"
                                    contenteditable="true">
                                    {{ $data ? $data['HowItWorksSection']['Steps']['Step 1']['Title'] : 'Create your account with us.' }}
                                </h5>
                                <input type="text" id="step1_title"
                                    value="{{ $data ? $data['HowItWorksSection']['Steps']['Step 1']['Title'] : 'Create your account with us.' }}"
                                    name="content[{{ $lang }}][HowItWorksSection][Steps][Step 1][Title]"
                                    hidden>
                                <div class="description-input"
                                    id="content[{{ $lang }}][HowItWorksSection][Steps][Step 1][Description]"
                                    data-text="content[{{ $lang }}][HowItWorksSection][Steps][Step 1][Description]">
                                    {!! $data
                                        ? $data['HowItWorksSection']['Steps']['Step 1']['Description']
                                        : 'Sign up using your email and basic information to get started.' !!}</div>
                                <input type="text" hidden id="HowItWorksSection_description1"
                                    name="content[{{ $lang }}][HowItWorksSection][Steps][Step 1][Description]"
                                    value="{{ $data ? $data['HowItWorksSection']['Steps']['Step 1']['Description'] : 'Sign up using your email and basic information to get started.' }}" />
                            </div>
                        </div>
                        <div class="single-point">
                            <div>
                                <span>02</span>
                            </div>
                            <div class="single-point-text">
                                <h5 class="title-input"
                                    id="content[{{ $lang }}][HowItWorksSection][Steps][Step 2][Title]"
                                    contenteditable="true">
                                    {{ $data ? $data['HowItWorksSection']['Steps']['Step 2']['Title'] : 'Submit you documents & get verified by embassy.' }}
                                </h5>
                                <input type="text" id="step2_title"
                                    value="{{ $data ? $data['HowItWorksSection']['Steps']['Step 2']['Title'] : 'Submit you documents & get verified by embassy.' }}"
                                    name="content[{{ $lang }}][HowItWorksSection][Steps][Step 2][Title]"
                                    hidden>
                                <div class="description-input"
                                    id="content[{{ $lang }}][HowItWorksSection][Steps][Step 2][Description]"
                                    data-text="content[{{ $lang }}][HowItWorksSection][Steps][Step 2][Description]">
                                    {!! $data
                                        ? $data['HowItWorksSection']['Steps']['Step 2']['Description']
                                        : 'Upload required documents securely and wait for quick embassy verification.' !!}</div>
                                <input type="text" hidden id="HowItWorksSection_description2"
                                    name="content[{{ $lang }}][HowItWorksSection][Steps][Step 2][Description]"
                                    value="{{ $data ? $data['HowItWorksSection']['Steps']['Step 2']['Description'] : 'Upload required documents securely and wait for quick embassy verification.' }}" />
                            </div>
                        </div>
                        <div class="single-point">
                            <div>
                                <span>03</span>
                            </div>
                            <div class="single-point-text">
                                <h5 class="title-input"
                                    id="content[{{ $lang }}][HowItWorksSection][Steps][Step 3][Title]"
                                    contenteditable="true">
                                    {{ $data ? $data['HowItWorksSection']['Steps']['Step 3']['Title'] : 'Explore different benefit with us.' }}
                                </h5>
                                <input type="text" id="step3_title"
                                    value="{{ $data ? $data['HowItWorksSection']['Steps']['Step 3']['Title'] : 'Explore different benefit with us.' }}"
                                    name="content[{{ $lang }}][HowItWorksSection][Steps][Step 3][Title]"
                                    hidden>
                                <div class="description-input"
                                    id="content[{{ $lang }}][HowItWorksSection][Steps][Step 3][Description]"
                                    data-text="content[{{ $lang }}][HowItWorksSection][Steps][Step 3][Description]">
                                    {!! $data
                                        ? $data['HowItWorksSection']['Steps']['Step 3']['Description']
                                        : 'Access exclusive services, community support, and cultural programs.' !!}</div>
                                <input type="text" hidden id="HowItWorksSection_description3"
                                    name="content[{{ $lang }}][HowItWorksSection][Steps][Step 3][Description]"
                                    value="{{ $data ? $data['HowItWorksSection']['Steps']['Step 3']['Description'] : 'Access exclusive services, community support, and cultural programs.' }}" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 d-lg-block d-none" data-aos="fade-left" data-aos-duration="1000">
                    @if ($data && $data['HowItWorksSection']['Background Image'])
                        <section id="output_bgImage1" class="journey-right-area"
                            style="background-image: url({{ asset($data['HowItWorksSection']['Background Image']) }})">
                            <div class="social-items">
                                <a href="javascript:void(0)"> <img
                                        src="{{ asset('assets/images/templates/x-icon.svg') }}"
                                        alt=""></a>
                                <a href="javascript:void(0)"> <img
                                        src="{{ asset('assets/images/templates/facebook-f.svg') }}"
                                        alt=""></a>
                                <a href="javascript:void(0)"> <img
                                        src="{{ asset('assets/images/templates/instagram.svg') }}"
                                        alt=""></a>
                                <a href="javascript:void(0)"><img
                                        src="{{ asset('assets/images/templates/linkedin-in.svg') }}"
                                        alt=""></a>
                            </div>
                        @else
                            <div class="journey-right-area" id="output_bgImage1">
                                <div class="social-items">
                                    <a href="javascript:void(0)"> <img
                                            src="{{ asset('assets/images/templates/x-icon.svg') }}"
                                            alt=""></a>
                                    <a href="javascript:void(0)"> <img
                                            src="{{ asset('assets/images/templates/facebook-f.svg') }}"
                                            alt=""></a>
                                    <a href="javascript:void(0)"> <img
                                            src="{{ asset('assets/images/templates/instagram.svg') }}"
                                            alt=""></a>
                                    <a href="javascript:void(0)"><img
                                            src="{{ asset('assets/images/templates/linkedin-in.svg') }}"
                                            alt=""></a>
                                </div>
                            </div>
                    @endif
                </div>
            </div>
            <a type="button" class="btn journey-begins-btn button-input" data-aos="fade-up"
                data-aos-duration="1000"
                data-text="content[{{ $lang }}][HowItWorksSection][Register Now Button][Text]"
                data-href="{{ $data ? $data['HowItWorksSection']['Register Now Button']['Url'] : '#' }}"
                data-url="content[{{ $lang }}][HowItWorksSection][Register Now Button][Url]">{{ $data ? $data['HowItWorksSection']['Register Now Button']['Text'] : 'Register Now' }}
                <img src="{{ asset('assets/images/templates/right-arrow.svg') }}" alt="right-arrow"
                    class="img-fluid invert-img"></a>
            <input type="text" hidden id="register_now_btn_text"
                name="content[{{ $lang }}][HowItWorksSection][Register Now Button][Text]"
                value="{{ $data ? $data['HowItWorksSection']['Register Now Button']['Text'] : 'Register Now' }}" />
            <input type="text" hidden id="register_now_btn_url"
                name="content[{{ $lang }}][HowItWorksSection][Register Now Button][Url]"
                value="{{ $data ? $data['HowItWorksSection']['Register Now Button']['Url'] : '#' }}" />
        </div>
    </div>
</section>

<section class="event-sec">
    <div class="container">
        <div class="event-top mb-4" data-aos="fade-down" data-aos-duration="1000">
            <label for="attachmentIcon6" class="pointer">
                <div id="preimageIcon6" style="display:block">
                    <img class="img-fluid" id='output_icon6'
                        src="{{ $data ? asset($data['EventsSection']['Title Icon']) : asset('assets/images/templates/ambsdr-icons-Group.svg') }}"
                        alt="">
                </div>
                <input type="file" accept="image/*" id="attachmentIcon6"
                    name="content[{{ $lang }}][EventsSection][Title Icon]" value=""
                    hidden>
                <input type="text" name="content[{{ $lang }}][EventsSection][old_Icon]"
                    value="assets/images/templates/ambsdr-icons-Group.svg" hidden>
            </label>
            <span class="title-input" class="ms-2 title-input"
                id="content[{{ $lang }}][EventsSection][Title]"
                contenteditable="true">{{ $data ? $data['EventsSection']['Title'] : 'Upcoming events' }}</span>
            <input type="text" id="upcoming_events_title"
                value="{{ $data ? $data['EventsSection']['Title'] : 'Upcoming events' }}"
                name="content[{{ $lang }}][EventsSection][Title]" hidden>
            <h3 class="title-input" data-aos="fade-down" data-aos-duration="1000"
                id="content[{{ $lang }}][EventsSection][Subtitle]" contenteditable="true">
                {!! $data ? $data['EventsSection']['Subtitle'] : 'Events That Connect. <span>Inspire. Elevate.</span>' !!}</h3>
            <input type="text" id="upcoming_events_subtitle" value="{!! $data ? $data['EventsSection']['Subtitle'] : 'Events That Connect. <span>Inspire. Elevate.</span>' !!}"
                name="content[{{ $lang }}][EventsSection][Subtitle]" hidden>
        </div>
        <div class="row g-3">
            @foreach($events as $event)
                <div class="col-lg-4" data-aos="fade-right" data-aos-duration="1000">
                    <div class="single-card">
                        <img src="{{ asset('storage/' . $event->images->first()?->path) }}" alt="" class="img-fluid w-100">
                        <div class="card-txt">
                            <div>
                                <h4>{{ $event->name }}</h4>
                                <p>{!! $event->event_overview !!}</p>
                            </div>
                            <img src="assets/images/templates/card-inactive.svg" alt=""
                                class="img-fluid">
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="text-center " data-aos="fade-up" data-aos-duration="1000">
                <a type="button" class="btn btn-view-more button-input"
                    data-text="content[{{ $lang }}][EventsSection][View More Events Button][Text]"
                    data-href="{{ $data ? $data['EventsSection']['View More Events Button']['Url'] : '#' }}"
                    data-url="content[{{ $lang }}][EventsSection][View More Events Button][Url]">{{ $data ? $data['EventsSection']['View More Events Button']['Text'] : 'View More' }}
                    <img src="{{ asset('assets/images/templates/right-arrow.svg') }}"
                        alt="right-arrow" class="img-fluid ms-2"></a>
                <input type="text" hidden id="view_more_event_btn_text"
                    name="content[{{ $lang }}][EventsSection][View More Events Button][Text]"
                    value="{{ $data ? $data['EventsSection']['View More Events Button']['Text'] : 'View More' }}" />
                <input type="text" hidden id="view_more_event_btn_url"
                    name="content[{{ $lang }}][EventsSection][View More Events Button][Url]"
                    value="{{ $data ? $data['EventsSection']['View More Events Button']['Url'] : '#' }}" />
            </div>

        </div>
    </div>
</section>