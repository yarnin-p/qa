<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>


<script>
    var start_search = getUrlParameter('start_search');
    var end_search = getUrlParameter('end_search');

    if (start_search == undefined) {
        start_search = '<?php echo date("Y-01-01")  ?>';
    }
    if (end_search == undefined) {
        end_search = '<?php echo date("Y-12-31")  ?>';
    }

    var category_name = [];
    var data_chart = [];
    var url = '/manage/dashboard/get_data_chart?start_search='+start_search+'&end_search='+end_search;
    $.getJSON(url, function (data) {
        category_name = data.category_name;
        data_chart = data.data_chart;

        Highcharts.chart('container1', {

            chart: {
                type: 'column'
            },

            title: {
                text: 'กราฟรายวัน รายรับ-เงินคืน '
            },

            xAxis: {
                categories: category_name
            },
            exporting: {
                buttons: {
                    contextButton: {
                    }
                }
            },

            yAxis: {
                allowDecimals: false,
                min: 0,
                title: {
                    text: 'ยอดเงิน'
                }
            },

            tooltip: {
                formatter: function () {
                    return '<b>' + this.x + '</b><br/>' +
                        this.series.name + ': ' + this.y + '<br/>' +
                        'Total: ' + this.point.stackTotal;
                }
            },

            plotOptions: {
                column: {
                    maxPointWidth: 14,
                    minPointLength: 2,
                    stacking: 'normal'
                }
            },
            credits: {enabled: false},
            series:   data_chart
        });
    });

</script>
