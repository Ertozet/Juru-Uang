<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Juru Uang</title>
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
        <li class="nav-item ms-4">
            <a class="nav-link active" aria-current="page" href="/Hari">Harian</a>
        </li>
        <li class="nav-item ms-4">
            <a class="nav-link text-white" aria-current="page" href="/minggu">Mingguan</a>
        </li>
        <li class="nav-item ms-4">
            <a class="nav-link text-white" aria-current="page" href="/bulan">Bulanan</a>
        </li>
    </ul>
    
    
    <div style="background-color:rgb(255, 255, 255)" class="text-center">
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    Pemasukan
                    <h5 style="color:green">Rp. {{ number_format($pemasukan, 0, ',', '.') }}</h5>
                </div>
                <div class="col">
                    Pengeluaran
                    <h5 style="color:red">Rp. {{ number_format($pengeluaran, 0, ',', '.') }}</h5>
                </div>
                <div class="col">
                    Saldo
                    <h5>Rp. {{ number_format($pemasukan - $pengeluaran, 0, ',', '.') }}</h5>
                </div>
            </div>
        </div>
    </div>
    
    @if($pemasukan == 0 && $pengeluaran == 0)
    <div class="container d-flex justify-content-center align-items-center" style="height: 70vh;">
        <div class="text-center">
             <h3 style="color:#3F4743">Jangan Malas Memanajemen Keuangan</h3>
        </div>
        </div>
    @else
    @foreach($juangs as $date => $entries)
    @php
        $totalPemasukan = $entries->where('bodoa', 'Pemasukan')->sum('jumlah');
        $totalPengeluaran = $entries->where('bodoa', 'Pengeluaran')->sum('jumlah');
    @endphp
    <div class="container-fluid mt-1 px-0" >
        <div class="card mb-3">
            <div class="card-body position-relative" >
                <h5 class="card-title text-center mb-2" style="color:green;">
                    {{ $date }}
                    <span class="text-success" style="padding: 0 30px;">Rp. {{ number_format($totalPemasukan, 0, ',', '.') }}</span> 
                    <span class="text-danger" style="padding: 0 30px;">Rp. {{ number_format($totalPengeluaran, 0, ',', '.') }}</span>                </h5>                    <hr style="position: absolute; left: 0; right: 0; border: 0; border-top: 2px solid #ccc; margin: 0;">
                    <div class="container mb-2 mt-4">
                        @foreach($entries as $juang)
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <h5>{{ $juang->kategori }}</h5>
                            </div>
                            <div class="col-md-3">
                                <p>{{ $juang->keterangan }}</p>
                            </div>
                            <div class="col-md-3">
                                @if($juang->bodoa == 'Pemasukan')
                                    <h5 style="color:green">Rp. {{ number_format($juang->jumlah, 0, ',', '.') }}</h5>
                                @elseif($juang->bodoa == 'Pengeluaran')
                                    <h5 style="color:red">Rp. {{ number_format($juang->jumlah, 0, ',', '.') }}</h5>
                                @else
                                    <h5>Rp. {{ number_format($juang->jumlah, 2, ',', '.') }}</h5>
                                @endif
                            </div>
                            <div class="col-md-3 text-end">
                                <div class="dropdown">
                                    <button class="btn" type="button" id="dropdownMenuButton{{ $juang->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                        &#x22EE; 
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $juang->id }}">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('editm', $juang->id) }}">Edit Pemasukan</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('editk', $juang->id) }}">Edit Pengeluaran</a>
                                        </li>
                                        <li>
                                            <form action="{{ route('juang.destroy', $juang->id) }}" method="POST" style="display: inline;">
                                                <button type="submit" class="dropdown-item" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @endif
    
    <a href="/pengeluaran" type="button" class="btn btn-danger btn-bottom-right">+</a>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
