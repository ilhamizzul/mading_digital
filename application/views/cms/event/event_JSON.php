<script>
    $(document).ready(function() { 

        $('#dataTable').dataTable()

        $('#create_button').click(function() {
            $('#form_create').submit();
        });
    })

    $('.dateTimePicker').datetimepicker({ footer: true, modal: true });

    function toggleEvent(id) {
        $.getJSON('<?= base_url() ?>Event/get_event_by_id/' + id, (data) => { 
            $('.id_info').html(data.id_info)
            $('.info_type').html(data.info_type)    
            $('#activate').attr('href', '<?= base_url() ?>Event/toggle_carousel/'+id+'/'+data.active)
            if (data.active == 'true') {
                $('.active_status').html('Unactivate')    
            } else {
                $('.active_status').html('Activate')
            }
            
        })
    }
</script>