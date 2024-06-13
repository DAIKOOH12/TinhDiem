<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/Vupload.css'; ?>">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/fontawesome/css/all.min.css'; ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Document</title>
</head>

<body>
    <div class="wrapper">
        <div class="header">
            <ul>
                <li class="active form_1_progessbar">
                    <div>
                        <p>1</p>
                    </div>
                </li>
                <li class="form_2_progessbar">
                    <div>
                        <p>2</p>
                    </div>
                </li>
                <li class="form_3_progessbar">
                    <div>
                        <p>3</p>
                    </div>
                </li>
            </ul>
        </div>
        <div class="form_wrap">
            <div class="form_1 data_info">
                <h2>Nhập đáp án cho các đề</h2>
                <form action="<?php echo site_url('site/spreadsheet_import') ?>" method="post" enctype="multipart/form-data" id="form-upload-key">
                    <div class="form_container">
                        <div class="input_wrap">
                            <label for="email">Nhập mã đề</label>
                            <input type="text" name="made" class="input" id="made">
                        </div>
                        <div class="input_wrap">
                            <label for="email">Nhập mã môn</label>
                            <input type="text" name="mamon" class="input" id="mamon">
                        </div>
                        <div class="input_wrap">
                            <label class="mr-2">Nhập bộ đáp án</label>
                            <input type="file" name="upload_file_key" id="upload_file" class="form-control" placeholder="Enter file">
                        </div>
                        <div class="input_wrap" style="display: flex;justify-content: center;">
                            <button class="btn btn-primary" id="btn-upload-key"><i class="fa-solid fa-file-arrow-up" style="color: #ffffff;margin-right: 10px;"></i>Tải lên</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="form_2 data_info" style="display: none;">
                <h2>Nhập file đáp án</h2>
                <form action="<?php echo site_url("site/upload") ?>" method="post" enctype="multipart/form-data" id="form-upload">
                    <div class="form_container">
                        <div class="input_wrap">
                            <div class="form-control" data-trigger="fileinput" style="width: 100%;"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename">Định dạng file hỗ trợ: .xlsx</span></div>
                        </div>
                        <div class="input_wrap">
                            <!-- <span>Chọn mã đề</span>
                            <select name="" id="">
                                <option value="">A113</option>
                                <option value="">A114</option>
                                <option value="">A115</option>
                                <option value="">A116</option>
                            </select> -->
                        </div>
                        <div class="input_wrap">
                            <span class="input-group-addon btn-outline-primary btn-file"><span class="fileinput-new"><i class="glyphicon glyphicon-paperclip"></i> Thêm các tệp tin</span><input type="file" name="file[]" multiple id="file" placeholder="Định dạng file hỗ trợ: .xlsx"></span>
                        </div>
                        <div class="input_wrap"  style="display: flex;justify-content: center;">
                        <button class="btn btn-primary" id="upload-btn"><i class="fa-solid fa-file-arrow-up" style="color: #ffffff;margin-right: 10px;"></i>Tải lên</button>
                        </div>
                        <div class="progress" style="display:none;width: 100%;">
                            <div id="progress-bar" class="progress-bar progress-bar-success progress-bar-striped " role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                                20%
                            </div>
                        </div>
                        <h4>Các file đã thêm</h4>
                        <ul class="list-group">

                        </ul>
                    </div>

                </form>

            </div>
            <div class="form_3 data_info" style="display: none;">
                <h2>Đang xử lí.....</h2>
                <form action="<?php echo site_url("site/upload") ?>" id="form-upload-key">
                    <div class="input_wrap" style="display: flex;justify-content: center;">
                        <div class="loader"></div>
                    </div>
                </form>
            </div>
        </div>
        <div class="btns_wrap">
            <div class="common_btns form_1_btns">
                <button type="button" class="btn_next">Next <span class="icon">
                        <ion-icon name="arrow-forward-sharp"></ion-icon>
                    </span></button>
            </div>
            <div class="common_btns form_2_btns" style="display: none;">
                <button type="button" class="btn_back"><span class="icon">
                        <ion-icon name="arrow-back-sharp"></ion-icon>
                    </span>Back</button>
                <button type="button" class="btn_next">Next <span class="icon">
                        <ion-icon name="arrow-forward-sharp"></ion-icon>
                    </span></button>
            </div>
            <div class="common_btns form_3_btns" style="display: none;">
                <button type="button" class="btn_back"><span class="icon">
                        <ion-icon name="arrow-back-sharp"></ion-icon>
                    </span>Back</button>
                <button type="button" class="btn_done">Done</button>
            </div>
        </div>
    </div>

    <div class="modal_wrapper">
        <div class="shadow"></div>
        <div class="success_wrap">
            <span class="modal_icon">
                <ion-icon name="checkmark-sharp"></ion-icon>
            </span>
            <p>You have successfully completed the process.</p>
        </div>
    </div>

</body>
<script src="<?php echo base_url(); ?>assets/js/upload_form.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jasny-bootstrap.min.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/js/custom.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>

</html>