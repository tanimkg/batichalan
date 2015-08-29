<div class="container">
<?php var_dump( $usr); ?>
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
                <p>From <?= $usr['primary_address']['city'] .', '.$usr['pirmary_address']['country'] ?></p>
                <p>Follower Following</p>
            </div>
            <div class="row">
                <div class="col-md-8 col-sm-12 col-lg-9">
                    <h2>Basic Info</h2>
                    <table class="table tbl-default tbl-hover">
                        <tr>
                            <td></td>
                        </tr>
                    </table>
                    <p><a class="btn btn-default" href="#" role="button">View details »</a>
                    </p>
                </div>

                <div class="jumbotron col-md-4 col-sm-12">
                    <table class="table tbl-default tbl-hover">
                        <tr>
                            <th>Primary Contact</th>
                            <td><?= $usr['primary_contact'] ?></td>
                        </tr>
                        <?php foreach($other_contacts as $ck => $cv) : ?>
                        <tr>
                            <th><?= $ck ?></th>
                            <td><?= $cv['no'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <tr>
                            <th>Gender</th>
                            <td><?= $usr['gender'] ?></td>
                        </tr>
                        <tr>
                            <th>Birthdate</th>
                            <td><?= $usr['birth_date'] ?></td>
                        </tr>
                    </table>
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