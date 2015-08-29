<div class="row">
    <div class="col-xs-12">
        <?= anchor('address/add/', lang('address a add'), 'class="btn btn-success"') ?>
        <p></p>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <td><i>Type</i></td>
                    <td><i>Address</i></td>
                    <td><i>City</i></td>
                    <td><i>State</i></td>
                    <td><i>Country</i></td>
                    <td><i>Post / Zip</i></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($addresses as $addr) : ?>
                <?php // if ($addr->addr_id == $user->c_addr_id) : ?>
                <tr>
                    <th><?= $addr_types[$addr->addr_type] ?></th>
                    <td><?= $addr->addr_line_1 . '<br>' . $addr->addr_line_2 ?></td>
                    <td><?= $addr->city ?></td>
                    <td><?= $addr->state ?></td>
                    <td><?= $addr->country ?></td>
                    <td><?= $addr->post_zip ?></td>
                    <td><?= anchor('address/edit/' . $addr->addr_id, 'Edit', 'class="btn btn-xs btn-primary"') ?>
                        <?= anchor('address/delete/' . $addr->addr_id, 'Delete', 'class="btn btn-xs btn-danger"') ?>
                        <?= anchor('address/mark_present/' . $addr->addr_id, 'Mark As Present', 'class="btn btn-xs btn-warning"') ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


