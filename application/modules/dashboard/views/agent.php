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
              action="<?php echo $url_ajax . 'agent'; ?>" style="margin-top: 17px">

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
            <li class="active"><a >Graph รายรับที่เกิดจากตัวแทน</a></li>
            <li><a href="<?php echo base_url().'dashboard/customer?'.$_SERVER['QUERY_STRING'] ?>">Detail ลูกค้า</a></li>
            <li><a href="<?php echo base_url().'dashboard/report_result?'.$_SERVER['QUERY_STRING'] ?>">Detail รายรับ-โอนคืน</a></li>
        </ul>

        <div class="tab-content">
            <div id="tab1" class="tab-pane fade in active">


                <div class="row">

                    <div class="col-md-4">
                        <div id="chart-income-agent" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                    </div>

                    <div class="col-md-4">
                        <div id="chart-income-payment-type" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                    </div>

                    <div class="col-md-4">
                        <div id="chart-income-ranking" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                    </div>


                </div>

                <div class="row"><br />&nbsp;<br /></div>

                <div class="row">
                    <div class="col-md-4">
                        <div id="chart-income-day" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                    </div>

                    <div class="col-md-4">
                        <div id="chart-income-no-day" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                    </div>

                    <div class="col-md-4">
                        <div id="chart-income-hour" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
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
