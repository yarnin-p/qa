<script>
    $(document).ready(function () {

        $.validator.methods.email = function( value, element ) {
            return this.optional( element ) || /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test( value );
        }

        $("#image").change(function () {
            if ($(this).val() !== '') {
                $(this).parent().parent().parent().removeClass('has-error');
                $('#name_' + $(this).attr('id') + '-error').remove();
            }
        });

        $("#form_data").validate({
            rules: {
                email: {
                    required: true
                },
            },
            messages: {
                email: "รูปแบบอีเมลไม่ถูกต้อง",
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
            },
            submitHandler: function (form) {

                form.submit();  
            }
        });
    });

    //check 
    function isThaichar(str, obj) {
        var orgi_text = "!@#$%^&*()";
        var str_length = str.length;
        var str_length_end = str_length - 1;
        var isThai = true;
        var Char_At = "";
        for (i = 0; i < str_length; i++) {
            Char_At = str.charAt(i);
            if (orgi_text.indexOf(Char_At) != -1) {
                isThai = false;
            }
        }
        if (str_length >= 1) {
            if (isThai == false) {
                obj.value = str.substr(0, str_length_end);
            }
        }
        return isThai; // ถ้าเป็น true แสดงว่าเป็นภาษาไทยทั้งหมด
    }




</script>