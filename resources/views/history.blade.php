@extends('layout.layout_with_navbar')

@section('title')
{{$namaPage}}
@endsection


@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="col-6">
            <span class="f-30 f-w-400"><i class="icon-layers"></i> {{$judulPage}}</span>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row widget-grid">
        <div class="col">
            <div class="card">
                <div class="table-responsive signal-table">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th>Action</th>
                                <th>Data</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Dilakukan</th>
                                <th class="text-center">Page</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($histories as $index => $val)
                            <tr>
                                <th scope="row">{{$index + 1}}</th>
                                <td>{{$val->history_action}}</td>
                                <td>{{$val->history_data}}</td>
                                <td>{{$val->users_username}}</td>
                                <td>{{$val->users_role}}</td>
                                <td>{{fAnaTgl($val->created_at, 'jam:mnt - hri, tgl bln thn')}}</td> 
                                <td class="d-flex d-row justify-content-center">
                                    <a class="btn btn-sm btn-primary" href="{{url($val->history_pageURL)}}">Lihat Page</a>
                                    {{-- <div class="btn-group" role="group" aria-label="Basic example">
                                        <button class="btn btn-sm btn-primary" type="button" onclick="update({{$val}})"><i class="fa fa-pencil-square-o"></i> Update</button>
                                        <button class="btn btn-sm btn-secondary" type="button" onclick='hapus({{$val -> id}}, `{{$val -> eselon_nama}}`)'><i class="fa fa-times"></i> Hapus</button>
                                    </div> --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection