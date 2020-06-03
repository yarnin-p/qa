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
                $today_date_start = date("Y-m-d",strtotime("-1 day"));
                $today_date_end = date("Y-m-d",strtotime("-1 day"));
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
                $week_date_start = date("Y-m-d", strtotime("-6 day",strtotime('monday this week')));
                $week_date_end = date("Y-m-d", strtotime("-6 day",strtotime('sunday this week')));
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
                $month_date_start = date("Y-m-d", strtotime("-28 day",strtotime("first day of this month")));
                $month_date_end = date("Y-m-d", strtotime("-28 day",strtotime("last day of this month")));
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
                    $year_date_start = date("Y-m-d",strtotime("-30 day"));
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
                <div class="col-xs-4 col-md-4"  style="padding: 3px">
                    <?php
                    $year_date_start = date("Y-m-d",strtotime("-90 day"));
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
                <div class="col-xs-4 col-md-4"  style="padding: 3px">
                    <?php
                    $year_date_start = date("Y-m-d",strtotime("-180 day"));
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
              action="<?php echo $url_ajax . 'customer'; ?>" style="margin-top: 17px">

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
<div class="row">&nbsp;<br /></div>
<div class="row ">

    <div class="col-md-12">
        <ul class="nav nav-tabs">
            <li  ><a href="<?php echo base_url().'dashboard/index?'.$_SERVER['QUERY_STRING'] ?>">Graph รายรับ-โอนคืน</a></li>
<!--            <li><a href="--><?php //echo base_url().'dashboard/agent?'.$_SERVER['QUERY_STRING'] ?><!--">Graph รายรับที่เกิดจากตัวแทน</a></li>-->
            <li class="active"><a >Detail ลูกค้า</a></li>
            <li><a href="<?php echo base_url().'dashboard/report_result?'.$_SERVER['QUERY_STRING'] ?>">Detail รายรับ-โอนคืน</a></li>
        </ul>

        <div class="tab-content">
            <div id="tab1" class="tab-pane fade in active">

                <div class="row">
                    <div class="col-md-12">
                        <div id="table-customer" class="table table-responsive">

                            <table class="table table-striped hd-grey">
                                <thead>
                                   <tr>
                                       <th rowspan="2" style="width:50px">No</th>
                                       <th rowspan="2">ชื่อลูกค้า</th>
                                       <!--                                    <th rowspan=2>อีเมล</th>-->
                                       <th rowspan="2">เบอร์โทรศัพท์</th>
                                       <th colspan="2" style="width: 150px" class="text-center">Non-Credit Card</th>
                                       <th colspan="2" style="width: 150px" class="text-center">บัตรเครดิต</th>
                                       <th rowspan="2">ยอดรวม</th>
                                       <th rowspan="2">บัญชีรับเงินคืน</th>
                                       <th rowspan="2">สมัครมาเมื่อ</th>
                                       <th rowspan="2">Agent Code</th>
                                       <th rowspan="2">From</th>
                                   </tr>
                                   <tr>
                                       <th class="text-center">จำนวน</th>
                                       <th class="text-center">ยอดเงิน</th>
                                       <!--                                    <th rowspan=2>อีเมล</th>-->
                                       <th class="text-center">จำนวน</th>
                                       <th class="text-center">ยอดเงิน</th>

                                   </tr>
                                </thead>
                                <tbody>
                                <?php if($result['result']):
                                    foreach ($result['result'] as $key=>$value):
                                ?>
                                    <tr>
                                        <td style="width: 50px;"><?php echo ($key+1) ?></td>
                                        <td  ><?php echo $value['fullname'] ?></td>
<!--                                        <td>--><?php //echo $value['email'] ?><!--</td>-->
                                        <td ><?php echo $value['telephone'] ?></td >
                                        <td class="text-center"><?php echo number_format($value['countItem'],0) ?></td>
                                        <td class="text-right"><?php echo number_format($value['total_non_ccard'],2) ?></td>
                                        <td class="text-center"><?php echo number_format($value['countItem'],0) ?></td>
                                        <td class="text-right"><?php echo number_format($value['total_ccard'],2) ?></td>
                                        <td class="text-right"><?php echo number_format($value['total_non_ccard']+$value['total_ccard'],2) ?></td>
                                        <td class="text-left">
                                            <?php
                                            if(!empty($value['cashback_bank_1']) && !empty($value['cashback_account_no_1'])){

//                                                $type_bank = ($value['agent_bank_account_type']=="S") ? "บัญชีออมทรัพย์" : "บัญชีกระเเสรายวัน";

//                                                echo '<b><u>ธนาคาร</u></b> '.$this->general->getBankName($value['cashback_bank_1']).'<br />';
//                                                echo '<b><u>เลขที่บัญชี</u></b> '.$value['cashback_account_no_1'].'<br />';
//                                                echo '<b><u>ชื่อ</u></b> '.$value['cashback_name_1'].'<br />';
//                                                echo '<b><u>สาขา</u></b> '.$value['cashback_department_1'];
                                            }else{
                                                echo "-";
                                            }
                                            ?>
                                        </td>
                                        <td ><?php echo date("d/m/Y H:i",strtotime("+543 year",strtotime($value['created_date']))) ?></td>
                                        <td ><?php echo $value['param_agent'] ?></td>
                                        <td >
                                            <?php
                                                if($value['location_country']=="TH"){
                                                    echo "Thailand";
                                                }else  if($value['location_country']=="CN"){
                                                    echo "China";
                                                }else{
                                                    echo "Other";
                                                }

                                            ?>
                                        </td>
                                    </tr>
                                        <?php
                                            endforeach;
                                        endif;
                                        ?>
                                </tbody>
                            </table>

                            <?php echo $this->pagination->aftertable(); ?>
                        </div>
                    </div>


                </div>

            </div>
            <div id="tab2" class="tab-pane fade">
                &nbsp;
            </div>
        </div>
    </div>


</div>

<div class="row"><br />&nbsp;<br />&nbsp;<br />&nbsp;</div>

