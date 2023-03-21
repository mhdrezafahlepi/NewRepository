@extends('layouts.app2')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Jawaban</h1>
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
            <!-- <h5 class="card-title">
                <a href="{{ route('jawab.create') }}" class="btn btn-cyan btn-sm"><i class="fa fa-plus"></i> Add</a>
            </h5> -->
            <div class="table-responsive">
                <table id="zero_config" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Pelajaran</th>
                            <th>Tanggal Jawab</th>
                            <th>Action</th1>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jawab as $no => $jwb)
                        <tr>
                            <td>{{ $no + 1 }}</td>
                            <td>{{ $jwb->nama_siswa }}</td>
                            <td>{{ $jwb->nama_pelajaran }}</td>
                            <td>{{ \Carbon\Carbon::parse($jwb->tgl_jawab)->isoFormat('D MMMM Y') }}</td>
                            <td>                                        
                                <button type="button" class="btn btn-info btn-sm" onclick="mDetail('{{$jwb->id_jawab}}', '{{ $jwb->nama_siswa }}', '{{ $jwb->nama_pelajaran }}')"><i class="fa fa-search"></i> Detail</button>
                                <!-- <button type="button" class="btn btn-danger btn-sm" onclick="mHapus('{{ route('jawab.delete', $jwb->id_jawab) }}')"><i class="fa fa-trash"></i> Delete</button> -->
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

<!-- modal detail -->
<div class="modal fade" id="ModalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title_detail">Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="isi">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    // untuk hapus data
    function mHapus(url) {
        $('#ModalHapus').modal()
        $('#formDelete').attr('action', url);
    }

    function mDetail(id, nama, pelajaran) {
        $('#title_detail').text('Detail Jawaban : ' + nama + " / " + pelajaran);
        
        axios.post("{{route('jawab.detail')}}", {
            'id_jawab' : id,
        }).then(function(res){
            // console.log(res.data);
            $('#isi').html(res.data);
        }).catch(function(err){
            console.log(err);
        });

        $('#ModalDetail').modal()
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
