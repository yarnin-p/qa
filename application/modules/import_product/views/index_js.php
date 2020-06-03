<script>
    $(document).ready(function () {
        $('#group_id').select2({
            width: "100%",
            placeholder: "เลือกประเภทสินค้า"
        });
        $('#supplier_id').select2({
            width: "100%",
            placeholder: "เลือกซัพพลายเออร์"
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