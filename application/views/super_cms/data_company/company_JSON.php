<script>
    $(document).ready(() => {

    })

    function grantAccess(id) {
        $.getJSON('<?= base_url() ?>Company/get_company_by_id/' + id, (data) => { 
            $('.company_name').html(data.company_name)
            $('.company_id').html(data.id_company)
            $('#granted').attr('href', '<?= base_url() ?>Company/grant_access/' + id)
        })
    }

</script>