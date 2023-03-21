@extends('layouts.app2')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Nilai</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <!-- <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v3</li>
            </ol> -->
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="container-fluid">
    <div class="card">

    <div class="alert alert-success" style="display:none" id="message">
        <strong>{{ session()->get('message') }}</strong>
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>

        <div class="card-body">
            <h5 class="card-title">
                <a href="{{ route('nilai.create') }}" class="btn btn-secondary btn-sm"><i class="fa fa-plus"></i> Add</a>
                <form action="{{route('nilai.cari')}}" method="POST">
                    @csrf
                <div class="row">
                        <div class="col-lg-5">
                        <input type="date" name="tanggal_awal" class="form-control">
                        </div>
                        <div class="col-lg-5">
                        <input type="date" name="tanggal_akhir" class="form-control">
                        </div>
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-success">Cari</button>
                        </div>
                    </div>
                    </form>
                </div>
            </h5>
            <div class="table-responsive">
                <table id="zero_config" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Siswa</th>
                            <th>Mata Pelajaran</th>
                            <th>Nilai</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($nilai as $no => $nilai)
                        <tr>
                            <td>{{ $no + 1 }}</td>
                            <td>{{ $nilai->nama_siswa }}</td>
                            <td>{{ $nilai->nama_pelajaran }}</td>
                            <td>{{ $nilai->nilai }}</td>
                            <td>
                                <a href="{{ route('nilai.edit', $nilai->id_nilai) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Update</a>
                                <button type="button" class="btn btn-danger btn-sm" onclick="mHapus('{{ route('nilai.delete', $nilai->id_nilai) }}')"><i class="fa fa-trash"></i> Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- modal hapus -->
<div class="modal fade" id="ModalHapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" id="formDelete">
                <div class="modal-body">
                    @csrf
                    @method('delete')
                    Yakin Hapus Data ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // untuk hapus data
    function mHapus(url) {
        $('#ModalHapus').modal()
        $('#formDelete').attr('action', url);
    }
</script>

@if (session()->has('message'))
<script>
    $('#message').show();
    setInterval(function(){
        $('#message').hide();
    }, 5000);
</script>
@endif
@endsection
