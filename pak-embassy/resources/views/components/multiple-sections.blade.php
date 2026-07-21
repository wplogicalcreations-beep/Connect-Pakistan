@props([
    'sections' => [],
    'maxSections' => 10,
    'minSections' => 1
])

@php
    $sections = $sections ?? [];
    $sectionCount = count($sections) > 0 ? count($sections) : 1;
@endphp

<div class="sections-container" data-section-count="{{ $sectionCount }}">
    @for($i = 0; $i < $sectionCount; $i++)
        <div class="section-item mb-4" data-section-index="{{ $i }}">
            <div class="card border-0 p-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="mb-0">Section {{ $i + 1 }}</h6>
                    @php
                        // Allow removing any section in edit mode, or sections beyond minimum in create mode
                        $isEditMode = isset($sections[$i]) && is_object($sections[$i]) && isset($sections[$i]->id);
                        $canRemove = $isEditMode || $i >= $minSections;
                    @endphp
                    @if($canRemove)
                        <button type="button" class="btn btn-sm btn-outline-danger remove-section" data-section-index="{{ $i }}">
                            <i class="fas fa-trash"></i> Remove
                        </button>
                    @endif
                </div>
                
                <div class="row g-3">
                    @if(isset($sections[$i]) && is_object($sections[$i]) && $sections[$i]->id)
                        <input type="hidden" name="sections[{{ $i }}][id]" value="{{ $sections[$i]->id }}">
                    @elseif(isset($sections[$i]['id']))
                        <input type="hidden" name="sections[{{ $i }}][id]" value="{{ $sections[$i]['id'] }}">
                    @endif
                    <div class="col-md-12">
                        <x-floating-input 
                            name="sections[{{ $i }}][name]"
                            id="sectionName{{ $i }}"
                            label="Section Name"
                            placeholder="Section Name"
                            :oldValue="old('sections.' . $i . '.name')"
                            :modelValue="isset($sections[$i]) ? (is_object($sections[$i]) ? ($sections[$i]->name ?? '') : ($sections[$i]['name'] ?? '')) : ''"
                        />
                    </div>
                    
                    <div class="col-md-12">
                        <x-floating-textarea 
                            name="sections[{{ $i }}][content]"
                            id="sectionContent{{ $i }}"
                            label="Section Content"
                            :oldValue="old('sections.' . $i . '.content')"
                            :modelValue="isset($sections[$i]) ? (is_object($sections[$i]) ? ($sections[$i]->content ?? '') : ($sections[$i]['content'] ?? '')) : ''"
                            :useCkeditor="true"
                        />
                    </div>
                    
                    <div class="col-md-12">
                        <div class="img-chose-input">
                            <label class="picture" for="sectionImage{{ $i }}" tabindex="0">
                                <span class="picture__image" id="sectionImagePreview{{ $i }}">
                                    @php
                                        $hasImage = false;
                                        $imagePath = '';
                                        
                                        // Handle Eloquent model instances
                                        if (isset($sections[$i]) && is_object($sections[$i])) {
                                            // Check if section has images relationship loaded
                                            if ($sections[$i]->images && $sections[$i]->images->count() > 0) {
                                                $hasImage = true;
                                                $imagePath = $sections[$i]->images->first()->path;
                                            }
                                        }
                                        // Handle array data (for backward compatibility)
                                        else {
                                            // Check if section has images relationship loaded
                                            if (isset($sections[$i]['images']) && $sections[$i]['images']->count() > 0) {
                                                $hasImage = true;
                                                $imagePath = $sections[$i]['images']->first()->path;
                                            }
                                            // Check if section has image path directly
                                            elseif (isset($sections[$i]['image']) && !empty($sections[$i]['image'])) {
                                                $hasImage = true;
                                                $imagePath = $sections[$i]['image'];
                                            }
                                        }
                                    @endphp
                                    
                                    @if($hasImage)
                                        <img src="{{ asset('storage/' . $imagePath) }}" alt="Section Image Preview" style="max-width: 150px; max-height: 150px;" onerror="this.src='/images/majesticons_image-line.svg'">
                                    @else
                                        <img src="/images/majesticons_image-line.svg" alt="Preview">
                                    @endif
                                </span>
                                Upload Section Image
                            </label>
                            <input type="file" 
                                   name="sections[{{ $i }}][image]" 
                                   id="sectionImage{{ $i }}" 
                                   accept="image/*"
                                   class="section-image-input"
                                   data-preview-target="sectionImagePreview{{ $i }}">
                            <p>Photos should be in "jpeg, jpg, png, gif" format only</p>
                            @error('sections.' . $i . '.image')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endfor
    
    <div class="text-end mb-3">
        <button type="button" class="btn btn-primary add-section" 
                @if($sectionCount >= $maxSections) disabled @endif>
            <i class="fas fa-plus"></i> Add Section
        </button>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sectionsContainer = document.querySelector('.sections-container');
    const addSectionBtn = document.querySelector('.add-section');
    const maxSections = <?php echo $maxSections; ?>;
    const minSections = <?php echo $minSections; ?>;
    
    // Initialize CKEditor for existing sections
    function initializeCKEditors() {
        if (typeof CKEDITOR !== 'undefined') {
            const textareas = sectionsContainer.querySelectorAll('textarea.ckeditor');
            textareas.forEach(textarea => {
                initializeCKEditorForElement(textarea.id);
            });
        }
    }
    
    // Initialize CKEditor for a specific element
    function initializeCKEditorForElement(elementId) {
        if (typeof CKEDITOR !== 'undefined') {
            const element = document.getElementById(elementId);
            if (element && !CKEDITOR.instances[elementId]) {
                try {
                    CKEDITOR.replace(elementId);
                } catch (error) {
                    console.log('CKEditor initialization failed for:', elementId, error);
                }
            }
        }
    }
    
    // Initialize CKEditors after a short delay to ensure DOM is ready
    setTimeout(initializeCKEditors, 500);
    
    // Initialize image preview handlers
    function initializeImagePreviews() {
        const imageInputs = sectionsContainer.querySelectorAll('.section-image-input');
        imageInputs.forEach(input => {
            input.addEventListener('change', function(event) {
                const previewTarget = this.dataset.previewTarget;
                const preview = document.getElementById(previewTarget);
                if (preview) {
                    preview.innerHTML = '';
                    const file = event.target.files[0];
                    if (file) {
                        const img = document.createElement('img');
                        img.src = URL.createObjectURL(file);
                        img.style.maxWidth = "150px";
                        img.style.maxHeight = "150px";
                        preview.appendChild(img);
                    }
                }
            });
        });
    }
    
    // Initialize image previews after a short delay
    setTimeout(initializeImagePreviews, 500);
    
    // Add new section
    addSectionBtn.addEventListener('click', function() {
        const currentCount = parseInt(sectionsContainer.dataset.sectionCount);
        
        if (currentCount >= maxSections) {
            alert('Maximum number of sections reached');
            return;
        }
        
        const newIndex = currentCount;
        const sectionHtml = createSectionHtml(newIndex);
        
        // Insert before the add button
        const addButtonContainer = addSectionBtn.parentElement;
        addButtonContainer.insertAdjacentHTML('beforebegin', sectionHtml);
        
        // Update section count
        sectionsContainer.dataset.sectionCount = currentCount + 1;
        
        // Update section numbers
        updateSectionNumbers();
        
        // Disable add button if max reached
        if (currentCount + 1 >= maxSections) {
            addSectionBtn.disabled = true;
        }
        
        // Initialize CKEditor for new textarea if needed
        setTimeout(() => {
            initializeCKEditorForElement('sectionContent' + newIndex);
            // Initialize image preview for new section
            const newImageInput = document.getElementById('sectionImage' + newIndex);
            if (newImageInput) {
                newImageInput.addEventListener('change', function(event) {
                    const previewTarget = this.dataset.previewTarget;
                    const preview = document.getElementById(previewTarget);
                    if (preview) {
                        preview.innerHTML = '';
                        const file = event.target.files[0];
                        if (file) {
                            const img = document.createElement('img');
                            img.src = URL.createObjectURL(file);
                            img.style.maxWidth = "150px";
                            img.style.maxHeight = "150px";
                            preview.appendChild(img);
                        }
                    }
                });
            }
        }, 200);
    });
    
    // Remove section
    sectionsContainer.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-section') || e.target.closest('.remove-section')) {
            const button = e.target.classList.contains('remove-section') ? e.target : e.target.closest('.remove-section');
            const sectionIndex = parseInt(button.dataset.sectionIndex);
            const sectionItem = button.closest('.section-item');
            
            // Check if this is the last section and we're in create mode
            const currentCount = parseInt(sectionsContainer.dataset.sectionCount);
            const isLastSection = currentCount === 1;
            
            // In edit mode, allow removing any section. In create mode, warn if removing last section
            let confirmMessage = 'Are you sure you want to remove this section?';
            if (isLastSection && currentCount <= minSections) {
                confirmMessage = 'This is the last section. Removing it will leave the form with no sections. Are you sure you want to continue?';
            }
            
            if (confirm(confirmMessage)) {
                // Destroy CKEditor instance if exists
                if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances['sectionContent' + sectionIndex]) {
                    CKEDITOR.instances['sectionContent' + sectionIndex].destroy();
                }
                
                sectionItem.remove();
                
                // Update section count
                sectionsContainer.dataset.sectionCount = currentCount - 1;
                
                // Update section numbers and indices
                updateSectionNumbers();
                updateSectionIndices();
                
                // Enable add button if under max
                if (currentCount - 1 < maxSections) {
                    addSectionBtn.disabled = false;
                }
            }
        }
    });
    
    function createSectionHtml(index) {
        return `
            <div class="section-item mb-4" data-section-index="${index}">
                <div class="card border-0 p-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0">Section ${index + 1}</h6>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-section" data-section-index="${index}">
                            <i class="fas fa-trash"></i> Remove
                        </button>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="form-floating floating-custom">
                                <input type="text"
                                       class="form-control"
                                       id="sectionName${index}"
                                       name="sections[${index}][name]"
                                       placeholder="Section Name"
                                       value="">
                                <label for="sectionName${index}">Section Name</label>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="floating-custom-common mt-5">
                                <div class="common-design">
                                    <textarea class="form-control ckeditor"
                                                id="sectionContent${index}"
                                                name="sections[${index}][content]"
                                                rows="4"></textarea>
                                    <label for="sectionContent${index}">Section Content</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="img-chose-input">
                                <label class="picture" for="sectionImage${index}" tabindex="0">
                                    <span class="picture__image" id="sectionImagePreview${index}">
                                        <img src="/images/majesticons_image-line.svg" alt="Preview">
                                    </span>
                                    Upload Section Image
                                </label>
                                <input type="file" 
                                       name="sections[${index}][image]" 
                                       id="sectionImage${index}" 
                                       accept="image/*"
                                       class="section-image-input"
                                       data-preview-target="sectionImagePreview${index}">
                                <p>Photos should be in "jpeg, jpg, png, gif" format only</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }
    
    function updateSectionNumbers() {
        const sections = sectionsContainer.querySelectorAll('.section-item');
        sections.forEach((section, index) => {
            const title = section.querySelector('h6');
            title.textContent = `Section ${index + 1}`;
        });
    }
    
    function updateSectionIndices() {
        const sections = sectionsContainer.querySelectorAll('.section-item');
        sections.forEach((section, index) => {
            section.dataset.sectionIndex = index;
            
            // Update form field names and IDs
            const nameInput = section.querySelector('input[name*="[name]"]');
            const contentTextarea = section.querySelector('textarea[name*="[content]"]');
            
            if (nameInput) {
                nameInput.name = `sections[${index}][name]`;
                nameInput.id = `sectionName${index}`;
                nameInput.nextElementSibling.setAttribute('for', `sectionName${index}`);
            }
            
            if (contentTextarea) {
                contentTextarea.name = `sections[${index}][content]`;
                contentTextarea.id = `sectionContent${index}`;
                contentTextarea.nextElementSibling.setAttribute('for', `sectionContent${index}`);
            }
            
            // Update remove button data attribute
            const removeBtn = section.querySelector('.remove-section');
            if (removeBtn) {
                removeBtn.dataset.sectionIndex = index;
            }
        });
    }
});
</script>
