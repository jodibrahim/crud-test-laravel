@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Image</th>
                            <th>Nama Produk</th>
                            <th>Stock</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produk as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img src="{{ asset('storage/' . $item->image) }}" width="100" height="100"
                                        alt="{{ $item->nama }}"></td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->stock }}</td>
                                <td>{{ 'Rp. ' . number_format($item->harga, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('produk.show', $item->id) }}" class="btn btn-sm btn-success">Lihat</a>
                                    <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-sm btn-warning">Ubah</a>
                                    <form action="{{ route('produk.destroy', $item->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mb-3">
                    <a href="{{ route('produk.create') }}" class="btn btn-primary">Tambah Produk</a>
                </div>
            </div>
        </div>
    </div>