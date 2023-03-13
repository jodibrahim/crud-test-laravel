<div>
    <h1>{{ $product->nama_produk }}</h1>
    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->nama_produk }}" style="max-width: 100%; height: auto;">
    <p>Harga: Rp{{ number_format($product->harga) }}</p>
    <p>Stok: {{ $product->stock }}</p>
    <p>Created at: {{ $product->created_at }}</p>
    <p>Updated at: {{ $product->updated_at }}</p>
</div>
