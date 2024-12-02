$(function(){
    $('#btn_submit').prop("disabled",false);
    $('#zoneform').on('submit',e => {
        e.preventDefault();
        let zonename = $('#zonename').val().trim();
        if(zonename == '')
        {
            $('#err_msg').addClass('text-danger').text('لطفا نام زون را درج کنید!')
        }
        else
        {
            $('#err_msg').text('')

            $.ajax({
                url : $('#zoneform').attr('action'),
                type : 'POST',
                data : $('#zoneform').serializeArray(),
                beforeSend : function(){
                    e.preventDefault();
                    $('#btn_submit').prop('disabled',true);
                    $('#btn_submit').text('در حال ثبت شدن...');
                },
                error : function(er){
                    $('#err_msg').text(er.responseJSON.errors.name)
                    $('#btn_submit').prop('disabled',false);
                    $('#btn_submit').text('ثبت');
                }
                ,
                success : (msg)=>{
                    let row = `<tr id="${msg.id}" data-zone="${msg.name}">
                    <td></td>
                    <td>${msg.name}</td>
                    <td><a href="javascript:void(0)" data-backdrop="static"><i class="fa fa-trash text-sm text-gray"></i></a></td>
                    <td><a href="javascript:void(0)"><i class="fa fa-edit text-sm text-gray"></i></a></td>
                    </tr>`;

                    $('#zone_tbl').append(row);
                    numbering();
                    $('#err_msg').text('')
                    $('#btn_submit').prop('disabled',false);
                    $('#zonename').val('');
                    $('#btn_submit').text('ثبت');
                    $('#success_msg').css('visibility','visible')
                    setTimeout(()=>{
                        $('#success_msg').css('visibility','hidden')
                    },3000)
                }
            })
        }
    })





    // open update modal
    $(document).on('click','.fa-edit',function(){
        $('#update_modal').modal('show');
    })

    $('#update_modal').on('hidden.bs.modal',function(){
        $('#u_err_msg').text('')
    })

    // update zone 
    
    $(document).on('click','.fa-edit',function (e) {
        $("#update_modal").modal({backdrop: 'static'});
        let name = $(e.target).parents('tr').data('zone')
        let id = $(e.target).parents('tr').attr('id');
        $('#u_zonename').val(name)
        $('#zone_id').val(id)
        $('#update_modal').modal('show');
    })


    $('#u_btn_submit').prop("disabled",false);
    $('#update_zone').on('submit',e => {
        e.preventDefault();
        let zonename = $('#u_zonename').val().trim();
        if(zonename == '')
        {
            $('#u_err_msg').addClass('text-danger').text('لطفا نام زون را درج کنید!')
        }
        else
        {
            $('#u_err_msg').text('')

            $.ajax({
                url : 'zone/' + $('#zone_id').val(),
                type : 'PUT',
                data : $('#update_zone').serializeArray(),
                beforeSend : function(){
                    e.preventDefault();
                    $('#u_btn_submit').prop('disabled',true);
                    $('#u_btn_submit').text('در حال ثبت شدن...');
                },
                error : function(er){
                    $('#u_err_msg').text(er.responseJSON.errors.name)
                    $('#u_btn_submit').prop('disabled',false);
                    $('#u_btn_submit').text('ثبت');
                }
                ,
                success : (msg)=>{
                    let row = `<tr id="${msg.id}" data-zone="${msg.name}">
                    <td></td>
                    <td>${msg.name}</td>
                    <td><a href="javascript:void(0)" data-backdrop="static"><i class="fa fa-trash text-sm text-gray"></i></a></td>
                    <td><a href="javascript:void(0)"><i class="fa fa-edit text-sm text-gray"></i></a></td>
                    </tr>`;

                    $('tr#'+msg.id).replaceWith(row);
                    numbering();
                    $('#u_err_msg').text('')
                    $('#u_zonename').val('');
                    $('#u_btn_submit').prop('disabled',false);
                    $('#u_btn_submit').text('ثبت');
                    $('#u_success_msg').css('visibility','visible')
                    setTimeout(()=>{
                        $('#u_success_msg').css('visibility','hidden')
                    },3000)
                    setTimeout(function(){
                    $('#update_modal').modal('toggle')

                    },3000)
                }
            })
        }
    })



        // open delete modal
        $(document).on('click','.fa-trash',function(){
            $('#delete_modal').modal('show');
        })
    
        // delete zone 
        
        $(document).on('click','.fa-trash',function (e) {
            $("#delete_modal").modal({backdrop: 'static'});
            let id = $(e.target).parents('tr').attr('id');
            $('#d_zone_id').val(id)
            $('#delete_modal').modal('show');
        })


        $('#d_btn_submit').prop("disabled",false);


        $('#delete_zone').on('submit',e => {
            e.preventDefault();
    
                $.ajax({
                    url : 'zone/' + $('#d_zone_id').val(),
                    type : 'DELETE',
                    data : $('#delete_zone').serializeArray(),
                    beforeSend : function(){
                        e.preventDefault();
                        $('#d_btn_submit').prop('disabled',true);
                        $('#d_btn_submit').text('در حال حذف شدن...');
                    },
                    error : function(er){
                        $('#d_btn_submit').prop('disabled',false);
                        $('#d_btn_submit').text('حذف');
                    }
                    ,
                    success : (msg)=>{
                        $('tr#'+msg.id).remove();
                        numbering();
                        $('#d_btn_submit').prop('disabled',false);
                        $('#d_btn_submit').text('حذف');
                        $('#delete_modal').modal('toggle')
                    }
                })
        })











function numbering()
{
    let count = $('#zone_tbl>tr').each((index,el)=>{
        $(el).children('td').first().text(index+1);
    });
}
})