<div class="container">
    <div class="row row-offcanvas row-offcanvas-right">
        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
            <div class="list-group">
                <a href="#" class="list-group-item active">Contacts</a>
                <a href="#" class="list-group-item">Addresses</a>
                <a href="#" class="list-group-item">Educations</a>
            </div>
        </div>
<?php //foreach ($user as $usr) : ?>
        <div class="col-xs-12 col-sm-9">
            <p class="pull-right visible-xs">
                <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
            </p>
            <div class="jumbotron">
                <h1><?= $usr['first_name'] . ' ' . $usr['last_name'] ?></h1>
                <p>From <?= $primary_address['city'] .', '. $primary_address['country'] ?></p>
                <p>Follower <span class="badge"><?= $usr['n_follower'] ?></span> Following <span class="badge"><?= $usr['n_following'] ?></span></p>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <h2>Basic Info</h2>
                    <table class="table tbl-default tbl-hover">
                        <tr>
                            <td></td>
                        </tr>
                    </table>
                    <p><a class="btn btn-default" href="#" role="button">View details »</a>
                    </p>
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
            <!--/row-->
        </div>
        <!--/span-->
<?php // endforeach; ?>
        <!--/span-->
    </div>
    <!--/row-->

    <hr>


</div>