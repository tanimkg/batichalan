<!-- Carousel
================================================== -->
<div id="myCarousel" class="carousel slide">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="item active">
            <img src="<?= base_url('assets/img/lost_f.jpg') ?>" style="width:100%" class="img-responsive">

            <div class="container">
                <div class="carousel-caption">
                    <h1>Lost and Found</h1>

                    <p class="lead">Share what you have lost or found</p>

                    <p><a class="btn btn-lg btn-primary" href="<?= base_url('signup') ?>">Join Now</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="item">
            <img src="<?= base_url('assets/img/cause_f.jpg') ?>" class="img-responsive">

            <div class="container">
                <div class="carousel-caption">
                    <h1>Apply for a Cause</h1>

                    <p>Apply and vote for a cause</p>

                    <p><a class="btn btn-lg btn-primary" href="<?= base_url('signup') ?>">Join Now</a>
                </div>
            </div>
        </div>
        <div class="item">
            <img src="<?= base_url('assets/img/promote_f.jpg') ?>" class="img-responsive">

            <div class="container">
                <div class="carousel-caption">
                    <h1>Promote by Me</h1>

                    <p>Promote companies and get paid</p>

                    <p><a class="btn btn-lg btn-primary" href="<?= base_url('signup') ?>">Join Now</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="icon-prev"></span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="icon-next"></span>
    </a>
</div>
<!-- /.carousel -->


<!-- Marketing messaging and featurettes
================================================== -->
<!-- Wrap the rest of the page in another container to center all the content. -->

<div class="container marketing">

    <!-- START THE FEATURETTES -->

    <div class="featurette">
        <img class="featurette-image img-circle pull-right" src="<?= base_url('assets/img/lost_found.png') ?>">

        <h2 class="featurette-heading">Lost and Found <span class="text-muted"></span></h2>


        <ul>
            <li><p class="lead">Remember the last time you lost something and found it back? How awesome did you feel? Give the same
                pleasure to someone else by notifying what you have found by chance. One might be very thankful for
                getting his goods back.</p>
            </li>
            <li><p class="lead">Or is that you lost something? No worries, post it here and see if there is any response.</p></li>
        </ul>

    </div>

    <hr class="featurette-divider">

    <div class="featurette">
        <img class="featurette-image img-circle pull-left" src="<?= base_url('assets/img/cause.png') ?>">

        <h2 class="featurette-heading">Apply for a Cause <span class="text-muted">To the Proper Authority.</span></h2>

        <ul>
            <li><p class="lead">Let us guess, you are worried about your social difficulties. Then you are at the just place.</p></li>
            <li><p class="lead">
                Create a cause and invite others to vote. Highly voted causes are sent to the proper authority for their
                attention. Which you cannot draw by any other means.</p>
            </li>
        </ul>
    </div>

    <hr class="featurette-divider">

    <div class="featurette">
        <img class="featurette-image img-circle pull-right" src="<?= base_url('assets/img/promote.png') ?>">

        <h2 class="featurette-heading">Promote by Me. <span class="text-muted"></span></h2>

        <p class="lead">
        <ul>
            <li><p class="lead">Earn some serious cash by lending your property's (or anything else's) space for marketing</p>
            </li>
            <li><p class="lead">Look for a sponsor</p></li>
            <li>
                <p class="lead">Make your unused space a fortune</p>
            </li>
        </ul>
        </p>
    </div>

    <hr class="featurette-divider">

    <!-- /END THE FEATURETTES -->
