<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url($this->config->item('favicon')); ?>">
    <link rel="icon" type="image/x-icon" href="<?php echo base_url($this->config->item('favicon')); ?>">
    <title><?php echo $page_title; ?> - <?php echo $this->config->item('site_title'); ?></title>
    <meta name="keywords" content="<?php echo $this->config->item('keywords'); ?>">
    <meta name="description" content="<?php echo $this->config->item('description'); ?>">

    <link href="<?php echo base_url($this->config->item('bootstrap_css')); ?>" rel="stylesheet">
    <link href="<?php echo base_url($this->config->item('fontawesome_css')); ?>" rel="stylesheet">
    <link href="<?php echo base_url($this->config->item('custom_css')); ?>" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<div class="navbar-wrapper">
    <div class="container">
        <div class="navbar navbar-inverse navbar-static-top">

            <div class="navbar-header">
                <a class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="navbar-brand" href="#">Batichalan</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><?= anchor('lost/index', 'Lost and Found') ?></li>
                    <li><?= anchor('cause/index', 'Apply for a Cause') ?></li>
                    <li><?= anchor('promote/index', 'Promote by Me') ?></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><?= anchor('login', 'Login') ?></li>
                            <li><?= anchor('signup', 'Signup') ?></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
    </div>
    <!-- /container -->
</div>
<!-- /navbar wrapper -->


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

        <p class="lead">
        <ul>
            <li>Remember the last time you lost something and found it back? How awesome did you feel? Give the same
                pleasure to someone else by notifying what you have found by chance. One might be very thankful for
                getting his goods back.
            </li>
            <li>Or is that you lost something? No worries, post it here and see if there is any response.</li>
        </ul>
        </p>
    </div>

    <hr class="featurette-divider">

    <div class="featurette">
        <img class="featurette-image img-circle pull-left" src="<?= base_url('assets/img/cause.png') ?>">

        <h2 class="featurette-heading">Apply for a Cause <span class="text-muted">To the Proper Authority.</span></h2>

        <p class="lead">
        <ul>
            <li>Let us guess, you are worried about your social difficulties. Then you are at the just place.</li>
            <li>
                Create a cause and invite others to vote. Highly voted causes are sent to the proper authority for their
                attention. Which you cannot draw by any other means.
            </li>
        </ul>
        </p>
    </div>

    <hr class="featurette-divider">

    <div class="featurette">
        <img class="featurette-image img-circle pull-right" src="<?= base_url('assets/img/promote.png') ?>">

        <h2 class="featurette-heading">Promote by Me. <span class="text-muted"></span></h2>

        <p class="lead">
        <ul>
            <li>Earn some serious cash by lending your property's (or anything else's) space for marketing
            </li>
            <li>Look for a sponsor</li>
            <li>
                Make your unused space a fortune
            </li>
        </ul>
        </p>
    </div>

    <hr class="featurette-divider">

    <!-- /END THE FEATURETTES -->


    <!-- FOOTER -->
    <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>

        <p>Batichalan.com | &copy; 2015</p>
    </footer>

</div>
<!-- /.container -->
<!-- script references -->
<script src="<?php echo base_url($this->config->item('jquery')); ?>"></script>
<script src="<?php echo base_url($this->config->item('bootstrap_js')); ?>"></script>
</body>
</html>