@extends('site.master.subpage')
@section('pageTitle', '害蟲辨識')
@section('description', '害蟲辨識')
@section('content')
<!-- 內容區塊 -->
<div class="container recognition">
    <!-- 頁面 Title -->
    <div class="row page-title">
        <h1 class="col-xs-12 text-Large-1">害蟲辨識</h1>
        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
            <hr />
        </div>
    </div>

    <!-- 影像辨識區塊 -->
    <div class="page-container">
        <form action="recognition" method="POST" enctype="multipart/form-data" class="hidden-md hidden-lg text-medium-0">
            @csrf
            <div class="btn-1">
                <span>拍攝影像</span>
                <input type="file" id="shootImg" name="userImg" accept="image/*" capture="camera">
            </div>
        </form>
        <hr>
        <form action="recognition" method="POST" enctype="multipart/form-data" class="text-medium-0">
            @csrf
            <div class="btn-1">
                <span>上傳影像</span>
                <input type="file" id="uploadImg" name="userImg" accept="image/*">
            </div>
            <p></p>
            <div class="btn-0 text-medium-1">
                <span>上傳影像</span>
            </div>
        </form>
    </div>

    <!-- 導入 camera.js 相機上傳模組 -->
    <script src="{{ asset('js/camera.js') }}"></script>
    <script>
        var _token = '@csrf';

    </script>
</div>
@stop
