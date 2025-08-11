@extends('admin.layouts.app')
@section('admin.title')
    @lang('admin.edit')
@endsection
@section('admin.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Flatpickr JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <style>
        .input-group-text {
            cursor: pointer;
        }

        .input-group-text i {
            font-size: 1.2rem;
        }

    </style>
@endsection
@section('admin.content')
    <div class="main-content">
        <div class="dashboard-breadcrumb mb-25">
            <h2>@lang('admin.add')</h2>
        </div>
        @include('components.admin.error')
        <div class="row">
            <div class="col-12">
                <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="panel">
                        <div class="panel-body">
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
                                                    <label class="form-label">@lang('admin.title') - {{$lang['code']}}</label>
                                                    <input type="text" class="form-control" name="name[{{$lang['code']}}]">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label">@lang('admin.full_text') - {{$lang['code']}}</label>
                                                    <textarea class="editor form-control"
                                                              data-locale="{{ $lang['code'] }}"
                                                              data-csrf-token="{{ csrf_token() }}"
                                                              name="description[{{$lang['code']}}]"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="tab-pane" id="other" role="tabpanel">
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label for="input-category" class="form-label">@lang('admin.category')</label>
                                            <select class="form-control" name="category_id" id="input-category">
                                                <option value="">@lang('admin.choose')</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{ !empty(json_decode($category, true)['title'][$currentLang])? json_decode($category, true)['title'][$currentLang]: null }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="form-label">@lang('admin.status')</label>
                                            <select class="form-control" name="status">
                                                <option value="1" >@lang('admin.active')</option>
                                                <option value="0" >@lang('admin.nonactive')</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">@lang('admin.is_main')</label>
                                            <select class="form-control" name="is_main">
                                                <option value="1" >@lang('admin.show')</option>
                                                <option value="0" >@lang('admin.nonshow')</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-lg-8 col-md-7">
                                                <div class="card component-jquery-uploader">
                                                    <div class="card-header">
                                                        @lang('admin.images')
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-xxl-9 col-sm-8">
                                                                <label class="form-label">@lang('admin.main_image')</label>
                                                                <input type="file" name="image" id="mainImageUpload">
                                                                <p> Şəkilin maksimum ölçüsü  1228x1228 piksel olmalıdır. Şəkil faylının maksimum ölçüsü 226 KB olmalıdır.</p>
                                                                <div id="mainImagePreview" style="margin-top: 10px;"></div>
                                                            </div>
                                                            <div class="col-xxl-9 col-sm-8">
                                                                <label class="form-label">@lang('admin.slider_image')</label>
                                                                <input type="file" id="multipleUpload" name="slider_image[]" multiple>
                                                                <p> Şəkilin maksimum ölçüsü  1228x1228 piksel olmalıdır. Şəkil faylının maksimum ölçüsü 226 KB olmalıdır.</p>
                                                                <div id="sliderImagePreview" style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary">@lang('admin.save')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('admin.js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Tek resim için: Dosya adını göster
            document.getElementById('mainImageUpload').addEventListener('change', function (event) {
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

            // Çoklu resim için: Sadece resim önizlemelerini göster ve silme özelliği ekle
            document.getElementById('multipleUpload').addEventListener('change', function (event) {
                const sliderImagePreview = document.getElementById('sliderImagePreview');
                sliderImagePreview.innerHTML = ''; // Clear the preview area

                Array.from(event.target.files).forEach((file, index) => {
                    const wrapper = document.createElement('div');
                    wrapper.style.display = 'inline-block';
                    wrapper.style.position = 'relative';
                    wrapper.style.marginRight = '5px';

                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(file);
                    img.style.width = '100px';
                    img.style.height = 'auto';
                    img.style.border = '1px solid #ccc';
                    img.style.padding = '5px';

                    // Add a remove button
                    const removeButton = document.createElement('button');
                    removeButton.textContent = 'X';
                    removeButton.style.position = 'absolute';
                    removeButton.style.top = '5px';
                    removeButton.style.right = '5px';
                    removeButton.style.background = 'red';
                    removeButton.style.color = 'white';
                    removeButton.style.border = 'none';
                    removeButton.style.borderRadius = '50%';
                    removeButton.style.cursor = 'pointer';
                    removeButton.style.width = '20px';
                    removeButton.style.height = '20px';

                    // Removal functionality
                    removeButton.addEventListener('click', function () {
                        wrapper.remove(); // Remove the image from the preview
                        const fileList = Array.from(event.target.files);
                        fileList.splice(index, 1); // Remove the file from the input list
                        const dataTransfer = new DataTransfer();
                        fileList.forEach(file => dataTransfer.items.add(file)); // Re-add remaining files
                        event.target.files = dataTransfer.files; // Update the input
                    });

                    wrapper.appendChild(img);
                    wrapper.appendChild(removeButton);
                    sliderImagePreview.appendChild(wrapper);
                });

                // Initialize SortableJS for the sliderImagePreview container
                new Sortable(sliderImagePreview, {
                    handle: 'img', // Optional: make only images draggable
                    animation: 150, // Smooth transition
                    onEnd: function (evt) {
                        // Optionally, handle any updates or reordering logic here after sorting
                        console.log('Sorted!');
                    }
                });
            });

            /*document.getElementById('multipleUpload').addEventListener('change', function (event) {
                const sliderImagePreview = document.getElementById('sliderImagePreview');
                sliderImagePreview.innerHTML = ''; // Önizleme alanını temizle

                Array.from(event.target.files).forEach((file, index) => {
                    const wrapper = document.createElement('div');
                    wrapper.style.display = 'inline-block';
                    wrapper.style.position = 'relative';
                    wrapper.style.marginRight = '5px';

                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(file);
                    img.style.width = '100px';
                    img.style.height = 'auto';
                    img.style.border = '1px solid #ccc';
                    img.style.padding = '5px';

                    // Silme düyməsi əlavə et
                    const removeButton = document.createElement('button');
                    removeButton.textContent = 'X';
                    removeButton.style.position = 'absolute';
                    removeButton.style.top = '5px';
                    removeButton.style.right = '5px';
                    removeButton.style.background = 'red';
                    removeButton.style.color = 'white';
                    removeButton.style.border = 'none';
                    removeButton.style.borderRadius = '50%';
                    removeButton.style.cursor = 'pointer';
                    removeButton.style.width = '20px';
                    removeButton.style.height = '20px';

                    // Silme funksiyası
                    removeButton.addEventListener('click', function () {
                        wrapper.remove(); // Resmi önizlemeden kaldır
                        const fileList = Array.from(event.target.files);
                        fileList.splice(index, 1); // Input'daki dosyayı sil
                        const dataTransfer = new DataTransfer();
                        fileList.forEach(file => dataTransfer.items.add(file)); // Geri kalan dosyaları yeniden ekle
                        event.target.files = dataTransfer.files; // Input'u güncelle
                    });

                    wrapper.appendChild(img);
                    wrapper.appendChild(removeButton);
                    sliderImagePreview.appendChild(wrapper);
                });
            });*/
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var errorDiv = document.getElementById('error-message');
                if (errorDiv) {
                    errorDiv.style.display = 'none';
                }
            }, 2000);
        });
    </script>
    <script src="{{ asset('summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('summernote/editor_summernote.js') }}"></script>
@endsection
