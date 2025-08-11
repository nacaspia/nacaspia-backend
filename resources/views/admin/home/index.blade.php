@extends('admin.layouts.app')
@section('admin.title')
@lang('admin.sliders')
@endsection
@section('admin.css')
<link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/jquery.uploader.css') }}">
<link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/aos.css') }}">
@endsection
@section('admin.content')

@endsection
@section('admin.js')
<script src="{{ asset('admin/assets/vendor/js/jquery.uploader.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/category.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/js/aos.js') }}"></script>
@endsection
