<div class="container-fluid main-container">

    <div class="col-md-3 sidebar">
        <ul class="nav nav-pills nav-stacked">

            <li class="<?php echo (uri_string() == 'dashboard') ? 'active' : ''; ?>"><a
                    href="<?php echo base_url('/dashboard'); ?>" id="dashLoaderBtn"><?php echo lang('core button all'); ?></a></li>
            <li class="<?php echo (uri_string() == 'lost') ? 'active' : ''; ?>"><a
                    href="<?php echo base_url('/lost'); ?>"  id="lostLoaderBtn"><?php echo lang('core button lost'); ?></a></li>
            <li class="<?php echo (uri_string() == 'cause') ? 'active' : ''; ?>"><a
                    href="<?php echo base_url('/cause'); ?>"  id="causeLoaderBtn"><?php echo lang('core button cause'); ?></a></li>
            <li class="<?php echo (uri_string() == 'promote') ? 'active' : ''; ?>"><a
                    href="<?php echo base_url('/promote'); ?>"  id="promoteLoaderBtn"><?php echo lang('core button promote'); ?></a></li>
        </ul>
        <hr>
        <div class="list-group">
            <a href="#" class="list-group-item active">
                Cras justo odio
            </a>
            <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
            <a href="#" class="list-group-item">Morbi leo risus</a>
            <a href="#" class="list-group-item">Porta ac consectetur ac</a>
            <a href="#" class="list-group-item">Vestibulum at eros</a>
        </div>
    </div>
    <div class="col-md-9 content">

        <div class="panel panel-default">
            <div class="panel-heading" id="serviceName">
                Service Name
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3">
                        <img src="" class="thumbnail"/>
                    </div>
                    <div class="col-md-9">
                        <p class="lead"><a class="" href="">Lorem ipsum dolor sit amet, consectetur adipisicing elit</a>
                        </p>

                        sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

                        <a href="" class="btn btn-xs btn-link">Read More</a>

                        <p class="text-muted">
                            <small>Published: 2015-08-31 20:06:56</small>
                        </p>
                    </div>
                </div>

            </div>
            <div class="panel-footer">

                <a class="btn btn-xs btn-default" href="" onclick="">Like <span class="badge">32</span></a>
                <a class="btn btn-xs btn-default" href="" onclick="">Comment <span
                        class="badge">11</span></a>

            </div>
        </div>
    </div>
</div>
</div>
<script>
    var baseUrl = "<?= base_url() ?>";
</script>