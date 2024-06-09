@extends('layout')

@section('title', 'Daftar Arsip Inaktif')

@section('styles')
    <!-- Add any additional styles specific to this view if needed -->
@endsection

@section('content')
    <h2>Daftar Arsip Inaktif</h2>
    <table>
        <thead>
            <tr>
                <th>Kode Klasifikasi</th>
                <th>Uraian Klasifikasi</th>
                <th>Uraian Informasi Klasifikasi</th>
                <th>Kurun Waktu</th>
                <th>Tingkat Perkembangan</th>
                <th>Jumlah Berkas</th>
                <th>Lokasi Simpan</th>
                <th>Jangka Simpan</th>
                <th>Klasifikasi Keamanan</th>
                <th>Hak Akses</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $dt)
                <tr>
                    <td>{{ $dt->tertib->kd_klasifikasi }}</td>
                    <td>{{ $dt->tertib->uraian_klasifikasi }}</td>
                    <td>{{ $dt->uraian_informasi_berkas }}</td>
                    <td>{{ $dt->tanggal }}</td>
                    <td>{{ $dt->tingkat_perkembangan }}</td>
                    <td>{{ $dt->jmlh_berkas }}</td>
                    <td>{{ $dt->lokasi_simpan }}</td>
                    <td>{{ $dt->tertib->jadwal_inaktif }} ({{ $dt->jadwal_inaktif }})</td>
                    <td>{{ $dt->tertib->klasifikasi_keamanan }}</td>
                    <td>{{ $dt->tertib->hak_akses }}</td>
                    <td>{{ $dt->tertib->ket }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection