<script>
    $(document).ready(function() { 

        $('#retrieve').on('click', () => {
            $('#form-retrieve').submit()
        })

        $('#dataTable').dataTable()
    
    })

    $('.dateTimePicker').datetimepicker({ 
        footer: true, 
        modal: true,
        format: 'yyyy-mm-dd HH:MM'
    });

    function retrieveEvent(id) {
        $.getJSON('<?= base_url() ?>Event/get_event_by_id/' + id, (data) => { 
            $('.id_info').html(data.id_info)
            $('.info_type').html(data.info_type)
            $('#due_date').val(data.due_date)
            $('#form-retrieve').attr('action', '<?= base_url() ?>Event/retrieve_event/'+id)
        })
    }
</script>