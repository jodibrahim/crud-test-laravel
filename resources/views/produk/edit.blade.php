@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Produk') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('produk.update', $produk->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="nama_produk"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Nama Produk') }}</label>

                                <div class="col-md-6">
                                    <input id="nama_produk" type="text"
                                        class="form-control @error('nama_produk') is-invalid @enderror" name="nama_produk"
                                        value="{{ $produk->nama_produk }}" required autocomplete="nama_produk" autofocus>

                                    @error('nama_produk')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="image"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                                <div class="col-md-6">
                                    <input id="image" type="file"
                                        class="form-control @error('image') is-invalid @enderror" name="image"
                                        value="{{ $produk->image }}" required accept=".jpg,.jpeg,.png">

                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="stock"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Stock') }}</label>

                                <div class="col-md-6">
                                    <input id="stock" type="number"
                                        class="form-control @error('stock') is-invalid @enderror" name="stock"
                                        value="{{ $produk->stock }}" required autocomplete="stock" autofocus>

                                    @error('stock')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="harga"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Harga') }}</label>

                                <div class="col-md-6">
                                    <input id="harga" type="text"
                                        class="form-control @error('harga') is-invalid @enderror" name="harga"
                                        value="{{ number_format($produk->harga, 0, ',', '.') }}" required
                                        autocomplete="harga" autofocus>

                                    @error('harga')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update Produk') }}
                                    </button>
                                    <a href="{{ route('produk.index') }}" class="btn btn-secondary">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>