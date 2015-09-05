<?php
$this->load->helper('text');
foreach ($promotes as $promote) : ?>
    <div class="panel panel-default">
        <div class="panel-heading" id="serviceName">
            Promote
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <img src="" class="thumbnail"/>
                </div>
                <div class="col-md-9">
                    <p class="lead">
                        <a class="" href="<?= base_url('promote/view/' . $promote['promote_id']) ?>"><?= $promote['title'] ?></a>
                    </p>

                    <?= word_limiter($promote['description'], 100, '...') ?>

                    <a href="<?= base_url('promote/view/' . $promote['promote_id']) ?>" class="btn btn-xs btn-link">Read More</a>

                    <p class="text-muted">
                        <small>Published: <?= $promote['created_at'] ?></small>
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
<?php endforeach; ?>
<div class="row">
    <div class=""><button type="button" id="loadMorePromotes" data-lastId="<?= $last_id ?>" class="btn btn-primary btn-lg btn-block">Load More</button></div>
</div>

<script>
    var baseUrl = "<?= base_url() ?>";
    var loadMoreButton = document.getElementById('loadMorePromotes');
    var lastId = loadMoreButton.getAttribute('data-lastId'); // lastId = '12'
    $(document).ready(function(){
        $('#loadMorePromotes').click(function(){
            $.ajax({
                url: baseUrl + "/promote/recent/"+lastId,
                type: "GET",
                success: function(view) {
                    $('#loadMorePromotes').remove();
                    $('#promotesLoadingDiv').append(view);

                },
                error: function() {
                    $('#promotesLoadingDiv').append('<h1>Error Loading! Try Again.</h1>');
                }
            });
        });
    });
</script>