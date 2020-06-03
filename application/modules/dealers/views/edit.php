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
                                        href="<?php echo base_url().'dealers'; ?>">หน้าหลัก</a></li>
                            <li class="breadcrumb-item active">เพิ่มดีลเลอร์</li>
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
                            <h4 class="card-title">ฟอร์มเพิ่มข้อมูลดีลเลอร์</h4>
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
                                                    <label for="dealer_name" class="col-sm-3 label-control" required>
                                                        <?php echo $this->lang->line('label_form_dealer_fullname'); ?>
                                                    </label>
                                                    <div class="col-md-9 mx-auto">
                                                        <div class="col-sm-9">
                                                            <input type="text"
                                                                   name="supplier_name"
                                                                   id="supplier_name"
                                                                   value="<?php echo $result['dealer_name']; ?>"
                                                                   placeholder="<?php echo $this->lang->line('label_form_dealer_fullname'); ?>"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="dealer_tel" class="col-sm-3 label-control" required>
                                                        <?php echo $this->lang->line('label_form_dealer_tel'); ?>
                                                    </label>
                                                    <div class="col-md-9 mx-auto">
                                                        <div class="col-sm-9">
                                                            <input type="text"
                                                                   name="dealer_tel"
                                                                   id="dealer_tel"
                                                                   value="<?php echo $result['dealer_tel']; ?>"
                                                                   placeholder="<?php echo $this->lang->line('label_form_dealer_tel'); ?>"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="dealer_tel" class="col-sm-3 label-control" required>
                                                        <?php echo $this->lang->line('label_form_dealer_email'); ?>
                                                    </label>
                                                    <div class="col-md-9 mx-auto">
                                                        <div class="col-sm-9">
                                                            <input type="email"
                                                                   name="dealer_email"
                                                                   id="dealer_email"
                                                                   value="<?php echo $result['dealer_email']; ?>"
                                                                   placeholder="<?php echo $this->lang->line('label_form_dealer_email'); ?>"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="dealer_line" class="col-sm-3 label-control" required>
                                                        <?php echo $this->lang->line('label_form_dealer_line'); ?>
                                                    </label>
                                                    <div class="col-md-9 mx-auto">
                                                        <div class="col-sm-9">
                                                            <input type="text"
                                                                   name="dealer_line"
                                                                   id="dealer_line"
                                                                   value="<?php echo $result['dealer_line']; ?>"
                                                                   placeholder="<?php echo $this->lang->line('label_form_dealer_line'); ?>"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="dealer_username" class="col-sm-3 label-control" required>
                                                        <?php echo $this->lang->line('label_form_dealer_username'); ?>
                                                    </label>
                                                    <div class="col-md-9 mx-auto">
                                                        <div class="col-sm-9">
                                                            <input type="text"
                                                                   name="dealer_username"
                                                                   id="dealer_username"
                                                                   value="<?php echo $result['username']; ?>"
                                                                   placeholder="<?php echo $this->lang->line('label_form_dealer_username'); ?>"
                                                                   class="form-control">
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



