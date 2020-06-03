<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class MY_Controller extends MX_Controller
{

    protected $template_name = "default";
    protected $output_data = array();
    protected $modules = "";
    public $CI;
    public $language;
    public $user;
    public $site_language;


    function __construct()
    {
        parent::__construct();
        $this->CI = &get_instance();
        $this->output_data["assets"] = base_url() . 'assets/';
        $this->output_data["url_ajax"] = '';
        $this->output_data["title"] = "ML Future Tech - ";

        /* Language */
        $this->language = $this->session->userdata('language_admin');
        if (empty($this->language)) {
            $this->language = 'tha';
            $this->session->set_userdata('language_admin', $this->language);
        }
        $this->output_data["admin_data"] = $this->session->userdata('admin_data');
        $this->output_data["language"] = $this->language;
        $this->lang->load("main", $this->language);

        // Set user admin
        $this->user = $this->session->userdata('admin_data');

        // Load model
        $this->load->model('config_model', "config_model");
        $this->load->model('default_model', "default_model");

//        $this->output_data["site_language"] = $this->config_model->site_language();
//        $this->output_data["list_language"] = $this->config_model->list_language();

//        $this->site_language = $this->output_data["site_language"];

        // Active Menu
        $this->output_data["active_menu"] = $this->uri->segment(1);
        $this->set_size_image_product();
        
    }

    public function set_cookie(){
        setcookie("url_for_callback", $_SERVER['HTTP_REFERER'], time()+3600, '/');
    }

    private  function set_size_image_product(){

        //New Set
        $this->output_data['package_tour']['width'] = 500;
        $this->output_data['package_tour']['height'] = 350;


        //SET config size image
        $this->output_data['image_for_home']['width'] = 320;
        $this->output_data['image_for_home']['height'] = 384;
        $this->output_data['image_for_share']['width'] = 320;
        $this->output_data['image_for_share']['height'] = 384;

        $this->output_data['image_product']['width'] = 320;
        $this->output_data['image_product']['height'] = 384;
        $this->output_data['image_product']['thumb_width'] = 125;
        $this->output_data['image_product']['thumb_height'] = 90;

        $this->output_data['image_special_deal_for_home']['width'] = 320;
        $this->output_data['image_special_deal_for_home']['height'] = 384;
        $this->output_data['image_special_deal_for_share']['width'] = 320;
        $this->output_data['image_special_deal_for_share']['height'] = 384;

        $this->output_data['image_special_deal']['width'] = 320;
        $this->output_data['image_special_deal']['height'] = 384;
        $this->output_data['image_special_deal']['thumb_width'] = 125;
        $this->output_data['image_special_deal']['thumb_height'] = 90;
        //for share min-mun 600x315 > max 1200*630
    }

    private function change_language()
    {
        $this->language = $this->input->get('change_lang');
        if (!in_array($this->language, array('tha', 'eng'))) {
            $this->language = $this->config->item('language');
        }
        $this->session->set_userdata('language', $this->language);
        $this->session->set_userdata('lang', $this->language);
    }

    public function change_date_format($date)
    {
        if (!empty($date)) {
            if (strpos($date, '-') !== false) {
                list($day, $month, $year) = explode('-', $date);
            } else {
                list($day, $month, $year) = explode('/', $date);
            }

            return $year . '-' . $month . '-' . $day;
        } else {
            return $date;
        }
    }

    public function change_datetime_format($datetime)
    {
        if (!empty($datetime)) {
            list($date, $time) = explode(' ', $datetime);
            if (strpos($date, '-') !== false) {
                list($day, $month, $year) = explode('-', $date);
            } else {
                list($day, $month, $year) = explode('/', $date);
            }

            return $year . '-' . $month . '-' . $day . ' ' . $time;
        } else {
            return $datetime;
        }
    }

    public function print_pre($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }

    protected function uploadImage($fileName, $name, $path, $width, $height)
    {
        $imageName = '';
        $uploadFieldName = $fileName;
        $fileName = $name;
        $success = TRUE;

        if (!empty($_FILES[$uploadFieldName])) {

            if (is_uploaded_file($_FILES[$uploadFieldName]['tmp_name'])) {

                if(file_exists($path.$fileName.'.jpg')){
                    unlink($path.$fileName.'.jpg');
                }else  if(file_exists($path.$fileName.'.png')){
                    unlink($path.$fileName.'.png');
                }

                //  Bind config data
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'jpg|JPG|png|PNG|jpeg|JPEG|gif|GIF|webp';
                $config['file_name'] = $fileName;
                $config['overwrite'] = true;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload($uploadFieldName)) {
                    $error = array('error' => $this->upload->display_errors());
                    echo "Error image , please contact your admin...";
                    var_dump($this->upload->data());
                    $fileName = null;
                    $imageName = '';
                    $success = FALSE;
                    exit;
                    
                } else {
                    $file_data = $this->upload->data();
                    $max_height = $height;
                    $max_width = $width;
//                    if ($file_data['image_width'] > $max_width || $file_data['image_height'] > $max_height) {
                        $configResize = array(
                            'source_image' => $file_data['full_path'],
                            'width' => $max_width,
                            'height' => $max_height,
                            'maintain_ratio' => FALSE
                        );

                        $this->load->library('image_lib', $configResize);
                        $this->image_lib->initialize($configResize);
                        $this->image_lib->resize();
//                    }

                    $data = array('upload_data' => $this->upload->data());

                    //  Insert new  data with upload file
                    $fileName = base_url() . $path . $data['upload_data']['file_name'];
                    $imageName = $data['upload_data']['file_name'];
                }// $this->upload->do_upload
            } //is_uploaded_file
        }// !empty

        return array('imageName' => $imageName, 'success' => $success);
    }

    public function uploadFile($file_name, $file_type, $name, $path)
    {
        $output_name = '';
        $upload_field_name = $file_name;
        $file_name = ($name == '' ? $_FILES[$file_name]['name'] : $name);

        if (!empty($_FILES[$upload_field_name])) {

            if (is_uploaded_file($_FILES[$upload_field_name]['tmp_name'])) {
                //  Bind config data
                $config['upload_path'] = $path;
                $config['allowed_types'] = $file_type;
                $config['file_name'] = $file_name;
                $config['overwrite'] = true;
                $this->load->library('upload', $config);
                $this->lang->load("upload", $this->language);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload($upload_field_name)) {
                    $error = array('error' => $this->upload->display_errors());
//                    echo "Error file , please contact your admin...";
//                    var_dump($error);
                    $file_name = null;
                    $output_name = '';
//                    exit;
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    //  Insert new  data with upload file
                    $file_name = base_url() . $path . $data['upload_data']['file_name'];
                    $output_name = $data['upload_data']['file_name'];
                }// $this->upload->do_upload

            } //is_uploaded_file

        }// !empty

        return $output_name;
    }

    public function getRealIpAddr()
    {

        if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
        {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
        {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    public function setSearch($search, $url = '')
    {
        if ($this->input->post('submit')) {

            $query_string = $this->input->get();
            $query_string['page'] = 1;

            foreach ($search as $key => $value) {
                if ($this->input->post($key)) {
                    $search[$key] = $this->input->post($key);
                }
            }

            $query_string = array_merge($query_string, $search);

            if (empty($url)) {
                redirect(base_url($this->function_name . '?' . http_build_query($query_string)));
            } else {
                redirect(base_url($url . '?' . http_build_query($query_string)));
            }

        } else {
            foreach ($search as $key => $value) {
                if ($this->input->get($key)) {
                    $search[$key] = $this->input->get($key);
                }
            }
        }

        return $search;
    }

    public function sendNotification_android($registatoin_ids, $message) {
        // Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';//'https://gcm-http.googleapis.com/gcm/send';
//        $fields = array(
//            'registration_ids' => $registatoin_ids,
//            'data' => $message
//        );

        $fields = array(
            'registration_ids' => $registatoin_ids,
            "content_available" => true,
            "priority" => "high", // Add this field corresponds to 10 for APNS
//            'notification' => array('title' => $message['txt'], 'body' => $message['box'], "badge" => 1),
            'data' => $message
        );


        $headers = array(
            'Authorization: key=AIzaSyDIHho5n7KMF_OwrJpT9TmPFOM4B64O1WY',
            'Content-Type: application/json'
        );

//        var_dump($fields);
//
//        exit();

        // Open connection
        $ch = curl_init();
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);
    }

    public function sendNotification_ios($registatoin_ids, $message) {
        // Set POST variables
        $url = 'https://gcm-http.googleapis.com/gcm/send';

        $fields = array(
            'registration_ids' => $registatoin_ids,
            "content_available"=>true,
            "priority"=> "high", // Add this field corresponds to 10 for APNS
            'notification' => $message
        );
        $headers = array(
            'Authorization: key=AIzaSyDIHho5n7KMF_OwrJpT9TmPFOM4B64O1WY',
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);
    }


//    public function sendNotification_ios($registatoin_ids, $message) {
//        // Set POST variables
//
//        $message = array('notification_type' => 2, 'stage_id' => 108, "cheer_reward" => 3, 'profile_image_url' => '/');
//
//        $url = 'https://fcm.googleapis.com/fcm/send';
//
////        $fields = array(
////            'registration_ids' => $registatoin_ids,
////            "content_available"=>true,
////            "priority"=> "high", // Add this field corresponds to 10 for APNS
////            'notification' => $message
////        );
//
//        $fields = array(
//            'registration_ids' => $registatoin_ids,
//            "content_available" => true,
//            "priority" => "high", // Add this field corresponds to 10 for APNS
//            'notification' => array('title' => 'Notification Title', 'body' => 'Notification Body', "badge" => 9),
//            'data' => $message
//        );
//
//        $headers = array(
//            'Authorization: key=AIzaSyDIHho5n7KMF_OwrJpT9TmPFOM4B64O1WY',
//            'Content-Type: application/json'
//        );
//        // Open connection
//        $ch = curl_init();
//        // Set the url, number of POST vars, POST data
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_POST, true);
//        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        // Disabling SSL Certificate support temporarly
//        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
//        // Execute post
//        $result = curl_exec($ch);
//        if ($result === FALSE) {
//            die('Curl failed: ' . curl_error($ch));
//        }
//        // Close connection
//        curl_close($ch);
//    }

    public function copy_image($source_path,$destination_path,$width,$height)
    {

        copy($source_path, $destination_path);

        $configResize = array(
            'source_image' => $destination_path,
            'width' => $width,
            'height' => $height,
            'maintain_ratio' => FALSE
        );

        $this->load->library('image_lib', $configResize);
        $this->image_lib->initialize($configResize);
        $this->image_lib->resize();

    }


    public function update_sort_no(){

        if(!empty($this->input->post())){
            $inputs = $this->input->post();

            $sort_no_source = $this->config_model->select_sort_no_by_product_id($inputs['product_id']);

            $id_target = $this->config_model->select_target_id_by_sort_no($inputs['order'],$sort_no_source['category_id']);

            $data['source']['product_id'] = $inputs['product_id'];
            $data['source']['sort_no'] = $inputs['order'];

            $data['target']['product_id'] = $id_target['product_id'];
            $data['target']['sort_no'] = $sort_no_source['sort_no'];

//            echo json_encode($data);

            $update_source['sort_no'] = $inputs['order'];
            $this->config_model->update_sort_no_with_source($inputs['product_id'],$update_source);

            if($id_target){
                $update_target['sort_no'] = $sort_no_source['sort_no'];
                $this->config_model->update_sort_no_with_target($id_target['product_id'],$update_target);

            }

        }

    }

    public function send_email($email, $subject, $body)
    {

        $get_mail = $this->config_model->setting_smtp();

        if (!empty($email)) {

            include('../PHPMailer/PHPMailerAutoload.php');

            $mail = new PHPMailer(true); // create a new object

            $mail->IsSMTP(); // enable SMTP
            $mail->CharSet = 'UTF-8';
            $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPAuth = true; // authentication enabled
            $mail->SMTPSecure = $get_mail['ssl_tls'];    //($setting['smtp_is_ssl']=='1'?'ssl':'tls'); // secure transfer enabled REQUIRED for Gmail //
            $mail->Host = $get_mail['smtp_server']; //"smtp.gmail.com";
            $mail->Port = $get_mail['smtp_port']; // 465 or 587
            $mail->IsHTML(true);
            $mail->Username = $get_mail['authenticate_username']; //"appwinnerwideworld@gmail.com";
            $mail->Password = $get_mail['authenticate_password']; //"winner@1234@";
            $mail->SetFrom($get_mail['authenticate_username']);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AddAddress($email);  //$mailto[$i]['email']
            $mail->From = $get_mail['authenticate_username'];
            $mail->FromName = $get_mail['authenticate_username'];

            $mail->send();
            //
            if (!$mail->Send()) {
                echo "Error";
            } else {
                echo "Success";
            }
        }
    }

    public function sendEmail_UserPassword($member_id)
    {

        $get_mail = $this->config_model->setting_smtp();
        $data_member = $this->config_model->select_member_by_id($member_id);
        $subject = "MANDAWEE CASHBACK - ลงทะเบียนสำเร็จ";

        $body = "<p>เรียนคุณ" . $data_member['name'] . " " . $data_member['surname'] . ",</p> 
                    <p>ทางบริษัท เว็บสวัสดี จำกัด(มหาชน) ได้รับข้อมูลลงทะเบียนของท่านเเล้ว " . "</p>
                    <p>หากท่านไม่ได้เป็นผู้ลงทะเบียนกรุณาติดต่อเจ้าหน่าที่ได้ที่ 02-2222-2222 (ในเวลาทำการ จ-ศ)</p> 
                    <p></p>
                    <p>หากท่านเป็นผู้ลงทะเบียน กรุณาเข้าสู๋ระบบบนเว็บไซต์ " . base_url() . " ด้วยอีเมลของท่าน เเละดำเนินการเลือกเมนู ตั้งรหัสผ่าน ขอบคุณค่ะ</p> 
                    <p>ขอบคุณที่ใช้บริการ https://mlfuturetech.co.th</p> 
                    <p>สวัสดีทีเดียวจบ ครบเครื่องเรื่องเที่ยว พักได้ทั่วไทย</p>

                    ";
        $email = $data_member['email'];
        if (!empty($email)) {

            include('PHPMailer/PHPMailerAutoload.php');
            $mail = new PHPMailer(true); // create a new object

            $mail->IsSMTP(); // enable SMTP
            $mail->CharSet = 'UTF-8';
            $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPAuth = true; // authentication enabled
            $mail->SMTPSecure = $get_mail['ssl_tls'];    //($setting['smtp_is_ssl']=='1'?'ssl':'tls'); // secure transfer enabled REQUIRED for Gmail //
            $mail->Host = $get_mail['smtp_server']; //"smtp.gmail.com";
            $mail->Port = $get_mail['smtp_port']; // 465 or 587
            $mail->IsHTML(true);
            $mail->Username = $get_mail['authenticate_username']; //"appwinnerwideworld@gmail.com";
            $mail->Password = $get_mail['authenticate_password']; //"winner@1234@";
            $mail->SetFrom($get_mail['authenticate_username']);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AddAddress($email);  //$mailto[$i]['email']
            $mail->From = $get_mail['authenticate_username'];
            $mail->FromName = $get_mail['authenticate_username'];

            //
            if (!$mail->Send()) {
                echo "Error";
            } else {
                echo "Success";
            }
        } else {
            echo "Success";
        }


    }


//    public function sendEmail_ResetPassword($agent_id)
//    {
//
//        $get_mail = $this->config_model->setting_smtp();
//        $data_member = $this->config_model->select_agent_by_id($agent_id);
//        echo print_r($data_member);
//        exit();
//        $subject = "MandaweeOnline Cashback - ลงทะเบียนสำเร็จ";
//
//        $body = "<p>เรียนคุณ" . $data_member['name'] . " " . $data_member['surname'] . ",</p>
//                    <p>ทางบริษัท เว็บสวัสดี จำกัด(มหาชน) ได้รับข้อมูลลงทะเบียนของท่านเเล้ว " . "</p>
//                    <p>หากท่านไม่ได้เป็นผู้ลงทะเบียนกรุณาติดต่อเจ้าหน่าที่ได้ที่ 02-2222-2222 (ในเวลาทำการ จ-ศ)</p>
//                    <p></p>
//                    <p>หากท่านเป็นผู้ลงทะเบียน กรุณาเข้าสู๋ระบบบนเว็บไซต์ " . base_url() . " ด้วยอีเมลของท่าน เเละดำเนินการเลือกเมนู ตั้งรหัสผ่าน ขอบคุณค่ะ</p>
//                    <p>ขอบคุณที่ใช้บริการ mlfuturetech.co.th</p>
//                    <p>สวัสดีทีเดียวจบ ครบเครื่องเรื่องเที่ยว พักได้ทั่วไทย</p>
//
//                    ";
//        $email = $data_member['email'];
//        if (!empty($email)) {
//
//            include('PHPMailer/PHPMailerAutoload.php');
//            $mail = new PHPMailer(true); // create a new object
//
//            $mail->IsSMTP(); // enable SMTP
//            $mail->CharSet = 'UTF-8';
//            $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
//            $mail->SMTPAuth = true; // authentication enabled
//            $mail->SMTPSecure = $get_mail['ssl_tls'];    //($setting['smtp_is_ssl']=='1'?'ssl':'tls'); // secure transfer enabled REQUIRED for Gmail //
//            $mail->Host = $get_mail['smtp_server']; //"smtp.gmail.com";
//            $mail->Port = $get_mail['smtp_port']; // 465 or 587
//            $mail->IsHTML(true);
//            $mail->Username = $get_mail['authenticate_username']; //"appwinnerwideworld@gmail.com";
//            $mail->Password = $get_mail['authenticate_password']; //"winner@1234@";
//            $mail->SetFrom($get_mail['authenticate_username']);
//            $mail->Subject = $subject;
//            $mail->Body = $body;
//            $mail->AddAddress($email);  //$mailto[$i]['email']
//            $mail->From = $get_mail['authenticate_username'];
//            $mail->FromName = $get_mail['authenticate_username'];
//
//            //
//            if (!$mail->Send()) {
//                echo "Error";
//            } else {
//                echo "Success";
//            }
//        } else {
//            echo "Success";
//        }
//
//
//    }
    public function replace_format_telephone($tel){
        $telephone = str_replace(array('(',')','-',' '),"",$tel);
        return $telephone;
    }
}
