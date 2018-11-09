@extends('site.master.subpage')
@section('content')
<!-- 內容區塊 -->
<div class="container">
    <!-- 頁面 Title -->
    <div class="row page-title">
        <h1 class="col-xs-12 text-Large-1">害蟲辨識</h1>
        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
            <hr />
        </div>
    </div>
    <form action="recognition" method="POST" enctype="multipart/form-data" class="hidden-md hidden-lg text-medium-0">
        @csrf
        <button for="fileinp" class="btn-1" style="margin-top:30px;position:relative;cursor: pointer">
            <span>拍攝影像</span>
            <input type="file" id="fileinp" name="userImg" accept="image/*" capture="camera" style="position: absolute;left: 0;top: 0;opacity: 0;width:99%;height:100%;">
        </button>
        <p></p>
        <button type="submit" class="btn-1 text-medium-0">送出</button>
        <hr>
    </form>
    <form action="recognition" method="POST" enctype="multipart/form-data" class="text-medium-0">
        @csrf
        <button for="fileinp" class="btn-1" style="margin-top:30px;position:relative;cursor: pointer">
            <span>上傳影像</span>
            <input type="file" id="fileinp" name="userImg" accept="image/*" style="position: absolute;left: 0;top: 0;opacity: 0;width:99%;height:100%;">
        </button>
        <p></p>
        <button type="submit" class="btn-1">送出</button>
    </form>
</div>
@stop