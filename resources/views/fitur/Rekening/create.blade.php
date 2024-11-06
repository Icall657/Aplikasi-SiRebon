<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="row">


        <div class="col">
            <div class="card profile-card">
                <div class="card-body">
                    <h5 class="card-title">Tambah Rekening Pembayaran</h5>
                    <hr>
                    <form action="{{ route('rekening.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="id_ref_bank">Bank</label>
                            <div class="col-sm-9">
                                <select name="id_ref_bank" id="id_ref_bank" class="form-select">
                                    @foreach($refBanks as $bank)
                                        <option value="{{ $bank->id }}">{{ $bank->nama_bank }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Nama Akun</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama_akun" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Nomor Rekening</label>
                            <div class="col-sm-9">
                                <input type="text" name="no_rekening" class="form-control">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>