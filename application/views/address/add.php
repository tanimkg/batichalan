<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php

$form_open = isset($form_open) ? $form_open : '';

$addr_type = isset($address['addr_type']) ? $address['addr_type'] : '';
$addr_line_1 = isset($address['addr_line_1']) ? $address['addr_line_1'] : '';
$addr_line_2 = isset($address['addr_line_2']) ? $address['addr_line_2'] : '';
$city = isset($address['city']) ? $address['city'] : '';
$state = isset($address['state']) ? $address['state'] : '';
$country = isset($address['country']) ? $address['country'] : '';
$post_zip = isset($address['post_zip']) ? $address['post_zip'] : '';
$living_since = isset($address['living_since']) ? $address['living_since'] : '';
$lived_upto = isset($address['lived_upto']) ? $address['lived_upto'] : '';
?>

<?php echo form_open($form_open, array('role' => 'form')); ?>

<?php echo form_hidden('created_by_uid', $uid); ?>
<?php echo form_hidden('addr_id', (isset($addr_id) ? $addr_id : NULL)); ?>
<?php echo form_hidden('profile_related', $profile_related);

if ($addr_id) {
    echo form_hidden('updated_at', mdate('%Y-%m-%d %H:%i:%s', time()));
} else {
    echo form_hidden('created_at', mdate('%Y-%m-%d %H:%i:%s', time()));
}

?>

<div class="row">
    <?php // type ?>
    <div class="form-group col-sm-6<?php echo form_error('addr_type') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('address input addr_type'), 'addr_type', array('class' => 'control-label')); ?>
        <span class="required">*</span>
        <?php echo form_dropdown('addr_type', $addr_types, set_value('addr_type', $addr_type), 'class="form-control"'); ?>
    </div>

</div>

<div class="row">
    <?php // addr line 1 ?>
    <div class="form-group col-sm-6<?php echo form_error('addr_line_1') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('address input addr_line_1'), 'addr_line_1', array('class' => 'control-label')); ?>
        <?php echo form_input(array('name' => 'addr_line_1', 'value' => set_value('addr_line_1', $addr_line_1), 'class' => 'form-control')); ?>
    </div>

    <?php // addr line 2 ?>
    <div class="form-group col-sm-6<?php echo form_error('addr_line_2') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('address input addr_line_2'), 'addr_line_2', array('class' => 'control-label')); ?>
        <?php echo form_input(array('name' => 'addr_line_2', 'value' => set_value('addr_line_2', $addr_line_2), 'class' => 'form-control')); ?>
    </div>

</div>

<div class="row">

    <?php // city ?>
    <div class="form-group col-sm-4<?php echo form_error('city') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('address input city'), 'city', array('class' => 'control-label')); ?>
        <?php echo form_input(array('name' => 'city', 'value' => set_value('city', $city), 'class' => 'form-control')); ?>
    </div>

    <?php // state ?>
    <div class="form-group col-sm-4<?php echo form_error('state') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('address input state'), 'city', array('class' => 'control-label')); ?>
        <?php echo form_input(array('name' => 'state', 'value' => set_value('state', $state), 'class' => 'form-control')); ?>
    </div>

    <?php // country ?>
    <div class="form-group col-sm-4<?php echo form_error('country') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('address input country'), 'country', array('class' => 'control-label')); ?>
        <?php echo form_input(array('name' => 'country', 'value' => set_value('country', $country), 'class' => 'form-control')); ?>
    </div>

</div>


<div class="row">

    <?php // zip ?>
    <div class="form-group col-sm-4<?php echo form_error('post_zip') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('address input post_zip'), 'post_zip', array('class' => 'control-label')); ?>
        <?php echo form_input(array('name' => 'post_zip', 'value' => set_value('post_zip', $post_zip), 'class' => 'form-control')); ?>
    </div>
<?php if ($profile_related == 1) : ?>
    <?php // since ?>
    <div class="sr-only form-group col-sm-4<?php echo form_error('living_since') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('address input living_since'), 'city', array('class' => 'control-label')); ?>
        <?php echo form_input_date(array('name' => 'living_since', 'value' => set_value('living_since', $living_since), 'class' => 'form-control')); ?>
    </div>

    <?php // upto ?>
    <div class="form-group col-sm-4<?php echo form_error('lived_upto') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('address input lived_upto'), 'lived_upto', array('class' => 'control-label')); ?>
        <?php echo form_input_date(array('name' => 'lived_upto', 'value' => set_value('lived_upto', $lived_upto), 'class' => 'form-control')); ?>
    </div>
<?php endif; ?>
</div>


<?php // buttons ?>
<div class="row">
    <div class="form-group col-sm-6">
        <a class="btn btn-default" href="<?php echo $cancel; ?>">Cancel</a>
        <button type="submit" name="submit" value="submit" class="btn btn-success">Save</button>
    </div>
</div>

<?php echo form_close(); ?>
