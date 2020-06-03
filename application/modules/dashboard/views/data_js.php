<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>


<script>
    var start_search = getUrlParameter('start_search');
    var end_search = getUrlParameter('end_search');

    if(start_search==undefined){
        start_search = '<?php echo $search['start_search']  ?>';
    }
    if(end_search==undefined){
        end_search = '<?php echo  $search['end_search']  ?>';
    }

    var category_name = [];
    var income = [];
    var outcome = [];

    var url = '/manage/dashboard/get_monday_to_sunday?start_search='+start_search+'&end_search='+end_search;
    $.getJSON(url, function (data) {

        category_name = data.category_name;
        income = data.income;
        outcome = data.outcome;

        Highcharts.chart('chart-income-day', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'ค่าเฉลี่ยตามวัน จ-อ'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: category_name,
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'ยอดเฉลี่ย'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.0f} ฿</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [
                {
                    name: 'ข้อมูล รายรับ (เฉลี่ย : จ-อ)',
                    data: income

                },
                {
                    name: 'ข้อมูล โอนคืน (เฉลี่ย : จ-อ)',
                    data: outcome,
                    color: "#ee0000"

                }]
        });
    });

    var income = [];
    var outcome = [];
    var url = '/manage/dashboard/get_all_day_month?start_search='+start_search+'&end_search='+end_search;
    $.getJSON(url, function (data) {
        category_name = data.category_name;
        income = data.income;
        outcome = data.outcome;
        Highcharts.chart('chart-income-no-day', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'ค่าเฉลี่ยตามวัน 1-31'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: category_name,
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'ยอดเฉลี่ย'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.0f} ฿</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [
                {
                    name: 'ข้อมูล รายรับ (เฉลี่ย : วัน)',
                    data: income

                },
                {
                    name: 'ข้อมูล โอนคืน (เฉลี่ย : วัน)',
                    data: outcome,
                    color:"#ee0000"

                },

            ]
        });
    });

    var category_name = [];
    var income = [];
    var outcome = [];
    var url = '/manage/dashboard/get_all_hour_month?start_search='+start_search+'&end_search='+end_search;
    $.getJSON(url, function (data) {
        category_name = data.category_name;
        income = data.income;
        outcome = data.outcome;

        Highcharts.chart('chart-income-hour', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'ค่าเฉลี่ยตามเวลา 24 ชั่วโมง'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: category_name,
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'ยอดเฉลี่ย'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.0f} ฿</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [
                {
                    name: 'ข้อมูล รายรับ (เฉลี่ย : เวลา)',
                    data: income
                },
                {
                    name: 'ข้อมูล โอนคืน (เฉลี่ย : เวลา)',
                    data: outcome,
                    color:"#ee0000"
                }
            ]
        });
    });


    var category_name = [];
    var income = [];
    var outcome = [];
    var url = '/manage/dashboard/get_payment_type?start_search='+start_search+'&end_search='+end_search;
    $.getJSON(url, function (data) {
        category_name = data.category_name;
        income = data.income;
        outcome = data.outcome;

        Highcharts.chart('chart-income-payment-type', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'ค่าเฉลี่ยตามประเภทการชำระ'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: category_name,
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'ยอดเฉลี่ย'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.0f} ฿</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [
                {
                    name: 'ข้อมูล รายรับ (เฉลี่ย : ประเภทชำระ)',
                    data: income
                },
                {
                    name: 'ข้อมูล โอนคืน (เฉลี่ย : ประเภทชำระ)',
                    data: outcome,
                    color: "#ee0000"
                }
            ]
        });
    });


    var category_name = [];
    var income = [];
    var outcome = [];
    var url = '/manage/dashboard/get_device?start_search='+start_search+'&end_search='+end_search;
    $.getJSON(url, function (data) {
        category_name = data.category_name;
        income = data.income;
        outcome = data.outcome;

        Highcharts.chart('chart-income-device', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'ค่าเฉลี่ยตามประเภท Device'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: category_name,
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'ยอดเฉลี่ย'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.0f} ฿</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [
                {
                    name: 'ข้อมูล รายรับ (เฉลี่ย : ประเภท Device)',
                    data: income
                },
                {
                    name: 'ข้อมูล โอนคืน (เฉลี่ย : ประเภท Device)',
                    data: outcome,
                    color:"#ee0000"
                }
            ]
        });
    });

    var category_name = [];
    var income = [];
    var outcome = [];
    var url = '/manage/dashboard/get_location_order_avg?start_search='+start_search+'&end_search='+end_search;
    $.getJSON(url, function (data) {
        category_name = data.category_name;

        tha_member = data.tha_member;
        tha_income = data.tha_income;

        usa_member = data.usa_member;
        usa_income = data.usa_income

        cny_member = data.cny_member;
        cny_income = data.cny_income

        Highcharts.chart('chart-income-agent', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'ค่าเฉลี่ยสมาชิกใหม่ แต่ละประเทศ : เดือน'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: category_name
            },
            yAxis: {
                allowDecimals: false,
                min: 0,
                title: {
                    text: 'ยอดเฉลี่ย'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.0f} </b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    stacking: 'normal'
                }
            },
            series: [
                {
                    name: 'ข้อมูลสมาชิกใหม่: THA ',
                    data: tha_member,
                    color:"#3399ff",
                    stack: 'tha'
                },
                {
                    name: 'ข้อมูลรายรับจากสมาชิก: THA ',
                    data: tha_income,
                    color:"#004080",
                    stack: 'tha'
                }
                ,
                {
                    name: 'ข้อมูลสมาชิกใหม่: CNY ',
                    data: cny_member,
                    color:"#ff0000",
                    stack: 'cny'
                }
                ,
                {
                    name: 'ข้อมูลรายรับจากสมาชิก: CNY ',
                    data: cny_income,
                    color:"#800000",
                    stack: 'cny'
                }
                ,
                {
                    name: 'ข้อมูลสมาชิกใหม่: USA ',
                    data: usa_member,
                    color: "#339966",
                    stack:'usa'
                }
                ,
                {
                    name: 'ข้อมูลรายรับจากสมาชิก: USA ',
                    data: usa_income,
                    color: "#133926",
                    stack:'usa'
                }
            ]
        });
    });

</script>