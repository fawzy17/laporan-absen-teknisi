<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 py-3">
                <center>
                    <h1>Halaman Absen Teknisi</h1>
                </center>

                <a href="/absen/create" class="btn btn-primary">Tambah</a>

            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NIP</th>
                            <th scope="col">Nama Karyawan</th>
                            <th scope="col">Lokasi</th>
                            <th scope="col">Kode Mesin</th>
                            <th scope="col">Kondisi Mesin</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @forelse($absens as $absen)
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $absen->nip_karyawan }}</td>
                            <td>{{ $absen->nama_karyawan }}</td>
                            <td style="width:450px; height:450px;">
                            <iframe src="https://www.google.com/maps?q={{ $absen->latitude }},{{ $absen->longitude }}&hl=es;z=14&output=embed" width="100%" height="100%" frameborder="0"></iframe>
                            </td>
                            <td>{{ $absen->kode_mesin }}</td>
                            <td>{{ $absen->kondisi_mesin }}</td>
                            <td>
                                <img src="{{ asset('storage/uploads/'.$absen->foto) }}" alt="" width="100" height="100">
                            </td>
                            <td>
                                <a href="/absen/{{ $absen->id }}/edit" class="btn btn-warning mb-3" style="color:white;">Edit</a>
                                <form method="post" action="">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure delete data?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <span class="text-danget">Tidak ada data..</span>

                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</body>

</html>
