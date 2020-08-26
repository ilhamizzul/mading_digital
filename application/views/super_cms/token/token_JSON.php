<script>
$(document).ready(function() { 

    $('#dataTable').dataTable()
    $('#dataRequest').dataTable()
    $('#dataTransaction').dataTable()
})

function acceptRequest(id_transaction, company_name) {
    $('.company_name').html(company_name);
    $('#granted').attr('href', '<?= base_url() ?>Token/accept_request_token/' + id_transaction)
}

function rejectRequest(token, company_name) {
    $('.company_name').html(company_name);
    $('#rejected').attr('href', '<?= base_url() ?>Token/reject_request_token/' + token)
}
</script>