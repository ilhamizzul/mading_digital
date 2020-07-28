<script>
    $(document).ready(function() { 

        $('#dataTable').dataTable()

        $('#create_button').click(function() {
            $('#form_create').submit();
        });

        $('#edit_button').click(function() {
            $('#form_edit').submit();
        })
    })

    function toggleCarousel(id) {
        $.getJSON('<?= base_url() ?>Carousel/get_carousel_by_id/' + id, (data) => { 
            $('.id_carousel').html(data.id_carousel)
            $('#activate').attr('href', '<?= base_url() ?>Carousel/toggle_carousel/'+id+'/'+data.active)
            if (data.active == 'true') {
                $('.active_status').html('Unactivate')    
            } else {
                $('.active_status').html('Activate')
            }
            
        })
    }

    function deleteCarousel(id) {
        $.getJSON('<?= base_url() ?>Carousel/get_carousel_by_id/' + id, (data) => { 
            $('.id_carousel').html(data.id_carousel)
            $('#delete_button').attr('href', '<?= base_url() ?>Carousel/delete_carousel/'+id)
        })
    }

    function editCarousel(id) {
        $.getJSON('<?= base_url() ?>Carousel/get_carousel_by_id/' + id, (data) => { 
            $('#data_carousel').html(data.data_carousel)
            $('#title').val(data.title)
            $('#description').text(data.description)
            $('#data_type').val(data.data_type)
            $('#data_type').text(data.data_type)
            $('#form_edit').attr('action', '<?= base_url() ?>Carousel/edit_carousel/'+id)
            $('#id_repeater option[value='+data.id_repeater+']').attr('selected', 'selected')
            if (data.data_type == 'image') {
                $('#data_preview').html('<img src="<?= base_url() ?>uploads/<?= $this->session->userdata('company_name')?>/carousel/image/'+data.data_carousel+'"style="max-width: 100%; height: auto;" alt="image not found">')
            } else {
                $('#data_preview').html('<video width="100%" height="auto" controls> <source src="<?= base_url() ?>uploads/<?= $this->session->userdata('company_name')?>/carousel/video/'+data.data_carousel+'" type="video/mp4"> </video>')
            }
        })
    }
</script>