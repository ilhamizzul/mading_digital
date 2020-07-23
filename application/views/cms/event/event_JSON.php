<script>
    $(document).ready(function() { 

        $('#dataTable').dataTable()

        $('#create_button').click(function() {
            $('#form_create').submit();
        });
    })

    $('.dateTimePicker').datetimepicker({ footer: true, modal: true });
</script>