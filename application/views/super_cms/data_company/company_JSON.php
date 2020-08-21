<?php 
    if ($this->uri->segment(2) == 'validity_end') {
        $count = 0;
        $dateNow = date('Y-m-d');
        $tsNow = strtotime($dateNow);
        $yearNow = date('Y', $tsNow);
        $monthNow = date('m', $tsNow);
        
        foreach ($data_company as $data) {
            $validity = $data['validity'];
            $tsValidity = strtotime($validity);
            $yearValidity = date('Y', $tsValidity);
            $monthValidity = date('m', $tsValidity);
            
            $diff = (($yearNow - $yearValidity) * 12) + ($monthNow - $monthValidity);
            if ($diff > 3) {
                $count++;
            }
        }
        if ($count > 0) {
            echo '<script>
            $("#modal_delete").modal("show")
            $(".count_expired").html('.$count.')
            </script>';
        }
    }
?>

<script>
    $(document).ready(() => {
        $('#dataTable').dataTable()
    })

    function grantAccess(id) {
        $.getJSON('<?= base_url() ?>Company/get_company_by_id/' + id, (data) => { 
            $('.company_name').html(data.company_name)
            $('.company_id').html(data.id_company)
            $('#granted').attr('href', '<?= base_url() ?>Company/grant_access/' + id)
        })
    }


</script>