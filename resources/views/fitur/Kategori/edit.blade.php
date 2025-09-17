<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ubah Kategori Retribusi</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<style>
    body {
        background-color: #4E73DF;
    }
</style>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Edit Kategori Retribusi</h5>
                        <hr>
                        <form action="{{ route('kategori-retribusi.update', $kategori->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                        
                            <div class="form-group mb-3">
                                <label for="kategori">Nama Kategori</label>
                                <input type="text" name="kategori" id="kategori" class="form-control"
                                    value="{{ old('kategori', $kategori->kategori) }}" required autocomplete="off">
                                @error('kategori')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="{{ route('kategori-retribusi.index') }}" class="btn btn-secondary">Batal</a>
                        </form>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
