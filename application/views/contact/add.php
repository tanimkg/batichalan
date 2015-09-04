<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
$type    = isset($contact['type']) ? $contact['type'] : '';
$no      = isset($contact['no']) ? $contact['no'] : '';
$privacy = isset($contact['privacy']) ? $contact['privacy'] : '';
$cancel = isset($redirect) ? $redirect : site_url();

?>
<?php echo form_open('', array('role'=>'form'));

if ($contact_id) {
    echo form_hidden('updated_at', mdate('%Y-%m-%d %H:%i:%s', time()));
} else {
    echo form_hidden('created_at', mdate('%Y-%m-%d %H:%i:%s', time()));
}

?>

    <?php echo form_hidden('created_by_uid', $uid); ?>
    <?php echo form_hidden('contact_id', (isset($contact_id) ? $contact_id : NULL)); ?>

    <div class="row">
        <?php  // type ?>
        <div class="form-group col-sm-6<?php echo form_error('type') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('contact input type'), 'type', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_dropdown('type', $contact_types, set_value('type', $type), 'class="form-control"'); ?>
        </div>
    </div>

    <div class="row">
        <?php  // no ?>
        <div class="form-group col-sm-6<?php echo form_error('no') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('contact input no'), 'no', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_input(array('name'=>'no', 'value'=>set_value('no', $no), 'class'=>'form-control')); ?>
        </div>
    </div>

    <div class="row">
        <?php  // privacy ?>
        <div class="form-group col-sm-6<?php echo form_error('privacy') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('contact input privacy'), 'privacy', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_dropdown('privacy', $privacies, set_value('privacy', $privacy), 'class="form-control"'); ?>
        </div>
    </div>


    <?php // buttons ?>
    <div class="row">
        <div class="form-group col-sm-6">
            <a class="btn btn-default" href="<?php echo $cancel; ?>">Cancel</a>
            <button type="submit" name="submit" value="submit" class="btn btn-success">Save</button>
        </div>
    </div>

<?php echo form_close(); ?>
