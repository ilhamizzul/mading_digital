<script>
    $(document).ready(function() { 

        $('#dataTable').dataTable()
        
        $('#create_button').click(function() {
			$('#form_create_user').submit();
		});
    })

    function toggleUser(id) {
        $.getJSON('<?= base_url() ?>User_management/get_user_by_id/' + id, (data) => { 
            $('.user_name').html(data.user_name)
            $('#activate').attr('href', '<?= base_url() ?>User_management/toggle_user/'+id+'/'+data.active)
            if (data.active == 'true') {
                $('.active_status').html('Unactivate')    
            } else {
                $('.active_status').html('Activate')
            }
            
        })
    }
</script>