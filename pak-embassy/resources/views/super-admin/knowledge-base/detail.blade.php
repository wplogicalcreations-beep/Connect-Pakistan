@extends("layouts.master")
@section('content')
<div class="page-content">
    <!-- Go Back Link -->
    <div class="mb-3">
        <a href="{{ route('knowledge.index') }}" class="text-decoration-none text-dark">
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
                                            <a href="#section-{{ $index + 1 }}" class="text-decoration-none text-dark section-nav-link">
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

<style>
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
    
    .section-nav-link {
        cursor: pointer;
    }
    
    .section-nav-link:hover {
        color: #0d6efd !important;
        text-decoration: underline !important;
    }
</style>

<script>
    // Ensure anchor links work correctly
    document.addEventListener('DOMContentLoaded', function() {
        const sectionLinks = document.querySelectorAll('.section-nav-link');
        
        sectionLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    });
</script>

@endsection
