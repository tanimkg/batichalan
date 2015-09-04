<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
$item_name = isset($lost['item_name']) ? $lost['item_name'] : '';
$item_desc = isset($lost['item_desc']) ? $lost['item_desc'] : '';
$dt = isset($lost['dt']) ? $lost['dt'] : '';
$category = isset($lost['category']) ? $lost['category'] : '';
$report_to = isset($lost['report_to']) ? $lost['report_to'] : '';
$award_desc = isset($lost['award_desc']) ? $lost['award_desc'] : '';
$report_to_contact = isset($lost['report_to_contact']) ? $lost['report_to_contact'] : '';
$is_found = isset($lost['is_found']) ? $lost['is_found'] : '';
$tags = isset($lost['tags']) ? $lost['tags'] : '';

$addr_line = isset($lost['addr_line']) ? $lost['addr_line'] : '';
$addr_area = isset($lost['addr_area']) ? $lost['addr_area'] : '';
$addr_city = isset($lost['addr_city']) ? $lost['addr_city'] : '';
$addr_country = isset($lost['addr_country']) ? $lost['addr_country'] : '';

echo form_open('', array('role' => 'form'));

echo form_hidden('lost_id', $lost_id);
if ($lost_id) {
    echo form_hidden('updated_at', mdate('%Y-%m-%d %H:%i:%s', time()));
} else {
    echo form_hidden('created_at', mdate('%Y-%m-%d %H:%i:%s', time()));
}

echo form_hidden('created_by_uid', $uid);
?>

<div class="row">
    <?php // lost/found ?>
    <div class="form-group col-sm-4<?php echo form_error('is_found') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('lost input is_found'), 'is_found', array('class' => 'control-label')); ?>
        <span class="required">*</span>
        <?php echo form_dropdown('is_found', [0 => 'Lost', 1=> 'Found'], set_value('is_found', $is_found), 'class="form-control"'); ?>
    </div>
</div>

<div class="row">
    <?php // category ?>
    <div class="form-group col-sm-4<?php echo form_error('category') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('lost input category'), 'category', array('class' => 'control-label')); ?>
        <span class="required">*</span>
        <?php echo form_input(array('name' => 'category', 'value' => set_value('category', $category), 'class' => 'form-control', 'placeholder'=> 'Document, Wallet, Watch etc.')); ?>
    </div>
</div>

<div class="row">
    <?php // item name ?>
    <div class="form-group col-sm-6<?php echo form_error('item_name') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('lost input item_name'), 'item_name', array('class' => 'control-label')); ?>
        <span class="required">*</span>
        <?php echo form_input(array('name' => 'item_name', 'value' => set_value('item_name', $item_name), 'class' => 'form-control')); ?>
    </div>
</div>

<div class="row">
    <?php // item desc ?>
    <div class="form-group col-sm-6<?php echo form_error('item_desc') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('lost input item_desc'), 'item_desc', array('class' => 'control-label')); ?>
        <span class="required">*</span>
        <?php echo form_textarea(array('name' => 'item_desc', 'value' => set_value('item_desc', $item_desc), 'class' => 'form-control')); ?>
    </div>
</div>

<div class="row">
    <?php // date ?>
    <div class="form-group col-sm-4<?php echo form_error('dt') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('lost input dt'), 'dt', array('class' => 'control-label')); ?>
        <?php echo form_input(array('name' => 'dt', 'value' => set_value('dt', $dt), 'class' => 'form-control')); ?>
    </div>
</div>


<div class="row">
    <?php // addr line 1 ?>
    <div class="form-group col-sm-4<?php echo form_error('addr_line') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('lost input addr_line'), 'addr_line', array('class' => 'control-label')); ?>
        <?php echo form_input(array('name' => 'addr_line', 'value' => set_value('addr_line', $addr_line), 'class' => 'form-control')); ?>
    </div>

    <?php // area ?>
    <div class="form-group col-sm-4<?php echo form_error('addr_area') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('lost input addr_area'), 'addr_area', array('class' => 'control-label')); ?>
        <?php echo form_input(array('name' => 'addr_area', 'value' => set_value('addr_area', $addr_area), 'class' => 'form-control')); ?>
    </div>

</div>

<div class="row">

    <?php // city ?>
    <div class="form-group col-sm-4<?php echo form_error('addr_city') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('lost input addr_city'), 'addr_city', array('class' => 'control-label')); ?>
        <?php echo form_input(array('name' => 'addr_city', 'value' => set_value('addr_city', $addr_city), 'class' => 'form-control')); ?>
    </div>

    <?php // country ?>
    <div class="form-group col-sm-4<?php echo form_error('addr_country') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('lost input addr_country'), 'addr_country', array('class' => 'control-label')); ?>
        <?php echo form_input(array('name' => 'addr_country', 'value' => set_value('addr_country', $addr_country), 'class' => 'form-control')); ?>
    </div>

</div>


<!----------address end------------->

<div class="row">
    <?php // report to  ?>
    <div class="form-group col-sm-6<?php echo form_error('report_to') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('lost input report_to'), 'report_to', array('class' => 'control-label')); ?>
        <?php echo form_textarea(array('name' => 'report_to', 'value' => set_value('report_to', $report_to), 'class' => 'form-control')); ?>
    </div>
</div>

<div class="row">
    <?php // report to contact  ?>
    <div class="form-group col-sm-6<?php echo form_error('report_to_contact') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('lost input report_to_contact'), 'report_to_contact', array('class' => 'control-label')); ?>
        <?php echo form_input(array('name' => 'report_to_contact', 'value' => set_value('report_to_contact', $report_to_contact), 'class' => 'form-control')); ?>
    </div>
</div>


<?php if ($is_found == 0) : // award ?>
<div class="row">
    <div class="form-group col-sm-6<?php echo form_error('award_desc') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('lost input award_desc'), 'award_desc', array('class' => 'control-label')); ?>
        <?php echo form_textarea(array('name' => 'award_desc', 'value' => set_value('award_desc', $award_desc), 'class' => 'form-control')); ?>
    </div>
</div>
<?php endif; ?>



<div class="row">
    <?php // tags ?>
    <div class="form-group col-sm-6<?php echo form_error('tags') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('lost input tags'), 'tags', array('class' => 'control-label')); ?>
        <?php echo form_input(array('name' => 'tags', 'value' => set_value('tags', $tags), 'class' => 'form-control', 'placeholder' => 'Use comma to seperate tags')); ?>
    </div>
</div>


<?php // buttons ?>
<div class="row">
    <a class="btn btn-default" href="<?php echo $cancel; ?>"><?php echo lang('core button cancel'); ?></a>
    <button type="submit" name="submit" class="btn btn-success"><span
            class="glyphicon glyphicon-save"></span> <?php echo lang('core button save'); ?></button>
</div>

<?php echo form_close(); ?>
