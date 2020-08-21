<script>
$(document).ready(function() { 

    $('#dataTable').dataTable()
    $('#dataRequest').dataTable()
    $('#dataTransaction').dataTable()
})

function acceptRequest(token, company_name, email) {
    $('.company_name').html(company_name);
    $('#granted').attr('href', '<?= base_url() ?>Token/accept_request_token/' + token)
}
</script>