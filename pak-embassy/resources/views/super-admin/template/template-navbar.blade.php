<nav class="navbar navbar-expand-lg navbar-light bg-light nav_desktop">
    <div class="container">
        <label for="attachmentLogo" class="pointer">
            <div id="preimageLogo" style="display:block">
                <img id='output_logo' height="80"
                    src="{{ asset($data ? $data['Logo'] : 'assets/images/templates/embassy-of-PK 1.svg') }}"
                    alt="">
            </div>
            <input type="file" accept="image/*" id="attachmentLogo"
                name="content[{{ $lang }}][Logo]" hidden>
            @if ($data)
                <input type="hidden" name="content[{{ $lang }}][old_Logo]"
                    value="{{ $data['Logo'] ?? '' }}">
            @else
                <input type="hidden" name="content[{{ $lang }}][old_Logo]"
                    value="assets/images/templates/embassy-of-PK 1.svg">
            @endif
        </label>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse side-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active button-input" aria-current="page"
                        data-text="content[{{ $lang }}][NavbarSection][Home][Text]"
                        data-href="{{ $data ? $data['NavbarSection']['Home']['url'] : '#' }}"
                        data-url="content[{{ $lang }}][NavbarSection][Home][url]">{{ $data ? $data['NavbarSection']['Home']['Text'] : 'Home' }}</a>
                </li>
                <input type="text" hidden id="home_btn_text"
                    name="content[{{ $lang }}][NavbarSection][Home][Text]"
                    value="{{ $data ? $data['NavbarSection']['Home']['Text'] : 'Home' }}" />
                <input type="text" hidden id="home_btn_url"
                    name="content[{{ $lang }}][NavbarSection][Home][url]"
                    value="{{ $data ? $data['NavbarSection']['Home']['url'] : '#' }}" />
                </li>
                <li class="nav-item">
                    <a class="nav-link button-input" aria-current="page"
                        data-text="content[{{ $lang }}][NavbarSection][Portal][Text]"
                        data-href="{{ $data ? $data['NavbarSection']['Portal']['url'] : '#' }}"
                        data-url="content[{{ $lang }}][NavbarSection][Portal][url]">{{ $data ? $data['NavbarSection']['Portal']['Text'] : 'Portal' }}</a>
                </li>
                <input type="text" hidden id="portal_btn_text"
                    name="content[{{ $lang }}][NavbarSection][Portal][Text]"
                    value="{{ $data ? $data['NavbarSection']['Portal']['Text'] : 'Portal' }}" />
                <input type="text" hidden id="portal_btn_url"
                    name="content[{{ $lang }}][NavbarSection][Portal][url]"
                    value="{{ $data ? $data['NavbarSection']['Portal']['url'] : '#' }}" />
                </li>
                <li class="nav-item">
                    <a class="nav-link button-input" aria-current="page"
                        data-text="content[{{ $lang }}][NavbarSection][Knowledge Base][Text]"
                        data-href="{{ $data ? $data['NavbarSection']['Knowledge Base']['url'] : '#' }}"
                        data-url="content[{{ $lang }}][NavbarSection][Knowledge Base][url]">{{ $data ? $data['NavbarSection']['Knowledge Base']['Text'] : 'Knowledge Base' }}</a>
                </li>
                <input type="text" hidden id="knowledge_base_btn_text"
                    name="content[{{ $lang }}][NavbarSection][Knowledge Base][Text]"
                    value="{{ $data ? $data['NavbarSection']['Knowledge Base']['Text'] : 'Knowledge Base' }}" />
                <input type="text" hidden id="knowledge_base_btn_url"
                    name="content[{{ $lang }}][NavbarSection][Knowledge Base][url]"
                    value="{{ $data ? $data['NavbarSection']['Knowledge Base']['url'] : '#' }}" />
                </li>
                <li class="nav-item">
                    <a class="nav-link button-input" aria-current="page"
                        data-text="content[{{ $lang }}][NavbarSection][Job Notice Board][Text]"
                        data-href="{{ $data ? $data['NavbarSection']['Job Notice Board']['url'] : '#' }}"
                        data-url="content[{{ $lang }}][NavbarSection][Job Notice Board][url]">{{ $data ? $data['NavbarSection']['Job Notice Board']['Text'] : 'Job Notice Board' }}</a>
                </li>
                <input type="text" hidden id="job_notice_board_btn_text"
                    name="content[{{ $lang }}][NavbarSection][Job Notice Board][Text]"
                    value="{{ $data ? $data['NavbarSection']['Job Notice Board']['Text'] : 'Job Notice Board' }}" />
                <input type="text" hidden id="job_notice_board_btn_url"
                    name="content[{{ $lang }}][NavbarSection][Job Notice Board][url]"
                    value="{{ $data ? $data['NavbarSection']['Job Notice Board']['url'] : '#' }}" />
                </li>
                <li class="nav-item">
                    <a class="nav-link button-input" aria-current="page"
                        data-text="content[{{ $lang }}][NavbarSection][Events][Text]"
                        data-href="{{ $data ? $data['NavbarSection']['Events']['url'] : '#' }}"
                        data-url="content[{{ $lang }}][NavbarSection][Events][url]">{{ $data ? $data['NavbarSection']['Events']['Text'] : 'Events' }}</a>
                </li>
                <input type="text" hidden id="events_btn_text"
                    name="content[{{ $lang }}][NavbarSection][Events][Text]"
                    value="{{ $data ? $data['NavbarSection']['Events']['Text'] : 'Events' }}" />
                <input type="text" hidden id="events_btn_url"
                    name="content[{{ $lang }}][NavbarSection][Events][url]"
                    value="{{ $data ? $data['NavbarSection']['Events']['url'] : '#' }}" />
                </li>
                <li class="nav-item">
                    <a class="nav-link button-input" aria-current="page"
                        data-text="content[{{ $lang }}][NavbarSection][Contact US][Text]"
                        data-href="{{ $data ? $data['NavbarSection']['Contact US']['url'] : '#' }}"
                        data-url="content[{{ $lang }}][NavbarSection][Contact US][url]">{{ $data ? $data['NavbarSection']['Contact US']['Text'] : 'Contact US' }}</a>
                </li>
                <input type="text" hidden id="contact_us_btn_text"
                    name="content[{{ $lang }}][NavbarSection][Contact US][Text]"
                    value="{{ $data ? $data['NavbarSection']['Contact US']['Text'] : 'Contact US' }}" />
                <input type="text" hidden id="contact_us_btn_url"
                    name="content[{{ $lang }}][NavbarSection][Contact US][url]"
                    value="{{ $data ? $data['NavbarSection']['Contact US']['url'] : '#' }}" />
                </li>
            </ul>
            <a class="btn btn-right-arrow button-input"
                data-text="content[{{ $lang }}][NavbarSection][Sign In Button][Text]"
                data-href="{{ $data ? $data['NavbarSection']['Sign In Button']['url'] : '#' }}"
                data-url="content[{{ $lang }}][NavbarSection][Sign In Button][url]">{{ $data ? $data['NavbarSection']['Sign In Button']['Text'] : 'Sign In Button' }}
                <img src="{{ asset('assets/images/templates/right-arrow.svg') }}" alt="right-arrow"
                    class="img-fluid "></a></li>
            <input type="text" hidden id="sign_in_button_us_btn_text"
                name="content[{{ $lang }}][NavbarSection][Sign In Button][Text]"
                value="{{ $data ? $data['NavbarSection']['Sign In Button']['Text'] : 'Sign In Button' }}" />
            <input type="text" hidden id="sign_in_button_us_btn_url"
                name="content[{{ $lang }}][NavbarSection][Sign In Button][url]"
                value="{{ $data ? $data['NavbarSection']['Sign In Button']['url'] : '#' }}" />
        </div>
    </div>
</nav>