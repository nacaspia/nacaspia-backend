<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>{{ !empty($data['name']) ? $data['name'] : null }} - Vakansiya Müraciəti</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Vakansiya Məlumatları" name="description" />
    <meta content="afsi.gov.az" name="author" />
    <link rel="stylesheet" href="{{ asset('email/css/email.css') }}">
</head>
<body>
<div class="email-container">
            {{--@if(!empty($data['type']) && $data['type'] == 'vacancy')
                <h2 class="page-title">Vakansiya Müraciəti</h2>
            @elseif(!empty($data['type']) && $data['type'] == 'volunteer')
                <h2 class="page-title">Könüllü ol Müraciəti</h2>
            @elseif(!empty($data['type']) && $data['type'] == 'service')
                <h2 class="page-title">Xidmet Müraciəti - {{  $data['service_name'] }}</h2>
            @elseif(!empty($data['type']) && $data['type'] == 'contact')
                <h2 class="page-title">Əlaqə Müraciəti - Bizimlə Əlaqə</h2>
            @endif--}}
        @if(!empty($data['type']) && $data['type'] == 'service')
                    <table>
                        <tbody>
                        <tr>
                            <td>
                                <div class="mail-header">
                                    <div class="logo">
                                        <a href="https://afsi.gov.az/" target="_blank">
                                            <img src="{{ asset('site/assets/images/logo_colorful.svg') }}" alt="AQTI">
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h2 class="page-title">Xidmet Müraciəti - {{  $data['service_name'] }}</h2>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="mail-body">
                                    <p><strong>Müraciətçi adı:</strong> {{ $data['surname'] ?? '' }} {{ $data['name'] ?? '' }}</p>

                                    @if(!empty($data['address']))
                                        <p><strong>Şirkətin adı:</strong> {{ $data['address'] ?? 'N/A' }}</p>
                                    @endif

                                    @if(!empty($data['region_name']))
                                        <p><strong>Yerləşdiyi Regional bölmə:</strong> {{ $data['region_name'] ?? 'N/A' }}</p>
                                    @endif

                                    @if(!empty($data['tin_enterprise']))
                                        <p><strong>VÖEN:</strong> {{ $data['tin_enterprise'] ?? 'N/A' }}</p>
                                    @endif

                                    @if(!empty($data['application_example']))
                                        <p><strong>Ərizə nümunəsi:</strong>
                                            <a href="{{ asset($data['application_example']) }}" target="_blank">Yüklə</a>
                                        </p>
                                    @endif

                                    @if(!empty($data['advisory_consulting']) && $data['advisory_consulting'] != 'option0')
                                        <p><strong>Məsləhət/konsaltinq:</strong> {{ $data['advisory_consulting'] ?? 'N/A' }}</p>
                                    @endif

                                    @if(!empty($data['evaluation']) && $data['evaluation'] != 'option0')
                                        <p><strong>Qiymətləndirmə:</strong> {{ $data['evaluation'] ?? 'N/A' }}</p>
                                    @endif

                                    <p><strong>E-poçt:</strong> {{ $data['email'] ?? 'N/A' }}</p>
                                    <p><strong>Telefon:</strong> {{ $data['phone'] ?? 'N/A' }}</p>

                                    @if(!empty($data['bank_visits']))
                                        <p><strong>Bank rekvizitləri:</strong> {{ $data['bank_visits'] ?? 'N/A' }}</p>
                                    @endif

                                    @if(!empty($data['note']))
                                        <p><strong>Qeyd:</strong> {{ $data['note'] ?? 'N/A' }}</p>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="mail-footer">
                                    <div class="logo">
                                        <img src="{{ asset('site/assets/images/logo_colorful.svg') }}" alt="AQTI">
                                     </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
        @elseif(!empty($data['type']) && $data['type'] == 'contact')
        <table>
            <tbody>
            <tr>
                <td>
                    <div class="mail-header">
                        <div class="logo">
                            <a href="https://afsi.gov.az/" target="_blank">
                                <img src="{{ asset('site/assets/images/logo_colorful.svg') }}" alt="AQTI">
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <h2 class="page-title">Əlaqə Müraciəti - Bizimlə Əlaqə</h2>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="mail-body">
                        <p><strong>Müraciətçi adı:</strong> {{ $data['surname'] ?? '' }} {{ $data['name'] ?? '' }}</p>
                        <p><strong>E-poçt:</strong> {{ $data['email'] ?? 'N/A' }}</p>
                        <p><strong>Telefon:</strong> {{ $data['phone'] ?? 'N/A' }}</p>
                        @if(!empty($data['note']))
                            <p><strong>Qeyd:</strong> {{ $data['note'] ?? 'N/A' }}</p>
                        @endif
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="mail-footer">
                        <div class="logo">
                            <img src="{{ asset('site/assets/images/logo_colorful.svg') }}" alt="AQTI">
                        </div>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        @elseif(!empty($data['type']) && $data['type'] == 'vacancy')
        <table>
        <tbody>
        <tr>
            <td>
                <div class="mail-header">
                    <div class="logo">
                        <a href="https://afsi.gov.az/" target="_blank">
                            <img src="{{ asset('site/assets/images/logo_colorful.svg') }}" alt="AQTI">
                        </a>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <h2 class="page-title">Vakansiya Müraciəti</h2>
            </td>
        </tr>
        <tr>
            <td>
                <div class="mail-body">
                    <p><strong>Ad:</strong> {{ $data['name'] ?? 'N/A' }}</p>
                    <p><strong>Soyad:</strong> {{ $data['surname'] ?? 'N/A' }}</p>
                    <p><strong>Ata adı:</strong> {{ $data['patronymic'] ?? 'N/A' }}</p>
                    <p><strong>Telefon:</strong> {{ $data['phone'] ?? 'N/A' }}</p>
                    <p><strong>Ünvan:</strong> {{ $data['address'] ?? 'N/A' }}</p>
                    <p><strong>E-poçt:</strong> {{ $data['email'] ?? 'N/A' }}</p>

                    <!-- Təhsil -->
                    @if(!empty($data['education']))
                        <h3 class="mt-4">Təhsil Məlumatları:</h3>
                        <table border="1" cellpadding="5" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Təhsil Müəssisəsi</th>
                                <th>Başlama Tarixi</th>
                                <th>Bitmə Tarixi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(json_decode($data['education'], true) as $index => $edu)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $edu['education_org'] ?? 'N/A' }}</td>
                                    <td>{{ $edu['start_date'] ?? 'N/A' }}</td>
                                    <td>{{ $edu['end_date'] ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif

                    <!-- Təcrübə -->
                    @if(!empty($data['experience']))
                        <h3 class="mt-4">Təcrübə Məlumatları:</h3>
                        <table border="1" cellpadding="5" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>İş Yeri</th>
                                <th>Vəzifə</th>
                                <th>Başlama Tarixi</th>
                                <th>Bitmə Tarixi</th>
                                <th>Çıxış Səbəbi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(json_decode($data['experience'], true) as $index => $exp)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $exp['institution_org'] ?? 'N/A' }}</td>
                                    <td>{{ $exp['position'] ?? 'N/A' }}</td>
                                    <td>{{ $exp['start_date'] ?? 'N/A' }}</td>
                                    <td>{{ $exp['end_date'] ?? 'N/A' }}</td>
                                    <td>{{ $exp['leaving_reason'] ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif

                    <!-- Dil Bilikləri -->
                    @if(!empty($data['language']))
                        <h3 class="mt-4">Dil Bilikləri:</h3>
                        <ul>
                            @foreach(json_decode($data['language'], true) as $language => $level)
                                <li><strong>{{ ucfirst($language) }}:</strong> {{ $level }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <!-- Şəkil və CV -->
                    <h3 class="mt-4">Əlavələr:</h3>
                    @if(!empty($data['image']))
                        <p><strong>Şəkil:</strong>
                            <a href="{{ asset($data['image']) }}" target="_blank">Bax</a>
                        </p>
                    @endif
                    @if(!empty($data['resume']))
                        <p><strong>CV:</strong>
                            <a href="{{ asset($data['resume']) }}" target="_blank">Yüklə</a>
                        </p>
                    @endif
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="mail-footer">
                    <div class="logo">
                        <img src="{{ asset('site/assets/images/logo_colorful.svg') }}" alt="AQTI">
                    </div>
                </div>
            </td>
        </tr>
        </tbody>
        </table>

    @elseif(!empty($data['type']) && $data['type'] == 'volunteer')
        <table>
            <tbody>
            <tr>
                <td>
                    <div class="mail-header">
                        <div class="logo">
                            <a href="https://afsi.gov.az/" target="_blank">
                                <img src="{{ asset('site/assets/images/logo_colorful.svg') }}" alt="AQTI">
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <h2 class="page-title">Könüllü ol Müraciəti</h2>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="mail-body">
                        <p><strong>Ad:</strong> {{ $data['name'] ?? 'N/A' }}</p>
                        <p><strong>Soyad:</strong> {{ $data['surname'] ?? 'N/A' }}</p>
                        <p><strong>Ata adı:</strong> {{ $data['patronymic'] ?? 'N/A' }}</p>
                        @if(!empty($data['birthday']))
                            <p><strong>Doğum tarixi:</strong> {{ $data['birthday'] ?? 'N/A' }}</p>
                        @endif
                        @if(!empty($data['gender']))
                            <p><strong>Cins:</strong> {{ $data['gender']=='male'? 'Kişi': 'Qadın' }}</p>
                        @endif
                        <p><strong>Telefon:</strong> {{ $data['phone'] ?? 'N/A' }}</p>
                        <p><strong>Ünvan:</strong> {{ $data['address'] ?? 'N/A' }}</p>
                        <p><strong>E-poçt:</strong> {{ $data['email'] ?? 'N/A' }}</p>
                        @if(!empty($data['address']))
                            <p ><strong>Ünvan:</strong> {{ $data['address'] ?? 'N/A' }}</p>
                        @endif
                        @if(!empty($data['actual_address']))
                            <p ><strong>Faktiki Ünvan:</strong> {{ $data['actual_address'] ?? 'N/A' }}</p>
                        @endif
                        <!-- Təhsil -->
                        @if(!empty($data['education']))
                            <h3 class="mt-4">Təhsil Məlumatları:</h3>
                            <table border="1" cellpadding="5" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Təhsil Müəssisəsi</th>
                                    <th>Başlama Tarixi</th>
                                    <th>Bitmə Tarixi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(json_decode($data['education'], true) as $index => $edu)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $edu['education_org'] ?? 'N/A' }}</td>
                                        <td>{{ $edu['start_date'] ?? 'N/A' }}</td>
                                        <td>{{ $edu['end_date'] ?? 'N/A' }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif

                        <!-- Dil Bilikləri -->
                        @if(!empty($data['language']))
                            <h3 class="mt-4">Dil Bilikləri:</h3>
                            <ul>
                                @foreach(json_decode($data['language'], true) as $language => $level)
                                    <li><strong>{{ ucfirst($language) }}:</strong> {{ $level }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <!-- Şəkil və CV -->
                        <h3 class="mt-4">Əlavələr:</h3>
                        @if(!empty($data['volunteer_expectations']))
                            <p><strong>"Qida Təhlükəsizliyi Könüllüləri" təşəbbüs qrupundan gözləntiləriniz nədir?:</strong> {{ $data['volunteer_expectations'] ?? 'N/A' }}</p>
                        @endif
                        @if(!empty($data['volunteer_differences']))
                            <p><strong>Sizi digərlərindən fərqləndirən cəhət hansılardır?:</strong> {{ $data['volunteer_differences'] ?? 'N/A' }}</p>
                        @endif
                        @if(!empty($data['is_volunteer']))
                            <p><strong>Bugünədək könüllü fəaliyyətiniz olubmu?: {{ $data['is_volunteer'] == 'Digər'? $data['voluntary_other_text']: $data['is_volunteer'] }}</p>
                        @endif
                        @if(!empty($data['volunteer_leaving_reason']))
                            <p><strong>Azərbaycanda qida təhlükəsizliyinin inkişafı istiqamətində hansı ideya və təklifləriniz var?:</strong> {{ $data['volunteer_leaving_reason'] ?? 'N/A' }}</p>
                        @endif
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="mail-footer">
                        <div class="logo">
                            <img src="{{ asset('site/assets/images/logo_colorful.svg') }}" alt="AQTI">
                        </div>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        @endif
</div>
</body>
</html>
