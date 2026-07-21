@extends('dashboard-layouts.company-layout.master')

@section('content')
    <div class="event-top mt-4 mb-3">
        <a href="{{ url('company/dashboard')}}"><img src="{{ asset('user-dash-img/ph_arrow-left-bold.svg')}}" alt="ph_arrow-left-bold image">Go Back</a>
    </div>
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-9 text-style">
            <h1>Fintech Revolution Summit 2025</h1>
            <p><strong>The Fintech Revolution Summit 2025</strong> will take place on <strong>4th July 2025 in
                    Riyadh, Saudi Arabia</strong>, serving as a flagship event that highlights the Kingdom's
                strategic shift towards a digitally empowered financial ecosystem.</p>

            <p>Under the umbrella of Vision 2030, Saudi Arabia has been aggressively enhancing its digital
                transformation agenda, with financial technologies (fintech) playing a critical role in shaping
                the future of the financial landscape and overall development of the Kingdom. Central to this
                effort is the Kingdom's intention to become a major fintech hub where broader financial services
                collaboration will play a crucial role, supporting the vision of fintech integration, enhancing
                regulatory frameworks, encouraging public-private partnerships, and attracting both local and
                foreign investment into the fintech space.</p>

            <p>Saudi Arabia aims to become the regional leader in fintech by 2030, enabling seamless, secure,
                and efficient digital financial services that benefit both consumers and institutions.
                Government bodies such as the Saudi Central Bank (SAMA) and the Capital Market Authority (CMA)
                have played pivotal roles in issuing regulatory sandboxes, open banking frameworks, and fintech
                licensing policies to streamline fintech services across financial sectors.</p>

            <p>As of 2024, the Kingdom’s fintech sector has reached a market valuation of approximately USD 3.6
                billion, making it one of the most dynamic in the MENA region. With the ambition to attract
                global support systems, the summit brings together C-level executives, policymakers, investors,
                and thought leaders to outline a unified approach for fintech-driven progress. With high
                smartphone penetration, a government-led initiative like Mada and SADAD, and new platform-based
                financial tools, Saudi Arabia is well-positioned to become a regional fintech powerhouse.</p>

            <p>This year’s summit will not only showcase cutting-edge fintech trends but will also lay the
                groundwork for broader economic resilience, youth development, and international collaboration.
                The Fintech Revolution Summit 2025 is paving the groundwork for broader economic resilience, job
                creation, and enhanced financial inclusion across the Kingdom.</p>

            <div class="text-center">
                <img src="{{ asset('user-dash-img/big-image-area.png')}}" alt="Meeting Image" class="article-image">
            </div>

            <h3>The Fintech Revolution Summit 2025 seeks to:</h3>
            <ul class="custom-list">
                <li>Empower financial innovation by showcasing cutting-edge technologies and solutions.</li>
                <li>Facilitate discussions on transforming fintech strategy through innovation and compliance.
                </li>
                <li>Connect regional CEOs, CTOs, Fintech VCs, and heads of innovation with fintech innovators to
                    explore investment opportunities.</li>
                <li>Highlight Saudi Arabia’s role as the Middle East’s next fintech hub.</li>
            </ul>

            <h3>Key Themes & Topics</h3>
            <p>The summit will delve into various themes, including:</p>
            <ul class="custom-list">
                <li>Digital Payment Platforms</li>
                <li>Open Banking & API-led Services</li>
                <li>AI-driven Financial Technologies</li>
                <li>Blockchain and Crypto-Finance Solutions</li>
                <li>Fintech Regulation and Compliance</li>
                <li>Cybersecurity in Financial Services</li>
                <li>Digital Identity and Authentication</li>
                <li>Cloud Infrastructure for Fintech and DLT-based Applications</li>
                <li>Women in Fintech Leadership</li>
                <li>Startups, Accelerators, and Incubators</li>
                <li>IoT, Smart Cities, and Blockchain/IoT Solutions</li>
                <li>AML, Anti-Fraud Systems</li>
            </ul>
        </div>

        <!-- Right Side Table of Contents (TOC) -->
        <div class="col-lg-3 d-none d-lg-block">
            <div class="toc sticky-top pt-3">
                <h6>On This Page</h6>
                <ul>
                    <li><a href="#overview">Overview</a></li>
                    <li><a href="#objectives">Characteristics</a></li>
                    <li><a href="#themes">Key Themes & Topics</a></li>
                    <li><a href="#details">Other Details</a></li>
                </ul>
            </div>
        </div>

    </div>
@endsection
@section('js-file')
@endsection
