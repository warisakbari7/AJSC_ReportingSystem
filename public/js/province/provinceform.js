$(function(){
    $('#btn_submit').prop("disabled",false);
    $('#province_form').on('submit',e=>{
        e.preventDefault();
        $.ajax({
            url : $('#province_form').attr('action'),
            type : 'POST',
            data : $('#province_form').serializeArray(),
            beforeSend : validation,
            error : err=>{
                $('#perror_msg').text(err.responseJSON.errors.name)
                $('#btn_submit').prop('disabled',false);
                $('#btn_submit').text('ثبت');
            },
            success : msg=>{
                $('#province_tbl').append(msg)
                numbering();
                $('#perror_msg').text('')
                $('#zerror_msg').text('')
                $('#province_form').get(0).reset();
                $('#success_msg').text('موفقانه ثبت شد')
                $('#success_msg').removeClass('invisible')
                setTimeout(()=>{
                $('#success_msg').addClass('invisible')
                },3000)
            }
    
        })
    })
    








    // updating province
    $(document).on('click','#edit_btn',e=>{
        $('#update_modal').modal('show');
    })

    $('#update_modal').on('hidden.bs.modal',function(){
        $('#u_err_msg').text('')
        $('#u_err_zone').text('')
    })

    $(document).on('click','#edit_btn',function(e){
        $("#update_modal").modal({backdrop: 'static'});
        let id = $(e.target).parents('tr').attr('id');
        let province = $(e.target).parents('tr').data('province');
        $('#province_id').val(id);
        $('#u_province_name').val(province);
        $('#update_modal').modal('show');
        $('#u_btn_submit').prop('disabled',false);
    })




    $('#update_province').on('submit',e=>{
        e.preventDefault();
        $.ajax({
            url : 'province/'+ $('#province_id').val(),
            type : 'PUT',
            data : $('#update_province').serializeArray(),
            beforeSend : ()=>{
                return validation('update');
            },
            error : err=>{
                $('#u_err_msg').text(err.responseJSON.errors.name)
            },
            success : msg=>{
                $('#'+msg[1]).replaceWith(msg[0])
                $('#u_err_msg').text('')
                $('#u_err_zone').text('')
                $('#update_province').get(0).reset();
                $('#update_modal').modal('toggle');
                numbering();
            }
    
        })
    })

















    $(document).on('click','#delete_btn',e=>{
        let id = $(e.target).parents('tr').attr('id');
        $('#d_province_id').val(id);
        $('#delete_modal').modal('show');
    })

    $('#delete_form').on('submit',e=>{
        e.preventDefault();
        $.ajax({
            url : 'province/'+$('#d_province_id').val(),
            type : 'DELETE',
            data : $('#delete_form').serializeArray(),
            error : er=>{
            },
            success : res=>{
            $('tr#'+res.id).remove();
            }
        })
    })
})

// functin for form validation
function validation(type=''){
    let flag = true;
    if(type == 'update')
    {
        let province = jQuery.trim($('#u_province_name').val());
        let zone = $('#u_zone').val();
        if(province == '')
        {
            flag = false;
            $('#u_err_msg').text('لطفا نام ولایت را بنویسید.')
        }
        else
        {
            $('#u_err_msg').text('')

        }
        if(zone == null)
        {
            flag = false;
            $('#u_err_zone').text('لطفا زون را انتخاب کنید.')
        }
        else
        {
            $('#u_err_zone').text('')
        }
    }
    else
    {
        let province = $('#province_name').val();
        let zone = $('#zone').val();
        if(province == '')
        {
            flag = false;
            $('#perror_msg').text('لطفا نام ولایت را بنویسید.')
        }
        else
        {
            $('#perror_msg').text('')
        }
        if(zone == null)
        {
            flag = false;
            $('#zerror_msg').text('لطفا زون را انتخاب کنید.')
        }
        else
        {
            $('#zerror_msg').text('')
        }
    
    }
        return flag;
}

function numbering()
{
    let count = $('#province_tbl>tr').each((index,el)=>{
        $(el).children('td').first().text(index+1);
    });
}