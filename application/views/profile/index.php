<div class="container">
    <div class="fb-profile">
        <img align="left" class="fb-image-lg" src="http://lorempixel.com/850/280/nightlife/5/" alt="Profile image example"/>
        <img align="left" class="fb-image-profile img-circle" src="http://lorempixel.com/180/180/people/9/" alt="Profile image example"/>
        <div class="fb-profile-text">
            <h1><?= $usr['first_name'] . ' ' . $usr['last_name'] ?></h1>
            <p>From <?= $primary_address['city'] .', '. $primary_address['country'] ?></p>
            <p>Follower <span class="badge"><?= $usr['n_follower'] ?></span> Following <span class="badge"><?= $usr['n_following'] ?></span></p>
        </div>
    </div>
</div> <!-- /container -->

<hr>

<div class="container">
    <div class="row">

        <div class="col-md-8">
            <div role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#basic" aria-controls="basic" role="tab" data-toggle="tab">Basic Info</a>
                    </li>
                    <li role="presentation">
                        <a href="#address" aria-controls="address" role="tab" data-toggle="tab">Addresses</a>
                    </li>
                    <li role="presentation">
                        <a href="#jobs" aria-controls="jobs" role="tab" data-toggle="tab">Jobs</a>
                    </li>
                    <li role="presentation">
                        <a href="#education" aria-controls="education" role="tab" data-toggle="tab">Educations</a>
                    </li>
                    <li role="presentation">
                        <a href="#following" aria-controls="following" role="tab" data-toggle="tab">Following</a>
                    </li>
                    <li role="presentation">
                        <a href="#follower" aria-controls="follower" role="tab" data-toggle="tab">Follower</a>
                    </li>
                    <li role="presentation">
                        <a href="#pic" aria-controls="pic" role="tab" data-toggle="tab">Picture & Media</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="basic">

                    </div>
                    <div role="tabpanel" class="tab-pane" id="address">
                        <?php foreach ($other_addresses as $a => $oa) : ?>
                            <h4><?= $a ?></h4>
                            <p>
                                <?= $oa['addr_line_1'] ?><br>
                                <?= $oa['addr_line_2'] ?><br>
                                <?= $oa['city'] ?><?= (($oa['state'] != '')||($oa['state'] != NULL)) ? ', ' .$oa['state'] : '' ?><br>
                                <?= (($oa['post_zip'] != '')||($oa['post_zip'] != NULL)) ? 'Post/Zip: ' .$oa['post_zip'] : '' ?><br>
                                <?= $oa['country'] ?><br><br>
                                <?= (($oa['living_since'] != '')||($oa['living_since'] != NULL)) ? 'Lived: ' .$oa['living_since'] : '' ?>
                                <?= (($oa['lived_upto'] != '')||($oa['lived_upto'] != NULL)) ? ' to ' .$oa['lived_upto'] : '' ?>
                            </p>
                        <?php endforeach; ?>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="jobs">

                    </div>
                    <div role="tabpanel" class="tab-pane" id="education">

                    </div>
                    <div role="tabpanel" class="tab-pane" id="following">
                        <?php $class_chooser = ['default', 'primary', 'info', 'warning', 'danger']; foreach ($followings as $f => $fv) : ?>
                            <a class="btn btn-xs btn-<?= $class_chooser[rand(0, 4)] ?>" href="<?= base_url('profiles/' . $fv['username']) ?>">
                                <?= $fv['first_name'] . ' ' . $fv['last_name'] ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="follower">
                        <?php $class_chooser = ['default', 'primary', 'info', 'warning', 'danger']; foreach ($followers as $r => $rv) : ?>
                            <a class="btn btn-xs btn-<?= $class_chooser[rand(0, 4)] ?>" href="<?= base_url('profiles/' . $fv['username']) ?>">
                                <?= $fv['first_name'] . ' ' . $fv['last_name'] ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="pic">

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-primary">
                <!-- Default panel contents -->
                <div class="panel-heading"><strong>Contacts & Bio</strong></div>

                <!-- Table -->
                <table class="table">
                    <tr>
                        <th>Primary Contact</th>
                        <td><?= $primary_contact ?></td>
                    </tr>
                    <?php foreach($other_contacts as $ck => $cv) : ?>
                        <tr>
                            <th><?= $ck ?></th>
                            <td><?= $cv['no'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <th>Gender</th>
                        <td><?= $usr['sex'] ?></td>
                    </tr>
                    <tr>
                        <th>Birthdate</th>
                        <td><?= $usr['birth_date'] ?></td>
                    </tr>
                </table>
            </div>
        </div>


    </div>
</div>