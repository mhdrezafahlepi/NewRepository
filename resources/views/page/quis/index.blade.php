@extends('layouts.app2')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Quiz</h1>
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
                <a href="{{ route('quis.create') }}" class="btn btn-secondary btn-sm form-control"><i class="fa fa-plus"></i> Add</a>
            </h5>
            <h5>
                <!-- <form action="{{route('quis.create')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-7">
                            <input type="number" name="jumlah_soal" placeholder="Jumlah Soal" class="form-control">
                        </div>
                        <div class="col-lg-5">
                            <button type="submit" class="btn btn-secondary"><i class="fa fa-plus"></i> Add</button>
                        </div>
                    </div>
                </form> -->
                <form action="{{route('quis.cari')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-5">
                            <select name="cari_kelas" class="form-control @error('id_kelas') {{ 'is-invalid' }} @enderror">
                                <option value="" disabled selected>Pilih Kelas</option>
                                @foreach($kelas as $no => $kelas)
                                <option value="{{ $kelas->id_kelas }}">
                                    {{ $kelas->nama_kelas}}{{ $kelas->grup_kelas}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-5">
                            <select name="cari_matpel" class="form-control @error('id_pelajaran') {{ 'is-invalid' }} @enderror">
                                <option value="" disabled selected>Pilih Pelajaran</option>
                                @foreach($pelajaran as $no => $pelajaran)
                                <option value="{{ $pelajaran->id_pelajaran }}">
                                    {{ $pelajaran->nama_pelajaran}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>

                        </div>
                    </div>
                </form>
            </h5>

        </div>
        <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kelas</th>
                        <th>Mata Pelajaran</th>
                        <th>Soal</th>
                        <th>Kunci Jawaban</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($quis as $no => $quis)
                    <tr>
                        <td>{{ $no + 1 }}</td>
                        <td>{{ $quis->nama_kelas }} {{ $quis->grup_kelas }}</td>
                        <td>{{ $quis->nama_pelajaran }}</td>
                        <td>{{ $quis->soal }}</td>
                        <td>{{ $quis->kunci }}</td>
                        <td>
                            <a href="{{ route('quis.edit', $quis->id_quis) }}" class="btn btn-warning btn-sm"><i
                                    class="fa fa-edit"></i> Update</a>
                            <button type="button" class="btn btn-danger btn-sm"
                                onclick="mHapus('{{ route('quis.delete', $quis->id_quis) }}')"><i
                                    class="fa fa-trash"></i> Delete</button>
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
    setInterval(function () {
        $('#message').hide();
    }, 5000);

</script>
@endif
@endsection
