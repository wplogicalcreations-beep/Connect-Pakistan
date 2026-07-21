<script src="{{asset('js/jquery/ckeditor.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.description-input').on('click', function () {
            let el_id = $(this).attr('id');
            $('textarea[name="general_model_desc"]').attr("id", el_id);
            myEditor.setData($(this).html());
            $('#myGeneralModel').addClass('animated-general-modal'); // after post
        });
 
        $('.title-input').on('keyup', function () {
            let el_id = $(this).attr('id');
            let textData = $(this).text();
            let input = $("input[name='" + el_id + "']");
            input.attr('value', textData);
            // let para = $('[data-text="'+el_id+'"]');
            // para.text('');
 
        });
 
        $('.button-input').on('click', function () {
            let btn_text_id = $(this).attr('data-text');
            let btn_url_id = $(this).attr('data-url');
            let btn_url_href = $(this).attr('data-href');
            let btn_text_input = $('input[name="general_btn_text"]');
            let btn_url_input = $('input[name="general_btn_url"]');
            btn_text_input.attr("id", btn_text_id).val($(this).text());
            btn_url_input.attr("id", btn_url_id).val(btn_url_href);
            $('#myButtonModel').addClass('animated-general-modal'); // after post
        });
    });
 
    $('.closebtnmodal').click(function () {
        // $("#mySidepanel").css({"width": "0", "display": "none"});
        $("#myGeneralModel").removeClass('animated-general-modal');
        $("#myButtonModel").removeClass('animated-general-modal');
    })
</script>
<script>
    var myEditor;
    ClassicEditor
        .create(document.querySelector('.ckeditor'))
        .then(editor => {
            myEditor = editor;
        })
        .catch(err => {
            console.error(err.stack);
        });
 
    $('#done_typing').on('click', function () {
        let input_textarea = $(this).closest("div.general_model_data").find("textarea[name='general_model_desc']");
        let textarea_id = input_textarea.attr('id');
        let textData = myEditor.getData();
        if (textData === '') {
            return false;
        }
        let input = $("input[name='" + textarea_id + "']");
        input.attr('value', textData);
        let para = $('[data-text="' + textarea_id + '"]');
        para.html('');
        para.html(textData);
        myEditor.setData('');
        $("#myGeneralModel").removeClass('animated-general-modal');
    });
 
    $('#done_btn_details').on('click', function () {
        let input_text_btn = $(this).closest("div.button_model_data").find("input[name='general_btn_text']");
        let input_url_btn = $(this).closest("div.button_model_data").find("input[name='general_btn_url']");
        if (input_url_btn.val() === '' || input_text_btn.val() === '') {
            return false;
        }
        //to get ids from modal
        let input_text_btn_id = input_text_btn.attr('id');
        let input_url_btn_id = input_url_btn.attr('id');
 
        //to match the input fields on file
        let input_text = $("input[name='" + input_text_btn_id + "']");
        let input_url = $("input[name='" + input_url_btn_id + "']");
 
        //Setting the values
        let btn = $('[data-text="' + input_text_btn_id + '"]');
        btn.text(input_text_btn.val());
        // btn.attr('href', input_url_btn.val());
        btn.attr('data-href', input_url_btn.val());
        input_text.attr('value', input_text_btn.val());
        input_url.attr('value', input_url_btn.val());
        $("#myButtonModel").removeClass('animated-general-modal');
    });
 
    @for($i = 0; $i < 20; $i++)
    $('#attachmentIcon{{$i}}').on('change', function (event) {
        var file = event.target.files[0];
        var maxSize = 2 * 1024 * 1024; // 2MB
        if (file.size > maxSize) {
            toastr.remove();
            toastr.error('Max file size allowed is 2MB');
            $(this).val('');
            return;
        }
        var output = document.getElementById('output_icon{{$i}}');
        $('#preimageIcon{{$i}}').show(600);
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function () {
            URL.revokeObjectURL(output.src) // free memory
        }
    });
    @endfor
 
    $('#attachmentLogo').on('change', function (event) {
        var file = event.target.files[0];
        var maxSize = 2 * 1024 * 1024; // 2MB
        if (file.size > maxSize) {
            toastr.remove();
            toastr.error('Max file size allowed is 2MB');
            $(this).val('');
            return;
        }
        var output = document.getElementById('output_logo');
        $('#preimageLogo').show(600);
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function () {
            URL.revokeObjectURL(output.src) // free memory
        }
    });
 
    @for($i = 0; $i < 15; $i++)
    $('#attachmentImage{{$i}}').on('change', function (event) {
        var file = event.target.files[0];
        var maxSize = 5 * 1024 * 1024; // 5MB
        if (file.size > maxSize) {
            toastr.remove();
            toastr.error('Max file size allowed is 5MB');
            $(this).val('');
            return;
        }
        var output = document.getElementById('output_image{{$i}}');
        $('#preimageImage{{$i}}').show(600);
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function () {
            URL.revokeObjectURL(output.src) // free memory
        }
    });
    @endfor
 
    @for($i = 0; $i < 10; $i++)
    $('#bgImage{{$i}}').on('change', function (event) {
        var file = event.target.files[0];
        var maxSize = 5 * 1024 * 1024; // 5MB
        if (file.size > maxSize) {
            toastr.remove();
            toastr.error('Max file size allowed is 5MB');
            $(this).val('');
            return;
        }
        var output = document.getElementById('output_bgImage{{$i}}');
        output.style.backgroundImage = "url(" + (URL.createObjectURL(event.target.files[0])) + ")";
        output.onload = function () {
            URL.revokeObjectURL(output.style.backgroundImage) // free memory
        }
    });
    @endfor
    $('#video0').on('change', function (event) {
        var videoPlayer = document.getElementById('output_video0');
        $('#preVideo0').show(600);
        var selectedFile = event.target.files[0];
        var videoURL = URL.createObjectURL(selectedFile);
        videoPlayer.src = videoURL;
        videoPlayer.onload = function () {
            URL.revokeObjectURL(videoPlayer.src);
        };
    });
</script>
<script type="text/javascript">
    $('.lang').on('change', function () {
        let formID = $(this).attr('data-form');
        $('#' + formID).submit();
    });
</script>