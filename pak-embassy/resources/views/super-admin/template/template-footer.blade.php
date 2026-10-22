<footer>
    <div class="container top-contianer">
        <div class="row g-5">
            <div class="col-lg-4 col-md-6">
                <div class="footer-logo-area">
                    <div>
                        <label for="attachmentIcon14" class="pointer">
                            <span class="visually-hidden">Upload Footer Section Title Icon</span>
                            <div id="preimageIcon14" style="display:block">
                                <img class="img-fluid" id='output_icon14'
                                    src="{{ $data ? asset($data['FooterSection']['Title Icon']) : asset('assets/images/templates/footer-logo.png') }}"
                                    alt="">
                            </div>
                            <input type="file" accept="image/*" id="attachmentIcon14"
                                name="content[{{ $lang }}][FooterSection][Title Icon]"
                                value="" hidden>
                            <input aria-label="Footer Section old Icon" type="text"
                                name="content[{{ $lang }}][FooterSection][old_Icon]"
                                value="assets/images/templates/footer-logo.png" hidden>
                        </label>
                    </div>

                    {{-- <div>
                        <label for="attachmentIcon5" class="pointer">
                            <span class="visually-hidden">Upload Footer Section Map Title Icon</span>
                            <div id="preimageIcon5" style="display:block">
                                <img class="img-fluid map-icon" class="img-fluid" id='output_icon5'
                                    src="{{ $data ? asset($data['FooterSection']['Map']['Title Icon']) : asset('assets/images/templates/footer-map.png') }}"
                                    alt="">
                            </div>
                            <input type="file" accept="image/*" id="attachmentIcon5"
                                name="content[{{ $lang }}][FooterSection][Map][Title Icon]"
                                value="" hidden>
                            <input aria-label="Footer Section Map old Icon" type="text"
                                name="content[{{ $lang }}][FooterSection][Map][old_Icon]"
                                value="assets/images/templates/footer-map.png" hidden>
                        </label>
                    </div> --}}
                </div>

                <div class="description-input"
                    id="content[{{ $lang }}][FooterSection][Description]"
                    data-text="content[{{ $lang }}][FooterSection][Description]">
                    {!! clean_html($data
                        ? $data['FooterSection']['Description']
                        : '<p class="footer-text">Empowering the Pakistani Diaspora, Enabling Progress Through Innovation,
                                                                                                                                                                Partnership, and Opportunity.</p>') !!}</div>
                <input aria-label="Footer Section Description" type="text" hidden id="footerSection_description"
                    name="content[{{ $lang }}][FooterSection][Description]"
                    value="{{ $data
                        ? $data['FooterSection']['Description']
                        : '<p class="footer-text">Empowering the Pakistani Diaspora, Enabling Progress Through Innovation,
                                                                                                                                                                Partnership, and Opportunity.</p>' }}" />

                <div class="footer-social-items">
                    <a href="javascript:void(0)"> <img
                            src="{{ asset('assets/images/templates/facebook-f.svg') }}"
                            alt=""></a>
                    <a href="javascript:void(0)"> <img
                            src="{{ asset('assets/images/templates/instagram.svg') }}"
                            alt=""></a>
                    <a href="javascript:void(0)"> <img
                            src="{{ asset('assets/images/templates/x-icon.svg') }}"
                            alt=""></a>
                    <a href="javascript:void(0)"><img
                            src="{{ asset('assets/images/templates/linkedin-in.svg') }}"
                            alt=""></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="useful-links">
                    <h6 class="title-input"
                        id="content[{{ $lang }}][FooterSection][Useful Links][Title]"
                        contenteditable="true">
                        {{ $data ? $data['FooterSection']['Useful Links']['Title'] : 'Useful Link' }}</h6>
                    <input aria-label="Footer Section Useful Links Title" type="text" id="useful_links_title"
                        value="{{ $data ? $data['FooterSection']['Useful Links']['Title'] : 'Useful Link' }}"
                        name="content[{{ $lang }}][FooterSection][Useful Links][Title]" hidden>
                    <ul>
                        <li>
                            <a class="fot-icon" href="">
                                <label for="attachmentIcon4" class="pointer">
                                    <span class="visually-hidden">Upload Footer Section Useful Links Portal Icon</span>
                                    <div id="preimageIcon4" style="display:block">
                                        <img id='output_icon4'
                                            src="{{ $data ? asset($data['FooterSection']['Useful Links']['Portal']['Icon']) : asset('assets/images/templates/footer-arrow.png') }}"
                                            alt="">
                                    </div>
                                    <input type="file" accept="image/*" id="attachmentIcon4"
                                        name="content[{{ $lang }}][FooterSection][Useful Links][Portal][Icon]"
                                        value="" hidden>
                                    <input aria-label="Footer Section Useful Links Portal old Icon" type="text"
                                        name="content[{{ $lang }}][FooterSection][Useful Links][Portal][old_Icon]"
                                        value="assets/images/templates/footer-arrow.png" hidden>
                                </label>

                                <a class="button-input"
                                    data-text="content[{{ $lang }}][FooterSection][Useful Links][Portal][Text]"
                                    data-href="{{ $data ? $data['FooterSection']['Useful Links']['Portal']['url'] : '#' }}"
                                    data-url="content[{{ $lang }}][FooterSection][Useful Links][Portal][url]">{{ $data ? $data['FooterSection']['Useful Links']['Portal']['Text'] : 'Portal' }}</a>
                        </li>
                        <input aria-label="Footer Section Useful Links Portal Text" type="text" hidden id="footer_portal_btn_text"
                            name="content[{{ $lang }}][FooterSection][Useful Links][Portal][Text]"
                            value="{{ $data ? $data['FooterSection']['Useful Links']['Portal']['Text'] : 'Portal' }}" />
                        <input aria-label="Footer Section Useful Links Portal url" type="text" hidden id="footer_portal_btn_url"
                            name="content[{{ $lang }}][FooterSection][Useful Links][Portal][url]"
                            value="{{ $data ? $data['FooterSection']['Useful Links']['Portal']['url'] : '#' }}" />
                        </a>
                        </li>
                        <li>
                            <a class="fot-icon" href="">
                                <label for="attachmentIcon3" class="pointer">
                                    <span class="visually-hidden">Upload Footer Section Useful Links Knowledge Base Icon</span>
                                    <div id="preimageIcon3" style="display:block">
                                        <img id='output_icon3'
                                            src="{{ $data ? asset($data['FooterSection']['Useful Links']['Knowledge Base']['Icon']) : asset('assets/images/templates/footer-arrow.png') }}"
                                            alt="">
                                    </div>
                                    <input type="file" accept="image/*" id="attachmentIcon3"
                                        name="content[{{ $lang }}][FooterSection][Useful Links][Knowledge Base][Icon]"
                                        value="" hidden>
                                    <input aria-label="Footer Section Useful Links Knowledge Base old Icon" type="text"
                                        name="content[{{ $lang }}][FooterSection][Useful Links][Knowledge Base][old_Icon]"
                                        value="assets/images/templates/footer-arrow.png" hidden>
                                </label>

                                <a class="button-input"
                                    data-text="content[{{ $lang }}][FooterSection][Useful Links][Knowledge Base][Text]"
                                    data-href="{{ $data ? $data['FooterSection']['Useful Links']['Knowledge Base']['url'] : '#' }}"
                                    data-url="content[{{ $lang }}][FooterSection][Useful Links][Knowledge Base][url]">{{ $data ? $data['FooterSection']['Useful Links']['Knowledge Base']['Text'] : 'Knowledge Base' }}</a>
                        </li>
                        <input aria-label="Footer Section Useful Links Knowledge Base Text" type="text" hidden id="footer_knowledge_base_btn_text"
                            name="content[{{ $lang }}][FooterSection][Useful Links][Knowledge Base][Text]"
                            value="{{ $data ? $data['FooterSection']['Useful Links']['Knowledge Base']['Text'] : 'Knowledge Base' }}" />
                        <input aria-label="Footer Section Useful Links Knowledge Base url" type="text" hidden id="footer_knowledge_base_btn_url"
                            name="content[{{ $lang }}][FooterSection][Useful Links][Knowledge Base][url]"
                            value="{{ $data ? $data['FooterSection']['Useful Links']['Knowledge Base']['url'] : '#' }}" />
                        </a>
                        </li>
                        <li>
                            <a class="fot-icon" href="">
                                <label for="attachmentIcon2" class="pointer">
                                    <span class="visually-hidden">Upload Footer Section Useful Links Job Notice Board Icon</span>
                                    <div id="preimageIcon2" style="display:block">
                                        <img id='output_icon2'
                                            src="{{ $data ? asset($data['FooterSection']['Useful Links']['Job Notice Board']['Icon']) : asset('assets/images/templates/footer-arrow.png') }}"
                                            alt="">
                                    </div>
                                    <input type="file" accept="image/*" id="attachmentIcon2"
                                        name="content[{{ $lang }}][FooterSection][Useful Links][Job Notice Board][Icon]"
                                        value="" hidden>
                                    <input aria-label="Footer Section Useful Links Job Notice Board old Icon" type="text"
                                        name="content[{{ $lang }}][FooterSection][Useful Links][Job Notice Board][old_Icon]"
                                        value="assets/images/templates/footer-arrow.png" hidden>
                                </label>

                                <a class="button-input"
                                    data-text="content[{{ $lang }}][FooterSection][Useful Links][Job Notice Board][Text]"
                                    data-href="{{ $data ? $data['FooterSection']['Useful Links']['Job Notice Board']['url'] : '#' }}"
                                    data-url="content[{{ $lang }}][FooterSection][Useful Links][Job Notice Board][url]">{{ $data ? $data['FooterSection']['Useful Links']['Job Notice Board']['Text'] : 'Job Notice Board' }}</a>
                        </li>
                        <input aria-label="Footer Section Useful Links Job Notice Board Text" type="text" hidden id="footer_job_notice_board_btn_text"
                            name="content[{{ $lang }}][FooterSection][Useful Links][Job Notice Board][Text]"
                            value="{{ $data ? $data['FooterSection']['Useful Links']['Job Notice Board']['Text'] : 'Job Notice Board' }}" />
                        <input aria-label="Footer Section Useful Links Job Notice Board url" type="text" hidden id="footer_job_notice_board_btn_url"
                            name="content[{{ $lang }}][FooterSection][Useful Links][Job Notice Board][url]"
                            value="{{ $data ? $data['FooterSection']['Useful Links']['Job Notice Board']['url'] : '#' }}" />
                        </a>
                        </li>
                        <li>
                            <a class="fot-icon" href="">
                                <label for="attachmentIcon1" class="pointer">
                                    <span class="visually-hidden">Upload Footer Section Useful Links Events Icon</span>
                                    <div id="preimageIcon1" style="display:block">
                                        <img id='output_icon1'
                                            src="{{ $data ? asset($data['FooterSection']['Useful Links']['Events']['Icon']) : asset('assets/images/templates/footer-arrow.png') }}"
                                            alt="">
                                    </div>
                                    <input type="file" accept="image/*" id="attachmentIcon1"
                                        name="content[{{ $lang }}][FooterSection][Useful Links][Events][Icon]"
                                        value="" hidden>
                                    <input aria-label="Footer Section Useful Links Events old Icon" type="text"
                                        name="content[{{ $lang }}][FooterSection][Useful Links][Events][old_Icon]"
                                        value="assets/images/templates/footer-arrow.png" hidden>
                                </label>

                                <a class="button-input"
                                    data-text="content[{{ $lang }}][FooterSection][Useful Links][Events][Text]"
                                    data-href="{{ $data ? $data['FooterSection']['Useful Links']['Events']['url'] : '#' }}"
                                    data-url="content[{{ $lang }}][FooterSection][Useful Links][Events][url]">{{ $data ? $data['FooterSection']['Useful Links']['Events']['Text'] : 'Events' }}</a>
                        </li>
                        <input aria-label="Footer Section Useful Links Events Text" type="text" hidden id="footer_events_btn_text"
                            name="content[{{ $lang }}][FooterSection][Useful Links][Events][Text]"
                            value="{{ $data ? $data['FooterSection']['Useful Links']['Events']['Text'] : 'Events' }}" />
                        <input aria-label="Footer Section Useful Links Events url" type="text" hidden id="footer_events_btn_url"
                            name="content[{{ $lang }}][FooterSection][Useful Links][Events][url]"
                            value="{{ $data ? $data['FooterSection']['Useful Links']['Events']['url'] : '#' }}" />
                        </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="news-letter">
                    <h6 class="title-input"
                        id="content[{{ $lang }}][FooterSection][Newsletter][Title]"
                        contenteditable="true">
                        {{ $data ? $data['FooterSection']['Newsletter']['Title'] : 'Subscribe Our Newsletter' }}
                    </h6>
                    <input aria-label="Footer Section Newsletter Title" type="text" id="footer_news_title"
                        value="{{ $data ? $data['FooterSection']['Newsletter']['Title'] : 'Subscribe Our Newsletter' }}"
                        name="content[{{ $lang }}][FooterSection][Newsletter][Title]" hidden>
                    <div class="description-input"
                        id="content[{{ $lang }}][FooterSection][Newsletter][Description]"
                        data-text="content[{{ $lang }}][FooterSection][Newsletter][Description]">
                        {!! clean_html($data
                            ? $data['FooterSection']['Newsletter']['Description']
                            : 'Find Your News, Settle Your Mind — Every Story Curated for Your Peace of Mind.') !!}</div>
                    <input aria-label="Footer Section Newsletter Description" type="text" hidden id="Newsletter_description"
                        name="content[{{ $lang }}][FooterSection][Newsletter][Description]"
                        value="{{ $data ? $data['FooterSection']['Newsletter']['Description'] : 'Find Your News, Settle Your Mind — Every Story Curated for Your Peace of Mind.' }}" />

                    <div class="news-email">
                        <input type="email" placeholder="Enter Email" aria-label="Enter Email" class="form-control">
                        <label class="btn email-send-btn " for="attachmentIcon0" class="pointer">
                            <span class="visually-hidden">Upload Footer Section Newsletter Title Icon</span>
                            <div id="preimageIcon0" style="display:block">
                                <img id='output_icon0'
                                    src="{{ $data ? asset($data['FooterSection']['Newsletter']['Title Icon']) : asset('assets/images/templates/email-icon.svg') }}"
                                    alt="">
                            </div>
                            <input type="file" accept="image/*" id="attachmentIcon0"
                                name="content[{{ $lang }}][FooterSection][Newsletter][Title Icon]"
                                value="" hidden>
                            <input aria-label="Footer Section Newsletter old Icon" type="text"
                                name="content[{{ $lang }}][FooterSection][Newsletter][old_Icon]"
                                value="assets/images/templates/email-icon.svg" hidden>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="container">
        <div class="copy-rights">
            <div class="description-input"
                id="content[{{ $lang }}][FooterSection][Bottom][Description]"
                data-text="content[{{ $lang }}][FooterSection][Bottom][Description]">
                {!! clean_html($data
                    ? $data['FooterSection']['Bottom']['Description']
                    : '© Pakistan-Saudi Arabia Embassy 2025 | All Rights Reserved') !!}</div>
            <input aria-label="Footer Section Bottom Description" type="text" hidden id="footer_bottom_description"
                name="content[{{ $lang }}][FooterSection][Bottom][Description]"
                value="{{ $data
                    ? $data['FooterSection']['Bottom']['Description']
                    : '© Pakistan-Saudi Arabia Embassy 2025 | All Rights Reserved' }}" />
            <ul>
                <li><a class="button-input"
                        data-text="content[{{ $lang }}][FooterSection][Links][Terms & Conditions][Text]"
                        data-href="{{ $data ? $data['FooterSection']['Links']['Terms & Conditions']['url'] : '#' }}"
                        data-url="content[{{ $lang }}][FooterSection][Links][Terms & Conditions][Url]">{{ $data ? $data['FooterSection']['Links']['Terms & Conditions']['Text'] : 'Terms & Conditions' }}</a>
                </li>
                <input aria-label="Footer Section Links Terms & Conditions Text" type="text" hidden id="term_btn_text"
                    name="content[{{ $lang }}][FooterSection][Links][Terms & Conditions][Text]"
                    value="{{ $data ? $data['FooterSection']['Links']['Terms & Conditions']['Text'] : 'Terms & Conditions' }}" />
                <input aria-label="Footer Section Links Terms & Conditions url" type="text" hidden id="term_btn_url"
                    name="content[{{ $lang }}][FooterSection][Links][Terms & Conditions][url]"
                    value="{{ $data ? $data['FooterSection']['Links']['Terms & Conditions']['url'] : '#' }}" />

                <li><a class="button-input"
                        data-text="content[{{ $lang }}][FooterSection][Links][Privacy Policy][Text]"
                        data-href="{{ $data ? $data['FooterSection']['Links']['Privacy Policy']['url'] : '#' }}"
                        data-url="content[{{ $lang }}][FooterSection][Links][Privacy Policy][Url]">{{ $data ? $data['FooterSection']['Links']['Privacy Policy']['Text'] : 'Privacy Policy' }}</a>
                </li>
                <input aria-label="Footer Section Links Privacy Policy Text" type="text" hidden id="privacy_btn_text"
                    name="content[{{ $lang }}][FooterSection][Links][Privacy Policy][Text]"
                    value="{{ $data ? $data['FooterSection']['Links']['Privacy Policy']['Text'] : 'Privacy Policy' }}" />
                <input aria-label="Footer Section Links Privacy Policy url" type="text" hidden id="privacy_btn_url"
                    name="content[{{ $lang }}][FooterSection][Links][Privacy Policy][url]"
                    value="{{ $data ? $data['FooterSection']['Links']['Privacy Policy']['url'] : '#' }}" />

                <li><a class="button-input"
                        data-text="content[{{ $lang }}][FooterSection][Links][Contact Us][Text]"
                        data-href="{{ $data ? $data['FooterSection']['Links']['Contact Us']['url'] : '#' }}"
                        data-url="content[{{ $lang }}][FooterSection][Links][Contact Us][Url]">{{ $data ? $data['FooterSection']['Links']['Contact Us']['Text'] : 'Contact Us' }}</a>
                </li>
                <input aria-label="Footer Section Links Contact Us Text" type="text" hidden id="contact_btn_text"
                    name="content[{{ $lang }}][FooterSection][Links][Contact Us][Text]"
                    value="{{ $data ? $data['FooterSection']['Links']['Contact Us']['Text'] : 'Contact Us' }}" />
                <input aria-label="Footer Section Links Contact Us url" type="text" hidden id="contact_btn_url"
                    name="content[{{ $lang }}][FooterSection][Links][Contact Us][url]"
                    value="{{ $data ? $data['FooterSection']['Links']['Contact Us']['url'] : '#' }}" />
            </ul>
        </div>
    </div>
</footer>