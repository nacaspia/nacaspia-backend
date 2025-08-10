@extends('admin.layouts.app')
@section('admin.title')
    @lang('admin.sliders')
@endsection
@section('admin.css')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/jquery.uploader.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/aos.css') }}">
@endsection
@section('admin.content')

    <!-- main content start -->
    <div class="main-content">
        <div class="dashboard-breadcrumb mb-25">
            <h2>@lang('admin.sliders')</h2>
            @can('sliders-create')
            <a class="btn btn-sm btn-primary" href="{{ route('admin.sliders.create') }}">
                <i class="fa-light fa-plus"></i> @lang('admin.add')
            </a>
            @endcan
        </div>
        <div class="row">
            <div class="col-12">
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            @if(!empty($sliders[0]) && isset($sliders[0]))
                                @foreach($sliders as $data)
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-header">
                                                {{ !empty($data['title'][$currentLang])? $data['title'][$currentLang]: null }}
                                                @can('sliders-edit')
                                                <a href="{{ route('admin.sliders.edit',$data['id']) }}" class="btn btn-sm btn-icon btn-primary" title="@lang('admin.edit')">
                                                    <i class="fa-light fa-edit"></i>
                                                </a>
                                                @endcan
                                                @can('sliders-delete')
                                                <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$data['id']}}">
                                                    <i class="fa-light fa-trash-can"></i>
                                                </button>
                                                @endcan
                                            </div>
                                            <div class="card-body animation-card">
                                                <div class="text-center" data-aos="flip-left">
                                                    <img src="{{ asset('uploads/sliders/'.$data->image) }}" alt="{{ !empty($data['title']['az'])? $data['title']['az']: $data['title']['az'] }}">
                                                </div>
                                            </div>
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
    @if(!empty($sliders[0]) && isset($sliders[0]))
        @foreach($sliders as $value)
            <div class="modal fade" id="delete{{$value['id']}}" tabindex="-1" aria-labelledby="deletecategory{{$value['id']}}Label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="deletecategory{{$value['id']}}Label">@lang('admin.delete')</h2>
                            <button type="button" class="btn btn-sm btn-icon btn-outline-primary" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa-light fa-times"></i>
                            </button>
                        </div>
                        <form action="{{ route('admin.sliders.destroy',$value['id']) }}" method="POST">
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
    <script src="{{ asset('admin/assets/vendor/js/aos.js') }}"></script>
@endsection
