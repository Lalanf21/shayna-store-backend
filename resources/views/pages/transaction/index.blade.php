@extends('layouts.default')

@section('content')
<div class="orders">
    <div class="row">
        <div class="col-12">
            @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('status') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <h4 class="box-title">
                        Daftar transaksi masuk
                    </h4>
                </div>
                <div class="card-body--">
                    <div class="table-stats order-table ov-h">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama pembeli</th>
                                    <th>Email</th>
                                    <th>Nomor Telp</th>
                                    <th>Total Transaksi</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($items as $item)
                                <tr>
                                    <td> {{$loop->iteration}} </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->number }}</td>
                                    <td>Rp.{{ $item->transaction_total }}</td>
                                    <td>
                                        @if($item->transaction_status == 'PENDING')
                                            <span class="badge badge-info">
                                        @elseif($item->transaction_status == 'SUCCESS')
                                            <span class="badge badge-success">
                                        @elseif($item->transaction_status == 'FAILED')
                                            <span class="badge badge-warning">
                                        @else
                                            <span>
                                        @endif
                                                {{ $item->transaction_status }}
                                            </span>
                                    </td>
                                    <td>
                                        @if($item->transaction_status == 'PENDING')
                                            <a href="{{ route('transaction.status', $item->id) }}?status=SUCCESS" class="btn btn-success btn-sm">
                                                <i class="fa fa-check"></i>
                                            </a>
                                            <a href="{{ route('transaction.status', $item->id) }}?status=FAILED" class="btn btn-warning btn-sm">
                                                <i class="fa fa-times"></i>
                                            </a>
                                            |
                                        @endif

                                        <a href="#myModal" data-remote="{{ route('transaction.show', $item->id) }}" data-toggle="modal" data-target="#myModal" data-title="Detail Transaksi {{ $item->uuid }}" class="btn btn-info btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                        <a href="{{ route('transaction.edit', $item->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>


                                        <form action="{{ route('transaction.destroy', $item->id) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center p-5">
                                        Data tidak tersedia
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

