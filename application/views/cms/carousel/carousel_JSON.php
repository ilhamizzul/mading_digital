<script>
    $(document).ready(function() { 

        $('#dataTable').dataTable()

        $('#create_button').click(function() {
            $('#form_create').submit();
        });
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
</script>