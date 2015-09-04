<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

        <?php echo form_open('', array('class'=>'form-signin')); ?>

        <?php echo form_input(array('name'=>'username', 'id'=>'username', 'class'=>'form-control', 'placeholder'=>lang('users input username_email'))); ?>
        <?php echo form_password(array('name'=>'password', 'id'=>'password', 'class'=>'form-control', 'placeholder'=>lang('users input password'), 'autocomplete'=>'off')); ?>
        <?php echo form_submit(array('name'=>'submit', 'class'=>'btn btn-lg btn-success btn-block'), lang('core button login')); ?>

        <p><br /><a href="<?php echo base_url('user/forgot'); ?>"><?php echo lang('users link forgot_password'); ?></a></p>
        <p><a href="<?php echo base_url('user/register'); ?>"><?php echo lang('users link register_account'); ?></a></p>

        <?php echo form_close(); ?>

<style>
    .padding-override {
        padding: 0 15px !important;
    }

    .form-signin {
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
    }

    .form-signin .form-control {
        position: relative;
        font-size: 16px;
        height: auto;
        padding: 10px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    .form-signin .form-control:focus {
        z-index: 2;
    }

    .form-signin input[type="text"] {
        margin-bottom: -1px;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }

    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
</style>
