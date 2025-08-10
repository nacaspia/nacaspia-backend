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
                <form action="{{ route('admin.projects.update',$project['id']) }}" method="POST" enctype="multipart/form-data">
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
                                                    <input type="text" class="form-control" name="name[{{$lang['code']}}]" value="{{ !empty($project['name'][$lang['code']])? $project['name'][$lang['code']]: NULL }}">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label">@lang('admin.full_text') - {{$lang['code']}}</label>
                                                    <textarea class="editor form-control"
                                                              data-locale="{{ $lang['code'] }}"
                                                              data-csrf-token="{{ csrf_token() }}"
                                                              name="description[{{$lang['code']}}]">{!! !empty($project['description'][$lang['code']])? $project['description'][$lang['code']]: NULL !!}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="tab-pane" id="other" role="tabpanel">
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label for="input-category" class="form-label">Kategory</label>
                                            <select class="form-control" name="category_id" id="input-category">
                                                <option value="">Sec</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}" @if($category->id ==  $project->category_id) selected @endif>{{ !empty(json_decode($category, true)['title'][$currentLang])? json_decode($category, true)['title'][$currentLang]: null }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="form-label">@lang('admin.status')</label>
                                            <select class="form-control" name="status">
                                                <option value="1" @if($project['status'] ==1) selected @endif>@lang('admin.active')</option>
                                                <option value="0" @if($project['status'] ==0) selected @endif>@lang('admin.nonactive')</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">@lang('admin.is_main')</label>
                                            <select class="form-control" name="is_main">
                                                <option value="1" @if($project['is_main'] ==1) selected @endif>@lang('admin.show')</option>
                                                <option value="0" @if($project['is_main'] ==0) selected @endif>@lang('admin.nonshow')</option>
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
                                                                <div class="col-md-5">
                                                                    <img src="{{ asset('uploads/projects/'.$project->image) }}" style="width: 288px;!important;">
                                                                </div>
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
                                        @if(!empty($project['slider_image']))
                                            <div class="col-md-5">
                                                <div class="slider-images" id="sortable-slider" style="display: flex; flex-wrap: wrap; gap: 10px;">
                                                    @foreach($project['slider_image'] as $slider_image)
                                                        <div class="sortable-item" data-image="{{ $slider_image }}" style="flex: 0 0 30%; position: relative; cursor: grab;">
                                                            <img src="{{ asset('uploads/projects/slider_image/'.$slider_image) }}" style="width:100%; height: auto; padding: 10px!important;">
                                                            <button type="button" class="btn btn-danger btn-sm delete-image" data-image="{{ $slider_image }}" style="position: absolute; top: 5px; right: 5px;">Sil</button>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
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
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".delete-image").forEach(function (button) {
                button.addEventListener("click", function () {
                    const imageName = this.getAttribute("data-image");
                    const container = this.parentElement;

                    if (confirm("Bu şəkili silmək istədiyinizə əminsiniz?")) {
                        fetch("{{ route('admin.projects.slider_image.delete') }}", {
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>

    {{--<script>
        document.addEventListener("DOMContentLoaded", function () {
            let sortableContainer = document.getElementById("sortable-slider");

            if (sortableContainer) {
                new Sortable(sortableContainer, {
                    animation: 150,
                    onEnd: function (evt) {
                        let newOrder = [];
                        document.querySelectorAll(".sortable-item").forEach(item => {
                            newOrder.push(item.getAttribute("data-image"));
                        });

                        // AJAX vasitəsilə yeni sıralamanı backend-ə göndəririk
                        fetch("{{ route('admin.news.orderSliderImage') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                id: "{{ $news->id }}",
                                new_order: newOrder
                            })
                        }).then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    console.log("Şəkil sıralaması yeniləndi");
                                }
                            });
                    }
                });
            }
        });

    </script>--}}
@endsection

