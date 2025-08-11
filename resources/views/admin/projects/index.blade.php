@extends('admin.layouts.app')
@section('admin.title')
    @lang('admin.projects')
@endsection
@section('admin.css')
    <style>
        #pagination {
            text-align: center;
            margin: 20px auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #pagination ul {
            list-style: none;
            display: flex;
            justify-content: center;
            gap: 5px;
            padding: 0;
            margin: 0;
        }

        #pagination .page-link {
            padding: 8px 12px;
            border: 1px solid #ddd;
            color: #007bff;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
            display: inline-block;
        }

        #pagination .page-link.active {
            background-color: #007bff;
            color: white;
            border: 1px solid #007bff;
        }

        #pagination .page-link:hover {
            background-color: #0056b3;
            color: white;
        }

        #pagination .dots {
            padding: 8px 12px;
            color: #777;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/jquery.uploader.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/aos.css') }}">
@endsection
@section('admin.content')

    <!-- main content start -->
    <div class="main-content">
        <div class="dashboard-breadcrumb mb-25">
            <h2>@lang('admin.projects')</h2>
            @can('news-create')
            <a class="btn btn-sm btn-primary" href="{{ route('admin.projects.create') }}">
                <i class="fa-light fa-plus"></i> @lang('admin.add')
            </a>
            @endcan
        </div>
        <div class="row">
            <div class="col-12">
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            @if(!empty($projects[0]) && isset($projects[0]))
                                @foreach($projects as $data)
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-header">
                                                {{ !empty($data['name'][$currentLang])? $data['name'][$currentLang]: null }}
                                                @can('news-edit')
                                                <a href="{{ route('admin.projects.edit',$data['id']) }}" class="btn btn-sm btn-icon btn-primary" title="@lang('admin.edit')">
                                                    <i class="fa-light fa-edit"></i>
                                                </a>
                                                @endcan
                                                @can('news-delete')
                                                <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$data['id']}}">
                                                    <i class="fa-light fa-trash-can"></i>
                                                </button>
                                                @endcan
                                            </div>
                                            <div class="card-body animation-card">
                                                <div class="text-center" data-aos="flip-left">
                                                    <img src="{{ asset('uploads/projects/'.$data->image) }}" alt="{{ !empty($data['name']['az'])? $data['name']['az']: null }}" style="max-height: 327px;!important;">
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
{{--        {{ $projects->appends(request()->except('page'))->links('components.admin.pagination',['posts' => $projects]) }}--}}

    </div>
    <!-- main content end -->
    @if(!empty($projects[0]) && isset($projects[0]))
        @foreach($projects as $value)
            <div class="modal fade" id="delete{{$value['id']}}" tabindex="-1" aria-labelledby="deletecategory{{$value['id']}}Label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="deletecategory{{$value['id']}}Label">@lang('admin.delete')</h2>
                            <button type="button" class="btn btn-sm btn-icon btn-outline-primary" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa-light fa-times"></i>
                            </button>
                        </div>
                        <form action="{{ route('admin.projects.destroy',$value['id']) }}" method="POST">
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paginationLinks = document.querySelectorAll('#pagination a');

            paginationLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    window.location.href = this.href;
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            });
        });
    </script>
    <script src="{{ asset('admin/assets/vendor/js/jquery.uploader.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/category.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/js/aos.js') }}"></script>
@endsection
