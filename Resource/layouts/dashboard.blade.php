<!DOCTYPE html>
<html>
<head>
    <base href="{{url(env("BASE_HREF"))}}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <title>Dashboard</title>
    {{--<link href="/dashboard/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">--}}
    <link href="/dashboard/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <style>
        #loader {
            transition: all .3s ease-in-out;
            opacity: 1;
            visibility: visible;
            position: fixed;
            height: 100vh;
            width: 100%;
            background: #fff;
            z-index: 90000
        }

        .section_title {
            text-transform: capitalize;
            padding: 12px 1px;
            margin-bottom: 28px;
            border-bottom: thin dashed #0000004f;
        }

        #loader.fadeOut {
            opacity: 0;
            visibility: hidden
        }

        .spinner {
            width: 40px;
            height: 40px;
            position: absolute;
            top: calc(50% - 20px);
            left: calc(50% - 20px);
            background-color: #333;
            border-radius: 100%;
            -webkit-animation: sk-scaleout 1s infinite ease-in-out;
            animation: sk-scaleout 1s infinite ease-in-out
        }

        @-webkit-keyframes sk-scaleout {
            0% {
                -webkit-transform: scale(0)
            }
            100% {
                -webkit-transform: scale(1);
                opacity: 0
            }
        }

        @keyframes sk-scaleout {
            0% {
                -webkit-transform: scale(0);
                transform: scale(0)
            }
            100% {
                -webkit-transform: scale(1);
                transform: scale(1);
                opacity: 0
            }
        }

        .select2-container--default .select2-selection--single
        {
            min-width: 635px;
            width: 100%;
        }

        .bg_footer_color {
            background-color: #b5942b;
            background-image: url(http://integrity-alnahlagroup.com/front/images/ar/footer_bg.png);
            background-repeat: no-repeat;
            padding: 0px !important;
            bottom: 0;
        }

        .bg_footer_color span{line-height: 10 !important; color: #fff;}

        .bg_footer_color span a{color: #fff;}

    </style>
    <link href="tf/bootstrap-tokenfield.min.css" rel="stylesheet">
    <link href="dashboard/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <style>


        a.btn {
            color: #fff !important;
            /*margin-bottom: 10px;*/
        }

        .btn-black {
            background: #1d1d1d;
        }

        .btn, a.btn {
            margin-top: 3px !important;
            margin-bottom: 3px !important;
        }
    </style>
    @yield("css")
</head>
<body class="app">
<div id="loader">
    <div class="spinner"></div>
</div>
<script>
    window.addEventListener('load', () => setTimeout(() => document.getElementById('loader').classList.add('fadeOut'), 300));
</script>
<div>
    @include("$scope.parts.sidebar")
    <div class="page-container">
        @include("Glib::parts.headerNavBar")
        <main class="main-content bgc-grey-100">
            <div id="mainContent">
                @include('flash::message')
                @yield("content")
            </div>
        </main>
        <footer class="bdT ta-c lh-0 fsz-sm c-grey-600 bg_footer_color">
            <div class="row">
                <div class="col-sm-6">
                    <span>
                    Copyright © {{date("Y")}} Designed & Develop by

                    <a href="http://integrity-alnahlagroup.com" target="_blank"
                    title="Integrity Al Nahla Group">
                    Integrity Al Nahla Group
                    </a>

                    . All rights reserved.
                    </span>
                </div>

                <div class="col-sm-6">
                    <img src="http://integrity-alnahlagroup.com/front/images/ar/logo_footer.png" class="img-responsive" alt="">
                </div>

            </div>
        </footer>
    </div>
</div>

<script>

    let token = "{{csrf_token()}}";
    let url = "{{url("/")}}";

</script>
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>

<script type="text/javascript" src="dashboard/vendor.js"></script>
<script type="text/javascript" src="dashboard/bundle.js"></script>
<script type="text/javascript" src="tf/bootstrap-tokenfield.min.js"></script>
<script type="text/javascript" src="js/sweetalert.min.js"></script>
<script type="text/javascript" src="js/Resource.js"></script>
<script type="text/javascript" src="js/confirmBtn.js"></script>
<script type="text/javascript" src="js/JLoading.js"></script>
<script src="//cdn.ckeditor.com/4.8.0/full/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

@include("Glib::js.LaravelErrors")
<script>
    CKEDITOR.replaceClass = 'richText';
    $('.tagable').tokenfield()
</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


@yield("js")
</body>
</html>