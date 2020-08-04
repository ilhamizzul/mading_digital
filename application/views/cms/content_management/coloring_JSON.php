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

    function deleteColor(id) {
        $.getJSON('<?= base_url() ?>Client_view_management/get_color_by_id/' + id, (data) => { 
            $('.title').html(data.title)
            $('.id_color').text(data.id_color)
            $('#delete_button').attr('href', '<?= base_url() ?>Client_view_management/delete_color/'+id)
        })
    }

    function toggleColor(id) {
        $.getJSON('<?= base_url() ?>Client_view_management/get_color_by_id/' + id, (data) => { 
            $('.id_color').html(data.id_color)
            $('#activate').attr('href', '<?= base_url() ?>Client_view_management/toggle_color/'+id)
        })
    }

</script>