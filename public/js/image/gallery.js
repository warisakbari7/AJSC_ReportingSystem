$(()=>{
    let url = $('#u_img').attr('href');
    $('.img-cursor-pointer').hover((e)=>{
        $(e.target).css('cursor','pointer')
        $(e.target).css('opacity','0.5')
    },function(e){
        $(e.target).css('opacity','1')
    })

    $('.img-cursor-pointer').click(e=>{
        let img = $(e.target).data('id')
        $('#id').val(img);
        let report = $('#report_tilte').data('report');

        let temp  = url.replace('/-1/','/'+img+'/');
         temp  = temp.replace('/0/','/'+report+'/');
        $('#u_img').attr('href',temp);
        $('#img-viewer').attr('src',e.target.src)
        $('#img-caption').text(e.target.alt)
        $('#img-container').slideDown(1000)
        setTimeout(()=>{
        location.href = '#img-viewer'
        },1000)
    })


    // editing image
    $('u_img').click()


    // deleting report and weekly report

    $('#delete_report').click(e=>{
        let id = $(e.target).data('id');
        $('#report_id').val(id);
        $('#delete_report_modal').modal('show');
    })


       // deleting title and  

       $('.detail_delete').click(e=>{
        let id = $(e.target).data('id');
        $('#detail_id').val(id);
        $('#delete_title_modal').modal('show');
    })
})