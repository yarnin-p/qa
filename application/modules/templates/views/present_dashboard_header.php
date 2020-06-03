<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title; ?></title>
    <link href="<?php echo $assets; ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $assets; ?>font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- Toastr style
    <link href="<?php echo $assets; ?>css/plugins/toastr/toastr.min.css" rel="stylesheet">
    -->

    <!-- Gritter
    <link href="<?php echo $assets; ?>js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
    -->
    <link href="<?php echo $assets; ?>css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
    <link href="<?php echo $assets; ?>css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $assets; ?>css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="<?php echo $assets; ?>css/plugins/dualListbox/bootstrap-duallistbox.min.css" rel="stylesheet">

    <link href="<?php echo $assets; ?>css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="<?php echo $assets; ?>css/plugins/steps/jquery.steps.css" rel="stylesheet">

    <link href="<?php echo $assets; ?>css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css"
          rel="stylesheet">

    <!-- Select2 -->
    <link href="<?php echo $assets; ?>plugins/select2/css/select2.min.css" rel="stylesheet">

    <!-- Intro js -->
    <link href="<?php echo $assets; ?>css/plugins/introjs/introjs.css" rel="stylesheet">

    <!-- Date Time Picker js -->
    <link href="<?php echo $assets; ?>css/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

    <!-- Time Picker js -->
    <link href="<?php echo $assets; ?>css/plugins/timepicker/jquery.timepicker.css" rel="stylesheet">

    <link href="<?php echo $assets; ?>css/animate.css" rel="stylesheet">
    <link href="<?php echo $assets; ?>css/style.css" rel="stylesheet">
    <link href="<?php echo $assets; ?>css/custom.css" rel="stylesheet">
    <script>
        var base_url = '<?php echo base_url(); ?>';
        var asset = '<?php echo $assets; ?>';
        var url_ajax = '<?php echo $url_ajax; ?>';
        var state_insert_row = '<?php echo $this->session->userdata('insert_row') == '1' ? '1' : '0';?>';
        var active_menu = '<?php echo $active_menu;?>';
    </script>
    <?php echo $css; ?>
    <style>body.mini-navbar #page-wrapper {
            margin: 0 0 0 0px;
        }</style>
</head>

<body><body class="pace-done mini-navbar">
<div id="wrapper">
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">


        </div>
        <script>
            //            $(document).ready(function(){
            //                $(body).removeClass('mini-navbar');
            //            });
        </script>