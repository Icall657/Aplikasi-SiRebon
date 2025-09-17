<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Sudah Membayar Retribusi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function printRow(row) {
            var printContent = row.cloneNode(true);
            var theadContent = document.querySelector("thead").cloneNode(true);
            var newWindow = window.open('', '', 'width=800,height=600');
            newWindow.document.write('<html><head><title>Print</title></head><body>');
            newWindow.document.write(
                '<table border="1" style="width:100%; border-collapse: collapse; text-align: center;">');
            newWindow.document.write(theadContent.outerHTML);
            newWindow.document.write(printContent.outerHTML);
            newWindow.document.write('</table></body></html>');
            newWindow.document.close();
            newWindow.print();
        }

        function printAll() {
            window.print();
        }
    </script>
</head>

<body class="bg-gray-100 p-6">
    <div class="max-w-5xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-center text-3xl font-bold mb-6">Laporan Sudah Membayar Retribusi</h2>
        <div class="text-right mb-4">
            <button onclick="printAll()"
                class="bg-green-500 text-white px-5 py-3 rounded hover:bg-green-600 transition duration-200 ease-in-out shadow-md">
                <i class="fas fa-print"></i> Print Semua
            </button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full border border-gray-400">
                <thead class="bg-gray-300">
                    <tr class="text-center text-lg">
                        <th class="border px-6 py-3">Nama Pemilik</th>
                        <th class="border px-6 py-3">Nama Kapal</th>
                        <th class="border px-6 py-3">Tanggal Pembayaran</th>
                        <th class="border px-6 py-3">Jumlah Dibayar</th>
                        <th class="border px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($laporan as $data)
                        <tr class="text-center text-lg">
                            <td class="border px-6 py-3">{{ $data->user->wajibRetribusi->nama }}</td>
                            <td class="border px-6 py-3">{{ $data->kapal->nama_kapal }}</td>
                            <td class="border px-6 py-3">{{ $data->tgl_bayar }}</td>
                            <td class="border px-6 py-3">Rp {{ number_format($data->nominal, 0, ',', '.') }}</td>
                            <td class="border px-6 py-3">
                                <button onclick="printRow(this.closest('tr'))"
                                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200 ease-in-out shadow-md">
                                    <i class="fas fa-print"></i> Print
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
</body>

</html>
