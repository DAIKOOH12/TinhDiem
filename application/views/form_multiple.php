<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/Vupload.css'; ?>">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Document</title>
</head>

<body>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>

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
                        <div class="input_wrap">
                            <input type="submit" value="Tải lên" name="submit" class="btn btn-primary" id="btn-upload-key">
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
                        <div class="input_wrap">
                            <input type="submit" value="Tải lên" name="submit" class="btn btn-primary" id="upload-btn">
                        </div>
                    </div>

                </form>
                <ul class="list-group"></ul>
            </div>
            <div class="form_3 data_info" style="display: none;">
                <h2>Professional Info</h2>
                <form action="<?php echo site_url("site/upload") ?>">
                    <div class="form_container">
                        <div class="input_wrap">
                            <label for="company">Current Company</label>
                            <input type="text" name="Current Company" class="input" id="company">
                        </div>
                        <div class="input_wrap">
                            <label for="experience">Total Experience</label>
                            <input type="text" name="Total Experience" class="input" id="experience">
                        </div>
                        <div class="input_wrap">
                            <label for="designation">Designation</label>
                            <input type="text" name="Designation" class="input" id="designation">
                        </div>
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

</html>