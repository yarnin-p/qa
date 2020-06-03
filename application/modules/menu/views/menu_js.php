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

    function check_screen_no(){
        var screen_id =  $("#screen_id").val();
        if(screen_id.length==4){
            $.ajax ({
                    url :  url_ajax + 'check_screen_no',
                    method : "POST",
                    data :  {screen_id :screen_id },
                    dataType: "json",
                    success:function(res)
                    {
                        console.log(res);
                        if(res.status=="OK"){
                            
                        }else{
                            alert("เลข Screen ID ซ้ำ");
                           $("#screen_id").val('');
                            $("#screen_id").focus();
                        }
                    }
                });
        }

    }

</script>