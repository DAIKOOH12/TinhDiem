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

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="panel panel-dark-outline tabs-panel">
                    <div class="panel-heading">
                        <ul class="nav nav-tabs pull-left type-document">
                            <li class="active"><a data-toggle="tab" href=".documents-panel" aria-expanded="true"><i class="fa fa-file"></i> Bộ đáp án</a></li>
                            <li class=""><a data-toggle="tab" href=".images-panel" aria-expanded="false"><i class="fa fa-file"></i> Bộ câu trả lờ<i></i> </a></li>
                        </ul>
                        <div class="clear"></div>
                    </div>
                    <div class="panel-body tab-content">
                        <div class="tab-pane active documents-panel">
                            <h4 class="no-margin-top"> Folders</h4>
                            <ul class="folders list-unstyled">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-folder"></i> Web projects
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-folder"></i> Presentation files
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-folder"></i> Books
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-folder"></i> Contest
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-folder"></i> Our Projects
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-folder"></i> Our Music
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-folder"></i> Messenger sounds
                                    </a>
                                </li>
                            </ul>
                            <div class="v-spacing-xs"></div>
                            <a class="btn btn-block btn-success"> <i class="fa fa-plus"> </i> Upload</a>
                        </div>
                        <div class="tab-pane images-panel">
                            <h4 class="no-margin-top"> Folders</h4>
                            <ul class="folders list-unstyled">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-folder"></i> April meeting
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-folder"></i> Application presentation
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-folder"></i> Staff profile pictures
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-folder"></i> Trip to Yosemite
                                    </a>
                                </li>
                            </ul>
                            <div class="v-spacing-xs"></div>
                            <a class="btn btn-block btn-success"> <i class="fa fa-plus"> </i> Upload</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-8 tab-content no-bg no-border">
                <div class="tab-pane active documents documents-panel">
                    <div class="document success">
                        <div class="document-body">
                            <i class="fa fa-file-excel-o text-success"></i>
                        </div>
                        <div class="document-footer">
                            <span class="document-name"> Excel database 2017 </span>
                            <span class="document-description"> 1.2 MB </span>
                        </div>
                    </div>
                    <div class="document">
                        <div class="document-body">
                            <i class="fa fa-file-excel-o text-success"></i>
                        </div>
                        <div class="document-footer">
                            <span class="document-name"> Excel database 2016 </span>
                            <span class="document-description"> 1.1 MB </span>
                        </div>
                    </div>
                    <div class="document info">
                        <div class="document-body">
                            <i class="fa fa-file-word-o text-info"></i>
                        </div>
                        <div class="document-footer">
                            <span class="document-name"> Word file 2017 </span>
                            <span class="document-description"> 932 KB </span>
                        </div>
                    </div>
                    <div class="document">
                        <div class="document-body">
                            <i class="fa fa-file-word-o text-info"></i>
                        </div>
                        <div class="document-footer">
                            <span class="document-name"> Word file 2016 </span>
                            <span class="document-description"> 426 MB </span>
                        </div>
                    </div>
                    <div class="document warning">
                        <div class="document-body">
                            <i class="fa fa-file-powerpoint-o text-warning"></i>
                        </div>
                        <div class="document-footer">
                            <span class="document-name"> Presentation 2017 </span>
                            <span class="document-description"> 2.7 MB </span>
                        </div>
                    </div>
                    <div class="document">
                        <div class="document-body">
                            <i class="fa fa-file-powerpoint-o text-warning"></i>
                        </div>
                        <div class="document-footer">
                            <span class="document-name"> Presentation 2016 </span>
                            <span class="document-description"> 1.9 MB </span>
                        </div>
                    </div>
                    <div class="document danger">
                        <div class="document-body">
                            <i class="fa fa-file-pdf-o text-danger"></i>
                        </div>
                        <div class="document-footer">
                            <span class="document-name"> PDF file 2017 </span>
                            <span class="document-description"> 5.3 MB </span>
                        </div>
                    </div>
                    <div class="document">
                        <div class="document-body">
                            <i class="fa fa-file-pdf-o text-danger"></i>
                        </div>
                        <div class="document-footer">
                            <span class="document-name"> PDF file 2016 </span>
                            <span class="document-description"> 4.4 MB </span>
                        </div>
                    </div>
                    <div class="document dark">
                        <div class="document-body">
                            <i class="fa fa-file-video-o text-dark"></i>
                        </div>
                        <div class="document-footer">
                            <span class="document-name text-dark"> Video file 2017 </span>
                            <span class="document-description"> 18.2 MB </span>
                        </div>
                    </div>
                    <div class="document">
                        <div class="document-body">
                            <i class="fa fa-file-video-o text-dark"></i>
                        </div>
                        <div class="document-footer">
                            <span class="document-name"> Video file 2016 </span>
                            <span class="document-description"> 23.7 MB </span>
                        </div>
                    </div>
                </div>
                <div class="tab-pane documents images-panel">
                    <div class="document">
                        <div class="document-body">
                            <img src="https://bootdey.com/img/Content/avatar/avatar6.png">
                        </div>
                        <div class="document-footer">
                            <span class="document-name"> Forest.png </span>
                            <span class="document-description"> 1.2 MB </span>
                        </div>
                    </div>
                    <div class="document">
                        <div class="document-body">
                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png">
                        </div>
                        <div class="document-footer">
                            <span class="document-name"> Developer.png </span>
                            <span class="document-description"> 2.5 MB </span>
                        </div>
                    </div>
                    <div class="document">
                        <div class="document-body">
                            <img src="https://bootdey.com/img/Content/avatar/avatar2.png">
                        </div>
                        <div class="document-footer">
                            <span class="document-name"> Meeting.png </span>
                            <span class="document-description"> 1.1 MB </span>
                        </div>
                    </div>
                    <div class="document">
                        <div class="document-body">
                            <img src="https://bootdey.com/img/Content/avatar/avatar3.png">
                        </div>
                        <div class="document-footer">
                            <span class="document-name"> Hiking.png </span>
                            <span class="document-description"> 3.5 MB </span>
                        </div>
                    </div>
                    <div class="document">
                        <div class="document-body">
                            <img src="https://bootdey.com/img/Content/avatar/avatar6.png">
                        </div>
                        <div class="document-footer">
                            <span class="document-name"> Developers meeting.png </span>
                            <span class="document-description"> 862 KB </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jasny-bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script>

</html>