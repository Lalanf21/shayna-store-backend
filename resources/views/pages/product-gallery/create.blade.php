@extends('layouts.default')

@section('content')
    <div class="card">
        <div class="card-header">
            <strong> Tambah foto barang </strong>
        </div>

        <div class="card-body card-block">
            <form action="{{ route('product-galleries.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name" class="form-control-label">
                        Nama barang
                    </label>
                    <select name="products_id" class="form-control @error('name') is-invalid @enderror">
                        <option>==PILIH==</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('products_id')
                        <div class="text-muted">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="photo" class="form-control-label">
                        Foto barang
                    </label>
                    <input type="file" name="photo" value="{{ old('photo') }}" class="form-control @error('photo') is-invalid @enderror" accept="image/*" />
                    @error('photo')
                    <div class="text-muted">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="is_default" class="form-control-label">
                        Jadikan default ?
                    </label>
                    <br>
                    <label>
                        <input type="radio" name="is_default" value="1" class="form-control">
                        Ya
                    </label>
                    &nbsp;
                    <label>
                        <input type="radio" name="is_default" value="0" class="form-control">
                        Tidak 
                    </label>
                    @error('is_default')
                    <div class="text-muted">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">Add foto barang</button>
                </div>

            </form>
        </div>
    </div>
@endsection
