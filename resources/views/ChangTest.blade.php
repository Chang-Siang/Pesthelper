<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{{ asset('css/bootstrap-3.3.7-dist/css/bootstrap.css') }}}">
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- 可选的 Bootstrap 主题文件（一般不用引入） -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- JQuery -3.3.1 一定要放在 Bootstrap.min.js 的前面 -->
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <title>PestHelper</title>
</head>
<body style="margin:20px">
    <!-- <div class="navbar">
        <div class="navbar-inner">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a href="#home" data-toggle="tab">Home</a></li>
                <li><a href="#news" data-toggle="tab">News</a></li>
                <li><a href="#blog" data-toggle="tab">blog</a></li>
                <li><a href="#about" data-toggle="tab">about</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="home">Home</div>
                <div class="tab-pane news" id="news">News</div>
                <div class="tab-pane blog" id="blog">blog</div>
                <div class=tab-pane id="about">about</div>
            </div>
        </div>
    </div> -->
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <h1 class="col-xs-12 col-sm-4" style="background-color:red">News</h1>
                    <h1 class="col-xs-12 col-sm-4" style="background-color:red">Blog</h1>
                    <h1 class="col-xs-12 col-sm-4" style="background-color:red">About</h1>
                </div>
            </div>
            <div class="col-xs-12 col-sm-9 col-md-7 col-lg-8" style="background-color:blue;color:white">
                <p><h1>this is a first Bootstrap page</h1></p>
            </div>
        </div>
    </div>

</body>
</html>