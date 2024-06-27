<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/Vadmin.css' ?>">
    <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css"> -->
    <!-- Jasny bootstrap -->
    <!-- <link href="<?php echo base_url(); ?>assets/css/jasny-bootstrap.min.css" rel="stylesheet" media="screen"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/fontawesome/css/all.min.css'; ?>">
    <link href="https://cdn.jsdelivr.net/npm/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
</head>

<body class="hero-anime">
    <div class="navigation-wrap bg-light start-header start-style" style="background-color: white !important;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-md navbar-light" style="background-color: white;">

                        <a class="navbar-brand" href="" target="_blank"><img src="https://hou.edu.vn/assets/frontend/img/dhmohn.png" alt=""></a>

                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto py-4 py-md-0">
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                    <a class="nav-link" href="#">Trường</a>
                                </li>
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 active">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Quản lý danh sách</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Danh sách môn thi</a>
                                        <a class="dropdown-item" href="#">Danh sách đề theo môn</a>
                                        <a class="dropdown-item" href="#">Danh sách bộ đáp án</a>
                                        <a class="dropdown-item" href="#">Danh sách kết quả chấm thi</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="main-page">
        <h2>DANH SÁCH MÔN THI</h2>
        <table class="table" id="data-table">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Mã môn</th>
                    <th scope="col">Tên môn</th>
                    <th scope="col">Tác vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($dsmon); $i++) { ?>
                    <tr>
                        <th scope="row"><?php echo $i + 1; ?></th>
                        <td><?php echo $dsmon[$i]['idMon']; ?></td>
                        <td><?php echo $dsmon[$i]['sTenMon']; ?></td>
                        <td>
                            <div class="action">
                                <div class="btn-details"><i class="fa-solid fa-eye" style="color: #ffffff;"></i></div>
                                <div class="btn-delete"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></div>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jasny-bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/admin.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script>
<script src="<?php echo base_url('assets/js/jquery-1.10.2.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>

</html>