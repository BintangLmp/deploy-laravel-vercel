@extends('components.admin')
@section('title', 'Petugas')

@push('addon-style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
@endpush

@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <!-- Header Content -->
        </div>
    </div>

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header border-0 d-flex justify-content-between">
                        <h3 class="mb-0">Data Pengaduan</h3>
                        <a href="{{ route('petugas.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Petugas</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush" id="pengaduanTable">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Petugas</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">No Telepon</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach($petugas as $k => $pet)
                                    <tr>
                                        <td>{{ $k + 1 }}</td>
                                        <td>{{ $pet->nama_petugas }}</td>
                                        <td>{{ $pet->username }}</td>
                                        <td>{{ $pet->telp }}</td>
                                        <td>{{ $pet->roles }}</td>
                                        <td>
                                            <a href="{{ route('petugas.edit', $pet->id_petugas) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="#" data-id_petugas="{{ $pet->id_petugas }}" class="btn btn-sm btn-danger petugasDelete">Hapus</a>
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

@push('addon-script')
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#pengaduanTable').DataTable();
    });

    $(document).on('click', '.petugasDelete', function (e) {
        e.preventDefault();
        let id_petugas = $(this).data('id_petugas');
        Swal.fire({
            title: 'Peringatan!',
            text: "Apakah Anda yakin akan menghapus petugas?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28B7B5',
            confirmButtonText: 'OK',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: '{{ route('petugas.destroy', '') }}/' + id_petugas,
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function (response) {
                        if (response == 'success') {
                            Swal.fire({
                                title: 'Pemberitahuan!',
                                text: "Petugas berhasil dihapus!",
                                icon: 'success',
                                confirmButtonColor: '#28B7B5',
                                confirmButtonText: 'OK',
                            }).then(() => {
                                location.reload();
                            });
                        }
                    },
                    error: function () {
                        Swal.fire({
                            title: 'Pemberitahuan!',
                            text: "Petugas gagal dihapus!",
                            icon: 'error',
                            confirmButtonColor: '#28B7B5',
                            confirmButtonText: 'OK',
                        });
                    }
                });
            }
        });
    });
</script>
@endpush