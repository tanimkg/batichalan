<?php
$this->load->helper('text');
foreach ($causes as $cause) : ?>
<div class="panel panel-default">
    <div class="panel-heading" id="serviceName">
        Cause Applied to <?= $cause['to_org'] ?>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3">
                <img src="" class="thumbnail"/>
            </div>
            <div class="col-md-9">
                <p class="lead">
                    <a class="" href="<?= base_url('cause/view/' . $cause['cause_id']) ?>"><?= $cause['cause_title'] ?></a>
                </p>

                <?= word_limiter($cause['cause_desc'], 100, '...') ?>

                <a href="<?= base_url('cause/view/' . $cause['cause_id']) ?>" class="btn btn-xs btn-link">Read More</a>

                <p class="text-muted">
                    <small>Published: <?= $cause['created_at'] ?></small>
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
    <div class=""><button type="button" id="loadMoreCauses" data-lastId="<?= $last_id ?>" class="btn btn-primary btn-lg btn-block">Load More</button></div>
</div>

<script>
    var baseUrl = "<?= base_url() ?>";
    var loadMoreButton = document.getElementById('loadMoreCauses');
    var lastId = loadMoreButton.getAttribute('data-lastId'); // lastId = '12'
    $(document).ready(function(){
        $('#loadMoreLosts').click(function(){
            $.ajax({
                url: baseUrl + "/cause/recent/"+lastId,
                type: "GET",
                success: function(view) {
                    $('#loadMoreCauses').remove();
                    $('#causesLoadingDiv').append(view);

                },
                error: function() {
                    $('#causesLoadingDiv').append('<h1>Error Loading! Try Again.</h1>');
                }
            });
        });
    });
</script>