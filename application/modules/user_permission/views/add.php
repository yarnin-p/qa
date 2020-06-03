<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $this->lang->line('label_title_head_add'); ?></h2>
        <?php echo $this->breadcrumbs->show(); ?>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <form method="post" id="dataForm" class="form-horizontal" enctype="multipart/form-data">
                        <div class="no-body" style="padding: 8px 10px;">
                            <div class="form-group">
                                <label class="col-sm-3 control-label" required>
                                    <?php echo $this->lang->line('label_username'); ?>
                                </label>
                                <div class="col-sm-9">
                                    <input type="text"
                                           name="group_name_tha"
                                           id="group_name_tha"
                                           placeholder="<?php echo $this->lang->line('label_username'); ?>"
                                           class="form-control"
                                           data-rule-required="true"
                                           data-msg-required="<?php echo $this->lang->line('label_error_msg'); ?>"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <ul class="list-unstyled list-inline text-center">
                                <li>
                                    <button class="btn btn-primary"
                                            type="submit">
                                        <?php echo $this->lang->line('label_btn_save'); ?>
                                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                    </button>
                                </li>
                                <li>
                                    <button type="reset"
                                            class="btn btn-white"
                                            style="margin-left: 0;"
                                            onclick="window.location.href='<?php echo $url_ajax; ?>'">
                                        <?php echo $this->lang->line('label_btn_cancel'); ?>
                                        <i class="fa fa-ban" aria-hidden="true"></i>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>