<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Dashboard extends MY_Controller
{

    protected $modules = "dashboard";
    private $model = "dashboard_model";

    function __construct()
    {
        parent::__construct();
        
        // Check Permission Access
        $this->permission->checkLogin();
        $this->permission->loadPermissionScreen($this->modules);

        $this->output_data["url_ajax"] = base_url() . $this->modules . '/';
        $this->output_data["modules"] = $this->modules;
        $this->lang->load($this->modules, $this->language);
        // load model
        $this->load->model($this->model, "main_model");
    }

    public function index()
    {
        // meta html
        $this->output_data["title"] .= str_replace("_", " ", $this->modules);
        // search and select data
        $search = array(
            'date_type' => 'day',
            'start_search' => date("Y-m-d"),
            'end_search' => date("Y-m-d"),
            'mode' => '',
        );

        // IF Search
        $search = $this->setSearch($search);
        $this->output_data['search'] = $search;

        // protect sql injection
        foreach ($search as $key => $value) {
            $search[$key] = addslashes($value);
        }

        $this->output_data["result_noti_approved"] = $this->main_model->getNotiApprovedProduct();



        // css style in header
        $this->output_data["css"] = $this->load->view('index_css', $this->output_data, true);

        $this->output_data["header"] = 'header';
        $this->output_data["footer"] = 'footer';

        // javascript, jquery in footer
        $this->output_data["js"] = $this->load->view('index_js', $this->output_data, true);
        $this->output_data["js"] .= $this->load->view('data_js', $this->output_data, true);

        // load views
        if($search['mode'] == 'monitor'){
            $this->template->load($this->output_data, 'present_dashboard', $this->modules, 'index');
        }else{
            $this->template->load($this->output_data, 'default', $this->modules, 'index');
        }
    }

    public function report_result(){
        // meta html
        $this->output_data["title"] .= str_replace("_", " ", $this->modules);
        // search and select data
        $search = array(
            'date_type' => 'day',
            'start_search' => date("Y-m-d"),
            'end_search' => date("Y-m-d"),
            'mode' => '',
        );

        // IF Search
        $search = $this->setSearch($search);
        $this->output_data['search'] = $search;

        // protect sql injection
        foreach ($search as $key => $value) {
            $search[$key] = addslashes($value);
        }

        $this->output_data["result_sum_order"] = $this->main_model->select_data_sum_order($search);
        $this->output_data["result_sum_order_payout"] = $this->main_model->select_data_sum_order_payout($search);

        $this->output_data["result_list_order"] = $this->main_model->select_order_list($search);
        $this->output_data["result_list_payout"] = $this->main_model->select_order_payout($search);

        // css style in header
        $this->output_data["css"] = $this->load->view('index_css', $this->output_data, true);

        $this->output_data["header"] = 'header';
        $this->output_data["footer"] = 'footer';

        // javascript, jquery in footer
        $this->output_data["js"] = $this->load->view('index_js', $this->output_data, true);
        $this->output_data["js"] .= $this->load->view('data_income_js', $this->output_data, true);

        // load views
        if($search['mode'] == 'monitor'){
            $this->template->load($this->output_data, 'present_dashboard', $this->modules, 'result');
        }else{
            $this->template->load($this->output_data, 'default', $this->modules, 'result');
        }
    }


    public function agent()
    {
        // meta html
        $this->output_data["title"] .= str_replace("_", " ", $this->modules);
        // search and select data
        $search = array(
            'date_type' => 'day',
            'start_search' => date("Y-m-d"),
            'end_search' => date("Y-m-d"),
            'mode' => '',
        );

        // IF Search
        $search = $this->setSearch($search);
        $this->output_data['search'] = $search;

        // protect sql injection
        foreach ($search as $key => $value) {
            $search[$key] = addslashes($value);
        }

        // css style in header
        $this->output_data["css"] = $this->load->view('index_css', $this->output_data, true);

        $this->output_data["header"] = 'header';
        $this->output_data["footer"] = 'footer';

        // javascript, jquery in footer
        $this->output_data["js"] = $this->load->view('index_js', $this->output_data, true);
        $this->output_data["js"] .= $this->load->view('data_agent_js', $this->output_data, true);

        // load views
        if($search['mode'] == 'monitor'){
            $this->template->load($this->output_data, 'present_dashboard', $this->modules, 'agent');
        }else{
            $this->template->load($this->output_data, 'default', $this->modules, 'agent');
        }
    }



    public function customer()
    {

        $this->output_data["modules"] = $this->modules.'/customer';
        // meta html
        $this->output_data["title"] .= str_replace("_", " ", $this->modules);
        // search and select data
        $search = array(
            'date_type' => 'day',
            'start_search' => date("Y-m-d"),
            'end_search' => date("Y-m-d"),
            'mode' => '',
        );

        // IF Search
        $search = $this->setSearch($search);
        $this->output_data['search'] = $search;

        // protect sql injection
        foreach ($search as $key => $value) {
            $search[$key] = addslashes($value);
        }

        $order_by = ($this->input->get('orderby')) ? $this->input->get('orderby') : $this->sorting_column;
        $order_type = ($this->input->get('ordertype')) ? $this->input->get('ordertype') : $this->sorting_type;
        $limit = ($this->input->get('limit')) ? $this->input->get('limit') : $this->config->config['limit'][0];
        $page = ($this->input->get('page')) ? $this->input->get('page') : $this->config->config['first_page_no'];
        $this->output_data['order'] = array('type' => $order_type, 'by' => $order_by, 'limit' => $limit, 'page' => $page, 'main' => $this->sorting_column);

        $this->output_data["result"] = $this->main_model->select_data_member_sum($search, $order_type, $order_by, $limit, $page);

        // css style in header
        $this->output_data["css"] = $this->load->view('index_css', $this->output_data, true);

        $this->output_data["header"] = 'header';
        $this->output_data["footer"] = 'footer';

        // javascript, jquery in footer
        $this->output_data["js"] = $this->load->view('index_js', $this->output_data, true);
        $this->output_data["js"] .= $this->load->view('data_customer_js', $this->output_data, true);

        // load views
        if($search['mode'] == 'monitor'){
            $this->template->load($this->output_data, 'present_dashboard', $this->modules, 'customer');
        }else{
            $this->template->load($this->output_data, 'default', $this->modules, 'customer');
        }
    }


    /*********************************/
    /*  TAB 1 :: Graph รายรับ-โอนคืน  */
    /*********************************/
    public function get_monday_to_sunday(){

        $search = array(
            'date_type' => 'day',
            'start_search' => date("Y-m-d"),
            'end_search' => date("Y-m-d")
        );

        // IF Search
        $search = $this->setSearch($search);
        $this->output_data['search'] = $search;

        // protect sql injection
        foreach ($search as $key => $value) {
            $search[$key] = addslashes($value);
        }

        $data_order_income = $this->main_model->select_data_order_compay($search);
        $data_order_outcome = $this->main_model->select_data_order_compay_outcome($search);

        //INCOME
        $setDataOfDays['Monday'] = [];
        $setDataOfDays['Tuesday'] = [];
        $setDataOfDays['Wednesday'] = [];
        $setDataOfDays['Thursday'] = [];
        $setDataOfDays['Friday'] = [];
        $setDataOfDays['Saturday'] = [];
        $setDataOfDays['Sunday'] = [];

        if($data_order_income){
            foreach ($data_order_income as $key=>$value){
                $setDataOfDays[date("l",strtotime($value['paid_date']))][] = $value['total_net'];
            }
        }
        $setDataOfDays['Monday']    =  (count($setDataOfDays['Monday'])>0) ? array_sum($setDataOfDays['Monday']) / count($setDataOfDays['Monday']) : 0;
        $setDataOfDays['Tuesday']   =  (count($setDataOfDays['Tuesday'])>0) ? array_sum($setDataOfDays['Tuesday']) / count($setDataOfDays['Tuesday']) : 0;
        $setDataOfDays['Wednesday'] =  (count($setDataOfDays['Wednesday'])>0) ? array_sum($setDataOfDays['Wednesday']) / count($setDataOfDays['Wednesday']) : 0;
        $setDataOfDays['Thursday']  =  (count($setDataOfDays['Thursday'])>0) ? array_sum($setDataOfDays['Thursday']) / count($setDataOfDays['Thursday']) : 0;
        $setDataOfDays['Friday']    =  (count($setDataOfDays['Friday'])>0) ? array_sum($setDataOfDays['Friday']) / count($setDataOfDays['Friday']) : 0;
        $setDataOfDays['Saturday']  =  (count($setDataOfDays['Saturday'])>0) ? array_sum($setDataOfDays['Saturday']) / count($setDataOfDays['Saturday']) : 0;
        $setDataOfDays['Sunday']    =  (count($setDataOfDays['Sunday'])>0) ? array_sum($setDataOfDays['Sunday']) / count($setDataOfDays['Sunday']) : 0;

        //Convert key , value
        $output['category_name'] =[];
        $output['income'] =[];
        foreach ($setDataOfDays as $key=>$value){
            $output['category_name'][] = $key;
            $output['income'][] = $value;
        }

        //OUTCOME
        $setDataOfDays['Monday'] = [];
        $setDataOfDays['Tuesday'] = [];
        $setDataOfDays['Wednesday'] = [];
        $setDataOfDays['Thursday'] = [];
        $setDataOfDays['Friday'] = [];
        $setDataOfDays['Saturday'] = [];
        $setDataOfDays['Sunday'] = [];

        if($data_order_outcome){
            foreach ($data_order_outcome as $key=>$value){
                $setDataOfDays[date("l",strtotime($value['paid_date']))][] = (($value['total_net']*$value['reward'])/100)+$value['total_net'];
            }
        }
        $setDataOfDays['Monday']    =  (count($setDataOfDays['Monday'])>0) ? array_sum($setDataOfDays['Monday']) / count($setDataOfDays['Monday']) : 0;
        $setDataOfDays['Tuesday']   =  (count($setDataOfDays['Tuesday'])>0) ? array_sum($setDataOfDays['Tuesday']) / count($setDataOfDays['Tuesday']) : 0;
        $setDataOfDays['Wednesday'] =  (count($setDataOfDays['Wednesday'])>0) ? array_sum($setDataOfDays['Wednesday']) / count($setDataOfDays['Wednesday']) : 0;
        $setDataOfDays['Thursday']  =  (count($setDataOfDays['Thursday'])>0) ? array_sum($setDataOfDays['Thursday']) / count($setDataOfDays['Thursday']) : 0;
        $setDataOfDays['Friday']    =  (count($setDataOfDays['Friday'])>0) ? array_sum($setDataOfDays['Friday']) / count($setDataOfDays['Friday']) : 0;
        $setDataOfDays['Saturday']  =  (count($setDataOfDays['Saturday'])>0) ? array_sum($setDataOfDays['Saturday']) / count($setDataOfDays['Saturday']) : 0;
        $setDataOfDays['Sunday']    =  (count($setDataOfDays['Sunday'])>0) ? array_sum($setDataOfDays['Sunday']) / count($setDataOfDays['Sunday']) : 0;

        //Convert key , value
        $output['outcome'] =[];
        foreach ($setDataOfDays as $key=>$value){
            $output['outcome'][] = $value;
        }

        echo json_encode($output);exit();

    }

    public function get_all_day_month(){

        $search = array(
            'date_type' => 'day',
            'start_search' => date("Y-m-d"),
            'end_search' => date("Y-m-d")
        );

        // IF Search
        $search = $this->setSearch($search);
        $this->output_data['search'] = $search;

        // protect sql injection
        foreach ($search as $key => $value) {
            $search[$key] = addslashes($value);
        }

        $data_order_income = $this->main_model->select_data_order_compay($search);
        $data_order_outcome = $this->main_model->select_data_order_compay_outcome($search);


        //INCOME
        $setDataOfDaysNum = [];
        for($i=1;$i<=date('t'); $i++){
            $setDataOfDaysNum[$i] = [];
        }

        if($data_order_income){
            foreach ($data_order_income as $key=>$value){
                $setDataOfDaysNum[(int)date("d",strtotime($value['paid_date']))][] = $value['total_net'];
            }
        }

        for($i=1;$i<=date('t'); $i++){
            $setDataOfDaysNum[$i] = (count($setDataOfDaysNum[$i])>0) ? array_sum($setDataOfDaysNum[$i]) / count($setDataOfDaysNum[$i]) : 0;
        }
        //Convert key , value
        $output['category_name'] =[];
        $output['income'] =[];
        ksort($setDataOfDaysNum);
        foreach ($setDataOfDaysNum as $key=>$value){
            $output['category_name'][] = $key;
            $output['income'][] = $value;
        }

        //OUTCOME
        $setDataOfDaysNum = [];
        for($i=1;$i<=date('t'); $i++){
            $setDataOfDaysNum[$i] = [];
        }

        if($data_order_outcome){
            foreach ($data_order_outcome as $key=>$value){
                $setDataOfDaysNum[(int)date("d",strtotime($value['paid_date']))][] = (($value['total_net']*$value['reward'])/100)+$value['total_net'];
            }
        }

        for($i=1;$i<=date('t'); $i++){
            $setDataOfDaysNum[$i] = (count($setDataOfDaysNum[$i])>0) ? array_sum($setDataOfDaysNum[$i]) / count($setDataOfDaysNum[$i]) : 0;
        }
        //Convert key , value
        $output['outcome'] =[];
        ksort($setDataOfDaysNum);
        foreach ($setDataOfDaysNum as $key=>$value){
            $output['outcome'][] = $value;
        }
        echo json_encode($output);exit();
    }

    public function get_all_hour_month(){

        $search = array(
            'date_type' => 'day',
            'start_search' => date("Y-m-d"),
            'end_search' => date("Y-m-d")
        );

        // IF Search
        $search = $this->setSearch($search);
        $this->output_data['search'] = $search;

        // protect sql injection
        foreach ($search as $key => $value) {
            $search[$key] = addslashes($value);
        }
        $data_order_income = $this->main_model->select_data_order_compay($search);
        $data_order_outcome = $this->main_model->select_data_order_compay_outcome($search);

        //Income
        $setDataOfDaysNum = [];
        for($i=1;$i<=24; $i++){
            $setDataOfDaysNum[$i] = [];
        }
        if($data_order_income){
            foreach ($data_order_income as $key=>$value){
                $setDataOfDaysNum[(int)date("H",strtotime($value['paid_date']))][] = $value['total_net'];
            }
        }
        for($i=1;$i<=24; $i++){
            $setDataOfDaysNum[$i] = (count($setDataOfDaysNum[$i])>0) ? array_sum($setDataOfDaysNum[$i]) / count($setDataOfDaysNum[$i]) : 0;
        }
        //Convert key , value
        $output['category_name'] =[];
        $output['income'] =[];
        ksort($setDataOfDaysNum);
        foreach ($setDataOfDaysNum as $key=>$value){
            $output['category_name'][] = $key;
            $output['income'][] = $value;
        }


        //OutCome
        $setDataOfDaysNum = [];
        for($i=1;$i<=24; $i++){
            $setDataOfDaysNum[$i] = [];
        }
        if($data_order_outcome){
            foreach ($data_order_outcome as $key=>$value){
                $setDataOfDaysNum[(int)date("H",strtotime($value['paid_date']))][] = ($value['total_net']*$value['reward']/100)+$value['total_net'];
            }
        }
        for($i=1;$i<=24; $i++){
            $setDataOfDaysNum[$i] = (count($setDataOfDaysNum[$i])>0) ? array_sum($setDataOfDaysNum[$i]) / count($setDataOfDaysNum[$i]) : 0;
        }
        //Convert key , value
        $output['outcome'] =[];
        ksort($setDataOfDaysNum);
        foreach ($setDataOfDaysNum as $key=>$value){
            $output['outcome'][] = $value;
        }

        echo json_encode($output);exit();

    }

    public function get_payment_type(){

        $search = array(
            'date_type' => 'day',
            'start_search' => date("Y-m-d"),
            'end_search' => date("Y-m-d")
        );

        // IF Search
        $search = $this->setSearch($search);
        $this->output_data['search'] = $search;

        // protect sql injection
        foreach ($search as $key => $value) {
            $search[$key] = addslashes($value);
        }
        $data_order_income = $this->main_model->select_data_order_compay($search);
        $data_order_outcome = $this->main_model->select_data_order_compay_outcome($search);

        //INCOME
        $setDataOfPaymentType['VISA'] = [];
        $setDataOfPaymentType['MasterCard'] = [];
        $setDataOfPaymentType['WeChat'] = [];
        $setDataOfPaymentType['Other'] = [];

        if($data_order_income){

            foreach ($data_order_income as $key=>$value){

                if($value['payment_method']=="Master"){
                    $addKey = "MasterCard";
                }else if($value['payment_method']=="VISA"){
                    $addKey = "VISA";
                }else if($value['payment_method']=="wechat"){
                    $addKey = "WeChat";
                }else{
                    $addKey = "Other";
                }

                $setDataOfPaymentType[$addKey][] = $value['total_net'];
            }

        }

        $setDataOfPaymentType['VISA']    =  (count($setDataOfPaymentType['VISA'])>0) ? array_sum($setDataOfPaymentType['VISA']) / count($setDataOfPaymentType['VISA']) : 0;
        $setDataOfPaymentType['MasterCard']   =  (count($setDataOfPaymentType['MasterCard'])>0) ? array_sum($setDataOfPaymentType['MasterCard']) / count($setDataOfPaymentType['MasterCard']) : 0;
        $setDataOfPaymentType['WeChat'] =  (count($setDataOfPaymentType['WeChat'])>0) ? array_sum($setDataOfPaymentType['WeChat']) / count($setDataOfPaymentType['WeChat']) : 0;
        if(count($setDataOfPaymentType['Other'])==0){
            unset($setDataOfPaymentType['Other']);
        }else{
            $setDataOfPaymentType['Other'] =  (count($setDataOfPaymentType['Other'])>0) ? array_sum($setDataOfPaymentType['Other']) / count($setDataOfPaymentType['Other']) : 0;
        }

        //Convert key , value
        $output['category_name'] =[];
        $output['income'] =[];
        foreach ($setDataOfPaymentType as $key=>$value){
            $output['category_name'][] = $key;
            $output['income'][] = $value;
        }

        //OUTCOME
        $setDataOfPaymentType['VISA'] = [];
        $setDataOfPaymentType['MasterCard'] = [];
        $setDataOfPaymentType['WeChat'] = [];
        $setDataOfPaymentType['Other'] = [];

        if($data_order_outcome){

            foreach ($data_order_outcome as $key=>$value){

                if($value['payment_method']=="Master"){
                    $addKey = "MasterCard";
                }else if($value['payment_method']=="VISA"){
                    $addKey = "VISA";
                }else if($value['payment_method']=="wechat"){
                    $addKey = "WeChat";
                }else{
                    $addKey = "Other";
                }

                $setDataOfPaymentType[$addKey][] = (($value['total_net']*$value['reward'])/100)+$value['total_net'];
            }

        }

        $setDataOfPaymentType['VISA']    =  (count($setDataOfPaymentType['VISA'])>0) ? array_sum($setDataOfPaymentType['VISA']) / count($setDataOfPaymentType['VISA']) : 0;
        $setDataOfPaymentType['MasterCard']   =  (count($setDataOfPaymentType['MasterCard'])>0) ? array_sum($setDataOfPaymentType['MasterCard']) / count($setDataOfPaymentType['MasterCard']) : 0;
        $setDataOfPaymentType['WeChat'] =  (count($setDataOfPaymentType['WeChat'])>0) ? array_sum($setDataOfPaymentType['WeChat']) / count($setDataOfPaymentType['WeChat']) : 0;
        if(count($setDataOfPaymentType['Other'])==0){
            unset($setDataOfPaymentType['Other']);
        }else{
            $setDataOfPaymentType['Other'] =  (count($setDataOfPaymentType['Other'])>0) ? array_sum($setDataOfPaymentType['Other']) / count($setDataOfPaymentType['Other']) : 0;
        }

        //Convert key , value
        $output['outcome'] =[];
        foreach ($setDataOfPaymentType as $key=>$value){
            $output['outcome'][] = $value;
        }

        echo json_encode($output);exit();

    }

    public function get_device(){

        $search = array(
            'date_type' => 'day',
            'start_search' => date("Y-m-d"),
            'end_search' => date("Y-m-d")
        );

        // IF Search
        $search = $this->setSearch($search);
        $this->output_data['search'] = $search;

        // protect sql injection
        foreach ($search as $key => $value) {
            $search[$key] = addslashes($value);
        }
        $data_order_income = $this->main_model->select_data_order_compay($search);
        $data_order_outcome = $this->main_model->select_data_order_compay_outcome($search);


        //INCOME
        $setDataOfDevice['Mobile'] = [];
        $setDataOfDevice['Browser'] = [];
        $setDataOfDevice['Other'] = [];

        if($data_order_income){

            foreach ($data_order_income as $key=>$value){

                if($value['log_device']=="mobile"){
                    $addKey = "Mobile";
                }else if($value['log_device']=="browser"){
                    $addKey = "Browser";
                }else{
                    $addKey = "Other";
                }

                $setDataOfDevice[$addKey][] = $value['total_net'];
            }
        }

        $setDataOfDevice['Mobile']    =  (count($setDataOfDevice['Mobile'])>0) ? array_sum($setDataOfDevice['Mobile']) / count($setDataOfDevice['Mobile']) : 0;
        $setDataOfDevice['Browser']   =  (count($setDataOfDevice['Browser'])>0) ? array_sum($setDataOfDevice['Browser']) / count($setDataOfDevice['Browser']) : 0;
        if(count($setDataOfDevice['Other'])==0){
            unset($setDataOfDevice['Other']);
        }else{
            $setDataOfDevice['Other'] =  (count($setDataOfDevice['Other'])>0) ? array_sum($setDataOfDevice['Other']) / count($setDataOfDevice['Other']) : 0;
        }

        //Convert key , value
        $output['category_name'] =[];
        $output['income'] =[];
        foreach ($setDataOfDevice as $key=>$value){
            $output['category_name'][] = $key;
            $output['income'][] = $value;
        }

        //OUTCOME
        $setDataOfDevice['Mobile'] = [];
        $setDataOfDevice['Browser'] = [];
        $setDataOfDevice['Other'] = [];

        if($data_order_outcome){

            foreach ($data_order_outcome as $key=>$value){

                if($value['log_device']=="mobile"){
                    $addKey = "Mobile";
                }else if($value['log_device']=="browser"){
                    $addKey = "Browser";
                }else{
                    $addKey = "Other";
                }

                $setDataOfDevice[$addKey][] = (($value['total_net']*$value['reward'])/100)+$value['total_net'];
            }
        }

        $setDataOfDevice['Mobile']    =  (count($setDataOfDevice['Mobile'])>0) ? array_sum($setDataOfDevice['Mobile']) / count($setDataOfDevice['Mobile']) : 0;
        $setDataOfDevice['Browser']   =  (count($setDataOfDevice['Browser'])>0) ? array_sum($setDataOfDevice['Browser']) / count($setDataOfDevice['Browser']) : 0;
        if(count($setDataOfDevice['Other'])==0){
            unset($setDataOfDevice['Other']);
        }else{
            $setDataOfDevice['Other'] =  (count($setDataOfDevice['Other'])>0) ? array_sum($setDataOfDevice['Other']) / count($setDataOfDevice['Other']) : 0;
        }

        //Convert key , value
        $output['outcome'] =[];
        foreach ($setDataOfDevice as $key=>$value){
            $output['outcome'][] = $value;
        }



        echo json_encode($output);exit();
    }

    public function get_location_order_avg(){

        $search = array(
            'date_type' => 'day',
            'start_search' => date("Y-m-d"),
            'end_search' => date("Y-m-d")
        );

        // IF Search
        $search = $this->setSearch($search);
        $this->output_data['search'] = $search;

        // protect sql injection
        foreach ($search as $key => $value) {
            $search[$key] = addslashes($value);
        }
        $data_member = $this->main_model->select_data_location_order($search);

        $setDataOfMonthNum = [];
        for($i=1;$i<=12; $i++){
            $setDataOfMonthNum[$i]['TH']['count_member'] = [];
            $setDataOfMonthNum[$i]['TH']['total'] = [];

            $setDataOfMonthNum[$i]['CN']['count_member'] = [];
            $setDataOfMonthNum[$i]['CN']['total'] = [];

            $setDataOfMonthNum[$i]['OTHER']['count_member'] = [];
            $setDataOfMonthNum[$i]['OTHER']['total'] = [];
        }

        if($data_member){

            foreach ($data_member as $key=>$value){

                if($value['location_country']=="TH" || $value['location_country']=="CN"){
                    $setDataOfMonthNum[(int)date("m",strtotime($value['created_date']))][$value['location_country']]['count_member'][] = 1;
                    $setDataOfMonthNum[(int)date("m",strtotime($value['created_date']))][$value['location_country']]['total'][] = $value['total_net'];
                }else{
                    $setDataOfMonthNum[(int)date("m",strtotime($value['created_date']))]['OTHER']['count_member'][] = 1;
                    $setDataOfMonthNum[(int)date("m",strtotime($value['created_date']))]['OTHER']['total'][] = $value['total_net'];
                }


            }

        }
        
        for($i=1;$i<=12; $i++){
            $setDataOfMonthNum[$i]['TH']['count_member'] =  array_sum($setDataOfMonthNum[$i]['TH']['count_member']);
            $setDataOfMonthNum[$i]['TH']['total'] =  array_sum($setDataOfMonthNum[$i]['TH']['total']);

            $setDataOfMonthNum[$i]['CN']['count_member'] =  array_sum($setDataOfMonthNum[$i]['CN']['count_member']);
            $setDataOfMonthNum[$i]['CN']['total'] =  array_sum($setDataOfMonthNum[$i]['CN']['total']);

            $setDataOfMonthNum[$i]['OTHER']['count_member'] =  array_sum($setDataOfMonthNum[$i]['OTHER']['count_member']);
            $setDataOfMonthNum[$i]['OTHER']['total'] =  array_sum($setDataOfMonthNum[$i]['OTHER']['total']);
        }
         

        $output['category_name'] =[];

        $output['tha_member'] =[];
        $output['tha_income'] =[];

        $output['usa_member'] =[];
        $output['usa_income'] =[];

        $output['cny_member'] =[];
        $output['cny_income'] =[];

        ksort($setDataOfMonthNum);
        foreach ($setDataOfMonthNum as $key=>$value){
            $output['category_name'][] = $key;

            $output['tha_member'][] = $value['TH']['count_member'];
            $output['tha_income'][] = $value['TH']['total'];

            $output['usa_member'][] = $value['OTHER']['count_member'];
            $output['usa_income'][] = $value['OTHER']['total'];

            $output['cny_member'][] = $value['CN']['count_member'];;
            $output['cny_income'][] = $value['CN']['total'];
        }

        echo json_encode($output);exit();
    }



    /*********************************/
    /*  TAB 2 :: Graph รายรับจากตัวแทน  */
    /*********************************/

    public function get_agent_monday_to_sunday(){

        $search = array(
            'date_type' => 'day',
            'start_search' => date("Y-m-d"),
            'end_search' => date("Y-m-d")
        );

        // IF Search
        $search = $this->setSearch($search);
        $this->output_data['search'] = $search;

        // protect sql injection
        foreach ($search as $key => $value) {
            $search[$key] = addslashes($value);
        }

        $data_order_income = $this->main_model->select_data_order_compay_agent($search);
        $data_order_outcome = $this->main_model->select_data_order_compay_outcome_agent($search);

        //INCOME
        $setDataOfDays['Monday'] = [];
        $setDataOfDays['Tuesday'] = [];
        $setDataOfDays['Wednesday'] = [];
        $setDataOfDays['Thursday'] = [];
        $setDataOfDays['Friday'] = [];
        $setDataOfDays['Saturday'] = [];
        $setDataOfDays['Sunday'] = [];

        if($data_order_income){
            foreach ($data_order_income as $key=>$value){
                $setDataOfDays[date("l",strtotime($value['paid_date']))][] = $value['total_net'];
            }
        }
        $setDataOfDays['Monday']    =  (count($setDataOfDays['Monday'])>0) ? array_sum($setDataOfDays['Monday']) / count($setDataOfDays['Monday']) : 0;
        $setDataOfDays['Tuesday']   =  (count($setDataOfDays['Tuesday'])>0) ? array_sum($setDataOfDays['Tuesday']) / count($setDataOfDays['Tuesday']) : 0;
        $setDataOfDays['Wednesday'] =  (count($setDataOfDays['Wednesday'])>0) ? array_sum($setDataOfDays['Wednesday']) / count($setDataOfDays['Wednesday']) : 0;
        $setDataOfDays['Thursday']  =  (count($setDataOfDays['Thursday'])>0) ? array_sum($setDataOfDays['Thursday']) / count($setDataOfDays['Thursday']) : 0;
        $setDataOfDays['Friday']    =  (count($setDataOfDays['Friday'])>0) ? array_sum($setDataOfDays['Friday']) / count($setDataOfDays['Friday']) : 0;
        $setDataOfDays['Saturday']  =  (count($setDataOfDays['Saturday'])>0) ? array_sum($setDataOfDays['Saturday']) / count($setDataOfDays['Saturday']) : 0;
        $setDataOfDays['Sunday']    =  (count($setDataOfDays['Sunday'])>0) ? array_sum($setDataOfDays['Sunday']) / count($setDataOfDays['Sunday']) : 0;

        //Convert key , value
        $output['category_name'] =[];
        $output['income'] =[];
        foreach ($setDataOfDays as $key=>$value){
            $output['category_name'][] = $key;
            $output['income'][] = $value;
        }

        //OUTCOME
        $setDataOfDays['Monday'] = [];
        $setDataOfDays['Tuesday'] = [];
        $setDataOfDays['Wednesday'] = [];
        $setDataOfDays['Thursday'] = [];
        $setDataOfDays['Friday'] = [];
        $setDataOfDays['Saturday'] = [];
        $setDataOfDays['Sunday'] = [];

        if($data_order_outcome){
            foreach ($data_order_outcome as $key=>$value){
                $setDataOfDays[date("l",strtotime($value['paid_date']))][] = (($value['total_net']*$value['agent_fee_rate'])/100)+$value['total_net'];
            }
        }
        $setDataOfDays['Monday']    =  (count($setDataOfDays['Monday'])>0) ? array_sum($setDataOfDays['Monday']) / count($setDataOfDays['Monday']) : 0;
        $setDataOfDays['Tuesday']   =  (count($setDataOfDays['Tuesday'])>0) ? array_sum($setDataOfDays['Tuesday']) / count($setDataOfDays['Tuesday']) : 0;
        $setDataOfDays['Wednesday'] =  (count($setDataOfDays['Wednesday'])>0) ? array_sum($setDataOfDays['Wednesday']) / count($setDataOfDays['Wednesday']) : 0;
        $setDataOfDays['Thursday']  =  (count($setDataOfDays['Thursday'])>0) ? array_sum($setDataOfDays['Thursday']) / count($setDataOfDays['Thursday']) : 0;
        $setDataOfDays['Friday']    =  (count($setDataOfDays['Friday'])>0) ? array_sum($setDataOfDays['Friday']) / count($setDataOfDays['Friday']) : 0;
        $setDataOfDays['Saturday']  =  (count($setDataOfDays['Saturday'])>0) ? array_sum($setDataOfDays['Saturday']) / count($setDataOfDays['Saturday']) : 0;
        $setDataOfDays['Sunday']    =  (count($setDataOfDays['Sunday'])>0) ? array_sum($setDataOfDays['Sunday']) / count($setDataOfDays['Sunday']) : 0;

        //Convert key , value
        $output['outcome'] =[];
        foreach ($setDataOfDays as $key=>$value){
            $output['outcome'][] = $value;
        }

        echo json_encode($output);exit();

    }

    public function get_agent_all_day_month(){

        $search = array(
            'date_type' => 'day',
            'start_search' => date("Y-m-d"),
            'end_search' => date("Y-m-d")
        );

        // IF Search
        $search = $this->setSearch($search);
        $this->output_data['search'] = $search;

        // protect sql injection
        foreach ($search as $key => $value) {
            $search[$key] = addslashes($value);
        }

        $data_order_income = $this->main_model->select_data_order_compay_agent($search);
        $data_order_outcome = $this->main_model->select_data_order_compay_outcome_agent($search);


        //INCOME
        $setDataOfDaysNum = [];
        for($i=1;$i<=date('t'); $i++){
            $setDataOfDaysNum[$i] = [];
        }

        if($data_order_income){
            foreach ($data_order_income as $key=>$value){
                $setDataOfDaysNum[(int)date("d",strtotime($value['paid_date']))][] = $value['total_net'];
            }
        }

        for($i=1;$i<=date('t'); $i++){
            $setDataOfDaysNum[$i] = (count($setDataOfDaysNum[$i])>0) ? array_sum($setDataOfDaysNum[$i]) / count($setDataOfDaysNum[$i]) : 0;
        }
        //Convert key , value
        $output['category_name'] =[];
        $output['income'] =[];
        ksort($setDataOfDaysNum);
        foreach ($setDataOfDaysNum as $key=>$value){
            $output['category_name'][] = $key;
            $output['income'][] = $value;
        }

        //OUTCOME
        $setDataOfDaysNum = [];
        for($i=1;$i<=date('t'); $i++){
            $setDataOfDaysNum[$i] = [];
        }

        if($data_order_outcome){
            foreach ($data_order_outcome as $key=>$value){
                $setDataOfDaysNum[(int)date("d",strtotime($value['paid_date']))][] = (($value['total_net']*$value['agent_fee_rate'])/100)+$value['total_net'];
            }
        }

        for($i=1;$i<=date('t'); $i++){
            $setDataOfDaysNum[$i] = (count($setDataOfDaysNum[$i])>0) ? array_sum($setDataOfDaysNum[$i]) / count($setDataOfDaysNum[$i]) : 0;
        }
        //Convert key , value
        $output['outcome'] =[];
        ksort($setDataOfDaysNum);
        foreach ($setDataOfDaysNum as $key=>$value){
            $output['outcome'][] = $value;
        }
        echo json_encode($output);exit();
    }

    public function get_agent_all_hour_month(){

        $search = array(
            'date_type' => 'day',
            'start_search' => date("Y-m-d"),
            'end_search' => date("Y-m-d")
        );

        // IF Search
        $search = $this->setSearch($search);
        $this->output_data['search'] = $search;

        // protect sql injection
        foreach ($search as $key => $value) {
            $search[$key] = addslashes($value);
        }
        $data_order_income = $this->main_model->select_data_order_compay_agent($search);
        $data_order_outcome = $this->main_model->select_data_order_compay_outcome_agent($search);

        //Income
        $setDataOfDaysNum = [];
        for($i=1;$i<=24; $i++){
            $setDataOfDaysNum[$i] = [];
        }
        if($data_order_income){
            foreach ($data_order_income as $key=>$value){
                $setDataOfDaysNum[(int)date("H",strtotime($value['paid_date']))][] = $value['total_net'];
            }
        }
        for($i=1;$i<=24; $i++){
            $setDataOfDaysNum[$i] = (count($setDataOfDaysNum[$i])>0) ? array_sum($setDataOfDaysNum[$i]) / count($setDataOfDaysNum[$i]) : 0;
        }
        //Convert key , value
        $output['category_name'] =[];
        $output['income'] =[];
        ksort($setDataOfDaysNum);
        foreach ($setDataOfDaysNum as $key=>$value){
            $output['category_name'][] = $key;
            $output['income'][] = $value;
        }


        //OutCome
        $setDataOfDaysNum = [];
        for($i=1;$i<=24; $i++){
            $setDataOfDaysNum[$i] = [];
        }
        if($data_order_outcome){
            foreach ($data_order_outcome as $key=>$value){
                $setDataOfDaysNum[(int)date("H",strtotime($value['paid_date']))][] = ($value['total_net']*$value['agent_fee_rate']/100)+$value['total_net'];
            }
        }
        for($i=1;$i<=24; $i++){
            $setDataOfDaysNum[$i] = (count($setDataOfDaysNum[$i])>0) ? array_sum($setDataOfDaysNum[$i]) / count($setDataOfDaysNum[$i]) : 0;
        }
        //Convert key , value
        $output['outcome'] =[];
        ksort($setDataOfDaysNum);
        foreach ($setDataOfDaysNum as $key=>$value){
            $output['outcome'][] = $value;
        }

        echo json_encode($output);exit();

    }

    public function get_agent_payment_type(){

        $search = array(
            'date_type' => 'day',
            'start_search' => date("Y-m-d"),
            'end_search' => date("Y-m-d")
        );

        // IF Search
        $search = $this->setSearch($search);
        $this->output_data['search'] = $search;

        // protect sql injection
        foreach ($search as $key => $value) {
            $search[$key] = addslashes($value);
        }
        $data_order_income = $this->main_model->select_data_order_compay_agent($search);
        $data_order_outcome = $this->main_model->select_data_order_compay_outcome_agent($search);

        //INCOME
        $setDataOfPaymentType['VISA'] = [];
        $setDataOfPaymentType['MasterCard'] = [];
        $setDataOfPaymentType['WeChat'] = [];
        $setDataOfPaymentType['Other'] = [];

        if($data_order_income){

            foreach ($data_order_income as $key=>$value){

                if($value['payment_method']=="Master"){
                    $addKey = "MasterCard";
                }else if($value['payment_method']=="VISA"){
                    $addKey = "VISA";
                }else if($value['payment_method']=="wechat"){
                    $addKey = "WeChat";
                }else{
                    $addKey = "Other";
                }

                $setDataOfPaymentType[$addKey][] = $value['total_net'];
            }

        }

        $setDataOfPaymentType['VISA']    =  (count($setDataOfPaymentType['VISA'])>0) ? array_sum($setDataOfPaymentType['VISA']) / count($setDataOfPaymentType['VISA']) : 0;
        $setDataOfPaymentType['MasterCard']   =  (count($setDataOfPaymentType['MasterCard'])>0) ? array_sum($setDataOfPaymentType['MasterCard']) / count($setDataOfPaymentType['MasterCard']) : 0;
        $setDataOfPaymentType['WeChat'] =  (count($setDataOfPaymentType['WeChat'])>0) ? array_sum($setDataOfPaymentType['WeChat']) / count($setDataOfPaymentType['WeChat']) : 0;
        if(count($setDataOfPaymentType['Other'])==0){
            unset($setDataOfPaymentType['Other']);
        }else{
            $setDataOfPaymentType['Other'] =  (count($setDataOfPaymentType['Other'])>0) ? array_sum($setDataOfPaymentType['Other']) / count($setDataOfPaymentType['Other']) : 0;
        }

        //Convert key , value
        $output['category_name'] =[];
        $output['income'] =[];
        foreach ($setDataOfPaymentType as $key=>$value){
            $output['category_name'][] = $key;
            $output['income'][] = $value;
        }

        //OUTCOME
        $setDataOfPaymentType['VISA'] = [];
        $setDataOfPaymentType['MasterCard'] = [];
        $setDataOfPaymentType['WeChat'] = [];
        $setDataOfPaymentType['Other'] = [];

        if($data_order_outcome){

            foreach ($data_order_outcome as $key=>$value){

                if($value['payment_method']=="Master"){
                    $addKey = "MasterCard";
                }else if($value['payment_method']=="VISA"){
                    $addKey = "VISA";
                }else if($value['payment_method']=="wechat"){
                    $addKey = "WeChat";
                }else{
                    $addKey = "Other";
                }

                $setDataOfPaymentType[$addKey][] = (($value['total_net']*$value['agent_fee_rate'])/100)+$value['total_net'];
            }

        }

        $setDataOfPaymentType['VISA']    =  (count($setDataOfPaymentType['VISA'])>0) ? array_sum($setDataOfPaymentType['VISA']) / count($setDataOfPaymentType['VISA']) : 0;
        $setDataOfPaymentType['MasterCard']   =  (count($setDataOfPaymentType['MasterCard'])>0) ? array_sum($setDataOfPaymentType['MasterCard']) / count($setDataOfPaymentType['MasterCard']) : 0;
        $setDataOfPaymentType['WeChat'] =  (count($setDataOfPaymentType['WeChat'])>0) ? array_sum($setDataOfPaymentType['WeChat']) / count($setDataOfPaymentType['WeChat']) : 0;
        if(count($setDataOfPaymentType['Other'])==0){
            unset($setDataOfPaymentType['Other']);
        }else{
            $setDataOfPaymentType['Other'] =  (count($setDataOfPaymentType['Other'])>0) ? array_sum($setDataOfPaymentType['Other']) / count($setDataOfPaymentType['Other']) : 0;
        }

        //Convert key , value
        $output['outcome'] =[];
        foreach ($setDataOfPaymentType as $key=>$value){
            $output['outcome'][] = $value;
        }

        echo json_encode($output);exit();

    }

    public function get_ranking_agent(){

        $search = array(
            'date_type' => 'day',
            'start_search' => date("Y-m-d"),
            'end_search' => date("Y-m-d")
        );

        // IF Search
        $search = $this->setSearch($search);
        $this->output_data['search'] = $search;

        // protect sql injection
        foreach ($search as $key => $value) {
            $search[$key] = addslashes($value);
        }
        $data_agent = $this->main_model->select_sum_order_agent($search);

        if($data_agent){
            foreach ($data_agent as $key=>$value){
                $setDataOfAgent[$value['agent_name']][] = (int)$value['sum_total'];
            }
        }
        
        //Convert key , value
        $output['agent_name'] =[];
        $output['amount'] =[];
        if($setDataOfAgent){
            foreach ($setDataOfAgent as $key=>$value){
                $output['agent_name'][] = $key;
                $output['amount'][] = $value;
            }
        }


        echo json_encode($output);exit();
    }

    public function get_agent_location_order_avg(){

        $search = array(
            'date_type' => 'day',
            'start_search' => date("Y-m-d"),
            'end_search' => date("Y-m-d")
        );

        // IF Search
        $search = $this->setSearch($search);
        $this->output_data['search'] = $search;

        // protect sql injection
        foreach ($search as $key => $value) {
            $search[$key] = addslashes($value);
        }
        $data_member = $this->main_model->select_data_location_order_agent($search);
        $setDataOfMonthNum = [];
        for($i=1;$i<=12; $i++){
            $setDataOfMonthNum[$i]['TH']['count_member'] = [];
            $setDataOfMonthNum[$i]['TH']['total'] = [];

            $setDataOfMonthNum[$i]['CN']['count_member'] = [];
            $setDataOfMonthNum[$i]['CN']['total'] = [];

            $setDataOfMonthNum[$i]['OTHER']['count_member'] = [];
            $setDataOfMonthNum[$i]['OTHER']['total'] = [];
        }

        if($data_member){

            foreach ($data_member as $key=>$value){

                if($value['location_country']=="TH" || $value['location_country']=="CN"){
                    $setDataOfMonthNum[(int)date("m",strtotime($value['created_date']))][$value['location_country']]['count_member'][] = 1;
                    $setDataOfMonthNum[(int)date("m",strtotime($value['created_date']))][$value['location_country']]['total'][] = $value['total_net'];
                }else{
                    $setDataOfMonthNum[(int)date("m",strtotime($value['created_date']))]['OTHER']['count_member'][] = 1;
                    $setDataOfMonthNum[(int)date("m",strtotime($value['created_date']))]['OTHER']['total'][] = $value['total_net'];
                }


            }

        }

        for($i=1;$i<=12; $i++){
            $setDataOfMonthNum[$i]['TH']['count_member'] =  array_sum($setDataOfMonthNum[$i]['TH']['count_member']);
            $setDataOfMonthNum[$i]['TH']['total'] =  array_sum($setDataOfMonthNum[$i]['TH']['total']);

            $setDataOfMonthNum[$i]['CN']['count_member'] =  array_sum($setDataOfMonthNum[$i]['CN']['count_member']);
            $setDataOfMonthNum[$i]['CN']['total'] =  array_sum($setDataOfMonthNum[$i]['CN']['total']);

            $setDataOfMonthNum[$i]['OTHER']['count_member'] =  array_sum($setDataOfMonthNum[$i]['OTHER']['count_member']);
            $setDataOfMonthNum[$i]['OTHER']['total'] =  array_sum($setDataOfMonthNum[$i]['OTHER']['total']);
        }


        $output['category_name'] =[];

        $output['tha_member'] =[];
        $output['tha_income'] =[];

        $output['usa_member'] =[];
        $output['usa_income'] =[];

        $output['cny_member'] =[];
        $output['cny_income'] =[];

        ksort($setDataOfMonthNum);
        foreach ($setDataOfMonthNum as $key=>$value){
            $output['category_name'][] = $key;

            $output['tha_member'][] = $value['TH']['count_member'];
            $output['tha_income'][] = $value['TH']['total'];

            $output['usa_member'][] = $value['OTHER']['count_member'];
            $output['usa_income'][] = $value['OTHER']['total'];

            $output['cny_member'][] = $value['CN']['count_member'];;
            $output['cny_income'][] = $value['CN']['total'];
        }

        echo json_encode($output);exit();
    }


    //Tab 4
    public function get_data_chart(){

        $search = array(
            'date_type' => 'day',
            'start_search' => date("Y-m-d"),
            'end_search' => date("Y-m-d")
        );

        // IF Search
        $search = $this->setSearch($search);
        $this->output_data['search'] = $search;

        // protect sql injection
        foreach ($search as $key => $value) {
            $search[$key] = addslashes($value);
        }
        $data_order_income = $this->main_model->select_data_order_compay($search);
        $data_order_outcome = $this->main_model->select_data_order_compay_outcome($search);

        //INCOME
        $setDataOfPaymentType['VISA'] = [];
        $setDataOfPaymentType['MasterCard'] = [];
        $setDataOfPaymentType['WeChat'] = [];
        $setDataOfPaymentType['Other'] = [];

        $order_date = [];
        $order_chart_data = [];
        if($data_order_income){

            foreach ($data_order_income as $key=>$value){

                $order_date[] = date("d/m/Y",strtotime("+543 year"));

                if(in_array( date("d/m/Y",strtotime("+543 year")), $order_date)){

                    if($value['payment_method']=="Master"){
                        $addKey = "MasterCard";
                    }else if($value['payment_method']=="VISA"){
                        $addKey = "VISA";
                    }else if($value['payment_method']=="wechat"){
                        $addKey = "WeChat";
                    }else{
                        $addKey = "Other";
                    }
                    $setDataOfPaymentType[$addKey][] = $value['total_net'];
                    $order_chart_data[ date("d/m/Y",strtotime("+543 year")) ] = $setDataOfPaymentType;

                }
                $order_date = array_values(array_unique(array_filter($order_date)));
            }
        }

        //Convert key , value
        $output['category_name'] = $order_date;
        $output['data_chart'] = [];
        $amount_non_ccard =0;

        $output['data_chart'][0]['name'] = 'VISA';
        $output['data_chart'][0]['color'] = '#ff5500'; //ee0000
        $output['data_chart'][0]['stack'] = 'visa';

        $output['data_chart'][1]['name'] = 'MasterCard';
        $output['data_chart'][1]['color'] = '#0099ff';
        $output['data_chart'][1]['stack'] = 'mastercard';

        $output['data_chart'][2]['name'] = 'WeChat';
        $output['data_chart'][2]['color'] = '#53c68c';
        $output['data_chart'][2]['stack'] = 'wechat';

        $output['data_chart'][3]['name'] = 'Other';
        $output['data_chart'][3]['color'] = '#ccc';
        $output['data_chart'][3]['stack'] = 'other';

        foreach ($order_chart_data as $key=>$value){

            if(count($value['VISA'])>0){
                $amount_ccard = array_sum($value['VISA']);
                $output['data_chart'][0]['data'][] = $amount_ccard;
            }
            if(count($value['MasterCard'])>0){
                $amount_ccard = array_sum($value['MasterCard']);
                $output['data_chart'][1]['data'][] = $amount_ccard;
            }

            if(count($value['WeChat'])>0){
                $amount_non_ccard = array_sum($value['WeChat']);
                $output['data_chart'][2]['data'][] = $amount_non_ccard;
            }

            if(count($value['Other'])>0){
                $amount_non_ccard = array_sum($value['Other']);
                $output['data_chart'][3]['data'][] = $amount_non_ccard;
            }
        }

        //OUTCOME
        $setDataOfPaymentType['VISA'] = [];
        $setDataOfPaymentType['MasterCard'] = [];
        $setDataOfPaymentType['WeChat'] = [];
        $setDataOfPaymentType['Other'] = [];

        if($data_order_outcome){

            foreach ($data_order_outcome as $key=>$value){

                $order_date[] = date("d/m/Y",strtotime("+543 year"));

                if(in_array( date("d/m/Y",strtotime("+543 year")), $order_date)){

                    if($value['payment_method']=="Master"){
                        $addKey = "MasterCard";
                    }else if($value['payment_method']=="VISA"){
                        $addKey = "VISA";
                    }else if($value['payment_method']=="wechat"){
                        $addKey = "WeChat";
                    }else{
                        $addKey = "Other";
                    }
                    $setDataOfPaymentType[$addKey][] = $value['total_net'];
                    $order_chart_data[ date("d/m/Y",strtotime("+543 year")) ] = $setDataOfPaymentType;

                }
                $order_date = array_values(array_unique(array_filter($order_date)));
            }
        }

        //Convert key , value
        $output['category_name'] = $order_date;
        $amount_non_ccard =0;

        $output['data_chart'][4]['name'] = 'โอนคืน (VISA)';
        $output['data_chart'][4]['color'] = '#ffaa80'; //ee0000
        $output['data_chart'][4]['stack'] = 'visa';

        $output['data_chart'][5]['name'] = 'โอนคืน (MasterCard)';
        $output['data_chart'][5]['color'] = '#99d6ff';
        $output['data_chart'][5]['stack'] = 'mastercard';

        $output['data_chart'][6]['name'] = 'โอนคืน (WeChat)';
        $output['data_chart'][6]['color'] = '#b3e6cc';
        $output['data_chart'][6]['stack'] = 'wechat';

        $output['data_chart'][7]['name'] = 'โอนคืน (Other)';
        $output['data_chart'][7]['color'] = '#e6e6e6';
        $output['data_chart'][7]['stack'] = 'other';


        foreach ($order_chart_data as $key=>$value){

            if(count($value['VISA'])>0){
                $amount_ccard = array_sum($value['VISA']);
                $output['data_chart'][4]['data'][] = $amount_ccard;
            }
            if(count($value['MasterCard'])>0){
                $amount_ccard = array_sum($value['MasterCard']);
                $output['data_chart'][5]['data'][] = $amount_ccard;
            }

            if(count($value['WeChat'])>0){
                $amount_non_ccard = array_sum($value['WeChat']);
                $output['data_chart'][6]['data'][] = $amount_non_ccard;
            }

            if(count($value['Other'])>0){
                $amount_non_ccard = array_sum($value['Other']);
                $output['data_chart'][7]['data'][] = $amount_non_ccard;
            }
        }




        foreach ($output['data_chart'] as $key=>$value ){

            if(!isset($value['data']) && count($value['data'])<=0 ){
                unset($output['data_chart'][$key]);
            }
        }

        $output['data_chart'] = array_values($output['data_chart']);

        echo json_encode($output);

    }



}