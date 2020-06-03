<script>
    $(document).ready(function () {
        validate_tap('#save_dataForm');
    })

    function checkNumeric() {
        return event.keyCode >= 48 && event.keyCode <= 57 || event.keyCode == 46;
    }
    function formatCurrency(obj) {
        var val = obj.value;
        val = val.replace(/,/g, "");
        var parts = val.toString().split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        obj.value =  parts.join(".");
    }
</script>