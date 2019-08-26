
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Logo | Dashboard</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    {{--<link rel="stylesheet" href="/admin/css/all.css">--}}
    {{--<link rel="stylesheet" href="/admin/css/font-awesome.min.css">--}}
    {{--<link rel="stylesheet" href="/admin/css/ionicons.min.css">--}}
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="/admin/css/select2.css">
    <link rel="stylesheet" href="/admin/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/admin/css/all-skins.min.css">
    <link rel="stylesheet" href="/admin/css/skin-red.css">
    <link rel="stylesheet" href="/admin/css/iCheck-square-blue.css">
    <link rel="stylesheet" href="/admin/css/dataTables.bootstrap.css">
    <link rel="stylesheet" href="/admin/css/daterangepicker-bs3.css">
    <link rel="stylesheet" href="/admin/css/datepicker3.css">
    <link rel="stylesheet" href="/admin/css/pikaday.css">
    <link rel="stylesheet" href="/admin/css/handsontable.css">
    <link rel="stylesheet" href="/admin/css/ion.rangeSlider.css">
    <link rel="stylesheet" href="/admin/css/ion.rangeSlider.skinFlat.css">
    <link rel="stylesheet" href="/admin/css/fileinput.css">
    <link rel="stylesheet" href="/admin/css/dropify.css">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="/admin/js/jquery.min.js"></script>

    <style>
        .table .form-group{
            margin-bottom: 0;
        }
        .table .input-group{
            width: 100%;
        }
        .select2{
            width: 100% !important;
        }
    </style>
    @yield('css')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        <a data-spa="true" href="/index.php" class="logo">
            <span class="logo-mini"><b>F</b></span>
            <span class="logo-lg"><b>Logo</b></span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="/admin/img/avatar.png" class="user-image" alt="User Image">
                            <span class="hidden-xs">Administrator</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <img src="/admin/img/avatar.png" class="img-circle" alt="User Image">
                                <p>
                                    Administrator                                            <small>Administrator</small>
                                </p>
                            </li>
                            <li class="user-footer">
                                <div>
                                    <a href="/logout"  class="btn pull-right btn-default btn-flat">Logout</a>
                                </div>

                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <aside class="main-sidebar">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="/admin/img/avatar.png" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>Administrator</p>
                    <a data-spa="true" href="/index.php">Administrator</a>
                </div>
            </div>
            <ul id="sidebar" class="sidebar-menu">
                <li class="header">NAVIGATION</li>
                <li data-tag="sidebar-dashboard">
                    <a data-spa="true" href="/admin/dashboard">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-briefcase"></i> <span>Variations</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a data-spa="true" href="{{route('variation.index')}}"><i class="fa fa-list"></i>Manage Variations</a></li>
                        <li class="active"><a data-spa="true" href="{{route('variation.create')}}"><i class="fa fa-plus"></i> Add Variation</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-briefcase"></i> <span>Categories</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a data-spa="true" href="{{route('category.index')}}"><i class="fa fa-list"></i> Manage Category</a></li>
                        <li class="active"><a data-spa="true" href="{{route('category.create')}}"><i class="fa fa-plus"></i> Add Category</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-briefcase"></i> <span>Products</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a data-spa="true" href="{{route('product.index')}}"><i class="fa fa-list"></i> Manage Product</a></li>
                        <li class="active"><a data-spa="true" href="{{route('product.create')}}"><i class="fa fa-plus"></i> Add Product</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-briefcase"></i> <span>Home Slider</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a data-spa="true" href="{{route('homeSlider.index')}}"><i class="fa fa-list"></i> Manage Slides</a></li>
                        <li class="active"><a data-spa="true" href="{{route('homeSlider.create')}}"><i class="fa fa-plus"></i> Add Slide</a></li>
                    </ul>
                </li>



            </ul>
        </section>
    </aside>
    <div class="content-wrapper">
        <section id="navigationHeader" class="content-header">
            <h1>
                <span>Dashboard</span>
            </h1>
            <ol class="breadcrumb" id="breadcrumb">
                <li>
                    <a data-spa="true" href=/">
                        <i class="fa fa-dashboard"></i> Home
                    </a>
                </li>
            </ol>
        </section>
        @yield('content')
    </div>
</div>



<script src="/admin/js/jquery.min.js"></script>
<script src="/admin/js/jquery-ui.min.js"></script>
<script src="/admin/js/bootstrap.min.js"></script>
<script src="/admin/js/jquery.slimscroll.min.js"></script>
<script src="/admin/js/fastclick.min.js"></script>
<script src="/admin/js/app.min.js"></script>
<script src="/admin/js/knockout.js"></script>
<script src="/admin/js/jquery.dataTables.min.js"></script>
<script src="/admin/js/dataTables.bootstrap.js"></script>
<script src="/admin/js/underscore.min.js"></script>
<script src="/admin/js/backbone.min.js"></script>
<script src="/admin/js/icheck.min.js"></script>
<script src="/admin/js/bootbox.min.js"></script>
<script src="/admin/js/jquery.blockUI.js"></script>
<script src="/admin/js/jquery.validate.min.js"></script>
<script src="/admin/js/select2.full.js"></script>
<script src="/admin/js/html2canvas.js"></script>
<script src="/admin/js/moment.js"></script>
<script src="/admin/js/daterangepicker.js"></script>
<script src="/admin/js/bootstrap-datepicker.js"></script>
<script src="/admin/js/fileinput.js"></script>
<script src="/admin/js/inputmask.js"></script>
<script src="/admin/js/jquery.inputmask.js"></script>
<script src="/admin/js/inputmask.regex.extensions.js"></script>
<script src="/admin/js/raphael-min.js"></script>
<script src="/admin/js/zeroClipboard.js"></script>
<script src="/admin/js/pikaday.js"></script>
<script src="/admin/js/handsontable.js"></script>
<script src="/admin/js/ion.rangeSlider.js"></script>
<script src="/admin/js/dropify.js"></script>
@yield('js')
</body>
</html>
