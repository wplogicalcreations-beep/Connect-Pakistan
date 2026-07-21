@extends("layouts.master")
@section("content")
    <div class="page-title">
        <h3>LOV - {{ ucfirst($category) }}</h3>
    </div>
    <div class="card border-0 py-3 px-2">
        <div class="row">
            <!-- Left Sidebar with LOV Types -->
            <div class="col-md-3 col-lg-2 mb-3">
                <div class="lov-sidebar">
                    <h5 class="mb-3 fw-bold text-dark">{{ ucfirst($category) }}</h5>
                    <div class="lov-type-list">
                        <ul class="list-unstyled mb-0">
                            @foreach($lovTypes as $lovType)
                                @php
                                    // Check if this is a skill option (for Individual) or Service Skills (for Business)
                                    $isSkillsOption = ($category === 'individual' && isset($lovType->is_skill) && $lovType->is_skill);
                                    $isServiceSkills = ($category === 'business' && $lovType->slug === 'service-skills');
                                    
                                    // Determine if this item is active
                                    $isActive = false;
                                    if ($isSkillsOption && isset($isSkillsView) && $isSkillsView && $selectedType === 'skills') {
                                        $isActive = true;
                                    } elseif ($isServiceSkills && isset($isSkillsView) && $isSkillsView) {
                                        $isActive = true;
                                    } elseif (!$isSkillsOption && !$isServiceSkills && $selectedType == $lovType->slug) {
                                        $isActive = true;
                                    }
                                @endphp
                                <li class="mb-2">
                                    <a href="{{ route('lov.category.index', ['category' => $category, 'type' => $lovType->slug]) }}" 
                                       class="text-decoration-none d-block p-2 rounded {{ $isActive ? 'bg-light fw-bold text-success' : 'text-dark' }}"
                                       style="transition: all 0.2s;">
                                        {{ $lovType->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Right Content Area -->
            <div class="col-md-9 col-lg-10">
                @if(isset($isSkillsView) && $isSkillsView && isset($skills) && $skills)
                    @php
                        $filterType = ($category === 'business' && $selectedType === 'service-skills') ? 'service-skills' : 'skills';
                    @endphp
                    @include('super-admin.lov.category.__filters', ['type' => $filterType, 'category' => $category, 'isSkills' => true])
                    @include('super-admin.lov.category.__skills_table', ['skills' => $skills])
                @elseif($selectedType && $lovs)
                    @include('super-admin.lov.category.__filters', ['type' => $selectedType, 'category' => $category])
                    @include('super-admin.lov.category.__table', ['lovs' => $lovs, 'type' => $selectedType])
                @else
                    <div class="text-center py-5">
                        <p>Please select a LOV type from the sidebar</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section("js-file")
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/lov.js') }}"></script>
    @if(isset($isSkillsView) && $isSkillsView)
        <script src="{{ asset('js/skill.js') }}"></script>
        <script>
            // Auto-fill type based on category when opening add modal
            $(document).ready(function() {
                let category = '{{ $category }}';
                
                // If category not available from view, extract from URL
                if (!category) {
                    const urlPath = window.location.pathname;
                    const categoryMatch = urlPath.match(/\/lov\/category\/(individual|business|embassy)/);
                    if (categoryMatch) {
                        category = categoryMatch[1];
                    }
                }
                
                $('#staticBackdropAdd').on('show.bs.modal', function(event) {
                    // Try to get category from button data attribute first
                    const button = $(event.relatedTarget);
                    const buttonCategory = button.data('category');
                    if (buttonCategory) {
                        category = buttonCategory;
                    }
                    
                    // Set the hidden type field
                    $('#skillType').val(category);
                });
            });
        </script>
    @endif
    <script>
        const category = '{{ $category }}';
        const baseUrl = '{{ route("lov.category.index", $category) }}';
        const isSkillsView = {{ isset($isSkillsView) && $isSkillsView ? 'true' : 'false' }};

        // Handle AJAX filtering
        $(document).ready(function() {
            $('#searchInput').on('keyup', function() {
                const search = $(this).val();
                if (isSkillsView) {
                    filterSkills(search);
                } else {
                    const type = '{{ $selectedType }}';
                    if (type) {
                        filterLovs(search, type);
                    }
                }
            });
        });

        function filterLovs(search, type) {
            $.ajax({
                url: baseUrl + '?type=' + type + '&search=' + search,
                type: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    if (response.success) {
                        $('#lovsTable').html(response.html);
                        $('.pagination-wrapper').html(response.pagination);
                    }
                }
            });
        }

        function filterSkills(search) {
            let url = baseUrl;
            // Add type parameter based on category
            if (category === 'individual') {
                url += '?type=skills';
            } else if (category === 'business') {
                url += '?type=service-skills';
            }
            if (search) {
                url += (url.includes('?') ? '&' : '?') + 'name=' + search;
            }
            
            $.ajax({
                url: url,
                type: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    if (response.success) {
                        $('#skillsTable').html(response.html);
                        $('.pagination-wrapper').html(response.pagination);
                    }
                }
            });
        }
    </script>
@endsection

