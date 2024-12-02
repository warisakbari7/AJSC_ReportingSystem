$(()=>{
    $('.fa-trash').on('click',function(e){
        let url = $('#deleteform').attr('action');
         url = url.split('/').reverse();
         url[0] = e.target.id;
         url = url.reverse().join('/');
         $('#deleteform').attr('action',url)
        $('#deleteid').val(e.target.id);
      })

    //   disabling user request
    $('input.user-state').click(function(e){
        let ischecked = $(this).is(':checked')
        let token = $('input[name=_token]').val()
        let id = $(this).attr('id');
        id = id.split('-').reverse()[0];
        if(!ischecked)
        {
            $.ajax({
                url : 'reporter-status',
                type : 'POST',
                data : {
                    _token : token,
                    id : id,
                    status : ischecked,
                },
                beforeSend : ()=>{
                    $(this).attr('disabled','disabled');
                },
                success : res => {
                    $(this).removeAttr('disabled');

                }
                
            })
        }
        else
        {
                $.ajax({
                    url : 'reporter-status',
                    type : 'POST',
                    data : {
                        status : ischecked,
                        _token : token,
                        id : id,

                    },
                    beforeSend : ()=>{
                        $(this).attr('disabled','disabled');
                    },

                    success : res => {
                    $(this).removeAttr('disabled');
                    }
            })
        }
    })
})