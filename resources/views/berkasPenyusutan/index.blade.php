@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Berkas Penyusutan</h2>
            </div>
            </br>
            <div class="pull-right">
                @can('penyusutan-create')
                    <a class="btn btn-success" href="{{ route('penyusutan.create') }}"> Create New Berkas Penyusutan</a>
                @endcan
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table_penyusutan table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Naskah</th>
                <th>Nomor Naskah</th>
                <th>Hal</th>
                <th>Unit Pengirim</th>
                <th>Unit Penerima</th>
                <th>File Arsip Inaktif</th>
                <th>File Berita Acara</th>
                <th>Status Kirim</th>
                <th>Status Penandatanganan</th>
                <th>Lampiran</th>
                <th width="500px">Action</th>
            </tr>
        </thead>
    </table>

    <script type="text/javascript">
        $(function() {

            var table = $('.table_penyusutan').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('penyusutan.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'tgl_naskah',
                        name: 'tgl_naskah'
                    },
                    {
                        data: 'no_naskah',
                        name: 'no_naskah'
                    },
                    {
                        data: 'hal',
                        name: 'hal'
                    },
                    {
                        data: 'pengirim',
                        name: 'pengirim'
                    },
                    {
                        data: 'penerima',
                        name: 'penerima'
                    },
                    {
                        data: 'file_arsip_inaktif',
                        name: 'file_arsip_inaktif',
                        render: function(data, type, row) {
                            console.log(data);
                            return '<embed src="/file_arsip_inaktif/' + data +
                                '" type="application/pdf" width="100px" height="100px">';
                        }
                    },
                    {
                        data: 'file_berita_acara',
                        name: 'file_berita_acara',
                        render: function(data, type, row) {
                            console.log(data);
                            return '<embed src="/file_berita_acara/' + data +
                                '" type="application/pdf" width="100px" height="100px">';
                        }
                    },
                    {
                        data: 'status_kirim',
                        name: 'status_kirim',
                        render:function(data) {
                            if(data == "success"){
                                return '<span class="badge badge-pill badge-success">'+data+'</span>';
                            }else{
                                return '<span class="badge badge-pill badge-warning">'+data+'</span>';
                            }
                        }
                    },
                    {
                        data: 'status_penandatanganan',
                        name: 'status_penandatanganan',
                        render:function(data,type,row){
                            return '<img src="/status_penandatanganan/' + data + '" width="100px" height="100px">';
                        }
                    },
                    {
                        data: 'lampiran',
                        name: 'lampiran',
                        render: function(data, type, row) {
                            console.log(data);
                            return '<embed src="/lampiran/' + data +
                                '" type="application/pdf" width="100px" height="100px">';
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }

                ]
            });

        });
    </script>
@endsection
