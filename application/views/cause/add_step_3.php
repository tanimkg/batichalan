<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
$tags = isset($cause['tags']) ? $cause['tags'] : '';

echo form_open('', array('role' => 'form'));

echo form_hidden('cause_id', $cause_id);

?>

<div class="row">
    <?php // tag ?>
    <div class="form-group col-sm-8<?php echo form_error('tags') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('cause input tags'), 'tags', array('class' => 'control-label')); ?>
        <?php echo form_input(array('name' => 'tags', 'value' => set_value('tags', $tags), 'class' => 'form-control')); ?>
    </div>
</div>

<!-- Media uploads -->

<?php // buttons ?>
<div class="row">
    <div class="form-group col-sm-6">
        <a class="btn btn-default" href="<?php echo $cancel; ?>"><?php echo lang('core button cancel'); ?></a>
        <button type="submit" name="submit" class="btn btn-success"><span
                class="glyphicon glyphicon-save"></span> <?php echo lang('core button save'); ?></button>
    </div>
</div>

<?php echo form_close(); ?>
