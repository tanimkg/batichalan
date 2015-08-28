<div class="row">
    <div class="col-xs-6">
        <?= anchor('contact/add/', 'Add Contact', 'class="btn btn-success"') ?>
        <p> </p>
    </div>
</div>
<div class="row">
    <div class="col-xs-6">
        <table class="table table-hover">
            <tbody>
            <?php foreach ($contacts as $ct) : ?>
                <tr>
                    <th><?= $contact_types[$ct->type] ?></th>
                    <td><?= $ct->no ?></td>
                    <td><?= $privacies[$ct->privacy] ?></td>
                    <td><?= anchor('contact/edit/' . $ct->contact_id, 'Edit', 'class="btn btn-xs btn-primary"') ?></td>
                    <td><?= anchor('contact/delete/' . $ct->contact_id, 'Delete', 'class="btn btn-xs btn-danger"') ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


