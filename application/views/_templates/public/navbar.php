<nav class="navbar navbar-default" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?= base_url() ?>">Batichalan</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
            <li class="<?php echo (uri_string() == '') ? 'active' : ''; ?>"><a
                    href="<?php echo base_url('/'); ?>"><?php echo lang('core button home'); ?></a></li>
            <li class="<?php echo (uri_string() == 'lost') ? 'active' : ''; ?>"><a
                    href="<?php echo base_url('/lost'); ?>"><?php echo lang('core button lost'); ?></a></li>
            <li class="<?php echo (uri_string() == 'cause') ? 'active' : ''; ?>"><a
                    href="<?php echo base_url('/cause'); ?>"><?php echo lang('core button cause'); ?></a></li>
            <li class="<?php echo (uri_string() == 'promote') ? 'active' : ''; ?>"><a
                    href="<?php echo base_url('/promote'); ?>"><?php echo lang('core button promote'); ?></a></li>
        </ul>
        <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default"><span class="fa fa-search"></span></button>
        </form>
        <ul class="nav navbar-nav navbar-right">
            <?php if ($this->session->userdata('logged_in')) { ?>
                <li><?= anchor('dashboard', ' My Dashboard', 'class="fa fa-dashboard"') ?></li>
                <li><?= anchor('profile', ' My Profile', 'class="fa fa-profile"') ?></li>
                <li><?= anchor('logout', ' Logout', 'class="fa fa-logout"') ?></li>
            <?php } else { ?>
                <li><?= anchor('login', ' Login', 'class="fa fa-user"') ?></li>
                <li><?= anchor('signup', ' Signup', 'class="fa fa-pencil"') ?></li>
            <?php } ?>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>
