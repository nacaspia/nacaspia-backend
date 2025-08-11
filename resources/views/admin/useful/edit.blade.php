@extends('admin.layouts.app')
@section('admin.title')
    @lang('admin.edit')
@endsection
@section('admin.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/swiper-bundle.min.css') }}">
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
            <h2>@lang('admin.edit')</h2>
        </div>
        @include('components.admin.error')
        <div class="row">
            <div class="col-12">
                <form action="{{ route('admin.useful.update',$useful['id']) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
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
                                                    <input type="text" class="form-control" name="title[{{$lang['code']}}]" value="{{ !empty($useful['title'][$lang['code']])? $useful['title'][$lang['code']]: NULL }}">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label">@lang('admin.text') - {{$lang['code']}}</label>
                                                    <textarea class="form-control" type="text" name="text[{{$lang['code']}}]" >{!! !empty($useful['text'][$lang['code']])? $useful['text'][$lang['code']]: NULL !!}</textarea>
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label">@lang('admin.full_text') - {{$lang['code']}}</label>
                                                    <textarea class="editor form-control"
                                                              data-locale="{{ $lang['code'] }}"
                                                              data-csrf-token="{{ csrf_token() }}"
                                                              name="fulltext[{{$lang['code']}}]">{!! !empty($useful['fulltext'][$lang['code']])? $useful['fulltext'][$lang['code']]: NULL !!}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="tab-pane" id="other" role="tabpanel">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label for="category_id" class="form-label">@lang('admin.main_category')</label>
                                            <select class="form-control" name="category_id" id="category_id">
                                                <option value="">@lang('admin.choose')</option>
                                                @foreach($mainUsefulCategories as $category)
                                                    <option value="{{ $category->id }}" @if($category->id ==  $useful->category_id) selected @endif>
                                                        {{ json_decode($category, true)['title'][$currentLang] ?? null }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4" id="parent-category-wrapper" @if(empty($useful['parent_category_id']))style="display: none;" @endif>
                                            <label for="parent_id" class="form-label">@lang('admin.parent_category')</label>
                                            <select class="form-control" name="parent_id" id="parent_id">
                                                @if(empty($useful['parent_category_id']))
                                                <option value="">@lang('admin.choose')</option>
                                                @else
                                                <option value="{{$useful['parent_category_id']}}">{{$useful['parentCategory']['title'][$currentLang] ?? null}}</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-4" id="sub-parent-category-wrapper" @if(empty($useful['sub_parent_category_id']))style="display: none;" @endif>
                                            <label for="sub_parent_id" class="form-label">@lang('admin.sub_category')</label>
                                            <select class="form-control" name="sub_parent_id" id="sub_parent_id">
                                                @if(empty($useful['sub_parent_category_id']))
                                                <option value="">@lang('admin.choose')</option>
                                                @else
                                                <option value="{{$useful['sub_parent_category_id']}}">{{$useful['subParentCategory']['title'][$currentLang] ?? null}}</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="form-label">@lang('admin.status')</label>
                                            <select class="form-control" name="status">
                                                <option value="1" @if($useful['status'] ==1) selected @endif>@lang('admin.active')</option>
                                                <option value="0" @if($useful['status'] ==0) selected @endif>@lang('admin.nonactive')</option>
                                            </select>
                                        </div>
                                        @if(!empty($useful->datetime) && date('Y', strtotime($useful->datetime)) != 1970)
                                        <div class="col-sm-4">
                                            <label class="form-label">@lang('admin.datetime')</label>
                                            <input type="text" class="form-control" name="datetime" value="{{ date('Y-m-d H:i:s', strtotime($useful->datetime)) }}">
                                        </div>
                                        @endif
                                        @if(!empty($useful->file))
                                            <div class="col-md-6">
                                                <label class="form-label">@lang('admin.file')</label>
                                                <input  class="form-control" type="file" name="file">
                                            </div>
                                            <a href="{{ asset('uploads/useful/file/'.$useful->file) }}">File</a>
                                        @endif
                                        @if(!empty($useful->link))
                                        <div class="col-md-6">
                                            <label class="form-label">Link</label>
                                            <input  class="form-control" type="text" name="link" value="{{$useful->link}}">
                                        </div>
                                        @endif
                                        @if(!empty($useful->image))
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
                                                                <p> Şəkilin maksimum ölçüsü  2048x1365 piksel olmalıdır. Şəkil faylının maksimum ölçüsü 328 KB olmalıdır.</p>
                                                                <div id="mainImagePreview" style="margin-top: 10px;"></div>
                                                                <div class="col-md-5">
                                                                    <img src="{{ asset('uploads/useful/image/'.$useful->image) }}" style="width: 288px;!important;">
                                                                </div>
                                                            </div>

                                                            <div class="col-xxl-9 col-sm-8">
                                                                <label class="form-label">@lang('admin.slider_image')</label>
                                                                <input type="file" id="multipleUpload" name="slider_image[]" multiple>
                                                                <p> Şəkilin maksimum ölçüsü  2048x1365 piksel olmalıdır. Şəkil faylının maksimum ölçüsü 328 KB olmalıdır.</p>
                                                                <div id="sliderImagePreview" style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if(!empty($useful['slider_image']))
                                            <div class="col-md-5">
                                                <div class="slider-images" style="display: flex; flex-wrap: wrap; gap: 10px;"> <!-- Flex container -->
                                                    @foreach($useful['slider_image'] as $slider_image)
                                                        <div style="flex: 0 0 30%; position: relative;">
                                                            <img src="{{ asset('uploads/useful/slider_image/'.$slider_image) }}" style="width:100%; height: auto; padding: 10px!important;">
                                                            <button type="button" class="btn btn-danger btn-sm delete-image" data-image="{{ $slider_image }}" style="position: absolute; top: 5px; right: 5px;">Sil</button>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                        @endif
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const categorySelect = document.getElementById('category_id');
            const fileWrapper = document.getElementById('file-input-wrapper');
            const linkWrapper = document.getElementById('link-input-wrapper');
            const imageWrapper = document.getElementById('image-input-wrapper');

            categorySelect.addEventListener('change', function () {
                const selectedOption = categorySelect.options[categorySelect.selectedIndex];
                const dataType = selectedOption.getAttribute('data-type');

                // Hamısını gizlət
                fileWrapper.style.display = 'none';
                linkWrapper.style.display = 'none';
                imageWrapper.style.display = 'none';

                // Dəyərlərə görə göstər
                if (dataType === 'files') {
                    fileWrapper.style.display = 'block';
                } else if (dataType === 'file_content') {
                    linkWrapper.style.display = 'block';
                } else if (dataType === 'image_content') {
                    imageWrapper.style.display = 'block';
                }
            });
        });

    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".delete-image").forEach(function (button) {
                button.addEventListener("click", function () {
                    const imageName = this.getAttribute("data-image");
                    const container = this.parentElement;

                    if (confirm("Bu şəkili silmək istədiyinizə əminsiniz?")) {
                        fetch("{{ route('admin.useful.slider_image.delete') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            },
                            body: JSON.stringify({ image: imageName }),
                        })
                            .then((response) => response.json())
                            .then((data) => {
                                if (data.success) {
                                    container.remove();
                                    alert("Şəkil uğurla silindi.");
                                } else {
                                    alert("Şəkili silmək mümkün olmadı.");
                                }
                            })
                            .catch((error) => {
                                console.error("Xəta:", error);
                                alert("Xəta baş verdi.");
                            });
                    }
                });
            });
        });

    </script>
    <script>
        let currentSlide = 0;

        function showSlide(slideIndex) {
            const slides = document.getElementById('slides');
            const totalSlides = slides.children.length;

            // Slide dizilimini değiştir
            if (slideIndex >= totalSlides) {
                currentSlide = 0; // İlk slide'a döner
            } else if (slideIndex < 0) {
                currentSlide = totalSlides - 1; // Son slide'a döner
            } else {
                currentSlide = slideIndex;
            }

            // Slide'ları kaydır
            const offset = -currentSlide * 100; // Offset hesapla
            slides.style.transform = `translateX(${offset}%)`;
        }

        // Slide'ları değiştir
        function changeSlide(n) {
            showSlide(currentSlide + n);
        }

        // İlk slide'ı göster
        showSlide(currentSlide);
    </script>
    <script src="{{ asset('admin/assets/vendor/js/swiper-bundle.min.js') }}"></script>
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
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize Flatpickr
            flatpickr(".datetime-picker", {
                enableTime: true, // Enable time selection
                dateFormat: "Y-m-d H:i", // Format for the datetime
                time_24hr: true // Use 24-hour format
            });
        });
    </script>
    <script src="{{ asset('summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('summernote/editor_summernote.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.summernote-height').summernote({
                airMode: true, // Eğer airMode kullanılıyorsa
                disableResizeEditor: true,
                toolbar: false, // Eğer toolbar varsa, kapat
                disableDragAndDrop: true,
                callbacks: {
                    onInit: function() {
                        // Editoru deaktiv et
                        $(this).summernote('disable');
                    }
                }
            });
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
@endsection

