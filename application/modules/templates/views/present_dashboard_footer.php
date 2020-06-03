<div class="footer">
    <div>
        <strong>Copyrights</strong> © 2020 ML Future Tech. All Rights Reserved. Designed by S-Planet
    </div>
</div>
</div>


<div class="modal fade" id="modal_delete">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div class="modal-title"><?php echo $this->lang->line('head_alert_delete'); ?></div>
            </div>
            <div class="modal-body text-center">
                <input type="hidden" name="delete_link" id="delete_link" class="hide" value="">
                <?php echo $this->lang->line('title_alert_delete'); ?>
            </div>
            <div class="modal-footer">
                <button type="button"
                        class="btn btn-default"
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

<div class="modal fade" id="modal_success">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div class="modal-title"><?php echo $this->lang->line('head_alert_success'); ?></div>
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

<div class="modal fade" id="modal_fail">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div class="modal-title"><?php echo $this->lang->line('head_alert_fail'); ?></div>
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


<a href="#" class="back-to-top">
    <span class="glyphicon glyphicon-chevron-up"></span>
</a>

<!-- Mainly scripts -->
<script src="<?php echo $assets; ?>js/jquery-3.1.1.min.js"></script>
<script src="<?php echo $assets; ?>js/bootstrap.min.js"></script>
<script src="<?php echo $assets; ?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo $assets; ?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo $assets; ?>plugins/ckeditor/ckeditor.js"></script>
<script src="<?php echo $assets; ?>js/plugins/iCheck/icheck.min.js"></script>

<!-- Flot
    <script src="<?php echo $assets; ?>js/plugins/flot/jquery.flot.js"></script>
    <script src="<?php echo $assets; ?>js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="<?php echo $assets; ?>js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="<?php echo $assets; ?>js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="<?php echo $assets; ?>js/plugins/flot/jquery.flot.pie.js"></script>
    -->

<!-- Peity
    <script src="<?php echo $assets; ?>js/plugins/peity/jquery.peity.min.js"></script>
    <script src="<?php echo $assets; ?>js/demo/peity-demo.js"></script>
    -->

<!-- Custom and plugin javascript -->
<script src="<?php echo $assets; ?>js/inspinia.js"></script>
<script src="<?php echo $assets; ?>js/plugins/pace/pace.min.js"></script>

<!-- Steps -->
<script src="<?php echo $assets; ?>js/plugins/steps/jquery.steps.min.js"></script>

<!-- jQuery UI
    <script src="<?php echo $assets; ?>js/plugins/jquery-ui/jquery-ui.min.js"></script>
    -->

<!-- GITTER
    <script src="<?php echo $assets; ?>js/plugins/gritter/jquery.gritter.min.js"></script>
    -->

<!-- Sparkline
    <script src="<?php echo $assets; ?>js/plugins/sparkline/jquery.sparkline.min.js"></script>
    -->

<!-- Data picker -->
<script src="<?php echo $assets; ?>js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- Date range picker -->
<script src="<?php echo $assets; ?>js/plugins/daterangepicker/daterangepicker.js"></script>

<!-- Date range use moment.js same as full calendar plugin -->
<script src="<?php echo $assets; ?>js/plugins/fullcalendar/moment.min.js"></script>

<!-- Sparkline demo data
    <script src="<?php echo $assets; ?>js/demo/sparkline-demo.js"></script>
    -->

<!-- ChartJS
    <script src="<?php echo $assets; ?>js/plugins/chartJs/Chart.min.js"></script>
    -->

<!-- Toastr
    <script src="<?php echo $assets; ?>js/plugins/toastr/toastr.min.js"></script>
    -->
<!-- Select2 -->
<script src="<?php echo $assets; ?>plugins/select2/js/select2.full.min.js"></script>

<!-- Jquery Validate -->
<script src="<?php echo $assets; ?>js/jquery.validate.js"></script>

<!-- Jquery Form -->
<script src="<?php echo $assets; ?>js/jquery.form.js"></script>

<!-- Jquery loading overlay -->
<script src="<?php echo $assets; ?>plugins/jquery-loading-overlay/loadingoverlay.min.js"></script>

<!-- Custom -->
<script src="<?php echo $assets; ?>js/custom.js"></script>

<!-- Dual Listbox -->
<script src="<?php echo $assets; ?>js/plugins/dualListbox/jquery.bootstrap-duallistbox.js"></script>

<!-- Input Mask-->
<script src="<?php echo $assets; ?>js/plugins/jasny/jasny-bootstrap.min.js"></script>

<!-- Intro js-->
<script src="<?php echo $assets; ?>js/plugins/introjs/intro.js"></script>

<!-- Data Time picker -->
<script src="<?php echo $assets; ?>js/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>

<!-- Time picker -->
<script src="<?php echo $assets; ?>js/plugins/timepicker/jquery.timepicker.js"></script>

<!-- Checkbox Images -->
<!--<script src="--><?php //echo $assets; ?><!--imgCheckbox/jquery.imgcheckbox.js"></script>-->

<!-- Format script -->
<script src="https://pixinvent.com/materialize-material-design-admin-template/app-assets/vendors/formatter/jquery.formatter.min.js"></script>

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
