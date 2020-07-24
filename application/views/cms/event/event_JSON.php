<script>
    $(document).ready(function() { 

        $('#dataTable').dataTable()

        $('#create_button').click(function() {
            $('#form_create').submit();
        });
        $('#edit_button').click(function() {
            $('#form_edit').submit();
        });
    })

    $('.dateTimePicker').datetimepicker({ footer: true, modal: true });

    function toggleEvent(id) {
        $.getJSON('<?= base_url() ?>Event/get_event_by_id/' + id, (data) => { 
            $('.id_info').html(data.id_info)
            $('.info_type').html(data.info_type)    
            $('#activate').attr('href', '<?= base_url() ?>Event/toggle_event/'+id+'/'+data.active)
            if (data.active == 'true') {
                $('.active_status').html('Unactivate')    
            } else {
                $('.active_status').html('Activate')
            }
            
        })
    }

    function deleteEvent(id) {
        $.getJSON('<?= base_url() ?>Event/get_event_by_id/' + id, (data) => { 
            $('.id_info').html(data.id_info)
            $('.info_type').html(data.info_type)
            $('#delete_button').attr('href', '<?= base_url() ?>event/delete_event/'+id)
        })
    }

    function editEvent(id) {
        $.getJSON('<?= base_url() ?>Event/get_event_by_id/' + id, (data) => { 
            $('.info_type').html(data.info_type)
            $('#description').val(data.description)
            $('#location').val(data.location)
            $('#due_date').val(data.due_date)
            $('#info_type').val(data.info_type)
            $('#id_repeater').val(data.id_repeater)
            $('#form_edit').attr('action', '<?= base_url() ?>Event/edit_event/'+id)
        })
    }
</script>