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
      <ul class="nav nav-tabs mb-1"style="background-color:#7D8E85">
        <li class="nav-item ms-4 ">
          <a class="nav-link text-white" aria-current="page" href="/Hari">Harian</a>
        </li>
        <li class="nav-item ms-4 ">
          <a class="nav-link text-white " aria-current="page" href="/minggu">Mingguan</a>
        </li>
        <li class="nav-item ms-4">
          <a class="nav-link active" aria-current="page" href="/bulan">Bulanan</a>
        </li>
      </ul>

      @php
      $months = [
        'Januari' => '2024-01',
        'Februari' => '2024-02',
        'Maret' => '2024-03',
        'April' => '2024-04',
        'Mei' => '2024-05',
        'Juni' => '2024-06',
        'Juli' => '2024-07',
        'Agustus' => '2024-08',
        'September' => '2024-09',
        'Oktober' => '2024-10',
        'November' => '2024-11',
        'Desember' => '2024-12'
      ];
      @endphp

        @foreach($months as $monthName => $month)
        @php
          $startOfMonth = $month . '-01';
          $endOfMonth = \Carbon\Carbon::parse($startOfMonth)->endOfMonth()->toDateString();

          $pemasukan = App\Models\Juang::where('bodoa', 'Pemasukan')
              ->whereBetween('tanggal', [$startOfMonth, $endOfMonth])
              ->sum('jumlah');

          $pengeluaran = App\Models\Juang::where('bodoa', 'Pengeluaran')
              ->whereBetween('tanggal', [$startOfMonth, $endOfMonth])
              ->sum('jumlah');

          $today = \Carbon\Carbon::now()->format('Y-m');
          $bgColor = $today === $month ? 'bg-warning' : 'bg-secondary';
          $Color = $today === $month ? '#000000' : '#ffffff';
        @endphp
          <div  style="background-color:rgb(255, 255, 255)" class=" text-center ">
            <div class="container text-center">
                <div class="row">
                <div class="col">
                  <h5 class="{{ $bgColor }} rounded p-2 mt-2" style="color:{{ $Color }}">{{ $monthName }}</h5>
                </div>
                <div class="col mt-3">
                  <h5 style="color:green">Rp. {{ number_format($pemasukan, 0, ',', '.') }}</h5>
                </div>
                <div class="col mt-3">
                  <h5 style="color:red">Rp. {{ number_format($pengeluaran, 0, ',', '.') }}</h5>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      <a href="/pengeluaran" type="button" class="btn btn-danger btn-bottom-right">+</a>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html