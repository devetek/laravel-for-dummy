<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mahasiswa - Export PDF</title>
    <!-- Styles -->
    <style>
        table,
        th,
        tr,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-align: center;">
                Mahasiswa
            </h2>
        </div>
    </header>
    <div class="py-12">
        <table class="w-full whitespace-nowrap" style="width:98%">
            <tr class="text-left font-bold">
                <th class="px-6 pt-6 pb-4">NIS</th>
                <th class="px-6 pt-6 pb-4">Nama</th>
                <th class="px-6 pt-6 pb-4">Jurusan</th>
                <th class="px-6 pt-6 pb-4" colspan="2">Alamat</th>
            </tr>
            @foreach($mahasiswa ?? '' as $data)
            <tr>
                <td class="border-t">{{ $data->nis }}</th>
                <td class="border-t">{{ $data->fullname }}</td>
                <td class="border-t">{{ $data->major }}</td>
                <td class="border-t">{{ $data->address }}</td>
            </tr>
            @endforeach
            </tr>
        </table>
    </div </body>

</html>