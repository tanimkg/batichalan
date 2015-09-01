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

    <?php // to sec ?>
    <div class="form-group col-sm-4<?php echo form_error('to_sec') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('cause input to_sec'), 'to_sec', array('class'=>'control-label')); ?>
        <?php echo form_input(array('name'=>'to_sec', 'value'=>set_value('to_sec', (isset($user['to_sec']) ? $user['to_sec'] : '')), 'class'=>'form-control')); ?>
    </div>
</div>

<div class="row">
    <?php // to org ?>
    <div class="form-group col-sm-4<?php echo form_error('to_org') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('cause input to_org'), 'to_org', array('class' => 'control-label')); ?>
        <?php echo form_input(array('name' => 'to_org', 'value' => set_value('to_org', $to_org), 'class' => 'form-control')); ?>
    </div>
</div>



    <!-- Address -->

<?php // buttons ?>
<div class="row">
    <div class="form-group col-sm-4<?php echo form_error('to_org') ? ' has-error' : ''; ?>">
        <a class="btn btn-primary" data-toggle="modal" href='#modal-to_addr'><?= lang('cause button open_to_addr_modal') ?></a>
        <div class="modal fade" id="modal-to_addr">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><?= lang('cause modal open_to_addr_modal_title') ?></h4>
                    </div>
                    <div class="modal-body">
                        <?php
                        $data['form_open'] = base_url('address/add_and_return_id');
                        $this->load->view('address/add_and_return_id', $data); ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="onClickTransferId">OK</button>
                    </div>
                </div>
            </div>
        </div>    </div>
</div>

    <?php echo form_hidden('created_by_uid', $uid); ?>
    <?php echo form_hidden('to_addr_id', (isset($addr_id) ? $addr_id : NULL), 'id="to_addr_id"'); ?>

<script type="text/javascript">
    $(document).ready(function(){

        $('#onClickTransferId').click(function(){
            // set the returned address id value
            $('#to_addr_id').val();
        })

    });
</script>

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

    </div>


    <!----------address end------------->

<div class="row">
    <?php // cause title ?>
    <div class="form-group col-sm-6<?php echo form_error('cause_title') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('cause input cause_title'), 'cause_title', array('class'=>'control-label')); ?>
        <span class="required">*</span>
        <?php echo form_input(array('name'=>'cause_title', 'value'=>set_value('cause_title', (isset($user['cause_title']) ? $user['cause_title'] : '')), 'class'=>'form-control')); ?>
    </div>
</div>

<div class="row">
    <?php // cause desc ?>
    <div class="form-group col-sm-6<?php echo form_error('cause_desc') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('cause input cause_desc'), 'cause_desc', array('class'=>'control-label')); ?>
        <span class="required">*</span>
        <?php echo form_textarea(array('name'=>'cause_desc', 'value'=>set_value('cause_desc', (isset($user['cause_desc']) ? $user['cause_desc'] : '')), 'class'=>'form-control')); ?>
    </div>
</div>

<!-- cause location address-->

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

</div>


<!----------cause location address end------------->
<div class="row">
    <?php // cause tags ?>
    <div class="form-group col-sm-6<?php echo form_error('tags') ? ' has-error' : ''; ?>">
        <?php echo form_label(lang('cause input tags'), 'tags', array('class'=>'control-label')); ?>
        <?php echo form_input(array('name'=>'tags', 'value'=>set_value('tags', (isset($user['tags']) ? $user['tags'] : '')), 'class'=>'form-control', 'placeholder'=>'Use comma to seperate tags')); ?>
    </div>
</div>



<?php // buttons ?>
<div class="row pull-right">
    <a class="btn btn-default" href="<?php echo $cancel_url; ?>"><?php echo lang('core button cancel'); ?></a>
    <button type="submit" name="submit" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> <?php echo lang('core button save'); ?></button>
</div>

<?php echo form_close(); ?>
