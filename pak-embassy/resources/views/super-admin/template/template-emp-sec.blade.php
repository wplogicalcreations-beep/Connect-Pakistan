<section class="empowering-sec">
    <div class="text-center">
        <label for="bgImage2" class="pointer mb-0">
            <a style="background-color: #198754; color:white" type="button"
                class="btn btn-theme btn-hover">Change Background Image</a>
            <input type="file" accept="image/*" id="bgImage2"
                name="content[{{ $lang }}][CallToAction][Background Image]"
                class="form-control" hidden>
            @if ($data)
                <input type="hidden"
                    name="content[{{ $lang }}][CallToAction][old_Background Image]"
                    value="{{ $data['CallToAction'] ? $data['CallToAction']['Background Image'] : 'assets/images/templates/banner-bg.png' }}">
            @else
                <input type="hidden"
                    name="content[{{ $lang }}][CallToAction][old_Background Image]"
                    value="assets/images/templates/banner-bg.png">
            @endif
        </label>
    </div>
    <div class="container">
        @if ($data && $data['CallToAction']['Background Image'])
            <section id="output_bgImage2" class="empowering-wrapper"
                style="background-image: url({{ asset($data['CallToAction']['Background Image']) }})">
            @else
                <div class="empowering-wrapper" id="output_bgImage2">
        @endif
        <div data-aos="fade-right" data-aos-duration="1000">
            <h2 class="title-input" id="content[{{ $lang }}][CallToAction][Title]"
                contenteditable="true">
                {{ $data ? $data['CallToAction']['Title'] : 'Empowering You to Grow in KSA — One Click Away.' }}
            </h2>
            <input type="text" hidden id="CallToAction_title"
                name="content[{{ $lang }}][CallToAction][Title]"
                value="{{ $data ? $data['CallToAction']['Title'] : 'Empowering You to Grow in KSA — One Click Away.' }}" />
            <div class="description-input"
                id="content[{{ $lang }}][CallToAction][Description]"
                data-text="content[{{ $lang }}][CallToAction][Description]">
                {!! $data
                    ? $data['CallToAction']['Description']
                    : 'Create your account today and become part of a trusted, embassy-backed platform connecting
                                                                                                                                        Pakistani talent and businesses across KSA.' !!}</div>
            <input type="text" hidden id="CallToAction_description"
                name="content[{{ $lang }}][CallToAction][Description]"
                value="{{ $data
                    ? $data['CallToAction']['Description']
                    : 'Create your account today and become part of a trusted, embassy-backed platform connecting
                                                                                                                                        Pakistani talent and businesses across KSA.' }}" />
        </div>
        <a type="button" class="btn journey-begins-btn button-input" data-aos="fade-right"
            data-aos-duration="1000"
            data-text="content[{{ $lang }}][CallToAction][Get Started Now Button][Text]"
            data-href="{{ $data ? $data['CallToAction']['Get Started Now Button']['Url'] : '#' }}"
            data-url="content[{{ $lang }}][CallToAction][Get Started Now Button][Url]">{{ $data ? $data['CallToAction']['Get Started Now Button']['Text'] : 'Get Started Now' }}</a>
        <input type="text" hidden id="CallToAction_btn_text"
            name="content[{{ $lang }}][CallToAction][Get Started Now Button][Text]"
            value="{{ $data ? $data['CallToAction']['Get Started Now Button']['Text'] : 'Get Started Now' }}" />
        <input type="text" hidden id="CallToAction_btn_url"
            name="content[{{ $lang }}][CallToAction][Get Started Now Button][Url]"
            value="{{ $data ? $data['CallToAction']['Get Started Now Button']['Url'] : '#' }}" />
    </div>
</section>