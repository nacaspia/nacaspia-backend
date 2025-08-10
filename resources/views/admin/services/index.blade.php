@extends('admin.layouts.app')
@section('admin.title')
    @lang('admin.categories')
@endsection
@section('admin.css')
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/jquery.uploader.css') }}">
@endsection
@section('admin.content')
    <!-- main content start -->
    <div class="main-content">
        @include('components.admin.error')
        <div class="row">
            <div class="col-12">
                <div class="panel">
                    <div class="panel-header">
                        <h2>@lang('admin.services')</h2>
                        @can('services-create')
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.service.create') }}">
                                <i class="fa-light fa-plus"></i> @lang('admin.add')
                            </a>
                        @endcan
                    </div>
                    <div class="panel-body">
                        <div class="row" id="sortable">
                            @if(!empty($servicesCategories[0]) && isset($servicesCategories[0]))
                                @foreach($servicesCategories as $data)
                                    <div class="col-sm-6" data-id="{{ $data['id'] }}">
                                        <div class="card">
                                            <div class="card-header">
                                                {{ !empty($data['title'][$currentLang])? $data['title'][$currentLang]: null }}
                                                @can('services-edit')
                                                    <a href="{{ route('admin.service.edit',$data['id']) }}" class="btn btn-sm btn-icon btn-primary" title="@lang('admin.edit')">
                                                        <i class="fa-light fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('services-delete')
                                                    <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="modal" data-bs-target="#deleteMain{{$data['id']}}">
                                                        <i class="fa-light fa-trash-can"></i>
                                                    </button>
                                                @endcan
                                            </div>
                                            @if(!empty($data['image']))
                                            <div class="card-body animation-card">
                                                <div class="text-center" data-aos="flip-left">
                                                    <img src="{{ asset('uploads/services/'.$data->image) }}" alt="{{ !empty($data['title'][$currentLang])? $data['title'][$currentLang]: null }}">
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- main content end -->
    @if(!empty($servicesCategories[0]) && isset($servicesCategories[0]))
        @foreach($servicesCategories as $value)
                <!-- edit task modal -->
                <div class="modal fade" id="deleteMain{{$value['id']}}" tabindex="-1" aria-labelledby="deleteMain{{$value['id']}}Label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="modal-title" id="deleteMain{{$value['id']}}Label">@lang('admin.delete')</h2>
                                <button type="button" class="btn btn-sm btn-icon btn-outline-primary" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fa-light fa-times"></i>
                                </button>
                            </div>
                            <form action="{{ route('admin.service.destroy',$value['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal-body">
                                    <h2>@lang('admin.delete_about')</h2>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">@lang('admin.not')</button>
                                    <button type="submit" class="btn btn-sm btn-primary">@lang('admin.yes')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        @endforeach
    @endif
@endsection
@section('admin.js')
    <script src="{{ asset('admin/assets/vendor/js/jquery.uploader.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/category.js') }}"></script>
@endsection
