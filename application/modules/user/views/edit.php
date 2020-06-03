<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block"><?php echo $this->lang->line('label_title_head'); ?></h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <!--                        --><?php //echo $this->breadcrumbs->show(); ?>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                        href="<?php echo base_url() . 'user'; ?>">หน้าหลัก</a></li>
                            <li class="breadcrumb-item active">แก้ไขผู้ใช้งานระบบ</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12">
            </div>
        </div>

        <div class="content-body">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">ฟอร์มแก้ไขข้อมูลผู้ใช้งานระบบ</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <!--                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>-->
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    <!--                                    <li><a data-action="close"><i class="ft-x"></i></a></li>-->
                                </ul>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-xl-12 col-lg-12 col-sm-12">
                                        <form method="post" id="form_data" class="form form-horizontal"
                                              enctype="multipart/form-data">
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-user"></i> Personal Info</h4>
                                                <div class="form-group row">
                                                    <label for="username" class="col-sm-3 label-control" required>
                                                        <?php echo $this->lang->line('label_username'); ?>
                                                    </label>
                                                    <div class="col-md-9 mx-auto">
                                                        <div class="col-sm-9">
                                                            <input type="text"
                                                                   name="username"
                                                                   id="username"
                                                                   placeholder="<?php echo $this->lang->line('label_username'); ?>"
                                                                   class="form-control"
                                                                   onkeyup="isThaichar(this.value,this)"
                                                                   data-rule-required="true"
                                                                   data-msg-required="<?php echo $this->lang->line('label_username_validate'); ?>"
                                                                   value="<?php echo $result['username'] ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="password" class="col-sm-3 label-control" required>
                                                        <?php echo $this->lang->line('label_password'); ?>
                                                    </label>
                                                    <div class="col-md-9 mx-auto">
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
                                                                   value="pw@pw@pw">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="confirm_password" class="col-sm-3 label-control"
                                                           required>
                                                        <?php echo $this->lang->line('label_confirm_password'); ?>
                                                    </label>
                                                    <div class="col-md-9 mx-auto">
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
                                                                   value="pw@pw@pw">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="group_id" class="col-sm-3 label-control" required>
                                                        <?php echo $this->lang->line('label_group_id'); ?>
                                                    </label>
                                                    <div class="col-md-9 mx-auto">
                                                        <div class="col-sm-9">
                                                            <select class="form-control"
                                                                    name="group_id"
                                                                    id="group_id"
                                                                    data-rule-required="true"
                                                                    data-msg-required="<?php echo $this->lang->line('label_error_select'); ?>">
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
                                                </div>
                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-3 label-control" required>
                                                        <?php echo $this->lang->line('label_name'); ?>
                                                    </label>
                                                    <div class="col-md-9 mx-auto">
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
                                                                   value="<?php echo $result['name'] ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="email" class="col-sm-3 label-control" required>
                                                        <?php echo $this->lang->line('label_placeholder_email'); ?>
                                                    </label>
                                                    <div class="col-md-9 mx-auto">
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
                                                                   value="<?php echo $result['email'] ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="telephone" class="col-sm-3 label-control" required>
                                                        <?php echo $this->lang->line('label_telephone'); ?>
                                                    </label>
                                                    <div class="col-md-9 mx-auto">
                                                        <div class="col-sm-9">
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
                                                                   value="<?php echo $result['telephone'] ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="image" class="col-sm-3 label-control" required>
                                                        <?php echo $this->lang->line('label_image'); ?>
                                                    </label>
                                                    <div class="col-md-9 mx-auto">
                                                        <div class="col-sm-9">
                                                            <?php
                                                            $picture = 'http://placehold.it/200x200';
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
                                                                   data-rule-required="false"
                                                                   data-msg-required="<?php echo $this->lang->line('label_error_image'); ?>"
                                                                   class="hidden"/>
                                                        </div>
                                                        <div class="row col-sm-12">
                                                            <button type="button" class="btn btn-success btn-select-img"
                                                                    onclick="choice_img('image');">
                                                                เลือกไฟล์บัตร <i class="fa fa-picture-o"
                                                                                 aria-hidden="true"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions text-center">
                                                <button class="btn btn-primary"
                                                        type="submit">
                                                    <?php echo $this->lang->line('label_btn_save'); ?>
                                                    <i class="fas fa-save"></i>
                                                </button>
                                                <button type="button"
                                                        onclick="window.location.href='<?php echo $url_ajax; ?>'"
                                                        class="btn btn-warning mr-1">
                                                    <i class="ft-x"></i> <?php echo $this->lang->line('label_btn_cancel'); ?>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



