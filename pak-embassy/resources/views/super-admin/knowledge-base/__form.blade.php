<div class="page-content page-content-ck">
    <div class="page-title">
        <h5 class="go-back" style="cursor: pointer;" onclick="window.history.back();">
            <- Go Back</h5>
    </div>

    <div class="card border-0 p-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form id="knowledgeForm" action="{{ isset($knowledgeBase) ? route('knowledge.update',['id' => $knowledgeBase->id]) : route('knowledge.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <div class="row g-3">

                        <!-- 1- Basic Detail -->
                        <h1>1- Basic Detail</h1>
                        <div class="col-md-12">
                            <x-floating-input 
                                name="page_name"
                                id="pageName"
                                label="Page Name"
                                placeholder="Page Name"
                                :oldValue="old('page_name')"
                                :modelValue="$knowledgeBase?->page_name ?? ''"
                            />

                            <x-floating-input 
                                name="heading"
                                id="heading"
                                label="Heading"
                                placeholder="Heading"
                                :oldValue="old('heading')"
                                :modelValue="$knowledgeBase?->heading ?? ''"
                            />
                        </div>

                        <!-- 2- Sections -->
                        <h1 class="mt-5">2- Sections</h1>
                        <div class="col-md-12">
                            <x-multiple-sections 
                                :sections="$knowledgeBase?->sections ?? []"
                                :maxSections="10"
                                :minSections="1"
                            />
                        </div>

                        <!-- Buttons -->
                        <div class="col-md-12 upload-btns">
                            <button type="reset" class="btn btn-outline-secondary button-style">Cancel</button>
                            <button type="submit" class="btn btn-common-bg">{{ isset($knowledgeBase) ? 'Update' : 'Add' }} Knowledge</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/jquery/ckeditor.js') }}"></script>
<script src="{{ asset('js/SuperAdmin/form-ckeditor.js') }}"></script>
<script>
document.getElementById('picture__input').addEventListener('change', function(event) {
    const preview = document.getElementById('picturePreview');
    preview.innerHTML = '';
    const file = event.target.files[0];
    if (file) {
        const img = document.createElement('img');
        img.src = URL.createObjectURL(file);
        img.style.maxWidth = "150px";
        img.style.maxHeight = "150px";
        preview.appendChild(img);
    }
});

// Handle form submission to prevent validation errors for removed sections
document.getElementById('knowledgeForm').addEventListener('submit', function(e) {
    // Remove any empty section inputs that might cause validation issues
    const sectionsContainer = document.querySelector('.sections-container');
    if (sectionsContainer) {
        const sectionItems = sectionsContainer.querySelectorAll('.section-item');
        const sectionsToRemove = [];
        
        sectionItems.forEach((item, index) => {
            const nameInput = item.querySelector('input[name*="[name]"]');
            const contentTextarea = item.querySelector('textarea[name*="[content]"]');
            
            // Check if both name and content are empty or just whitespace
            const nameValue = nameInput ? nameInput.value.trim() : '';
            const contentValue = contentTextarea ? contentTextarea.value.trim() : '';
            
            // If both are empty, mark for removal
            if (!nameValue && !contentValue) {
                sectionsToRemove.push(item);
            }
        });
        
        // Remove empty sections
        sectionsToRemove.forEach(item => {
            item.remove();
        });
        
        // Re-index the remaining sections to avoid gaps
        const remainingItems = sectionsContainer.querySelectorAll('.section-item');
        console.log(`Found ${remainingItems.length} remaining sections after cleanup`);
        
        remainingItems.forEach((item, newIndex) => {
            // Update all input names to be sequential
            const nameInput = item.querySelector('input[name*="[name]"]');
            const contentTextarea = item.querySelector('textarea[name*="[content]"]');
            const imageInput = item.querySelector('input[name*="[image]"]');
            const idInput = item.querySelector('input[name*="[id]"]');
            
            if (nameInput) {
                nameInput.name = `sections[${newIndex}][name]`;
                nameInput.id = `sectionName${newIndex}`;
            }
            if (contentTextarea) {
                contentTextarea.name = `sections[${newIndex}][content]`;
                contentTextarea.id = `sectionContent${newIndex}`;
            }
            if (imageInput) {
                imageInput.name = `sections[${newIndex}][image]`;
                imageInput.id = `sectionImage${newIndex}`;
            }
            if (idInput) {
                idInput.name = `sections[${newIndex}][id]`;
            }
            
            // Update section number display
            const sectionTitle = item.querySelector('h6');
            if (sectionTitle) {
                sectionTitle.textContent = `Section ${newIndex + 1}`;
            }
        });
    }
});

setTimeout(() => {
    document.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
    document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
}, 5000);
</script>