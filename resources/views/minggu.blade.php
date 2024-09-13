<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Juru uang</title>
    <link rel="icon" type="image/png" href="/logo/27.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body style="background-color:#B0C4B1">
    <nav class="navbar " style="background-color:#7D8E85">
        <div class="container-fluid">
          <div class="text-white">
            <img src="/logo/27.png" width="50px" height="auto" class="mb-2">
             Juru Uang
          </div>
          <form class="d-flex" role="search">
            <style>
              .btn-bottom-right {
                position: fixed;
                bottom: 20px;
                right: 20px;
              }
              </style>
          </form>
          <div class="text-white">{{ \Carbon\Carbon::now()->locale('id')->isoFormat(' D MMMM Y')}}</div>
        </div>
      </nav>
      <ul class="nav nav-tabs "style="background-color:#7D8E85">
        <li class="  nav-item ms-4">
          <a class="nav-link  text-white" aria-current="page" href="/Hari">Harian</a>
        </li>
        <li class="nav-item ms-4">
          <a class="nav-link active" aria-current="page" href="/minggu">Mingguan</a>
        </li>
        <li class="nav-item ms-4">
          <a class="nav-link text-white" aria-current="page" href="/bulan">Bulanan</a>
        </li>
      </ul>
      <div class="justify-content-between mt-1">
        @php
           $today = \Carbon\Carbon::now()->format('Y-m-d');
            $weeks = [
                'Minggu 1' => ['start' => '2024-09-01', 'end' => '2024-09-07'],
                'Minggu 2' => ['start' => '2024-09-08', 'end' => '2024-09-14'],
                'Minggu 3' => ['start' => '2024-09-15', 'end' => '2024-09-21'],
                'Minggu 4' => ['start' => '2024-09-22', 'end' => '2024-09-28'],
                'Minggu 5' => ['start' => '2024-09-29', 'end' => '2024-09-30']
            ];
        @endphp

        @foreach($weeks as $weekName => $dates)
        @php
            $isCurrentWeek = $today >= $dates['start'] && $today <= $dates['end'];
            $pemasukan = App\Models\Juang::where('bodoa', 'Pemasukan')
                ->whereBetween('tanggal', [$dates['start'], $dates['end']])
                ->sum('jumlah');

            $pengeluaran = App\Models\Juang::where('bodoa', 'Pengeluaran')
                ->whereBetween('tanggal', [$dates['start'], $dates['end']])
                ->sum('jumlah');
        @endphp
          <div  style="background-color:rgb(255, 255, 255)" class=" text-center ">
            <div class="container text-center">
                        <div class="row">
                        <div class="col">
                            {{ $weekName }}
                            <h5 class="bg-{{ $isCurrentWeek ? 'warning' : 'secondary' }} text-{{ $isCurrentWeek ? 'dark' : 'white' }} rounded" style="color:rgb(255, 255, 255)">
                                {{ \Carbon\Carbon::parse($dates['start'])->format('d.m') }} ~ {{ \Carbon\Carbon::parse($dates['end'])->format('d.m') }}
                            </h5>
                        </div>
                        <div class="col">
                            <h5 class="mt-3" style="color:green">Rp. {{ number_format($pemasukan, 0, ',', '.') }}</h5>
                        </div>
                        <div class="col">
                            <h5 class="mt-3" style="color:red">Rp. {{ number_format($pengeluaran, 0, ',', '.') }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
        <a href="/pengeluaran" type="button" class="btn btn-danger btn-bottom-right">+</a>      
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html