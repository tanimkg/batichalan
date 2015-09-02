<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
$title = isset($promote['title']) ? $promote['title'] : '';
$conditions = isset($promote['conditions']) ? $promote['conditions'] : '';
$tags = isset($promote['tags']) ? $promote['tags'] : '';
$promotable_space = isset($promote['promotable_space']) ? $promote['promotable_space'] : '';
$description = isset($promote['description']) ? $promote['description'] : '';
$addr_line = isset($promote['addr_line']) ? $promote['addr_line'] : '';
$addr_area = isset($promote['addr_area']) ? $promote['addr_area'] : '';
$addr_city = isset($promote['addr_city']) ? $promote['addr_city'] : '';
$addr_state = isset($promote['addr_state']) ? $promote['addr_state'] : '';
$addr_country = isset($promote['addr_country']) ? $promote['addr_country'] : '';
$addr_post_zip = isset($promote['addr_post_zip']) ? $promote['addr_post_zip'] : '';

echo form_open('', array('role'=>'form'));

echo form_hidden('promote_id', $promote_id);
echo form_hidden('created_by_uid', $uid);

?>


<div class="row">
    <?php //  title ?>
    <div class="form-group col-sm-6<?php echo form_error('title') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('promote input title'), 'title', array('class'=>'control-label')); ?>
        <span class="required">*</span>
        <?php echo form_input(array('name'=>'title', 'value'=>set_value('title', $title), 'class'=>'form-control')); ?>
    </div>
</div>

<div class="row">
    <?php //  desc ?>
    <div class="form-group col-sm-6<?php echo form_error('description') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('promote input description'), 'description', array('class'=>'control-label')); ?>
        <span class="required">*</span>
        <?php echo form_textarea(array('name'=>'description', 'value'=>set_value('description', $description), 'class'=>'form-control')); ?>
    </div>
</div>

<div class="row">
    <?php //  desc ?>
    <div class="form-group col-sm-6<?php echo form_error('conditions') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('promote input conditions'), 'conditions', array('class'=>'control-label')); ?>
        <?php echo form_textarea(array('name'=>'conditions', 'value'=>set_value('conditions', $conditions), 'class'=>'form-control')); ?>
    </div>
</div>

<div class="row">
    <?php //  promotable space ?>
    <div class="form-group col-sm-2<?php echo form_error('promotable_space') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('promote input promotable_space'), 'promotable_space', array('class'=>'control-label')); ?>
        <?php echo form_input(array('name'=>'promotable_space', 'value'=>set_value('promotable_space', $promotable_space), 'class'=>'form-control')); ?>
    </div>
</div>


<div class="row">
    <?php //  tags ?>
    <div class="form-group col-sm-8<?php echo form_error('tags') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('promote input tags'), 'tags', array('class'=>'control-label')); ?>
        <?php echo form_input(array('name'=>'tags', 'value'=>set_value('tags', $tags), 'class'=>'form-control')); ?>
    </div>
</div>

<!--  location -->

<div class="row">
    <?php // addr line ?>
    <div class="form-group col-sm-4<?php echo form_error('addr_line') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('promote input addr_line'), 'addr_line', array('class' => 'control-label')); ?>
        <?php echo form_input(array('name' => 'addr_line', 'value' => set_value('addr_line', $addr_line), 'class' => 'form-control')); ?>
    </div>

    <?php // addr area ?>
    <div class="form-group col-sm-4<?php echo form_error('addr_area') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('promote input addr_area'), 'addr_area', array('class' => 'control-label')); ?>
        <?php echo form_input(array('name' => 'addr_area', 'value' => set_value('addr_area', $addr_area), 'class' => 'form-control')); ?>
    </div>

    <?php // addr city area ?>
    <div class="form-group col-sm-4<?php echo form_error('addr_city') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('promote input addr_city'), 'addr_city', array('class' => 'control-label')); ?>
        <?php echo form_input(array('name' => 'addr_city', 'value' => set_value('addr_city', $addr_city), 'class' => 'form-control')); ?>
    </div>

</div>
<div class="row">
    <?php // addr state ?>
    <div class="form-group col-sm-4<?php echo form_error('addr_state') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('promote input addr_state'), 'addr_state', array('class' => 'control-label')); ?>
        <?php echo form_input(array('name' => 'addr_state', 'value' => set_value('addr_state', $addr_state), 'class' => 'form-control')); ?>
    </div>

    <?php // addr country ?>
    <div class="form-group col-sm-4<?php echo form_error('addr_country') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('promote input addr_country'), 'addr_country', array('class' => 'control-label')); ?>
        <?php echo form_input(array('name' => 'addr_country', 'value' => set_value('addr_country', $addr_country), 'class' => 'form-control')); ?>
    </div>

    <?php // zip ?>
    <div class="form-group col-sm-4<?php echo form_error('addr_post_zip') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('promote input addr_post_zip'), 'addr_post_zip', array('class' => 'control-label')); ?>
        <?php echo form_input(array('name' => 'addr_post_zip', 'value' => set_value('addr_post_zip', $addr_post_zip), 'class' => 'form-control')); ?>
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
