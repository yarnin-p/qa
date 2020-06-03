<script>
    $(document).ready(function () {
        $('#group_id').select2({
            width: "100%",
            placeholder: "เลือกประเภทสินค้า"
        });



        $('.tb-input-approved').on('input', function (event) {
            this.value = this.value.replace(/[^0-9.]/g, '');
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


    // format number of approved table
    function formatNumPrice(obj) {
        const defaultVal = obj.getAttribute('data-price');
        if (obj.value && obj.value != defaultVal) {
            var numValue = obj.value * 1;
            obj.classList.add("border");
            obj.classList.add("border-success");
            obj.classList.add("text-success");
            numValue.toFixed(2);
        } else {
            obj.value = defaultVal;
            obj.classList.remove("text-success");
            obj.classList.remove("border");
            obj.classList.remove("border-success");
        }

    }


</script>