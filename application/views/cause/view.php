<?php
$u = $this->session->userdata('logged_in');

?>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <strong><?= $cause['created_at'] ?></strong><br>

        <p>
            To<br>
            <?= $cause['to_name'] ?><br>
            <?= $cause['to_apt'] ?><br>
            <?= $cause['to_sec'] ?><br>
            <?= $cause['to_org'] ?>
        </p>
        <p>
            <strong>Subject: <?= $cause['cause_title'] ?></strong>
        </p>
        <p>
            Dear Sir/Madam,<br>
            <?= nl2br($cause['cause_desc']) ?>
        </p>
        <p>
            Sincerely,<br>
            <a href="<?= base_url('profile/'. $u['username']) ?>">
                <?= $u['first_name'] . ' ' . $u['first_name'] ?>
            </a>
            <br>
            And <a href="<?= base_url('cause/supporters/'.$cause_id) ?>">
                <?= count(csd_to_array($cause['supporter_uids'])) - 1 ?>
            </a> other people
        </p>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <a href="">
            <img class="thumbnail">
        </a>
    </div>
</div>