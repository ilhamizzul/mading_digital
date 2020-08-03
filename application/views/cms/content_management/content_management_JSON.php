<script>
    $("document").ready(() => {
        <?php foreach ($data_client_view as $data) : ?>
            $('select[name="<?= $data['description'] ?>"] option[value="<?= $data['active'] ?>"]').attr("selected","selected");
        <?php endforeach; ?>
    })
</script>