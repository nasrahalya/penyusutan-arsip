@extends('layout')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Users Management</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <script type="text/javascript">
        $(function() {

            var table = $('.table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'roles',
                        name: 'roles',
                        render: function(data, type, full, meta) {
                            var rolesHtml = '';
                            if (data && data.length > 0) {
                                data.forEach(function(role) {
                                    console.log(role.name);

                                    rolesHtml += '<label class="badge badge-success">' +
                                        role.name + '</label> ';
                                });
                            }
                            return rolesHtml;
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

    {{-- 
@if (!empty($user->getRoleNames()))
@foreach ($user->getRoleNames() as $v)
    <label class="badge badge-success">{{ $v }}</label>
@endforeach
@endif --}}



    {{-- {!! $data->render() !!} --}}
@endsection
