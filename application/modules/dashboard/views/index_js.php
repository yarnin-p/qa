<script>

    $("#start_search").datepicker({});
    $("#end_search").datepicker({});

    function send_date_search(start_date, end_date, type) {
        $('#date_type').val(type);
        $('#start_search').attr('data-value', start_date);
        $('#end_search').attr('data-value', end_date);
        $('#start_search').datepicker({
            format: 'yyyy-mm-dd',
            todayBtn: true
        }).datepicker("setDate", $('#start_search').attr('data-value'));
        $('#end_search').datepicker({
            format: 'yyyy-mm-dd',
            todayBtn: true
        }).datepicker("setDate", $('#end_search').attr('data-value'));
        $('#search_form').submit();
    }


    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
    };

    function change_mode(mode) {
        $('#mode').val(mode);
        $('#search_form').submit();
    }
</script>