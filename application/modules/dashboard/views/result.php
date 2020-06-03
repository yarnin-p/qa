<div class="row wrapper border-bottom white-bg page-heading page-english_media_category body-dashboard"
     style="height: auto;">

    <div class="col-xs-12 col-md-3 col-lg-4">
        <h2>
            <?php if ($search['mode'] == 'monitor') { ?>
                <a class="btn btn-warning" onclick="change_mode('')"><i class="fa fa-compress"></i></a>
            <?php } else { ?>
                <a class="btn btn-warning" onclick="change_mode('monitor')"><i class="fa fa-expand"></i></a>
            <?php } ?>
            Dashboard ML Future Tech
        </h2>
    </div>

    <div class="col-xs-12 col-md-9 col-lg-8" style="padding-right: 0px;">
        <div class="row">
            <div class="col-xs-6 col-md-3 col-lg-3 text-center" style="padding-left: 0px">
                <?php
                $today_date_start = date("Y-m-d");
                $today_date_end = date("Y-m-d");
                $btn_day = 'btn_date_normal';
                if ($search['date_type'] == 'day') {
                    $btn_day = 'btn_date_active';
                }
                ?>
                <button class="btn btn-md btn_fixwidth <?php echo $btn_day; ?>"
                        onclick="send_date_search('<?php echo $today_date_start; ?>','<?php echo $today_date_end; ?>','day')"
                        style="margin-top: 17px">
                    วันนี้
                </button>
            </div>
            <!--    ///////////////สัปดาห์นี้-->
            <div class="col-xs-6 col-md-3 col-lg-3 text-center" style="padding-left: 0px">
                <?php
                $week_date_start = date("Y-m-d", strtotime('monday this week'));
                $week_date_end = date("Y-m-d", strtotime('sunday this week'));
                $btn_week = 'btn_date_normal';
                if ($search['date_type'] == 'week') {
                    $btn_week = 'btn_date_active';
                }
                ?>
                <button class="btn btn-md btn_fixwidth <?php echo $btn_week; ?>"
                        onclick="send_date_search('<?php echo $week_date_start; ?>','<?php echo $week_date_end; ?>','week')"
                        style="margin-top: 17px">
                    สัปดาห์นี้
                </button>
            </div>
            <!--    ///////////////เดือนนี้-->
            <div class="col-xs-6 col-md-3 col-lg-3 text-center" style="padding-left: 0px">
                <?php
                $month_date_start = date("Y-m-d", strtotime("first day of this month"));
                $month_date_end = date("Y-m-d", strtotime("last day of this month"));
                $btn_month = 'btn_date_normal';
                if ($search['date_type'] == 'month') {
                    $btn_month = 'btn_date_active';
                }
                ?>
                <button class="btn btn-md btn_fixwidth <?php echo $btn_month; ?>"
                        onclick="send_date_search('<?php echo $month_date_start; ?>','<?php echo $month_date_end; ?>','month')"
                        style="margin-top: 17px">
                    เดือนนี้
                </button>
            </div>
            <!--    ///////////////ปีนี้-->
            <div class="col-xs-6 col-md-3 col-lg-3 text-center" style="padding-left: 0px">
                <?php
                $year_date_start = date("Y") . '-01-01';
                $year_date_end = date("Y") . '-12-31';
                $btn_year = 'btn_date_normal';
                if ($search['date_type'] == 'year') {
                    $btn_year = 'btn_date_active';
                }
                ?>
                <button class="btn btn-md btn_fixwidth <?php echo $btn_year; ?>"
                        onclick="send_date_search('<?php echo $year_date_start; ?>','<?php echo $year_date_end; ?>','year')"
                        style="margin-top: 17px">
                    ปีนี้
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-md-3 col-lg-3 text-center" style="padding-left: 0px">
                <?php
                $today_date_start = date("Y-m-d", strtotime("-1 day"));
                $today_date_end = date("Y-m-d", strtotime("-1 day"));
                $btn_day = 'btn_date_normal';
                if ($search['date_type'] == 'yesterday') {
                    $btn_day = 'btn_date_active';
                }
                ?>
                <button class="btn btn-md btn_fixwidth <?php echo $btn_day; ?>"
                        onclick="send_date_search('<?php echo $today_date_start; ?>','<?php echo $today_date_end; ?>','yesterday')"
                        style="margin-top: 17px">
                    เมื่อวานนี้
                </button>
            </div>
            <!--    ///////////////สัปดาห์นี้-->
            <div class="col-xs-6 col-md-3 col-lg-3 text-center" style="padding-left: 0px">
                <?php
                $week_date_start = date("Y-m-d", strtotime("-6 day", strtotime('monday this week')));
                $week_date_end = date("Y-m-d", strtotime("-6 day", strtotime('sunday this week')));
                $btn_week = 'btn_date_normal';
                if ($search['date_type'] == 'last_week') {
                    $btn_week = 'btn_date_active';
                }
                ?>
                <button class="btn btn-md btn_fixwidth <?php echo $btn_week; ?>"
                        onclick="send_date_search('<?php echo $week_date_start; ?>','<?php echo $week_date_end; ?>','last_week')"
                        style="margin-top: 17px">
                    สัปดาห์ที่เเล้ว
                </button>
            </div>
            <!--    ///////////////เดือนนี้-->
            <div class="col-xs-6 col-md-3 col-lg-3 text-center" style="padding-left: 0px">
                <?php
                $month_date_start = date("Y-m-d", strtotime("-28 day", strtotime("first day of this month")));
                $month_date_end = date("Y-m-d", strtotime("-28 day", strtotime("last day of this month")));
                $btn_month = 'btn_date_normal';
                if ($search['date_type'] == 'last_month') {
                    $btn_month = 'btn_date_active';
                }
                ?>
                <button class="btn btn-md btn_fixwidth <?php echo $btn_month; ?>"
                        onclick="send_date_search('<?php echo $month_date_start; ?>','<?php echo $month_date_end; ?>','last_month')"
                        style="margin-top: 17px">
                    เดือนที่เเล้ว
                </button>
            </div>
            <!--    ///////////////ปีนี้-->
            <div class="col-xs-6 col-md-3 col-lg-3 text-center" style="padding-left: 0px">
                <div class="col-xs-4 col-md-4" style="padding: 3px">
                    <?php
                    $year_date_start = date("Y-m-d", strtotime("-30 day"));
                    $year_date_end = date("Y-m-d");
                    $btn_year = 'btn_date_normal';
                    if ($search['date_type'] == 'previous_30') {
                        $btn_year = 'btn_date_active';
                    }
                    ?>
                    <button class="btn btn-md btn_fixwidth <?php echo $btn_year; ?>"
                            onclick="send_date_search('<?php echo $year_date_start; ?>','<?php echo $year_date_end; ?>','previous_30')"
                            style="margin-top: 17px">
                        < 30
                    </button>
                </div>
                <div class="col-xs-4 col-md-4" style="padding: 3px">
                    <?php
                    $year_date_start = date("Y-m-d", strtotime("-90 day"));
                    $year_date_end = date("Y-m-d");
                    $btn_year = 'btn_date_normal';
                    if ($search['date_type'] == 'previous_90') {
                        $btn_year = 'btn_date_active';
                    }
                    ?>
                    <button class="btn btn-md btn_fixwidth <?php echo $btn_year; ?>"
                            onclick="send_date_search('<?php echo $year_date_start; ?>','<?php echo $year_date_end; ?>','previous_90')"
                            style="margin-top: 17px">
                        < 90
                    </button>
                </div>
                <div class="col-xs-4 col-md-4" style="padding: 3px">
                    <?php
                    $year_date_start = date("Y-m-d", strtotime("-180 day"));
                    $year_date_end = date("Y-m-d");
                    $btn_year = 'btn_date_normal';
                    if ($search['date_type'] == 'previous_180') {
                        $btn_year = 'btn_date_active';
                    }
                    ?>
                    <button class="btn btn-md btn_fixwidth <?php echo $btn_year; ?>"
                            onclick="send_date_search('<?php echo $year_date_start; ?>','<?php echo $year_date_end; ?>','previous_180')"
                            style="margin-top: 17px">
                        < 180
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!--    ///////////////custom-->
    <div class="col-xs-12 col-md-9 col-md-offset-3 col-lg-8 col-lg-offset-4" style="padding-right: 0px;">
        <form class="form_search group-btn-english-media" id="search_form" method="get"
              action="<?php echo $url_ajax . 'report_result'; ?>" style="margin-top: 17px">

            <input type="hidden" name="date_type" id="date_type" value="<?php echo $search['date_type']; ?>">
            <input type="hidden" name="mode" id="mode" value="<?php echo $search['mode']; ?>">
            <div class="col-xs-12 col-md-5 col-lg-5" style="padding-left: 0px;padding-right: 0px;">
            </div>
            <div class="col-xs-12 col-md-3 col-lg-3">
                <div class="input-group date">
                <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </span>
                    <input type="text"
                           placeholder="<?php echo $this->lang->line('label_search'); ?>"
                           class="input-sm form-control"
                           name="start_search" id="start_search"
                           data-value="<?php echo ($this->input->get('start_search')) ? $this->input->get('start_search') : date("Y-m-d"); ?>"
                           value="<?php echo ($this->input->get('start_search')) ? $this->input->get('start_search') : date("Y-m-d"); ?>"
                           autocomplete="off"
                           required
                           style="height: 36px;"
                        <?php echo $search_type == "1" ? "disabled" : ""; ?>
                    />
                </div>
            </div>
            <div class="col-xs-12 col-md-4 col-lg-4">
                <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </span>
                    <input type="text"
                           placeholder="<?php echo $this->lang->line('label_search'); ?>"
                           class="input-sm form-control"
                           name="end_search" id="end_search"
                           data-value="<?php echo ($this->input->get('end_search')) ? $this->input->get('end_search') : date("Y-m-d"); ?>"
                           value="<?php echo ($this->input->get('end_search')) ? $this->input->get('end_search') : date("Y-m-d"); ?>"
                           autocomplete="off"
                           required
                           style="height: 36px;"
                        <?php echo $search_type == "1" ? "disabled" : ""; ?>
                    />
                <span class="input-group-btn">
                    <button class="btn btn-md btn-search"
                            style="height: 36px;"
                            onclick="on_submit('input_date')"
                        <?php echo $search_type == "1" ? "disabled" : ""; ?>>
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </span>
                <span class="input-group-btn">
                    <button type="button"
                            class="btn btn-md get_all_data"
                            style="height: 36px;"
                            data-href="<?php echo base_url($modules) . ($this->input->get('mode') == 'monitor' ? '?mode=monitor' : ''); ?>"
                        <?php echo $search_type == "1" ? "disabled" : ""; ?>>
                            <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </span>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row">&nbsp;<br/></div>
<div class="row ">

    <div class="col-md-12">
        <ul class="nav nav-tabs">
            <li><a href="<?php echo base_url() . 'dashboard/index?' . $_SERVER['QUERY_STRING'] ?>">Graph
                    รายรับ-โอนคืน</a></li>
<!--            <li><a href="--><?php //echo base_url() . 'dashboard/agent?' . $_SERVER['QUERY_STRING'] ?><!--">Graph รายรับที่เกิดจากตัวแทน</a></li>-->
            <li><a href="<?php echo base_url() . 'dashboard/customer?' . $_SERVER['QUERY_STRING'] ?>">Detail ลูกค้า</a>
            </li>
            <li class="active"><a>Detail รายรับ-โอนคืน</a></li>
        </ul>

        <div class="tab-content">
            <div id="tab1" class="tab-pane fade in active">

                <br/>&nbsp;<br/>
                <div class="col-md-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h4><u>รายรับ</u> ตามช่วงเวลาที่กำหนด</h4>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-md-6 col-xs-6 col-sm-6">
                                    <h1 class="no-margins"><?php echo number_format($result_sum_order['total_non_ccard'], 2) ?></h1>
                                    <small>Non-CreditCard</small>
                                </div>
                                <div class="col-md-6 col-xs-6 col-sm-6">
                                    <h1 class="no-margins"><?php echo number_format($result_sum_order['total_ccard'], 1) ?></h1>
                                    <small>CreditCard</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">

                    <div class="panel panel-primary" style="cursor:pointer;" >
                        <div class="panel-heading">สรุปยอดรายรับ (ปัจจุบัน)</div>
                        <div class="panel-body" style="padding: 5px; height: 100px;text-align: center;">
                            <h1 class="font-bold"
                                style="margin: 0px; padding: 5px; color:darkgreenp; font-size: 30px; color:red;
                                    top:25%;position: relative;
                                ">
                                <?php echo number_format($result_sum_order['total_non_ccard'] + $result_sum_order['total_ccard'], 2) ?>
                            </h1>
<!--                            <div class="col-md-12">-->
<!--                                <div class="widget style1" style="color:red; padding: 0px;">-->
<!--                                    <div class="row"  >-->
<!--                                        <div class="col-xs-12 text-center">-->
<!--                                            <h1 class="font-bold"-->
<!--                                                style="margin: 0px; padding: 5px; color:darkgreenp; font-size: 28px">-->
<!--                                                --><?php //echo number_format($result_sum_order['total_non_ccard'] + $result_sum_order['total_ccard'], 2) ?>
<!--                                            </h1>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->

<!--                            <div class="col-md-6">-->
<!--                                <div class="widget style1 "-->
<!--                                     style="background-color:#fff; color:blue; margin: 0px; padding: 0px;">-->
<!--                                    <div class="row">-->
<!--                                        <div class="col-xs-12 text-center">-->
<!--                                            <span>Non-CreditCard</span>-->
<!--                                            <h3 class="font-bold">-->
<!--                                                --><?php //echo number_format($result_sum_order['total_non_ccard'], 2) ?>
<!--                                            </h3>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!---->
<!--                            <div class="col-md-6">-->
<!--                                <div class="widget style1 bg-default"-->
<!--                                     style="background-color:#fff; color:red;margin: 0px; padding: 0px;">-->
<!--                                    <div class="row">-->
<!--                                        <div class="col-xs-12 text-center">-->
<!--                                            <span>CreditCard</span>-->
<!--                                            <h3 class="font-bold">-->
<!--                                                --><?php //echo number_format($result_sum_order['total_ccard']) ?>
<!--                                            </h3>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->

                        </div>
                    </div>
                </div>

                <?php
                $amount_income = $result_sum_order['total_non_ccard'] + $result_sum_order['total_ccard'];
                $reward = 3.21;//$result_sum_order_payout['reward'];
                $amount_reward = (($amount_income * $reward) / 100);
                $cal_amount = (($amount_income * $reward) / 100) + $amount_income;

                ?>
                <div class="col-md-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h4><u>โอนคืน</u> ตามช่วงเวลาที่กำหนด</h4>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-md-6 col-xs-6 col-sm-6">
                                    <h1 class="no-margins"><?php echo number_format((($result_sum_order_payout['total_non_ccard'] * $reward) / 100) + $result_sum_order_payout['total_non_ccard'], 2) ?></h1>
                                    <small>Non-CreditCard</small>
                                </div>
                                <div class="col-md-6 col-xs-6 col-sm-6">
                                    <h1 class="no-margins"><?php echo number_format((($result_sum_order_payout['total_ccard'] * $reward) / 100) + $result_sum_order_payout['total_ccard'], 2) ?></h1>
                                    <small>CreditCard</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">

                    <div class="panel panel-danger" style="cursor:pointer;" >
                        <div class="panel-heading">สรุปยอดโอนคืน</div>
                        <div class="panel-body" style=" height: 100px; padding: 0px;">


                            <div class="col-md-12" style="padding: 0px;;">
                                <div class="widget style1" style="color:red; padding: 0px; margin-top: 0px;">
                                    <div class="row" style="margin: 0px; border-bottom: 1px solid #ccc ">
                                        <div class="col-xs-12 text-center">
                                            <h1 class="font-bold" style="margin: 0px; padding: 5px;">
                                                <?php echo number_format($cal_amount, 2) ?>
                                            </h1>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="widget style1 "
                                     style="background-color:#fff; color:blue; margin: 0px; padding: 0px;">
                                    <div class="row">
                                        <div class="col-xs-12 text-center">
                                            <span>ยอดรวมรายรับ</span>
                                            <h3 class="font-bold">
                                                <?php echo number_format($amount_income, 2) ?>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="widget style1 bg-default"
                                     style="background-color:#fff; color:red;margin: 0px; padding: 0px;">
                                    <div class="row">
                                        <div class="col-xs-12 text-center">
                                            <span>คำนวนส่วนต่าง</span>
                                            <h3 class="font-bold">
                                                <?php echo number_format($amount_reward, 2) ?>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="ibox float-e-margins container-follow" id="container-receive">
                        <div class="ibox-title">
                            <h5>รายการรายรับ ตามช่วงเวลาที่กำหนด</h5>
                        </div>
                        <div class="ibox-content" style="height:400px; overflow-y: scroll;">
                            <div id="table-customer" class="table table-responsive">
                                <table class="table table-striped hd-grey">
                                    <thead>
                                    <tr>
                                        <th>Request no.</th>
                                        <th>ชื่อลูกค้า</th>
                                        <th>ชื่อพนักงานขาย / ตัวเเทน</th>
                                        <th>ยอดชำระ</th>
                                        <th>วันที่ซื้อเเพ็คเเก็จ</th>
                                        <th>สถานะ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if ($result_list_order):
                                        foreach ($result_list_order as $key => $value):
                                            ?>
                                            <tr>
                                                <td style="width:50px"><?php echo $value['invoice_no'] ?></td>
                                                <td><?php echo $value['billing_name'] ?></td>
                                                <td><?php echo $value['billing_tel'] ?></td>
                                                <td><?php echo number_format($value['total_net'],2) ?></td>
                                                <td><?php echo date("d/m/Y",strtotime("+543 year",strtotime($value['paid_date']))) ?></td>
                                                <?php
                                                if($value['order_status']=="P" && $value['payment_status']=="SC"){
                                                    $str_status= "ชำระเงินสำเร็จ";
                                                    $color_status = "green";
                                                }else if($value['payment_status']=="CL" || $value['payment_status']=="FL"){
                                                    $str_status= "ยกเลิกการชำระเงิน";
                                                    $color_status = "red";
                                                }else if($value['order_status']=="P" && $value['payment_status']=="PD"){
                                                    $str_status= "รอการชำระเงิน";
                                                    $color_status = "orange";
                                                }else{
                                                    $str_status= "ดำเนินการสำเร็จ";
                                                    $color_status = "green";
                                                }
                                                ?>
                                                <td style="color:<?php echo $color_status?>">
                                                    <?php echo $str_status ?>
                                                </td>
                                            </tr>
                                            <?php
                                        endforeach;
                                    endif;

                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <br/><br/>
                    <div class="ibox float-e-margins container-follow" id="container-receive">
                        <div class="ibox-title">
                            <h5>รายการรอโอนคืน ตามช่วงเวลาที่กำหนด</h5>
                        </div>
                        <div class="ibox-content" style="height:400px; overflow-y: scroll;">
                            <div id="table-customer" class="table table-responsive">
                                <table class="table table-striped hd-grey">
                                    <thead>
                                    <tr>
                                        <th>Request no.</th>
                                        <th>ชื่อลูกค้า</th>
                                        <th>ชื่อพนักงานขาย / ตัวเเทน</th>
                                        <th>ยอดชำระ</th>
                                        <th>วันที่ซื้อเเพ็คเเก็จ</th>
                                        <th>สถานะ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if ($result_list_order):
                                        foreach ($result_list_order as $key => $value):
                                            ?>
                                            <tr>
                                                <td style="width:50px"><?php echo $value['invoice_no'] ?></td>
                                                <td><?php echo $value['billing_name'] ?></td>
                                                <td><?php echo $value['billing_tel'] ?></td>
                                                <td><?php echo number_format($value['total_net'],2) ?></td>
                                                <td><?php echo date("d/m/Y",strtotime("+543 year",strtotime($value['paid_date']))) ?></td>
                                                <?php
                                                if($value['order_status']=="P" && $value['payment_status']=="SC"){
                                                    $str_status= "รอโอนคืน";
                                                    $color_status = "red";
                                                }else if($value['order_status']=="S" ){
                                                    $str_status= "โอนคืนสำเร็จ";
                                                    $color_status = "green";
                                                }else{
                                                    $str_status= "รอตรวจสอบ";
                                                    $color_status = "orange";
                                                }
                                                ?>
                                                <td style="color:<?php echo $color_status?>">
                                                    <?php echo $str_status ?>
                                                </td>
                                            </tr>
                                            <?php
                                        endforeach;
                                    endif;

                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div id="container1" style="width: auto !important; "></div>
                </div>
            </div>
        </div>
    </div>


</div>

<div class="row"><br/>&nbsp;<br/>&nbsp;<br/>&nbsp;</div>

