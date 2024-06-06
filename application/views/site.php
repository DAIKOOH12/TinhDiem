<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ajax file Upload with jQuery + Codeigniter + Bootstrap</title>

  <!-- Bootstrap -->
  <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/Vupload.css' ?>">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
  <!-- Jasny bootstrap -->
  <link href="<?php echo base_url(); ?>assets/css/jasny-bootstrap.min.css" rel="stylesheet" media="screen">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
  <div class="super_container">

    <!-- Header -->

    <header class="header">

      <!-- Top Bar -->

      <div class="top_bar">
        <div class="container">
          <div class="row">
            <div class="col d-flex flex-row">
              <div class="top_bar_contact_item">
                <div class="top_bar_icon"><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1560918577/phone.png" alt=""></div>+91 9823 132 111
              </div>
              <div class="top_bar_contact_item">
                <div class="top_bar_icon"><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1560918597/mail.png" alt=""></div><a href="mailto:fastsales@gmail.com">contact@bbbootstrap.com</a>
              </div>
              <div class="top_bar_content ml-auto">
                <div class="top_bar_menu">
                  <ul class="standard_dropdown top_bar_dropdown">
                    <li>
                      <a href="#">English<i class="fas fa-chevron-down"></i></a>
                      <ul>
                        <li><a href="#">Italian</a></li>
                        <li><a href="#">Spanish</a></li>
                        <li><a href="#">Japanese</a></li>
                      </ul>
                    </li>
                  </ul>
                </div>
                <div class="top_bar_user">
                  <div class="user_icon"><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1560918647/user.svg" alt=""></div>
                  <div><a href="#">Register</a></div>
                  <div><a href="#">Sign in</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Main Navigation -->

      <nav class="main_nav">
        <div class="container">
          <div class="row">
            <div class="col">

              <div class="main_nav_content d-flex flex-row">
                <div class="main_nav_menu">
                  <ul class="standard_dropdown main_nav_dropdown">
                    <li><a href="#">Home<i class="fas fa-chevron-down"></i></a></li>
                    <li><a href="contact.html">Contact<i class="fas fa-chevron-down"></i></a></li>
                  </ul>
                </div>

                <!-- Menu Trigger -->

                <div class="menu_trigger_container ml-auto">
                  <div class="menu_trigger d-flex flex-row align-items-center justify-content-end">
                    <div class="menu_burger">
                      <div class="menu_trigger_text">menu</div>
                      <div class="cat_burger menu_burger_inner">
                        <span></span><span></span><span></span>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </nav>

      <!-- Menu -->

      <div class="page_menu">
        <div class="container">
          <div class="row">
            <div class="col">

              <div class="page_menu_content">

                <div class="page_menu_search">
                  <form action="#">
                    <input type="search" required="required" class="page_menu_search_input" placeholder="Search for products...">
                  </form>
                </div>
                <ul class="page_menu_nav">
                  <li class="page_menu_item has-children">
                    <a href="#">Language<i class="fa fa-angle-down"></i></a>
                    <ul class="page_menu_selection">
                      <li><a href="#">English<i class="fa fa-angle-down"></i></a></li>
                      <li><a href="#">Italian<i class="fa fa-angle-down"></i></a></li>
                      <li><a href="#">Spanish<i class="fa fa-angle-down"></i></a></li>
                      <li><a href="#">Japanese<i class="fa fa-angle-down"></i></a></li>
                    </ul>
                  </li>
                  <li class="page_menu_item has-children">
                    <a href="#">Currency<i class="fa fa-angle-down"></i></a>
                    <ul class="page_menu_selection">
                      <li><a href="#">US Dollar<i class="fa fa-angle-down"></i></a></li>
                      <li><a href="#">EUR Euro<i class="fa fa-angle-down"></i></a></li>
                      <li><a href="#">GBP British Pound<i class="fa fa-angle-down"></i></a></li>
                      <li><a href="#">JPY Japanese Yen<i class="fa fa-angle-down"></i></a></li>
                    </ul>
                  </li>
                  <li class="page_menu_item">
                    <a href="#">Home<i class="fa fa-angle-down"></i></a>
                  </li>
                  <li class="page_menu_item has-children">
                    <a href="#">Super Deals<i class="fa fa-angle-down"></i></a>
                    <ul class="page_menu_selection">
                      <li><a href="#">Super Deals<i class="fa fa-angle-down"></i></a></li>
                      <li class="page_menu_item has-children">
                        <a href="#">Menu Item<i class="fa fa-angle-down"></i></a>
                        <ul class="page_menu_selection">
                          <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                          <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                          <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                          <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                        </ul>
                      </li>
                      <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                      <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                      <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                    </ul>
                  </li>
                  <li class="page_menu_item has-children">
                    <a href="#">Featured Brands<i class="fa fa-angle-down"></i></a>
                    <ul class="page_menu_selection">
                      <li><a href="#">Featured Brands<i class="fa fa-angle-down"></i></a></li>
                      <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                      <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                      <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                    </ul>
                  </li>
                  <li class="page_menu_item has-children">
                    <a href="#">Trending Styles<i class="fa fa-angle-down"></i></a>
                    <ul class="page_menu_selection">
                      <li><a href="#">Trending Styles<i class="fa fa-angle-down"></i></a></li>
                      <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                      <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                      <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                    </ul>
                  </li>
                  <li class="page_menu_item"><a href="blog.html">blog<i class="fa fa-angle-down"></i></a></li>
                  <li class="page_menu_item"><a href="contact.html">contact<i class="fa fa-angle-down"></i></a></li>
                </ul>

                <div class="menu_contact">
                  <div class="menu_contact_item">
                    <div class="menu_contact_icon"><img src="" alt=""></div>
                    +38 068 005 3570
                  </div>
                  <div class="menu_contact_item">
                    <div class="menu_contact_icon"><img src="" alt=""></div><a href="mailto:fastsales@gmail.com">fastsales@gmail.com</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </header>


    <!-- original pen: https://codepen.io/roydigerhund/pen/ZQdbeN  -->

    <!-- NO JS ADDED YET -->

  </div>
  <section id="form-container" style="padding: 0;">
    <div class="main-body">
      <div style="width: 80%;display: flex;justify-content: space-evenly;">
        <div class="upload-key">
          <form action="<?php echo site_url('site/spreadsheet_import') ?>" method="post" enctype="multipart/form-data" id="form-upload-key">
            <div class="form-group">
              <label for="exampleInputEmail1" required="required">Nhập mã đề</label>
              <input type="text" name="made" id="made" placeholder="Nhập mã đề" class="form-control">
            </div>
            <hr>
            <div class="form-group mt-3">
              <label class="mr-2">Nhập bộ đáp án</label>
              <input type="file" name="upload_file_key" id="upload_file" class="form-control" placeholder="Enter file">
            </div>
            <hr>
            <input type="submit" value="Tải lên" name="submit" class="btn btn-primary" id="btn-upload-key">
          </form>
        </div>
        <div class="upload-anwser">
          <form action="<?php echo site_url("site/upload") ?>" id="form-upload">
            <div class="fileinput fileinput-new input-group form-ctrl" data-provides="fileinput" id="iiwo">
              <div class="form-control" data-trigger="fileinput" style="width: 100%;"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename">Định dạng file hỗ trợ: .xlsx</span></div>
              <div class="opt-files">
                <span class="input-group-addon btn-outline-primary btn-file"><span class="fileinput-new"><i class="glyphicon glyphicon-paperclip"></i> Thêm các tệp tin</span><span class="fileinput-exists"><i class="glyphicon glyphicon-repeat"></i> Thay đổi</span><input type="file" name="file[]" multiple id="file" placeholder="Định dạng file hỗ trợ: .xlsx"></span>
                <div class="btn-tacvu" style="width: 100%;display: flex;">
                  <a href="#" class="btn btn-outline-danger fileinput-exists" data-dismiss="fileinput"><i class="glyphicon glyphicon-remove"></i> Xóa</a>
                  <a href="#" id="upload-btn" class="input-group-addon btn btn-outline-warning fileinput-exists"><i class="glyphicon glyphicon-open"></i> Tải file lên</a>
                  <a href="#" id="cal-btn" class="input-group-addon btn btn-outline-success fileinput-exists"><i class="fa-solid fa-calculator"></i> Tính điểm</a>
                </div>
              </div>
            </div>
          </form>

          <!-- <progress id="progress-bar" max="100" value="0"></progress> -->
          <div class="progress" style="display:none;width: 100%;">
            <div id="progress-bar" class="progress-bar progress-bar-success progress-bar-striped " role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
              20%
            </div>
          </div>

          <ul class="list-group"></ul>
          <a href="<?php echo site_url('site/spreadsheet_format') ?>" target="_blank" class="btn btn-outline-info" id="btn-save-result">Tải kết quả</a>
        </div><!-- /.container -->
      </div>
    </div>


  </section>
  <footer class="bg-dark text-center text-lg-start text-white">
    <!-- Grid container -->
    <div class="container p-4">
      <!--Grid row-->
      <div class="row mt-4">
        <!--Grid column-->
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <h5 class="text-uppercase">See other books</h5>

          <ul class="list-unstyled mb-0">
            <li>
              <a href="#!" class="text-white"><i class="fas fa-book fa-fw fa-sm me-2"></i>Bestsellers</a>
            </li>
            <li>
              <a href="#!" class="text-white"><i class="fas fa-book fa-fw fa-sm me-2"></i>All books</a>
            </li>
            <li>
              <a href="#!" class="text-white"><i class="fas fa-user-edit fa-fw fa-sm me-2"></i>Our
                authors</a>
            </li>
          </ul>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <h5 class="text-uppercase">Execution of the contract</h5>

          <ul class="list-unstyled">
            <li>
              <a href="#!" class="text-white"><i class="fas fa-shipping-fast fa-fw fa-sm me-2"></i>Supply</a>
            </li>
            <li>
              <a href="#!" class="text-white"><i class="fas fa-backspace fa-fw fa-sm me-2"></i>Returns</a>
            </li>
            <li>
              <a href="#!" class="text-white"><i class="far fa-file-alt fa-fw fa-sm me-2"></i>Regulations</a>
            </li>
            <li>
              <a href="#!" class="text-white"><i class="far fa-file-alt fa-fw fa-sm me-2"></i>Privacy
                policy</a>
            </li>
          </ul>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <h5 class="text-uppercase">Publishing house</h5>

          <ul class="list-unstyled">
            <li>
              <a href="#!" class="text-white">The BookStore</a>
            </li>
            <li>
              <a href="#!" class="text-white">123 Street</a>
            </li>
            <li>
              <a href="#!" class="text-white">05765 NY</a>
            </li>
            <li>
              <a href="#!" class="text-white"><i class="fas fa-briefcase fa-fw fa-sm me-2"></i>Send us a
                book</a>
            </li>
          </ul>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <h5 class="text-uppercase">Write to us</h5>

          <ul class="list-unstyled">
            <li>
              <a href="#!" class="text-white"><i class="fas fa-at fa-fw fa-sm me-2"></i>Help in
                purchasing</a>
            </li>
            <li>
              <a href="#!" class="text-white"><i class="fas fa-shipping-fast fa-fw fa-sm me-2"></i>Check
                the order status</a>
            </li>
            <li>
              <a href="#!" class="text-white"><i class="fas fa-envelope fa-fw fa-sm me-2"></i>Join the
                newsletter</a>
            </li>
          </ul>
        </div>
        <!--Grid column-->
      </div>
      <!--Grid row-->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
      © 2021 Copyright:
      <a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
    </div>
    <!-- Copyright -->
  </footer>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jasny-bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script>

</body>

</html>