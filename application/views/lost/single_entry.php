<?php
$this->load->helper('text');
foreach ($losts as $lost) : ?>
<div class="panel panel-default">
    <div class="panel-heading" id="serviceName">
        <?= ($lost['is_found'] == 1) ? 'Found' : 'Lost' ?>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3">
                <img src="" class="thumbnail"/>
            </div>
            <div class="col-md-9">
                <p class="lead">
                    <a class="" href="<?= base_url('lost/view/' . $lost['lost_id']) ?>"><?= $lost['item_name'] ?></a>
                </p>

                <?= word_limiter($lost['item_desc'], 100, '...') ?>

                <a href="<?= base_url('lost/view/' . $lost['lost_id']) ?>" class="btn btn-xs btn-link">Read More</a>

                <p class="text-muted">
                    <small>Published: <?= $lost['created_at'] ?></small>
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
    <div class=""><button type="button" id="loadMoreLosts" data-lastId="<?= $last_id ?>" class="btn btn-primary btn-lg btn-block">Load More</button></div>
</div>

<script>
    var baseUrl = "<?= base_url() ?>";
    var loadMoreButton = document.getElementById('loadMoreLosts');
    var lastId = loadMoreButton.getAttribute('data-lastId'); // lastId = '12'
    $(document).ready(function(){
        $('#loadMoreLosts').click(function(){
            $.ajax({
                url: baseUrl + "/lost/recent/"+lastId,
                type: "GET",
                success: function(view) {
                    $('#loadMoreLosts').remove();
                    $('#lostsLoadingDiv').append(view);

                },
                error: function() {
                    $('#lostsLoadingDiv').append('<h1>Error Loading! Try Again.</h1>');
                }
            });
        });
    });
</script>