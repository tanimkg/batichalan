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
            <?= anchor('lost/add', 'Create a Lost or Found Entry', 'class="list-group-item"'); ?>
            <?= anchor('lost/list', 'List My Lost and Found Posts', 'class="list-group-item"'); ?>
        </div>
    </div>
    <div class="col-md-9 content" id="lostsLoadingDiv">

        <button type="button" id="loadMoreLostsInit" class="btn btn-primary btn-lg btn-block">View Losts and Founds</button></div>


    </div>

</div>
</div>
<script>
    var baseUrl = "<?= base_url() ?>";

    $(document).ready(function(){
        $('#loadMoreLostsInit').click(function(){
            $.ajax({
                url: baseUrl + "/lost/recent/",
                type: "GET",
                success: function(view) {
                    $('#lostsLoadingDiv').html(view);
                    $('#loadMoreLostsInit').remove();
                },
                error: function() {
                    $('#lostsLoadingDiv').html('<h1>Error Loading! Try Again.</h1>');
                }
            });
        });

    });
</script>