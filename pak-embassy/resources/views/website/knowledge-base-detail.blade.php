<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/embassy-logo.svg') }}" type="image/x-icon">
    <title>{{ $knowledgeBase->heading ?? $knowledgeBase->page_name }}</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #fff;
        }
        
        .common-base-main {
            padding: 40px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .section-content {
            scroll-margin-top: 100px;
        }
        
        .content-text {
            line-height: 1.8;
            color: #333;
        }
        
        .content-text p {
            margin-bottom: 1rem;
        }
        
        .content-text img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
        
        .image-container img {
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .card-header {
            border-bottom: 1px solid #e9ecef;
        }
        
        .card-body a:hover {
            color: #0d6efd !important;
            text-decoration: underline !important;
        }
        
        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
        }
        
        h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }
        
        h2 {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        
        .go-back-link {
            color: #333;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            margin-bottom: 2rem;
            transition: color 0.3s;
        }
        
        .go-back-link:hover {
            color: #0d6efd;
        }
        
        .card {
            border-radius: 8px;
        }
        
        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }
            
            h2 {
                font-size: 1.5rem;
            }
            
            .common-base-main {
                padding: 20px 15px;
            }
        }
    </style>
</head>
<body>
    <div class="common-base-main">
        <div class="container-fluid">
            <!-- Go Back Link -->
            <div class="mb-4">
                <a href="{{ route('knowledge') }}" target="_parent" class="go-back-link">
                    <i class="fas fa-arrow-left me-2"></i>Go Back
                </a>
            </div>

            <div class="row">
                <!-- Main Content Area -->
                <div class="col-lg-8 col-md-12">
                    <!-- Main Title -->
                    <h1 class="mb-4 fw-bold">{{ $knowledgeBase->heading ?? $knowledgeBase->page_name }}</h1>

                    <!-- Sections Content -->
                    @if($knowledgeBase->sections && $knowledgeBase->sections->count() > 0)
                        @foreach($knowledgeBase->sections as $index => $section)
                            <div id="section-{{ $index + 1 }}" class="section-content mb-5">
                                <!-- Section Name as Subheading -->
                                @if($section->name)
                                    <h2 class="mb-3 fw-bold">{{ $section->name }}</h2>
                                @endif
                                
                                <!-- Section Content -->
                                @if($section->content)
                                    <div class="content-text mb-4">
                                        {!! $section->content !!}
                                    </div>
                                @endif
                                
                                <!-- Section Images -->
                                @if($section->images && $section->images->count() > 0)
                                    <div class="section-images mb-4">
                                        @foreach($section->images as $image)
                                            <div class="image-container mb-3">
                                                <img src="{{ asset('storage/' . $image->path) }}" 
                                                     alt="{{ $section->name }}" 
                                                     class="img-fluid rounded w-100"
                                                     style="max-height: 500px; object-fit: cover;">
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> No content available for this knowledge base.
                        </div>
                    @endif
                </div>

                <!-- Sidebar - On This Page Navigation -->
                <div class="col-lg-4 col-md-12">
                    <div class="sticky-top" style="top: 20px;">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white">
                                <h5 class="mb-0 fw-bold">On This Page</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled mb-0">
                                    @if($knowledgeBase->sections && $knowledgeBase->sections->count() > 0)
                                        @foreach($knowledgeBase->sections as $index => $section)
                                            @if($section->name)
                                                <li class="mb-2">
                                                    <a href="#section-{{ $index + 1 }}" class="text-decoration-none text-dark">
                                                        {{ $section->name }}
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    @else
                                        <li class="text-muted">No sections available</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
            crossorigin="anonymous"></script>
</body>
</html>
