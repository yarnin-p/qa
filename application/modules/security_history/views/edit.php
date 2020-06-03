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
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" required>
                                            <?php echo $this->lang->line('label_card_type_code'); ?>
                                        </label>
                                        <div class="col-sm-4">
                                            <input type="text"
                                                   name="card_type_code"
                                                   id="card_type_code"
                                                   value="<?php echo $result['card_type_code']?>"
                                                   placeholder="<?php echo $this->lang->line('label_card_type_code'); ?>"
                                                   class="form-control to-upper"
                                                   data-rule-required="true"
                                                   data-msg-required="<?php echo $this->lang->line('label_card_type_code_validate'); ?>"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" required>
                                            <?php echo $this->lang->line('label_name_tha'); ?>
                                        </label>
                                        <div class="col-sm-4">
                                            <input type="text"
                                                   name="name_tha"
                                                   id="name_tha"
                                                   value="<?php echo $result['name_tha']?>"
                                                   placeholder="<?php echo $this->lang->line('label_name_tha'); ?>"
                                                   class="form-control"
                                                   data-rule-required="true"
                                                   data-msg-required="<?php echo $this->lang->line('label_name_tha_validate'); ?>"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" required>
                                            <?php echo $this->lang->line('label_name_eng'); ?>
                                        </label>
                                        <div class="col-sm-4">
                                            <input type="text"
                                                   name="name_eng"
                                                   id="name_eng"
                                                   value="<?php echo $result['name_eng']?>"
                                                   placeholder="<?php echo $this->lang->line('label_name_eng'); ?>"
                                                   class="form-control"
                                                   data-rule-required="true"
                                                   data-msg-required="<?php echo $this->lang->line('label_name_eng_validate'); ?>"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">
                                            <?php //echo $this->lang->line('label_username'); ?>
                                            หมายเหตุ
                                        </label>
                                        <div class="col-sm-4">
                                            <textarea class="form-control"
                                                      name="remark"
                                                      id="remark"
                                                      placeholder="<?php echo $this->lang->line('label_remark'); ?>"
                                                      class="form-control"
                                                      size="2"
                                            ><?php echo $result['remark']?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <ul class="list-unstyled list-inline text-center">
                                <li>
                                    <button class="btn btn-primary"
                                            type="button"
                                            id="save_dataForm">
                                        <?php echo $this->lang->line('label_btn_save'); ?>
                                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                    </button>
                                </li>
                                <li>
                                    <button type="button"
                                            class="btn btn-default"
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