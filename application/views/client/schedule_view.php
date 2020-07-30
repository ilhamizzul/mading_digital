<div class="<?= ($content_group['carousel']['active'] == 'true') ? 'col-md-4 col-lg-4' : 'col-md-12 col-lg-12' ; ?>">
    <div class="card schedule" <?= ($content_group['footer']['active'] == 'false') ? 'style="min-height: 90vh"' : '' ; ?>>
        <div class="card-body">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" colspan="3">Schedule</th>
                    </tr>
                    <tr>
                        <th scope="col">Description</th>
                        <th scope="col">Location</th>
                        <th scope="col">Due Date</th>
                    </tr>
                </thead>
                <tbody id="show_event" <?= ($content_group['carousel']['active'] == 'false') ? 'class="text-center"' : '' ; ?>>
                </tbody>
            </table>
        </div>
    </div>
</div>