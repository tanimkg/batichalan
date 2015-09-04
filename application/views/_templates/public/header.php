<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url($this->config->item('favicon')); ?>">
    <link rel="icon" type="image/x-icon" href="<?php echo base_url($this->config->item('favicon')); ?>">
    <title><?php echo ($site_title) ? $site_title . ' - ' : ''; ?><?php echo $this->config->item('site_title'); ?></title>
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
