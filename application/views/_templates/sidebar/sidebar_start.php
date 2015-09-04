<div class="container-fluid main-container">
    <div class="col-md-3 sidebar">
        <ul class="nav nav-pills nav-stacked">
            <li class="<?php echo (uri_string() == 'lost') ? 'active' : ''; ?>"><a
                    href="<?php echo base_url('/lost'); ?>"><?php echo lang('core button lost'); ?></a></li>
            <li class="<?php echo (uri_string() == 'cause') ? 'active' : ''; ?>"><a
                    href="<?php echo base_url('/cause'); ?>"><?php echo lang('core button cause'); ?></a></li>
            <li class="<?php echo (uri_string() == 'promote') ? 'active' : ''; ?>"><a
                    href="<?php echo base_url('/promote'); ?>"><?php echo lang('core button promote'); ?></a></li>
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