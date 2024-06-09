@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>DAFTAR ARSIP</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('daftarArsip.create') }}"> Create New Tertib Arsip</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table_daftarArsip table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode klasifikasi</th>
                <th>Uraian klasifikasi</th>
                <th>Uraian Informasi Berkas</th>
                <th>No Berkas</th>
                <th>No Item Berkas</th>
                <th>Tanggal</th>
                <th>Tingkat Perkembangan</th>
                <th>Jumlah Berkas</th>
                <th>Lokasi Simpan</th>
                <th>Aktif Hingga</th>
                <th>Inaktif Hingga</th>
                <th>Klasifikasi Keamanan</th>
                <th>Hak Akses</th>
                <th>Keterangan</th>
                <th>File Arsip</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
    </table>

    <script type="text/javascript">
        $(function() {

            var table = $('.table_daftarArsip').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('daftarArsip.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable:false,
                        searchable:false
                    },
                    {
                        data: 'kd_klasifikasi',
                        name: 'kd_klasifikasi'
                    },
                    {
                        data: 'uraian_klasifikasi',
                        name: 'uraian_klasifikasi'
                    },
                    {
                        data: 'uraian_informasi_berkas',
                        name: 'uraian_informasi_berkas'
                    },
                    {
                        data: 'no_berkas',
                        name: 'no_berkas'
                    },
                    {
                        data: 'no_item_berkas',
                        name: 'no_item_berkas'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'tingkat_perkembangan',
                        name: 'tingkat_perkembangan'
                    },
                    {
                        data: 'jmlh_berkas',
                        name: 'jmlh_berkas'
                    },
                    {
                        data: 'lokasi_simpan',
                        name: 'lokasi_simpan'
                    },
                    {
                        data: 'jadwal_aktif',
                        name: 'jadwal_aktif'
                    },
                    {
                        data: 'jadwal_inaktif',
                        name: 'jadwal_inaktif'
                    },
                    {
                        data: 'klasifikasi_keamanan',
                        name: 'klasifikasi_keamanan'
                    },
                    {
                        data: 'hak_akses',
                        name: 'hak_akses'
                    },
                    {
                        data: 'ket',
                        name: 'ket'
                    },
                    {
                        data: 'file_arsip',
                        name: 'file_arsip',
                        render: function(data, type, row) {
                            console.log(data);
                            return '<embed src="/file_arsip/' + data +
                                '" type="application/pdf" width="100px" height="100px">';
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

        });
    </script>

@endsection