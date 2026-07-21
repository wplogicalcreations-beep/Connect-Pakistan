window.editors = [];
document.querySelectorAll('.ckeditor').forEach((el, index) => {
    ClassicEditor
        .create(el)
        .then(editor => {
            window.editors[index] = editor;
            console.log('CKEditor 5 instance created for:', el.id, 'at index:', index);
        })
        .catch(err => {
            console.error('Error creating CKEditor 5 instance:', err.stack);
        });
});