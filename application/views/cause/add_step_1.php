<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
$cause_title = isset($cause['cause_title']) ? $cause['cause_title'] : '';
$cause_desc = isset($cause['cause_desc']) ? $cause['cause_desc'] : '';
$cause_addr_line = isset($cause['cause_addr_line']) ? $cause['cause_addr_line'] : '';
$cause_addr_area = isset($cause['cause_addr_area']) ? $cause['cause_addr_area'] : '';
$cause_addr_city = isset($cause['cause_addr_city']) ? $cause['cause_addr_city'] : '';
$cause_addr_state = isset($cause['cause_addr_state']) ? $cause['cause_addr_state'] : '';
$cause_addr_country = isset($cause['cause_addr_country']) ? $cause['cause_addr_country'] : '';
$cause_addr_post_zip = isset($cause['cause_addr_post_zip']) ? $cause['cause_addr_post_zip'] : '';

echo form_open('', array('role'=>'form'));

echo form_hidden('cause_id', $cause_id);
echo form_hidden('created_by_uid', $uid);

if ($cause_id) {
    echo form_hidden('updated_at', mdate('%Y-%m-%d %H:%i:%s', time()));
} else {
    echo form_hidden('created_at', mdate('%Y-%m-%d %H:%i:%s', time()));
}


?>

<div class="row">
    <?php // cause title ?>
    <div class="form-group col-sm-6<?php echo form_error('cause_title') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('cause input cause_title'), 'cause_title', array('class'=>'control-label')); ?>
        <span class="required">*</span>
        <?php echo form_input(array('name'=>'cause_title', 'value'=>set_value('cause_title', $cause_title), 'class'=>'form-control')); ?>
    </div>
</div>

<div class="row">
    <?php // cause desc ?>
    <div class="form-group col-sm-6<?php echo form_error('cause_desc') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('cause input cause_desc'), 'cause_desc', array('class'=>'control-label')); ?>
        <span class="required">*</span>
        <?php echo form_textarea(array('name'=>'cause_desc', 'value'=>set_value('cause_desc', $cause_desc), 'class'=>'form-control')); ?>
    </div>
</div>

<!-- cause location cause-->

<div class="row">
    <?php // addr line ?>
    <div class="form-group col-sm-4<?php echo form_error('cause_addr_line') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('cause input cause_addr_line'), 'cause_addr_line', array('class' => 'control-label')); ?>
        <?php echo form_input(array('name' => 'cause_addr_line', 'value' => set_value('cause_addr_line', $cause_addr_line), 'class' => 'form-control')); ?>
    </div>

    <?php // addr area ?>
    <div class="form-group col-sm-4<?php echo form_error('cause_addr_area') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('cause input cause_addr_area'), 'cause_addr_area', array('class' => 'control-label')); ?>
        <?php echo form_input(array('name' => 'cause_addr_area', 'value' => set_value('cause_addr_area', $cause_addr_area), 'class' => 'form-control')); ?>
    </div>

    <?php // addr city area ?>
    <div class="form-group col-sm-4<?php echo form_error('cause_addr_city') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('cause input cause_addr_city'), 'cause_addr_city', array('class' => 'control-label')); ?>
        <?php echo form_input(array('name' => 'cause_addr_city', 'value' => set_value('cause_addr_city', $cause_addr_city), 'class' => 'form-control')); ?>
    </div>

</div>
<div class="row">
    <?php // addr state ?>
    <div class="form-group col-sm-4<?php echo form_error('cause_addr_state') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('cause input cause_addr_state'), 'cause_addr_state', array('class' => 'control-label')); ?>
        <?php echo form_input(array('name' => 'cause_addr_state', 'value' => set_value('cause_addr_state', $cause_addr_state), 'class' => 'form-control')); ?>
    </div>

    <?php // addr country ?>
    <div class="form-group col-sm-4<?php echo form_error('cause_addr_country') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('cause input cause_addr_country'), 'cause_addr_country', array('class' => 'control-label')); ?>
        <?php echo form_input(array('name' => 'cause_addr_country', 'value' => set_value('cause_addr_country', $cause_addr_country), 'class' => 'form-control')); ?>
    </div>

</div>


<div class="row">

    <?php // zip ?>
    <div class="form-group col-sm-4<?php echo form_error('cause_addr_post_zip') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('cause input cause_addr_post_zip'), 'cause_addr_post_zip', array('class' => 'control-label')); ?>
        <?php echo form_input(array('name' => 'cause_addr_post_zip', 'value' => set_value('cause_addr_post_zip', $cause_addr_post_zip), 'class' => 'form-control')); ?>
    </div>

</div>


<?php // buttons ?>
<div class="row">
    <div class="form-group col-sm-6">
        <a class="btn btn-default" href="<?php echo $cancel; ?>"><?php echo lang('core button cancel'); ?></a>
        <button type="submit" name="submit" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> <?php echo lang('core button save'); ?></button>
    </div>
</div>

<?php echo form_close(); ?>
