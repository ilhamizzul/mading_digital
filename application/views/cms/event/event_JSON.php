<script>
    $(document).ready(function() { 

        $('#dataTable').dataTable()
    })

    $(".type").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value")
            var html = ''
            if(optionValue == ''){
                $(".event").remove()
                $(".general-info").remove()
            } else if(optionValue == 'event'){
                html += '<div class="form-row event">' +
                            '<div class="form-group col">' +
                                '<label>Location</label>' +
                                '<input type="text" class="form-control" name="location" placeholder="Insert Location with max length 50..." required maxlength="50">'+
                            '</div>'+
                            '<div class="form-group col">'+
                                '<label>Repeated By</label>'+
                                '<select class="form-control" name="id_repeater" required>'+
                                    '<option value="">Chose...</option>'+
                                    <?php foreach ($data_repeater as $data) : ?>
                                        '<option value="<?= $data['id_repeater'] ?>"><?= $data['description'] ?></option>'+
                                    <?php endforeach; ?>
                                '</select>'+
                            '</div>'+
                        '</div>'
                $(".general-info").remove()
            } else {
                html += '<div class="form-group general-info">'+
                            '<label>Repeated By</label>'+
                            '<select class="form-control" name="id_repeater">'+
                                '<option value="">Chose...</option>'+
                                <?php foreach ($data_repeater as $data) : ?>
                                    '<option value="<?= $data['id_repeater'] ?>"><?= $data['description'] ?></option>'+
                                <?php endforeach; ?>
                            '</select>'+
                        '</div>'
                $(".event").remove()
                $(".general-info").remove()
            }
            $('#form_create > .modal-body').append(html)
        })
    }).change()

    $('#info_type').change( function () {
        $(this).find("option:selected").each(function(){ 
            if ($(this).attr("value") != 'event') {
                $('#location').attr('disabled', 'disabled')
            } else {
                $('#location').removeAttr('disabled')
            }
        })
    }).change()

    $('.dateTimePicker').datetimepicker({ 
        footer: true, 
        modal: true,
        format: 'yyyy-mm-dd HH:MM'
    });


    function toggleEvent(id) {
        $.getJSON('<?= base_url() ?>Event/get_event_by_id/' + id, (data) => { 
            $('.id_info').html(data.id_info)
            $('.info_type').html(data.info_type)    
            $('#activate').attr('href', '<?= base_url() ?>Event/toggle_event/'+id)
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
            if (data.info_type != 'event') {
                $('#location').attr('disabled', 'disabled')
            } else {
                $('#location').removeAttr('disabled')
            }
        })
    }
</script>