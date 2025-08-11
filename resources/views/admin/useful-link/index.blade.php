@extends('admin.layouts.app')
@section('admin.title')
    @lang('admin.useful_links')
@endsection
@section('admin.css')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/jquery.uploader.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/aos.css') }}">
@endsection
@section('admin.content')
    <!-- main content start -->
    <div class="main-content">
        <div class="dashboard-breadcrumb mb-25">
            <h2>@lang('admin.useful_links')</h2>
            @can('useful-link-create')
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addTaskModal">
                <i class="fa-light fa-plus"></i> @lang('admin.add')
            </button>
            @endcan
        </div>
        @include('components.admin.error')
        <div class="row">
            <div class="col-12">
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            @if(!empty($usefulLinks[0]) && isset($usefulLinks[0]))
                                @foreach($usefulLinks as $data)
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-header">
                                                {{ !empty($data['title'][$currentLang])? $data['title'][$currentLang]: null }}
                                                @can('useful-link-edit')
                                                <button class="btn btn-sm btn-icon btn-primary" data-bs-toggle="modal" data-bs-target="#editTaskModal{{$data['id']}}">
                                                    <i class="fa-light fa-edit"></i>
                                                </button>
                                                @endcan
                                                @can('useful-link-delete')
                                                <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$data['id']}}">
                                                    <i class="fa-light fa-trash-can"></i>
                                                </button>
                                                @endcan
                                            </div>
                                            <div class="card-body animation-card">
                                                <div class="text-center" data-aos="flip-left">
                                                    <img src="{{ asset('uploads/usefulLink/'.$data->image) }}" alt="{{ !empty($data['title'][$currentLang])? $data['title'][$currentLang]: null }}">
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
    <!-- add new task modal -->
    <div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="addTaskModalLabel">@lang('admin.add')</h2>
                    <button type="button" class="btn btn-sm btn-icon btn-outline-primary" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-light fa-times"></i>
                    </button>
                </div>
                <form action="{{ route('admin.useful-link.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <ul class="nav nav-pills nav-justified" role="tablist">
                            @if(!empty($locales))
                                @foreach($locales as $key => $lang)
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link @if(++$key ==1) active @endif" data-bs-toggle="tab"
                                           href="#{{$lang->code}}" role="tab">
                                            <span class="d-none d-sm-block">{{$lang->code}}</span>
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link" data-bs-toggle="tab"
                                   href="#other" role="tab">
                                    <span class="d-none d-sm-block">@lang('admin.other')</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content p-3 text-muted">
                            @if(!empty($locales))
                                @foreach($locales as $key => $lang)
                                    <div class="tab-pane @if(++$key ==1) active @endif" id="{{$lang['code']}}"
                                         role="tabpanel">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label class="form-label">@lang('admin.title')- {{$lang['code']}}</label>
                                                <input type="text" class="form-control" name="title[{{$lang['code']}}]">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            <div class="tab-pane" id="other" role="tabpanel">
                                <div class="row g-3">
                                    <div class="col-sm-12">
                                        <label class="form-label">@lang('admin.link')</label>
                                        <input type="text" class="form-control" name="link">
                                    </div>
                                    <div class="col-sm-12">
                                        <label class="form-label">@lang('admin.status')</label>
                                        <select class="form-control" name="status">
                                            <option value="1" >Aktiv</option>
                                            <option value="0" >Deactiv</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12">
                                        <label class="form-label">@lang('admin.photo')</label>
                                        <input type="file" name="image" id="mainImageUpload">
                                        <p> Şəkilin maksimum ölçüsü 134x122 piksel olmalıdır. Şəkil faylının maksimum ölçüsü 13.8 KB olmalıdır.</p>
                                        <div id="mainImagePreview" style="margin-top: 10px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">@lang('admin.close')</button>
                        <button type="submit" class="btn btn-sm btn-primary">@lang('admin.save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- add new task modal -->
    <!-- main content end -->
    @if(!empty($usefulLinks[0]) && isset($usefulLinks[0]))
        @foreach($usefulLinks as $value)
            <!-- edit task modal -->
            <div class="modal fade" id="editTaskModal{{$value['id']}}" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <form action="{{ route('admin.useful-link.update',$value['id']) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <ul class="nav nav-pills nav-justified" role="tablist">
                                    @if(!empty($locales))
                                        @foreach($locales as $key => $lang)
                                            <li class="nav-item waves-effect waves-light">
                                                <a class="nav-link @if(++$key ==1) active @endif" data-bs-toggle="tab" href="#edit{{$value['id']}}{{$lang->code}}" role="tab">
                                                    <span class="d-none d-sm-block">{{$lang->code}}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link" data-bs-toggle="tab" href="#editother{{$value['id']}}" role="tab">
                                            <span class="d-none d-sm-block">@lang('admin.other')</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content p-3 text-muted">
                                    @if(!empty($locales))
                                        @foreach($locales as $key => $lang)
                                            <div class="tab-pane @if(++$key ==1) active @endif" id="edit{{$value['id']}}{{$lang['code']}}" role="tabpanel">
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <label class="form-label">@lang('admin.title')- {{$lang['code']}}</label>
                                                        <input type="text" class="form-control" name="title[{{$lang['code']}}]" value="{{ !empty($value['title'][$lang['code']])? $value['title'][$lang['code']]: NULL }}">
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    <div class="tab-pane" id="editother{{$value['id']}}" role="tabpanel">
                                        <div class="row g-3">
                                            <div class="col-sm-12">
                                                <label class="form-label">@lang('admin.link')</label>
                                                <input type="text" class="form-control" name="link" value="{{$value['link']}}">
                                            </div>
                                            <div class="col-sm-12">
                                                <label class="form-label">@lang('admin.status')</label>
                                                <select class="form-control" name="status">
                                                    <option value="1" @if($value['status'] ==1) selected @endif>Aktiv</option>
                                                    <option value="0" @if($value['status'] ==0) selected @endif>Deactiv</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-12">
                                                <label class="form-label">@lang('admin.photo')</label>
                                                <input type="file" name="image" id="mainImageUpload">
                                                <p> Şəkilin maksimum ölçüsü 134x122 piksel olmalıdır. Şəkil faylının maksimum ölçüsü 13.8 KB olmalıdır.</p>
                                                <div id="mainImagePreview" style="margin-top: 10px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">@lang('admin.close')</button>
                                <button type="submit" class="btn btn-sm btn-primary">@lang('admin.save')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- edit task modal -->
            <div class="modal fade" id="delete{{$value['id']}}" tabindex="-1" aria-labelledby="deletecategory{{$value['id']}}Label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="deletecategory{{$value['id']}}Label">@lang('admin.delete')</h2>
                            <button type="button" class="btn btn-sm btn-icon btn-outline-primary" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa-light fa-times"></i>
                            </button>
                        </div>
                        <form action="{{ route('admin.useful-link.destroy',$value['id']) }}" method="POST">
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
        document.addEventListener("DOMContentLoaded", function() {
            // Tek resim için: Dosya adını göster
            document.getElementById('mainImageUpload').addEventListener('change', function(event) {
                const mainImagePreview = document.getElementById('mainImagePreview');
                mainImagePreview.innerHTML = ''; // Önizleme alanını temizle
                const file = event.target.files[0];
                if (file) {
                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(file); // Resmin src'sini ayarla
                    img.style.width = '150px';
                    img.style.height = 'auto';
                    img.style.border = '1px solid #ccc';
                    img.style.padding = '5px';
                    img.style.marginTop = '5px';

                    // Önizleme alanına resmi ekle
                    mainImagePreview.appendChild(img);
                }
            });
        });
    </script>
    <script src="{{ asset('admin/assets/vendor/js/jquery.uploader.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/category.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/js/aos.js') }}"></script>
@endsection
