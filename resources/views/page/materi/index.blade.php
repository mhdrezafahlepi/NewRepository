    @extends('layouts.app2')

    @section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Materi</h1>
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

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                    <div class="alert alert-success" style="display:none" id="message">
                        <strong>{{ session()->get('message') }}</strong>
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    </div>

                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('materi.create') }}" class="btn btn-secondary btn-sm"><i class="fa fa-plus"></i> Add</a>
                            </h5>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Kelas</th>
                                            <th>Judul Materi</th>
                                            <th>Materi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($materi as $no => $materi)
                                        <tr>
                                            <td>{{ $no + 1 }}</td>
                                            <td>{{ $materi->nama_pelajaran2 }}</td>
                                            <td>{{ $materi->nama_kelas }} {{ $materi->grup_kelas }}</td>
                                            <td>{{ $materi->nama_pelajaran}}</td>
                                            <td><a href="{{ asset('backend/file/materi/' . $materi->materi_pelajaran) }}" class="btn btn-info btn-sm"><i class="fa fa-download"></i> Download</a></td>
                                            <td>
                                                <a href="{{ route('materi.edit', $materi->id_materi) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Update</a>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="mHapus('{{ route('materi.delete', $materi->id_materi) }}')"><i class="fa fa-trash"></i> Delete</button>
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
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->

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
