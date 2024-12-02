// variable for keep the count of number of titles 
var titles_counter = 1;
$(()=>{
// ‍   diplaying name of pictures
    $(document).on('change','input.r_img', function() {
        let img = $(this).val().split("\\").pop();
        let ext = img.substr( (img.lastIndexOf('.') +1) );
        if(img != '')
        {
            switch (ext) {
                case 'jpg':
                case 'jpeg':
                case 'png':
                $(this).siblings('label.lbl').children('span.lbl_name').text(img);
                $(this).siblings('p').text('')
                break;
                case "":
                $(this).siblings('label.lbl').children('span.lbl_name').text('');
                default:
                $(this).siblings('p').text('تصویر باید jgp, jpeg یا png باشد.')
                $(this).siblings('label.lbl').children('span.lbl_name').text('');
                this.value = '';
            }
            return;
        }
        else
        {
            $(this).siblings('label.lbl').children('span.lbl_name').text(img);
            $(this).siblings('p').text('');
        }
      });



    // placing file name to labels
    $("#video").on("change", function() {
        let video = $(this).val().split("\\").pop();
        let ext = video.substr( (video.lastIndexOf('.') +1) );
        if(video != '')
        {
            switch (ext) {
                case 'mp4':
                case 'mov':
                case 'mkv':
                $('#lbl_video').text(video);
                $('#video_err').text('')
                break;
                case "":
                $('#lbl_video').text('');
    
                default:
                $('#video_err').text('ویدیو باید mp4, mov یا mkv باشد.')
                $('#lbl_video').text('');
                this.value = '';
            }
            return;
        }
        else
        {
            $('#lbl_video').text(video);
            $('#video_err').text('')
        }
      });
      
      
      $("#file").on("change", function() {
        let file = $(this).val().split("\\").pop();
        let ext = file.substr( (file.lastIndexOf('.') +1) );
        if(file != '')
        {
            switch (ext) {
                case 'zip':
                case 'rar':
                case 'pdf':
                $('#lbl_file').text(file);
                $('#file_err').text('')
                break;
                case "":
                $('#lbl_file').text('');
    
                default:
                $('#file_err').text('فایل باید zip, rar یا pdf باشد.')
                $('#lbl_file').text('');
                this.value = '';
            }
            return;
        }
        else
        {
            $('#lbl_file').text(video);
            $('#file_err').text('')
        }
        });

        $('#audio').on('change',function()
        {
            let audio = $(this).val().split("\\").pop();
            let ext = file.substr( (file.lastIndexOf('.') +1) );
        
        if(audio != '')
        {
            switch (ext) {
                case 'mp3':
                case 'wav':
                $('#lbl_audio').text(audio);
                $('#audio_err').text('')
                break;
                case "":
                $('#lbl_audio').text('');
    
                default:
                $('#audio_err').text('صوتی باید wav یا mp3 باشد.')
                $('#lbl_audio').text('');
                this.value = '';
            }
            return;
        }
        else
        {
            $('#lbl_audio').text(video);
            $('#audio_err').text('')
        }
        })




        var bar = $('.bar');
        var percent = $('.percent');
        var progress = $('.progress');
        // this is for creating and updating 
        $('#form_report').ajaxForm({
            beforeSubmit: function() {
                if(validate())
                {
                    $('#btn_submit').prop('disabled',true);
                    // to unhide laravel blade codes in dynamically created element
                        $('.created_element').removeClass('d-none');
                    var percentVal = '0%';
                    bar.width(percentVal);
                    progress.removeClass('d-none');
                    percent.removeClass('d-none');
                    percent.html(percentVal);
                }
                else
                {
                    return false;
                }

            },
            uploadProgress: function(event, position, total, percentComplete) {
                var percentVal = percentComplete + '%';
                bar.width(percentVal);
                percent.html(percentVal);
            },
            complete: function(xhr) {
               
                if(xhr.responseText !=  '[]')
                {
                    var url = location.href.replace('/edit','');
                    window.location.replace(url);
                }
                $('#btn_submit').prop('disabled',false);
                $('#form_report')[0].reset();
                progress.addClass('d-none');
                percent.addClass('d-none');
                Swal.fire({
                    icon: 'success',
                    toast:true,
                    title: '',
                    text: 'موفقانه ثبت شد.',
                    showConfirmButton: false,
                    timer: 4000,
                  })
                $('#lbl_video').text('');
                $('#lbl_audio').text('');
                $('#lbl_file').text('');
                $('.lbl_name').text('');
            }
        });



        
        // adding more titles for report
        $(document).on('click','#adddetails_btn',function()
        {
            titles_counter+=1;
            
            element = 
            `
            <div id="report_titles_wrapper${titles_counter}" class="border border-top-1 rounded p-1 my-2">

            <div class="form-group">
            <label for="date${titles_counter}">تاریخ </label>
            <a href="javascript:void(0)" id="delete_title"><i class="fa fa-window-close text-danger float-right rounded"></i></a>
            <input type="date" id="date${titles_counter}" class="form-control" name="date[]">
            <p class="text-danger created_element d-none mr-2" id="date${titles_counter}_err">

            </p>
            </div>
            <div class="form-group">
                <label for="title${titles_counter}">عنوان</label>
                <input type="text" name="title[]" id="title${titles_counter}" class="form-control" placeholder="عنوان..." value="">
                <p class="text-danger created_element mr-2 d-none" id="title${titles_counter}_err">
                </p>
            </div>
            <div class="form-group">
                <label for="content${titles_counter}">محتوا</label>
                <textarea name="content[]" id="content${titles_counter}" cols="30" rows="5" class="form-control" placeholder="جزییات"></textarea>
                <p class="text-danger mr-2 created_element d-none" id="content${titles_counter}_err">
                    
                </p>
            </div>

            <div>
                <label>تصویر <span class="font-italic font-weight-lighter"> (jpg, .jpeg, .png.) </span></label>
                <input class="d-none r_img" type="file" name="image[]" id="file${titles_counter}" accept=".jpg,.jpeg,.png">
                <label for="file${titles_counter}" class="d-flex justify-content-between border lbl  border-1 rounded">
                    <span class="text-gray text-sm-center font-weight-lighter p-2 px-3" style="background-color:#e3e3e3">جستجو</span>
                    <span class="font-italic font-weight-lighter lbl_name p-2" id="lbl_file${titles_counter}"></span>
                </label>
                <p class="text-danger mr-2" id="file${titles_counter}_err">
                </p>
              </div>
        </div>
            `;
            $('#repot_titles_container').append(element);
        
        });


        // to delete title in creation form
        $(document).on('click','#delete_title',function(){
            $(this).parent().parent().remove();
        })



})


function validate(){
    let flag = true;
    let user = $('#user').val();
    let date = $('#date').val();
    let first = $('#first').val();
    let second = $('#second').val();
    let third = $('#third').val();
    let fourth = $('#fourth').val();
    let fifth = $('#fifth').val();

    if(user==null)
    {
        $('#user_err').text('گزارش دهنده را انتخاب کنید.')
        $('html, body').animate({
            scrollTop : $('#user').offset().top
        }, 500);
        flag = false;
        return;    }
    else
    {
        $('#user_err').text('')
    }
    if(date == '')
    {
        $('#date_err').text('تاریخ گزارش را بنویسید.')
        $('html, body').animate({
            scrollTop : $('#date').offset().top
        }, 500);
        flag = false;
        return;
    }
    else
    {
        $('#date_err').text('')
    }



    
    for(let i = 0; i <= titles_counter; i++)
    {
        if($('#date'+titles_counter).val() == '')
        {
            $('.created_element').removeClass('d-none');
            $('#date'+titles_counter+'_err').text('تاریخ را درج کنید.')
            $('html, body').animate({
                scrollTop : $('#date'+titles_counter).offset().top
            }, 500);
            flag = false;
            return;
        }
        else
        {
            $('#date'+titles_counter+'_err').text('')
        }



        if($('#title'+titles_counter).val() == '')
        {
            $('.created_element').removeClass('d-none');
            $('#title'+titles_counter+'_err').text('عنوان گزارش را بنویسید.')
            $('html, body').animate({
                scrollTop : $('#title'+titles_counter).offset().top
            }, 500);
            flag = false;
            return;
        }
        else
        {
            $('#title'+titles_counter+'_err').text('')
        }
        if($('#content'+titles_counter).val() == '')
        {
            $('#content'+titles_counter+'_err').text('جزییات گزارش را بنویسید.')
            $('html, body').animate({
                scrollTop : $('#content'+titles_counter).offset().top
            }, 500);
            flag = false;
            return;
        }
        else
        {   
            $('#content'+titles_counter+'_err').text('')
        }

        if($('#file'+titles_counter).val() == '')
        {
            $('.created_element').removeClass('d-none');
            $('#file'+titles_counter+'_err').text('تصویر را اضافه کنید.')
            $('html, body').animate({
                scrollTop : $('#file'+titles_counter).siblings('label').offset().top
            }, 500);
            flag = false;
            return;
        }
        else
        {
            $('#file'+titles_counter+'_err').text('')
        }

    }



    if(first == '')
    {
        $('#first_err').text('این ضروری می باشد.');
        $('html, body').animate({
            scrollTop : $('#first').offset().top
        }, 500);
        flag = false;
        return;
    }
    else
    {
        $('#first_err').text('')
    }

    if(second == '')
    {
        $('#second_err').text('این ضروری می باشد.');
        $('html, body').animate({
            scrollTop : $('#second').offset().top
        }, 500);
        flag = false;
        return;
    }
    else
    {
        $('#second_err').text('')
    }
    
    if(third == '')
    {
        $('#third_err').text('این ضروری می باشد.')

        $('html, body').animate({
            scrollTop : $('#third').offset().top
        }, 500);
        flag = false;
        return;
    }
    else
    {
        $('#third_err').text('')
    }
    
    if(fourth == '')
    {
        $('#fourth_err').text('این ضروری می باشد.')

        $('html, body').animate({
            scrollTop : $('#fourth').offset().top
        }, 500);
        flag = false;
        return;
    }
    else
    {
        $('#fourth_err').text('')
    }
    
    if(fifth == '')
    {
        $('#fifth_err').text('این ضروری می باشد.')

        $('html, body').animate({
            scrollTop : $('#fifth').offset().top
        }, 500);
        flag = false;
        return;
    }
    else
    {
        $('#fifth_err').text('')
    }
    return flag;
}








