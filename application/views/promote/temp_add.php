<!-- Categories| add following form fields to attain category selection in promote/add -->
<div class="row">
    <?php //  category ?>
    <div class="form-group col-sm-3">
        <?php echo form_label(lang('core input category'), 'parent_cat', array('class'=>'control-label')); ?>
        <?php echo form_dropdown('category', $category, set_value('category', $category), 'class="form-control" id="parent_cat"'); ?>
    </div>
    <?php //  sub category ?>
    <div class="form-group col-sm-3">
        <?php echo form_label(lang('core input sub_category'), 'sub_category', array('class'=>'control-label')); ?>
        <?php echo form_dropdown('sub_category', $sub_category, set_value('sub_category', $sub_category), 'class="form-control" id="parent_cat"'); ?>
    </div>
</div>



<script>
    $(document).ready(function(){
        $('#parent_cat').click(function(){
            $.getJSON(
                "<?= base_url('category/get_categories') ?>",
                null,
                function(cat) {
                    var catDropdownOpts = '';
                    $.each(cat, function(key, item) {
                        catDropdownOpts += '<option value="' + item.category + '">' + item.category + '</option>';
                    });
                    $('#parent_cat').html(catDropdownOpts);
                }

            );
        });
    });
</script>