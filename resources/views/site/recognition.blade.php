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
        <input type="file" name="userImg" accept="image/*" capture="camera" class="btn-1">
        <button type="submit" class="btn-1 text-medium-0">post</button>
    </form>
    <form action="recognition" method="POST" enctype="multipart/form-data" class="text-medium-0">
        @csrf
        <input type="file" name="userImg" accept="image/*" class="btn-1 text-medium-0">
        <button type="submit" class="btn-1 text-medium-0">post</button>
    </form>
</div>
@stop
