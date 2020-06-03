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
                                        href="<?php echo base_url().'menu'; ?>">หน้าหลัก</a></li>
                            <li class="breadcrumb-item active">เพิ่มเมนู</li>
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
                            <h4 class="card-title">ฟอร์มเพิ่มข้อมูลเมนู</h4>
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
                                                    <label for="parent_id" class="col-sm-3 label-control" required>
                                                        <?php echo $this->lang->line('label_select_parent_menu'); ?>
                                                    </label>
                                                    <div class="col-md-9 mx-auto">
                                                        <div class="col-sm-9">
                                                            <select class="form-control select2"
                                                                    name="parent_id"
                                                                    id="parent_id" >
                                                                <option value="-1"><?php echo $this->lang->line('label_select_parent_menu') ?></option>
                                                                <?php
                                                                if (!empty($get_menu_level)) {
                                                                    foreach ($get_menu_level as $key => $value) {
                                                                        ?>
                                                                        <option value="<?php echo $value['parent_id']; ?>">
                                                                            <?php echo $value['text_name_tha']; ?>
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
                                                    <label for="screen_id" class="col-sm-3 label-control" required>
                                                        <?php echo $this->lang->line('label_screen_id'); ?>
                                                    </label>
                                                    <div class="col-md-9 mx-auto">
                                                        <div class="col-sm-9">
                                                            <input type="text"
                                                                   name="screen_id"
                                                                   id="screen_id"
                                                                   minlength="4"
                                                                   maxlength="4"
                                                                   onkeyup="check_screen_no()"
                                                                   placeholder="<?php echo $this->lang->line('label_screen_id'); ?>"
                                                                   class="form-control"
                                                                   data-rule-required="true"
                                                                   data-msg-required="<?php echo $this->lang->line('label_screen_id_validate'); ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="text_name_tha" class="col-sm-3 label-control" required>
                                                        <?php echo $this->lang->line('label_name_tha'); ?>
                                                    </label>
                                                    <div class="col-md-9 mx-auto">
                                                        <div class="col-sm-9">
                                                            <input type="text"
                                                                   name="text_name_tha"
                                                                   id="text_name_tha"
                                                                   placeholder="<?php echo $this->lang->line('label_name_tha'); ?>"
                                                                   class="form-control"
                                                                   data-rule-required="true"
                                                                   data-msg-required="<?php echo $this->lang->line('label_name_tha_validate'); ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="text_name_eng" class="col-sm-3 label-control" required>
                                                        <?php echo $this->lang->line('label_name_eng'); ?>
                                                    </label>
                                                    <div class="col-md-9 mx-auto">
                                                        <div class="col-sm-9">
                                                            <input type="text"
                                                                   name="text_name_eng"
                                                                   id="text_name_eng"
                                                                   placeholder="<?php echo $this->lang->line('label_name_eng'); ?>"
                                                                   class="form-control"
                                                                   data-rule-required="true"
                                                                   data-msg-required="<?php echo $this->lang->line('label_name_eng_validate'); ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="class_name" class="col-sm-3 label-control" required>
                                                        <?php echo $this->lang->line('label_class_name'); ?>
                                                    </label>
                                                    <div class="col-md-9 mx-auto">
                                                        <div class="col-sm-9">
                                                            <input type="text"
                                                                   name="class_name"
                                                                   id="class_name"
                                                                   placeholder="<?php echo $this->lang->line('label_class_name'); ?>"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="icon" class="col-sm-3 label-control" required>
                                                        <?php echo $this->lang->line('label_icon'); ?>
                                                    </label>
                                                    <div class="col-md-9 mx-auto">
                                                        <div class="col-sm-9">
                                                            <input type="text"
                                                                   name="icon"
                                                                   id="icon"
                                                                   placeholder="<?php echo $this->lang->line('label_icon'); ?>"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="sort_no" class="col-sm-3 label-control" required>
                                                        <?php echo $this->lang->line('label_sort'); ?>
                                                    </label>
                                                    <div class="col-md-9 mx-auto">
                                                        <div class="col-sm-9">
                                                            <input type="text"
                                                                   name="sort_no"
                                                                   id="sort_no"
                                                                   class="form-control"
                                                                   placeholder="<?php echo $this->lang->line('label_sort'); ?>"
                                                                   data-rule-required="true"
                                                                   data-msg-required="<?php echo $this->lang->line('label_sort_validate'); ?>">
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



