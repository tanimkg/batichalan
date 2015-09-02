<div class="container">
    <div class="row">

        <div class="col-md-4">
            <div class="panel panel-default">
                    <table class="table">
                        <tr>
                            <th>Posted By</th>
                            <td><a href="<?= base_url('profile/'.$creator['username']) ?>">
                                <?= $creator['first_name'] .' '. $creator['last_name'] ?></a>
                            </td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>
                                <?= $promote['addr_line'] .', '. $promote['addr_area'] ?><br>
                                <?= $promote['addr_city'] .', '. $promote['addr_state'] ?><br>
                                <?= $promote['addr_country'] .' - '. $promote['addr_post_zip'] ?><br>
                            </td>
                        </tr>
                        <tr>
                            <th>Contact</th>
                            <td>
                                <?= $contact['no'] ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Posted</th>
                            <td>
                                <?= $promote['created_at'] ?>
                            </td>
                        </tr>
                    </table>
            </div>

        </div>
        <div class="col-md-8">
            <h3>Description</h3>
            <p class="lead"><?= $promote['description'] ?></p>
            <h3>Conditions</h3>
            <p><?= $promote['conditions'] ?></p>
        </div>


    </div>
</div>