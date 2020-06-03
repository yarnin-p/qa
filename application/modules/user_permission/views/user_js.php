<script>
    $(document).ready(function () {
        $("#dataForm").validate({
            rules: {
                telephone: {
                    required: true,
                    number: true,
                    minlength: 9,

                }
            },
            messages: {
                telephone: {
                    required: "<?php echo $this->lang->line('label_error_msg'); ?>",
                    number: "<?php echo $this->lang->line('label_error_number'); ?>",
                    minlength: "<?php echo str_replace('{n}', '9-15', $this->lang->line('label_error_minlength')); ?>"
                }
            },
            highlight: function (element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function (error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            }
            /*submitHandler: function (form) {
             form.submit();
             }*/
        });

        $("#permission_group").change(function () {
            window.location.href = '<?php echo base_url($modules)?>?group_id=' + $(this).val();
        });

    });

    function check_view(obj) {
        var parent_code = obj.id;
        parent_code = parent_code.substr(-4, 4);

        if (obj.checked){
            $('#chk_add' + parent_code).attr('disabled', false);
            $('#chk_edit' + parent_code).attr('disabled', false);
            $('#chk_delete' + parent_code).attr('disabled', false);
        } else {
            //unCheck
            $('#chk_add' + parent_code).prop("checked", false);
            $('#chk_edit' + parent_code).prop("checked", false);
            $('#chk_delete' + parent_code).prop("checked", false);

            //disable
            $('#chk_add' + parent_code).attr('disabled', true);
            $('#chk_edit' + parent_code).attr('disabled', true);
            $('#chk_delete' + parent_code).attr('disabled', true);
        }
    }



</script>