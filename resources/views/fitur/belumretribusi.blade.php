<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Belum Membayar Retribusi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100 p-6">
    <div class="max-w-5xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-center text-3xl font-bold mb-6">Laporan Belum Membayar Retribusi</h2>
        <div class="overflow-x-auto">
            <table class="w-full border border-gray-400">
                <thead class="bg-gray-300">
                    <tr class="text-center text-lg">
                        <th class="border px-6 py-3">Nama Pemilik</th>
                        <th class="border px-6 py-3">Nama Kapal</th>
                        <th class="border px-6 py-3">Nomor HP</th>
                        <th class="border px-6 py-3">Alamat</th>
                        <th class="border px-6 py-3">Status</th>
                        <th class="border px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($belumBayar as $data)
                        <tr class="text-center text-lg">
                            <td class="border px-6 py-3">{{ $data->wajibRetribusi->nama }}</td>
                            <td class="border px-6 py-3">
                                {{ $data->kapals->first()->nama_kapal ?? '-' }}
                            </td>                            
                            <td class="border px-6 py-3">{{ $data->wajibRetribusi->no_hp }}</td>
                            <td class="border px-6 py-3">{{ $data->wajibRetribusi->alamat }}</td>
                            <td class="border px-6 py-3">
                                @if ($data->wajibRetribusi->status === 'A')
                                    Aktif
                                @elseif ($data->wajibRetribusi->status === 'B')
                                    Tidak Aktif
                                @else
                                    {{ $data->wajibRetribusi->status }}
                                @endif
                            </td>                                                        
                            <td class="border px-6 py-3">
                                <button onclick="sendReminder('{{ $data->wajibRetribusi->no_hp }}')"
                                    class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition duration-200 ease-in-out shadow-md">
                                    <i class="fas fa-bell"></i> Kirim Pengingat
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6 text-center">
            <a href="{{ route('carilaporan.index') }}"
                class="bg-gray-500 text-white px-5 py-3 rounded hover:bg-gray-600">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <script>
        function sendReminder(phone) {
            Swal.fire({
                title: "Kirim Pengingat?",
                text: "Pengingat akan dikirim ke nomor: " + phone,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Kirim!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        "Terkirim!",
                        "Pengingat telah dikirim ke: " + phone,
                        "success"
                    );
                }
            });
        }
    </script>
</body>

</html>
