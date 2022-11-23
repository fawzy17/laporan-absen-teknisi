<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body onload="getLocation()">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <center>
                    <h1>Form Edit</h1>
                </center>
                <form class="myForm" method="post" action="/absen/{{ $absen->id }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">NIP</label>
                        <input type="numeric" class="form-control" name="nip_karyawan" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('nip_karyawan') ?? $absen->nip_karyawan }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Nama Karyawan</label>
                        <input type="text" name="nama_karyawan" class="form-control" value="{{ old('nama_karyawan') ?? $absen->nama_karyawan }}">

                    </div>
                    <div class="mb-3">
                        {{-- <label for="" class="form-label">Lokasi</label> --}}
                        <input type="hidden" name="latitude" class="form-control">
                        <input type="hidden" name="longitude" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Kode Mesin</label>
                        <input type="text" name="kode_mesin" class="form-control" value="{{ old('kode_mesin') ?? $absen->kode_mesin }}">

                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Kondisi Mesin</label>
                        <select class="form-select" name="kondisi_mesin" aria-label="Default select example">
                            <option value="Sangat Baik" {{ old('kondisi_mesin') ?? $absen->kondisi_mesin == "Sangat Baik" ? 'selected' : '' }}>Sangat Baik
                            </option>
                            <option value="Baik" {{ old('kondisi_mesin') ?? $absen->kondisi_mesin == "Baik" ? 'selected' : '' }}>Baik
                            </option>
                            <option value="Buruk" {{ old('kondisi_mesin') ?? $absen->kondisi_mesin == "Buruk" ? 'selected' : '' }}>Buruk
                            </option>
                            <option value="Sangat Buruk" {{ old('kondisi_mesin') ?? $absen->kondisi_mesin == "Sangat Buruk" ? 'selected' : '' }}>Sangat Buruk
                            </option>
                        </select></div>

                    <div class="mb-3">
                        <label for="" class="form-label">Foto</label>
                        <input type="file" name="foto" class="form-control" value="{{ old('nip_karyawan') ?? $absen->nip_karyawan }}"> 
                        <img src="{{ asset('storage/uploads/'.$absen->foto) }}" width="106px" height="110px"
                            alt="{{ $absen->nama }}" class="mt-2">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>

    <script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            }
        }

        function showPosition(position) {
            document.querySelector('.myForm input[name="latitude"]').value = position.coords.latitude;
            document.querySelector('.myForm input[name="longitude"]').value = position.coords.longitude;
        }

        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    alert('Anda harus mengaktifkan lokasi saat ini!');
                    location.reload();
                    break;
            }
        }

    </script>
</body>

</html>

