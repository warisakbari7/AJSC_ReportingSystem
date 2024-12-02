$(()=>{
    // placing file name to labels
    $("#image").on("change", function() {
        let image = $(this).val().split("\\").pop();
        let ext = image.substr( (image.lastIndexOf('.') +1) );
        if(image != '')
        {
            switch (ext) {
                case 'jpg':
                case 'png':
                case 'jpeg':
                $('#lbl_image').text(image);
                $('#image_err').text('')
                break;
                case "":
                $('#lbl_image').text('');
    
                default:
                $('#image_err').text('عکس باید png, jpeg یا jpg باشد.')
                $('#lbl_image').text('');
                this.value = '';
            }
            if(this.files[0].size > 4000000)
            {
                $('#image_err').text('عکس باید بیشتر از 4Mb نباشد.')
                $('#lbl_image').text('');
                this.value = '';
            } 
            else{
                $('#image_err').text('')
            }
            return;
        }
        else
        {
            $('#lbl_image').text(image);
            $('#image_err').text('')
        }

      });

})