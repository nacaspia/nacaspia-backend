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
<div class="container my-5">
    <div class="card">
        <div class="card-header text-center">
            @if(!empty($data['type']) && $data['type'] == 'vacancy')
                <h3>Vakansiya Müraciəti</h3>
            @elseif(!empty($data['type']) && $data['type'] == 'volunteer')
                <h3>Könüllü ol Müraciəti</h3>
            @elseif(!empty($data['type']) && $data['type'] == 'service')
                <h3>Xidmet Müraciəti - {{  $data['service_name'] }}</h3>
            @elseif(!empty($data['type']) && $data['type'] == 'contact')
                <h3>Əlaqə Müraciəti - Bizimlə Əlaqə</h3>
            @endif
        </div>
        @if(!empty($data['type']) && $data['type'] == 'service')
            <div class="card-body">
                <h4 class="text-center">Müraciətçi adı: {{ $data['surname'] ?? '' }} {{ $data['name'] ?? '' }}</h4>
                @if(!empty($data['address']))
                    <p class="text-center">Şirkətin adı : {{ $data['address'] ?? 'N/A' }}</p>
                @endif
                @if(!empty($data['region_name']))
                    <p class="text-center">Yerləşdiyi Regional bölmə : {{ $data['region_name'] ?? 'N/A' }}</p>
                @endif
                @if(!empty($data['tin_enterprise']))
                    <p class="text-center">VÖEN: {{ $data['tin_enterprise'] ?? 'N/A' }}</p>
                @endif
                @if(!empty($data['application_example']))
                    <p>Ərizə nümunəsi:
                        <a href="{{ asset($data['application_example']) }}" target="_blank">Yüklə</a>
                    </p>
                @endif
                @if(!empty($data['advisory_consulting']) && $data['advisory_consulting'] != 'option0')
                    <p class="text-center">Məsləhət/konsaltinq: {{ $data['advisory_consulting'] ?? 'N/A' }}</p>
                @endif
                @if(!empty($data['evaluation']) && $data['evaluation'] != 'option0')
                    <p class="text-center">Qiymətləndirmə: {{ $data['evaluation'] ?? 'N/A' }}</p>
                @endif
                <p class="text-center">E-poct: {{ $data['email'] ?? 'N/A' }}</p>
                <p class="text-center">Telefon: {{ $data['phone'] ?? 'N/A' }}</p>
                @if(!empty($data['bank_visits']))
                    <p class="text-center">Bank rekvizitləri: {{ $data['bank_visits'] ?? 'N/A' }}</p>
                @endif
                @if(!empty($data['note']))
                    <p class="text-center">Qeyd: {{ $data['note'] ?? 'N/A' }}</p>
                @endif
            </div>
        @elseif(!empty($data['type']) && $data['type'] == 'contact')
            <div class="card-body">
                <p class="text-center">Ad: {{ $data['name'] ?? 'N/A' }}</p>
                <p class="text-center">Soyad: {{ $data['surname'] ?? 'N/A' }}</p>
                <p class="text-center">E-poçt: {{ $data['email'] ?? 'N/A' }}</p>
                <p class="text-center">Telefon: {{ $data['phone'] ?? 'N/A' }}</p>
                @if(!empty($data['note']))
                    <p class="text-center">Qeyd: {{ $data['note'] ?? 'N/A' }}</p>
                @endif
            </div>
        @elseif(!empty($data['type']) && $data['type'] == 'vacancy')
            <div class="card-body">
                <p class="text-center">Ad: {{ $data['name'] ?? 'N/A' }}</p>
                <p class="text-center">Soyad: {{ $data['surname'] ?? 'N/A' }}</p>
                <p class="text-center">Ata adı: {{ $data['patronymic'] ?? 'N/A' }}</p>
                <p class="text-center">Telefon: {{ $data['phone'] ?? 'N/A' }}</p>
                <p class="text-center">Ünvan: {{ $data['address'] ?? 'N/A' }}</p>
                <p class="text-center">E-poçt: {{ $data['email'] ?? 'N/A' }}</p>
                <!-- Təhsil -->
                @if(!empty($data['education']))
                    <h5 class="mt-4">Təhsil Məlumatları:</h5>
                    <table class="table table-bordered">
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
                    <h5 class="mt-4">Təcrübə Məlumatları:</h5>
                    <table class="table table-bordered">
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
                    <h5 class="mt-4">Dil Bilikləri:</h5>
                    <ul>
                        @foreach(json_decode($data['language'], true) as $language => $level)
                            <li><strong>{{ ucfirst($language) }}:</strong> {{ $level }}</li>
                        @endforeach
                    </ul>
                @endif
                <!-- Şəkil və CV -->
                <h5 class="mt-4">Əlavələr:</h5>
                @if(!empty($data['image']))
                    <p>Şəkil:
                        <a href="{{ asset($data['image']) }}" target="_blank">Bax</a>
                    </p>
                @endif
                @if(!empty($data['resume']))
                    <p>CV:
                        <a href="{{ asset($data['resume']) }}" target="_blank">Yüklə</a>
                    </p>
                @endif
            </div>
        @elseif(!empty($data['type']) && $data['type'] == 'volunteer')
            <div class="card-body">
                <p class="text-center">Ad: {{ $data['name'] ?? 'N/A' }}</p>
                <p class="text-center">Soyad: {{ $data['surname'] ?? 'N/A' }}</p>
                <p class="text-center">Ata adı: {{ $data['patronymic'] ?? 'N/A' }}</p>
                @if(!empty($data['birthday']))
                    <p class="text-center">Doğum tarixi: {{ $data['birthday'] ?? 'N/A' }}</p>
                @endif
                @if(!empty($data['gender']))
                    <p class="text-center">Cins: {{ $data['gender']=='male'? 'Kişi': 'Qadın' }}</p>
                @endif
                <p class="text-center">Telefon: {{ $data['phone'] ?? 'N/A' }}</p>
                <p class="text-center">E-poçt: {{ $data['email'] ?? 'N/A' }}</p>
                @if(!empty($data['address']))
                    <p class="text-center">Ünvan: {{ $data['address'] ?? 'N/A' }}</p>
                @endif
                @if(!empty($data['actual_address']))
                    <p class="text-center">Faktiki Ünvan: {{ $data['actual_address'] ?? 'N/A' }}</p>
                @endif
                <!-- Təhsil -->
                @if(!empty($data['education']))
                    <h5 class="mt-4">Təhsil Məlumatları:</h5>
                    <table class="table table-bordered">
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
                    <h5 class="mt-4">Dil Bilikləri:</h5>
                    <ul>
                        @foreach(json_decode($data['language'], true) as $language => $level)
                            <li><strong>{{ ucfirst($language) }}:</strong> {{ $level }}</li>
                        @endforeach
                    </ul>
                @endif
                <!-- Şəkil və CV -->
                <h5 class="mt-4">Əlavələr:</h5>
                @if(!empty($data['volunteer_expectations']))
                    <p class="text-center">"Qida Təhlükəsizliyi Könüllüləri" təşəbbüs qrupundan gözləntiləriniz nədir?: {{ $data['volunteer_expectations'] ?? 'N/A' }}</p>
                @endif
                @if(!empty($data['volunteer_differences']))
                    <p class="text-center">Sizi digərlərindən fərqləndirən cəhət hansılardır?: {{ $data['volunteer_differences'] ?? 'N/A' }}</p>
                @endif
                @if(!empty($data['is_volunteer']))
                    <p class="text-center">Bugünədək könüllü fəaliyyətiniz olubmu?: {{ $data['is_volunteer'] == 'Digər'? $data['voluntary_other_text']: $data['is_volunteer'] }}</p>
                @endif
                @if(!empty($data['volunteer_leaving_reason']))
                    <p class="text-center">Azərbaycanda qida təhlükəsizliyinin inkişafı istiqamətində hansı ideya və təklifləriniz var?: {{ $data['volunteer_leaving_reason'] ?? 'N/A' }}</p>
                @endif
            </div>
        @endif
        <div class="card-footer text-center">
            <p>© <script>document.write(new Date().getFullYear())</script> afsi.gov.az</p>
        </div>
    </div>
</div>
</body>
</html>
