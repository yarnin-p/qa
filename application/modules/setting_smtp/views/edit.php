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
                                            <?php echo $this->lang->line('label_smtp_server'); ?>
                                        </label>
                                        <div class="col-sm-4">
                                            <input type="text"
                                                   name="smtp_server"
                                                   id="smtp_server"
                                                   placeholder="<?php echo $this->lang->line('smtp_server'); ?>"
                                                   class="form-control"
                                                   value="<?php echo $result['smtp_server']?>"
                                                   data-rule-required="true"
                                                   data-msg-required="<?php echo $this->lang->line('smtp_server_validate'); ?>"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" required>
                                            <?php echo $this->lang->line('label_ssl_tls'); ?>
                                        </label>
                                        <div class="col-sm-2">
                                            <select class="form-control select2"
                                                    id="ssl_tls"
                                                    name="ssl_tls"
                                            >
                                                <option value="ssl"
                                                    <?php echo $result['ssl_tls'] == "ssl" ? 'selected' : '' ; ?>
                                                >ssl</option>
                                                <option value="tls"
                                                    <?php echo $result['ssl_tls'] == "tls" ? 'selected' : '' ; ?>
                                                >tls</option>
                                                <option value="none"
                                                    <?php echo $result['ssl_tls'] == "none" ? 'selected' : '' ; ?>
                                                >none</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" required>
                                            <?php echo $this->lang->line('label_smtp_port'); ?>
                                        </label>
                                        <div class="col-sm-2">
                                            <input type="text"
                                                   name="smtp_port"
                                                   id="smtp_port"
                                                   placeholder="<?php echo $this->lang->line('smtp_port'); ?>"
                                                   class="form-control"
                                                   value="<?php echo $result['smtp_port']?>"
                                                   data-rule-required="true"
                                                   data-msg-required="<?php echo $this->lang->line('smtp_port_validate'); ?>"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" required>
                                            <?php echo $this->lang->line('label_is_authenticate'); ?>
                                        </label>
                                        <div class="col-sm-1">
                                            <label class="control-label">
                                                <input type="radio"
                                                       name="is_authenticate"
                                                       value="1"
                                                       <?php echo $result['is_authenticate'] == "1" ? 'checked' : '' ; ?>
                                                /><?php echo $this->lang->line('radio_yes'); ?></label>
                                        </div>
                                        <div class="col-sm-1">
                                            <label class="control-label">
                                                <input type="radio"
                                                       name="is_authenticate"
                                                       value="0"
                                                       <?php echo $result['is_authenticate'] == "0" ? 'checked' : '' ; ?>
                                                /><?php echo $this->lang->line('radio_no'); ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" required>
                                            <?php echo $this->lang->line('label_authenticate_username'); ?>
                                        </label>
                                        <div class="col-sm-4">
                                            <input type="text"
                                                   name="authenticate_username"
                                                   id="authenticate_username"
                                                   placeholder="<?php echo $this->lang->line('authenticate_username'); ?>"
                                                   class="form-control"
                                                   value="<?php echo $result['authenticate_username']?>"
                                                   data-rule-required="true"
                                                   data-msg-required="<?php echo $this->lang->line('authenticate_username_validate'); ?>"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" required>
                                            <?php echo $this->lang->line('label_authenticate_password'); ?>
                                        </label>
                                        <div class="col-sm-4">
                                            <input type="password"
                                                   name="authenticate_password"
                                                   id="authenticate_password"
                                                   placeholder="<?php echo $this->lang->line('authenticate_password'); ?>"
                                                   class="form-control"
                                                   value="<?php echo $result['authenticate_password']?>"
                                                   data-rule-required="true"
                                                   data-msg-required="<?php echo $this->lang->line('authenticate_password_validate'); ?>"
                                            />
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