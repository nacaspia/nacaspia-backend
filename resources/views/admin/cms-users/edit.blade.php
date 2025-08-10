@extends('admin.layouts.app')
@section('admin.title')
    @lang('admin.cms_users')
@endsection
@section('admin.css')
@endsection
@section('admin.content')
    <div class="main-content">
        <div class="dashboard-breadcrumb mb-25">
            <h2>@lang('admin.cms_users')</h2>
        </div>
        @include('components.admin.error')
        <div class="row">
            <div class="col-12">
                <form action="{{ route('admin.cms-users.update',$cmsUser['id']) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="panel">
                        <div class="panel-body">
                            <div class="tab-content profile-edit-tab" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-edit-profile" role="tabpanel"
                                     aria-labelledby="nav-edit-profile-tab" tabindex="0">

                                    <div class="private-information mb-25">
                                        <div class="row g-3">
                                            <div class="col-sm-6">
                                                <label class="form-label">@lang('admin.name')</label>
                                                <input type="text" class="form-control" value="{{ !empty($cmsUser['name'])? $cmsUser['name']: old('name') }}" name="name">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">@lang('admin.surname')</label>
                                                <input type="text" class="form-control" value="{{ !empty($cmsUser['surname'])? $cmsUser['surname']: old('surname') }}" name="surname">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">@lang('admin.father_name')</label>
                                                <input type="text" class="form-control" value="{{ !empty($cmsUser['father_name'])? $cmsUser['father_name']: old('father_name') }}" name="father_name">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">@lang('admin.phone')</label>
                                                <input type="text" class="form-control" value="{{ !empty($cmsUser['phone'])? $cmsUser['phone']: old('phone') }}" name="phone">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">@lang('admin.Email')</label>
                                                <input type="email" class="form-control" value="{{ !empty($cmsUser['email'])? $cmsUser['email']: old('email') }}" name="email">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">@lang('admin.password')</label>
                                                <input type="password" class="form-control"  name="password">
                                            </div>
                                            @if($appUser->type != 'user')
                                                <div class="col-sm-6">
                                                    <label class="form-label">@lang('admin.roles')</label>
                                                    <select class="form-control" name="role">
                                                        <option value="">@lang('admin.choose')</option>
                                                        @foreach($roles as $role)
                                                            @if(/*$role['id'] !=*/1)
                                                            <?php $select = !empty($cmsUser['type'])? $cmsUser['type']: old('role'); ?>
                                                            <option value="{{$role['name']}}" @if($select==$role['name']) selected="selected" @endif >{{$role['name']}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @else
                                                <input type="hidden" name="role" value="{{$cmsUser->type}}">
                                            @endif
                                            <div class="col-sm-6">
                                                <label class="form-label">@lang('admin.status')</label>
                                                <select class="form-control" name="status">
                                                    <option value="1" @if(!empty($cmsUser['status']) && $cmsUser['status'] == '1') selected="selected" @endif>Aktiv</option>
                                                    <option value="0" @if(!empty($cmsUser['status']) && $cmsUser['status'] == '0') selected="selected" @endif>Deactiv</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">@lang('admin.save')</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('admin.js')
@endsection
