
<!-- END: Content-->

<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light navbar-border navbar-shadow">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2019 <a class="text-bold-800 grey darken-2" href="https://1.envato.market/modern_admin" target="_blank">PIXINVENT</a></span><span class="float-md-right d-none d-lg-block">Hand-crafted & Made with<i class="ft-heart pink"></i><span id="scroll-top"></span></span></p>
</footer>
<!-- END: Footer-->


<!-- BEGIN: Modal-->
<div class="modal fade" id="modal_delete" aria-labelledby="myModalLabelDelete" aria-hidden="true">
    <div class="modal-dialog modal-xs" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning white">
                <h4 class="modal-title" id="myModalLabelDelete"><?php echo $this->lang->line('head_alert_delete'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <input type="hidden" name="delete_link" id="delete_link" class="hide" value="">
                <?php echo $this->lang->line('title_alert_delete'); ?>
            </div>
            <div class="modal-footer">
                <button type="button"
                        class="btn btn-outline-secondary"
                        data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i>
                    <?php echo $this->lang->line('button_alert_save_no'); ?>
                </button>
                <button type="button"
                        class="btn btn-primary"
                        id="confirm_delete">
                    <i class="fa fa-check" aria-hidden="true"></i>
                    <?php echo $this->lang->line('button_alert_save_yes'); ?>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_success" aria-labelledby="myModalLabelSuccess" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success white">
                <h4 class="modal-title" id="myModalLabelSuccess"><?php echo $this->lang->line('head_alert_success'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                <?php echo $this->lang->line('title_alert_success'); ?>
            </div>
            <div class="modal-footer">
                <button type="button"
                        class="btn btn-primary" id="btn_modal_success">
                    <i class="fa fa-check" aria-hidden="true"></i>
                    <?php echo $this->lang->line('button_alert_save_yes'); ?>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_fail" aria-labelledby="myModalLabelFail" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger white">
                <h4 class="modal-title" id="myModalLabelFail"><?php echo $this->lang->line('head_alert_fail'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                <?php echo $this->lang->line('title_alert_fail'); ?>
            </div>
            <div class="modal-footer">
                <button type="button"
                        class="btn btn-primary" id="btn_modal_fail">
                    <i class="fa fa-check" aria-hidden="true"></i>
                    <?php echo $this->lang->line('button_alert_save_yes'); ?>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- END: Modal-->


<!-- BEGIN: Vendor JS-->
<script src="<?php echo $assets; ?>vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="<?php echo $assets; ?>vendors/js/charts/chart.min.js"></script>
<script src="<?php echo $assets; ?>vendors/js/charts/raphael-min.js"></script>
<script src="<?php echo $assets; ?>vendors/js/charts/morris.min.js"></script>
<script src="<?php echo $assets; ?>vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js"></script>
<script src="<?php echo $assets; ?>vendors/js/charts/jvector/jquery-jvectormap-world-mill.js"></script>
<script src="<?php echo $assets; ?>js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="<?php echo $assets; ?>js/plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?php echo $assets; ?>js/plugins/fullcalendar/moment.min.js"></script>
<script src="<?php echo $assets; ?>js/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo $assets; ?>js/jquery.validate.js"></script>
<script src="<?php echo $assets; ?>js/plugins/timepicker/jquery.timepicker.js"></script>
<script src="<?php echo $assets; ?>js/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="<?php echo $assets; ?>js/core/app-menu.js"></script>
<script src="<?php echo $assets; ?>js/core/app.js"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="<?php echo $assets; ?>js/custome.js"></script>
<!-- END: Page JS-->

<?php echo $js; ?>
<script>
    $(document).ready(function () {

       

        $(".select2-cate").select2({
            width: '100%',
            placeholder: "<?php echo $this->lang->line('placeholder_select_cate');?>",
            allowClear: true
        });
    });

    $('input[name="daterange"]').daterangepicker();

    $('#reportrange').daterangepicker({
        format: 'MM/DD/YYYY',
        startDate: moment().subtract(29, 'days'),
        endDate: moment(),
        minDate: '01/01/2012',
        maxDate: '12/31/2015',
        dateLimit: { days: 60 },
        showDropdowns: true,
        showWeekNumbers: true,
        timePicker: false,
        timePickerIncrement: 1,
        timePicker12Hour: true,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        opens: 'right',
        drops: 'down',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-primary',
        cancelClass: 'btn-default',
        separator: ' to ',
        locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Cancel',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
        }
    }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    });
</script>
</body>
</html>
