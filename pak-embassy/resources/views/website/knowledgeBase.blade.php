@extends('layouts.landing-page')

@section('title', 'Knowledge Base')

@section('content')
    <x-common-banner
        primary_button=true
        :data="$data"
    />


    <section class="common-base-main">
        <div class="container">
            <h3 class="section-heading">Knowledge Area</h3>

            <div class="row g-3">
                @forelse($knowledgeItems as $knowledge)
                    <x-knowledge-card :knowledge="$knowledge" />
                @empty
                    <div class="col-12">
                        <div class="text-center">
                            <p class="text-muted">No knowledge base items available at the moment.</p>
                        </div>
                    </div>
                @endforelse
            </div>
            
            @if($knowledgeItems->hasPages())
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-center">
                            {{ $knowledgeItems->links() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection