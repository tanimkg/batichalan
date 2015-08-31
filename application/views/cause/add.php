<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
$to_apt = isset($cause['to_apt']) ? $cause['to_apt'] : '';

echo form_open('', array('role'=>'form')); ?>
<!-- `cause_id`, `to_appt`, `to_name`, `to_sec`, `to_org`, `to_addr_id`,
`created_by_uid`, `supporter_uids`, `cause_title`, `cause_desc`, `cause_addr`, `media_id`,
`other_media_ids`, `tags`, `created_at`, `updated_at`-->
<div class="row">
    <?php // to_apt ?>
    <div class="form-group col-sm-4<?php echo form_error('to_apt') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('cause input to_apt'), 'to_apt', array('class'=>'control-label')); ?>
        <span class="required">*</span>
        <?php echo form_input(array('name'=>'to_apt', 'value'=>set_value('to_apt', $to_apt), 'class'=>'form-control')); ?>
    </div>
</div>

<div class="row">
    <?php // to name ?>
    <div class="form-group col-sm-4<?php echo form_error('to_name') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('cause input to_name'), 'to_name', array('class'=>'control-label')); ?>
        <span class="required">*</span>
        <?php echo form_input(array('name'=>'to_name', 'value'=>set_value('to_name', (isset($user['to_name']) ? $user['to_name'] : '')), 'class'=>'form-control')); ?>
    </div>

    <?php // last name ?>
    <div class="form-group col-sm-4<?php echo form_error('last_name') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('users input last_name'), 'last_name', array('class'=>'control-label')); ?>
        <span class="required">*</span>
        <?php echo form_input(array('name'=>'last_name', 'value'=>set_value('last_name', (isset($user['last_name']) ? $user['last_name'] : '')), 'class'=>'form-control')); ?>
    </div>
</div>

<div class="row">
    <?php // birthday ?>
    <div class="form-group col-sm-4<?php echo form_error('birth_date') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('users input birth_date'), 'birth_date', array('class' => 'control-label')); ?>
        <?php echo form_input(array('name' => 'birth_date', 'value' => set_value('birth_date', $birth_date), 'class' => 'form-control')); ?>
    </div>

    <?php // gender ?>
    <div class="form-group col-sm-3<?php echo form_error('gender') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('users input gender'), 'gender', array('class' => 'control-label')); ?>
        <?php echo form_dropdown('gender', [1 => "Male", 0 => 'Female', 2=> 'Prefer not to say'],set_value('gender', $gender), 'class="form-control"'); ?>
    </div>

</div>

<div class="row">
    <?php // email ?>
    <div class="form-group col-sm-6<?php echo form_error('email') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('users input email'), 'email', array('class'=>'control-label')); ?>
        <span class="required">*</span>
        <?php echo form_input(array('name'=>'email', 'value'=>set_value('email', (isset($user['email']) ? $user['email'] : '')), 'class'=>'form-control')); ?>
    </div>
</div>

<div class="row">
    <?php // password ?>
    <div class="form-group col-sm-4<?php echo form_error('password') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('users input password'), 'password', array('class'=>'control-label')); ?>
        <?php if ($password_required) : ?><span class="required">*</span><?php endif; ?>
        <?php echo form_password(array('name'=>'password', 'value'=>'', 'class'=>'form-control', 'autocomplete'=>'off')); ?>
    </div>

    <?php // password repeat ?>
    <div class="form-group col-sm-4<?php echo form_error('password_repeat') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('users input password_repeat'), 'password_repeat', array('class'=>'control-label')); ?>
        <?php if ($password_required) : ?><span class="required">*</span><?php endif; ?>
        <?php echo form_password(array('name'=>'password_repeat', 'value'=>'', 'class'=>'form-control', 'autocomplete'=>'off')); ?>
    </div>
    <?php if ( ! $password_required) : ?>
        <span class="help-block"><br /><?php echo lang('users help passwords'); ?></span>
    <?php endif; ?>
</div>

<?php // buttons ?>
<div class="row pull-right">
    <a class="btn btn-default" href="<?php echo $cancel_url; ?>"><?php echo lang('core button cancel'); ?></a>
    <?php if ($this->session->userdata('logged_in')) : ?>
        <button type="submit" name="submit" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> <?php echo lang('core button save'); ?></button>
    <?php else : ?>
        <button type="submit" name="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> <?php echo lang('users button register'); ?></button>
    <?php endif; ?>
</div>

<?php echo form_close(); ?>
