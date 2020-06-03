<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $this->lang->line('label_title_head_show_user'); ?></h2>
<!--        --><?php //echo $this->breadcrumbs->show(); ?>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <form method="post" id="form_data" class="form-horizontal" enctype="multipart/form-data">
                        <div class="no-body" style="padding: 8px 10px;">
                            <div class="form-group">
                                <label class="col-sm-3 control-label" required>
                                    <?php echo $this->lang->line('label_username'); ?>
                                </label>
                                <div class="col-sm-9">
                                    <input type="text"
                                           name="username"
                                           id="username"
                                           placeholder="<?php echo $this->lang->line('label_username'); ?>"
                                           class="form-control"
                                           onkeyup="isThaichar(this.value,this)"
                                           data-rule-required="true"
                                           data-msg-required="<?php echo $this->lang->line('label_username_validate'); ?>"
                                           value="<?php echo $result['username'] ?>"
                                    />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" required>
                                    <?php echo $this->lang->line('label_password'); ?>
                                </label>
                                <div class="col-sm-9">
                                    <input type="password"
                                           name="password"
                                           id="password"
                                           placeholder="<?php echo $this->lang->line('label_password'); ?>"
                                           class="form-control"
                                           data-rule-required="true"
                                           data-msg-required="<?php echo $this->lang->line('label_error_msg'); ?>"
                                           data-rule-minlength="6"
                                           data-msg-minlength="<?php echo str_replace('{n}', '6', $this->lang->line('label_error_minlength')); ?>"
                                           maxlength="20"
                                           value="pw@pw@pw"
                                    />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" required>
                                    <?php echo $this->lang->line('label_confirm_password'); ?>
                                </label>
                                <div class="col-sm-9">
                                    <input type="password"
                                           name="confirm_password"
                                           id="confirm_password"
                                           placeholder="<?php echo $this->lang->line('label_confirm_password'); ?>"
                                           class="form-control"
                                           data-rule-required="true"
                                           data-msg-required="<?php echo $this->lang->line('label_error_msg'); ?>"
                                           data-rule-minlength="6"
                                           data-msg-minlength="<?php echo str_replace('{n}', '6', $this->lang->line('label_error_minlength')); ?>"
                                           data-rule-equalto="#password"
                                           data-msg-equalto="<?php echo $this->lang->line('label_confirm_password_validate'); ?>"
                                           maxlength="20"
                                           value="pw@pw@pw"
                                    />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">
                                    <?php echo $this->lang->line('label_group_id'); ?>
                                </label>
                                <div class="col-sm-9">
                                    <select class="form-control"
                                            name="group_id"
                                            id="group_id"
                                            data-rule-required="true"
                                            data-msg-required="<?php echo $this->lang->line('label_error_select'); ?>"
                                            disabled="disabled"
                                    >
                                        <option value=""><?php echo $this->lang->line('label_select_group') ?></option>
                                        <?php
                                        if (!empty($data_user_group)) {
                                            foreach ($data_user_group as $key => $value) {
                                                $selected = '';
                                                if ($result['group_id'] == $value['id']) {
                                                    $selected = 'selected';
                                                }
                                                ?>
                                                <option value="<?php echo $value['id']; ?>" <?php echo $selected; ?>>
                                                    <?php echo $value['group_name']; ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" required>
                                    <?php echo $this->lang->line('label_name'); ?>
                                </label>
                                <div class="col-sm-9">
                                    <input type="text"
                                           name="name"
                                           id="name"
                                           placeholder="<?php echo $this->lang->line('label_name'); ?>"
                                           class="form-control"
                                           data-rule-required="true"
                                           data-msg-required="<?php echo $this->lang->line('label_error_msg'); ?>"
                                           data-rule-minlength="6"
                                           data-msg-minlength="<?php echo str_replace('{n}', '6', $this->lang->line('label_error_minlength')); ?>"
                                           maxlength="250"
                                           value="<?php echo $result['name'] ?>"
                                    />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" required>
                                    <?php echo $this->lang->line('label_email'); ?>
                                </label>
                                <div class="col-sm-9">
                                    <input type="email"
                                           name="email"
                                           id="email"
                                           placeholder="<?php echo $this->lang->line('label_placeholder_email'); ?>"
                                           class="form-control"
                                           data-rule-required="true"
                                           data-msg-required="<?php echo $this->lang->line('label_error_msg'); ?>"
                                           data-rule-email="true"
                                           data-msg-email="<?php echo $this->lang->line('label_error_email_format'); ?>"
                                           maxlength="100"
                                           value="<?php echo $result['email'] ?>"
                                    />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" required>
                                    <?php echo $this->lang->line('label_telephone'); ?>
                                </label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                    <span
                                        class="input-group-addon"><?php echo $this->lang->line('label_prefix_phone'); ?></span>
                                        <input type="text"
                                               name="telephone"
                                               id="telephone"
                                               class="form-control"
                                               placeholder="<?php echo $this->lang->line('label_telephone'); ?>"
                                               data-rule-required="true"
                                               data-msg-required="<?php echo $this->lang->line('label_error_telephone'); ?>"
                                               data-rule-minlength="9"
                                               data-msg-minlength="<?php echo str_replace('{n}', '9', $this->lang->line('label_error_minlength')); ?>"
                                               data-rule-number="true"
                                               data-msg-number="<?php echo $this->lang->line('label_error_telephone_num'); ?>"
                                               maxlength="15"
                                               value="<?php echo $result['telephone'] ?>"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">
                                    <?php echo $this->lang->line('label_image'); ?>
                                </label>
                                <div class="col-sm-9">
                                    <div class="row col-sm-12">
                                        <?php
                                        $picture = 'http://placehold.it/200x100';
                                        if (!empty($result['picture'])) {
                                            $picture = base_url('uploads/user/' . $result['picture']);
                                        }
                                        ?>
                                        <img id="show_image"
                                             class="img_200x200"
                                             src="<?php echo $picture; ?>"
                                             alt="Upload Image"/>
                                        <input type="file"
                                               name="image"
                                               id="image"
                                               onchange="preview_image(event, this);"
                                               accept="image/*"
                                               data-rule-required="true"
                                               data-msg-required="<?php echo $this->lang->line('label_error_image'); ?>"
                                               class="hidden"/>
                                    </div>
                                    <div class="row col-sm-12">
                                        <button type="button" class="btn btn-success btn-select-img" onclick="choice_img('image');">
                                            <?php echo $this->lang->line('label_select_file'); ?>
                                        </button>
                                    <span class="text-guide m-b-none">
                                        <?php echo $this->lang->line('label_help_image'); ?>
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="">
                            <ul class="list-unstyled list-inline text-center">
                                <li>
                                    <button class="btn btn-primary"
                                            type="submit"
                                    >
                                        <?php echo $this->lang->line('label_btn_save'); ?>
                                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                    </button>
                                </li>
                                <li>
                                    <button type="button"
                                            class="btn btn-default"
                                            style="margin-left: 0;"
                                            onclick="window.location.href='<?php echo base_url('dashboard'); ?>'">
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