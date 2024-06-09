@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>RUMUSAN KLASIFIKASI ARSIP, JADWAL RETENSI ARSIP DAN SISTEM KLASIFIKASI KEAMANAN DAN AKSES ARSIP DINAMIS DI LINGKUNGAN PEMERINTAH  DAERAH</h2>
            </div>
        </br>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('tertibArsip.create') }}"> Create New Tertib Arsip</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table_tertibArsip table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode klasifikasi</th>
                <th>Uraian klasifikasi</th>
                <th>Klasifikasi Keamanan</th>
                <th>Hak Akses</th>
                <th>Jadwal Aktif</th>
                <th>Jadwal Inaktif</th>
                <th>Keterangan</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
    </table>

    <script type="text/javascript">
        $(function() {

            var table = $('.table_tertibArsip').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('tertibArsip.index') }}",
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
                        data: 'klasifikasi_keamanan',
                        name: 'klasifikasi_keamanan'
                    },
                    {
                        data: 'hak_akses',
                        name: 'hak_akses'
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
                        data: 'ket',
                        name: 'ket'
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


    {{-- @foreach ($products as $product)
            <tr>
                <td>{{ ++$i }}</td>
                <td><img src="/image/{{ $product->image }}" width="100px" alt=""></td>
                <td>{{ $product->nama_product }}</td>
                <td>{{ $product->harga }}</td>
                <td>{{ $product->keterangan }}</td>
                <td>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('products.show', $product->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('products.edit', $product->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $products->links() !!} --}}
@endsection