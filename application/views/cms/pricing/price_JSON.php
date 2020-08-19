<script>
function purchaseToken(token_type) {
    switch (token_type) {
        case '1month':
            $('.token_type').html('"1 Month"')
            $('#token_purchase_submit').attr('href', '<?= base_url() ?>Price/purchase_token/1month')
            break;
        case '3month':
            $('.token_type').html('"3 Months"')
            $('#token_purchase_submit').attr('href', '<?= base_url() ?>Price/purchase_token/3months')
        break;
        case '1year':
            $('.token_type').html('"1 Year"')
            $('#token_purchase_submit').attr('href', '<?= base_url() ?>Price/purchase_token/1year')
        break;
    }
}
</script>