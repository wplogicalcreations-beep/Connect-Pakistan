@extends('layouts.master')

@section('content')
    <div class="page-content page-content-ck">
        <div class="page-title">
            <h5 class="go-back">
                <- Go Back</h3>
        </div>
        <div class="card border-0 p-3">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="row g-3">
                        <h1>1- Basic Details</h1>
                        <div class="col-md-12">
                            <div class="form-floating floating-custom">
                                <input type="text" class="form-control" id="pageName" placeholder="name@example.com"
                                       value="Fintech Revolution Summit 2025">
                                <label for="pageName">Event Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating floating-custom">
                                <input type="text" id="from" class="form-control" value="15-05-2025" />
                                <label for="from">Start Date</label>
                                <img src="./images/Calendar.svg" alt="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating floating-custom">
                                <input type="text" id="to" class="form-control" value="16-05-2025" />
                                <label for="from">End Date</label>
                                <img src="./images/Calendar.svg" alt="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating floating-custom">
                                <input type="text" class="form-control" name="time1" id="time1" value="12:00 AM"
                                       readonly>
                                <label for="from">Start Time</label>
                                <img src="./images/Clock.svg" alt="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating floating-custom">
                                <input type="text" class="form-control" name="time2" id="time2" value="03 : 00 PM"
                                       readonly>
                                <label for="from">End Time</label>
                                <img src="./images/Clock.svg" alt="">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-floating floating-custom">
                                <div class="form-location">
                                    <p class="my-2">Al Badeia'ah Dist., P.O.Box: 2903111,Riyadh</p>
                                    <img src="/images/location_on.svg" alt="">
                                    <label>Location</label>
                                </div>
                            </div>
                        </div>

                        <h1 class="mt-5">2- Add Some More Info</h1>
                        <div class="col-md-12">
                            <div class="floating-custom-common">
                                <div class="common-design">
                                    <p class="my-2">The Fintech Revolution Summit 2025 will take place on 4th
                                        July 2025 in Riyadh, Saudi Arabia, serving as a flagship event that
                                        highlights the Kingdom’s strategic shift towards a digitally empowered
                                        financial ecosystem.
                                    </p>
                                    <label>Event Overview</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="floating-custom-common">
                                <div class="common-design">
                                    <h5 class="heading">
                                        Morning Sessions
                                    </h5>
                                    <p class="mb-1"> 09:00 AM – 10:00 AM | Opening Ceremony & Keynote Address</p>
                                    <ul>
                                        <li>Welcome speech by government officials</li>
                                        <li> Keynote on Saudi Arabia’s fintech vision</li>
                                    </ul>
                                    <p class="mb-1">10:00 AM – 11:30 AM | Panel Discussion: The Future of Digital
                                        Banking
                                    </p>
                                    <ul>
                                        <li>Experts discuss innovations in banking and financial services
                                        </li>
                                    </ul>
                                    <p class="mb-1">11:30 AM – 12:30 PM | Payments Innovation & Blockchain Security
                                    </p>
                                    <ul>
                                        <li>Exploring next-gen payment solutions and cybersecurity measures
                                        </li>
                                    </ul>
                                    <h5 class="heading">
                                        Afternoon Sessions
                                    </h5>
                                    <p class="mb-1">
                                        01:30 PM – 02:30 PM | Regulatory Frameworks for Fintech Growth
                                    </p>
                                    <ul>
                                        <li> Policymakers and industry leaders discuss fintech regulations</li>
                                    </ul>
                                    <p class="mb-1">
                                        02:30 PM – 03:30 PM | Product Demonstrations & Startup Pitches
                                    </p>
                                    <ul>
                                        <li>Showcasing cutting-edge fintech solutions</li>
                                    </ul>
                                    <p class="mb-1">
                                        03:30 PM – 04:30 PM | Networking & Strategic Partnerships
                                    </p>
                                    <ul>
                                        <li> Investors, startups, and financial institutions connect
                                        </li>
                                    </ul>
                                    <p class="mb-1"> 04:30 PM – 05:00 PM | Closing Remarks & Future Roadmap
                                    </p>
                                    <ul>
                                        <li>Summary of key takeaways and next steps for fintech in Saudi Arabia
                                        </li>
                                    </ul>
                                    <label>Agenda</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="floating-custom-common">
                                <div class="common-design">
                                    <p class="mb-1">Participants can engage in:
                                    </p>
                                    <ul>
                                        <li>Keynote Sessions – Insights from industry leaders and policymakers.</li>
                                        <li>Expert Panels – Discussions on emerging fintech trends and challenges.
                                        </li>
                                        <li>Product Demonstrations – Showcasing cutting-edge fintech solutions.</li>
                                        <li>Networking Opportunities – Connecting with investors, startups, and
                                            financial institutions.</li>
                                    </ul>
                                    <label>Event Format</label>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <h1 class="mt-3">3- Who’s Attending?</h1>
                            <button class="btn"><img src="images/add-btn.svg" alt=""></button>
                        </div>
                        <div class="col-md-6">
                            <div class="floating-custom-common">
                                <div class="common-design attendees">
                                    <p class="my-2">Jawad Mahmood (CIBO barq PK)
                                    </p>
                                    <label>Attendee 1</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="floating-custom-common">
                                <div class="common-design attendees">
                                    <p class="my-2">www.linkedin.com/jawadmahmood
                                    </p>
                                    <label>Profile URL</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="floating-custom-common">
                                <div class="common-design attendees">
                                    <p class="my-2">Iftikhar Shahid (CTO barq PK)
                                    </p>
                                    <label>Attendee 2</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="floating-custom-common">
                                <div class="common-design attendees">
                                    <p class="my-2">www.linkedin.com/iftikharshahid
                                    </p>
                                    <label>Profile URL</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="floating-custom-common">
                                <div class="common-design attendees">
                                    <p class="my-2">Saad Sarwar (CDO barq PK)
                                    </p>
                                    <label>Attendee 3</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="floating-custom-common">
                                <div class="common-design attendees">
                                    <p class="my-2">www.linkedin.com/saadsarwar
                                    </p>
                                    <label>Profile URL</label>
                                </div>
                            </div>
                        </div>

                        <h1 class="mt-5">4- Upload Event Picture</h1>

                        <div class="img-chose-input">

                            <label class="picture" for="picture__input" tabindex="0">
                                <span class="picture__image"><img src="/images/majesticons_image-line.svg" alt=""></span>
                                Upload Image
                            </label>

                            <input type="file" name="picture__input" id="picture__input">
                            <p>Photos should be in “ jpeg, jpg,  png, gif format only</p>
                        </div>
                        <div class="upload-btns">
                            <button type="button" class="btn btn-outline-secondary button-style">Cancel</button>
                            <button type="button" class="btn btn-common-bg"><a href="add-knowledge-page.html">Create Event</a></button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js-file')
@endsection
