<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
$to_apt = isset($cause['to_apt']) ? $cause['to_apt'] : '';
$to_name = isset($cause['to_name']) ? $cause['to_name'] : '';
$to_sec = isset($cause['to_sec']) ? $cause['to_sec'] : '';
$to_org = isset($cause['to_org']) ? $cause['to_org'] : '';
$to_addr_line = isset($cause['to_addr_line']) ? $cause['to_addr_line'] : '';
$to_addr_area = isset($cause['to_addr_area']) ? $cause['to_addr_area'] : '';
$to_addr_city = isset($cause['to_addr_city']) ? $cause['to_addr_city'] : '';
$to_addr_state = isset($cause['to_addr_state']) ? $cause['to_addr_state'] : '';
$to_addr_country = isset($cause['to_addr_country']) ? $cause['to_addr_country'] : '';
$to_addr_post_zip = isset($cause['to_addr_post_zip']) ? $cause['to_addr_post_zip'] : '';

echo form_open('', array('role' => 'form'));

echo form_hidden('cause_id', $cause_id);

if ($cause_id) {
    echo form_hidden('updated_at', mdate('%Y-%m-%d %H:%i:%s', time()));
} else {
    echo form_hidden('created_at', mdate('%Y-%m-%d %H:%i:%s', time()));
}


?>

<div class="row">
    <?php // to_apt ?>
    <div class="form-group col-sm-4<?php echo form_error('to_apt') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('cause input to_apt'), 'to_apt', array('class' => 'control-label')); ?>
        <?php echo form_input(array('name' => 'to_apt', 'value' => set_value('to_apt', $to_apt), 'class' => 'form-control')); ?>
    </div>
</div>

<div class="row">
    <?php // to name ?>
    <div class="form-group col-sm-4<?php echo form_error('to_name') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('cause input to_name'), 'to_name', array('class' => 'control-label')); ?>
        <?php echo form_input(array('name' => 'to_name', 'value' => set_value('to_name', $to_name), 'class' => 'form-control')); ?>
    </div>

    <?php // to sec ?>
    <div class="form-group col-sm-4<?php echo form_error('to_sec') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('cause input to_sec'), 'to_sec', array('class' => 'control-label')); ?>
        <?php echo form_input(array('name' => 'to_sec', 'value' => set_value('to_sec', $to_sec), 'class' => 'form-control')); ?>
    </div>
</div>

<div class="row">
    <?php // to org ?>
    <div class="form-group col-sm-4<?php echo form_error('to_org') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('cause input to_org'), 'to_org', array('class' => 'control-label')); ?>
        <span class="required">*</span>
        <?php echo form_input(array('name' => 'to_org', 'value' => set_value('to_org', $to_org), 'class' => 'form-control')); ?>
    </div>
</div>


<!-- to address -->

<div class="row">
    <?php // addr line ?>
    <div class="form-group col-sm-8<?php echo form_error('to_addr_line') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('cause input to_addr_line'), 'to_addr_line', array('class' => 'control-label')); ?>
        <?php echo form_input(array('name' => 'to_addr_line', 'value' => set_value('to_addr_line', $to_addr_line), 'class' => 'form-control')); ?>
    </div>
</div>
<div class="row">
    <?php // addr area ?>
    <div class="form-group col-sm-4<?php echo form_error('to_addr_area') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('cause input to_addr_area'), 'to_addr_area', array('class' => 'control-label')); ?>
        <?php echo form_input(array('name' => 'to_addr_area', 'value' => set_value('to_addr_area', $to_addr_area), 'class' => 'form-control')); ?>
    </div>

    <?php // addr city area ?>
    <div class="form-group col-sm-4<?php echo form_error('to_addr_city') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('cause input to_addr_city'), 'to_addr_city', array('class' => 'control-label')); ?>
        <?php echo form_input(array('name' => 'to_addr_city', 'value' => set_value('to_addr_city', $to_addr_city), 'class' => 'form-control')); ?>
    </div>

</div>
<div class="row">
    <?php // addr state ?>
    <div class="form-group col-sm-4<?php echo form_error('to_addr_state') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('cause input to_addr_state'), 'to_addr_state', array('class' => 'control-label')); ?>
        <?php echo form_input(array('name' => 'to_addr_state', 'value' => set_value('to_addr_state', $to_addr_state), 'class' => 'form-control')); ?>
    </div>

    <?php // addr country ?>
    <div class="form-group col-sm-4<?php echo form_error('to_addr_country') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('cause input to_addr_country'), 'to_addr_country', array('class' => 'control-label')); ?>
        <?php echo form_input(array('name' => 'to_addr_country', 'value' => set_value('to_addr_country', $to_addr_country), 'class' => 'form-control')); ?>
    </div>

</div>


<div class="row">

    <?php // zip ?>
    <div class="form-group col-sm-4<?php echo form_error('to_addr_post_zip') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('cause input to_addr_post_zip'), 'to_addr_post_zip', array('class' => 'control-label')); ?>
        <?php echo form_input(array('name' => 'to_addr_post_zip', 'value' => set_value('to_addr_post_zip', $to_addr_post_zip), 'class' => 'form-control')); ?>
    </div>

</div>


<?php // buttons ?>
<div class="row">
    <div class="form-group col-sm-6">
        <a class="btn btn-default" href="<?php echo $cancel; ?>"><?php echo lang('core button cancel'); ?></a>
        <button type="submit" name="submit" class="btn btn-success"><span
                class="glyphicon glyphicon-save"></span> <?php echo lang('core button save'); ?></button>
    </div>
</div>

<?php echo form_close(); ?>
