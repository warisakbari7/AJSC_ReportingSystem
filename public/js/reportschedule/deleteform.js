$(function(){
    $('.fa-trash').click(e=>{
        let id = $(e.target).attr('id');
        
        let url = $('#delete_form').attr('action').split('/').reverse();
        url[0] = id;
        url = url.reverse().join('/');
        $(delete_form).attr('action',url);
        $('#delete_modal').modal('toggle');
    })
})