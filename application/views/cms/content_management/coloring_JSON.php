<script>
    $(document).ready(function() { 

        $('#dataTable').dataTable()

    })

    function editColor(id) {
        $.getJSON('<?= base_url() ?>Client_view_management/get_color_by_id/' + id, (data) => { 
            $('.title').html(data.title)
            $('#title').val(data.title)
            $('#bg_color1').val(data.bg_color1)
            $('#bg_color2').val(data.bg_color2)
            $('#bg_color3').val(data.bg_color3)
            $('#nav_color').val(data.nav_color)
            $('#txt_color').val(data.txt_color)
            $('#txt_news_color').val(data.txt_news_color)
            $('#form_edit').attr('action', '<?= base_url() ?>Client_view_management/edit_color/'+id)
        })
    }

    // function toggleEvent(id) {
    //     $.getJSON('<?= base_url() ?>Event/get_event_by_id/' + id, (data) => { 
    //         $('.id_info').html(data.id_info)
    //         $('.info_type').html(data.info_type)    
    //         $('#activate').attr('href', '<?= base_url() ?>Event/toggle_event/'+id)
    //         if (data.active == 'true') {
    //             $('.active_status').html('Unactivate')    
    //         } else {
    //             $('.active_status').html('Activate')
    //         }
            
    //     })
    // }

</script>