<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Rules\RupiahFormat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        return view('produk.index', compact('produk'));
    }

    public function store(Request $request)
    {
        // Validate form input
        $validator = Validator::make($request->all(), [
            'nama_produk' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (Produk::where('nama_produk', $value)->exists()) {
                        $fail('Nama produk sudah ada.');
                    }
                }
            ],
            'image' => 'required|file|image|max:5120|mimes:jpg,jpeg,png',
            'stock' => 'required|numeric',
            'harga' => ['required', 'numeric', new RupiahFormat],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create new product
        $product = new Produk();
        $product->nama_produk = $request->nama_produk;
        $product->stock = $request->stock;
        $product->harga = $request->harga;

        // Save product image to storage
        $path = $request->file('image')->store('public/images');
        $product->image = str_replace('public/', 'storage/', $path);

        $product->save();

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }


    public function create()
    {
        return view('produk.create');
    }

    public function show($id)
    {
        $product = Produk::find($id);
        if (!$product) {
            abort(404);
        }

        return view('produk.show', ['product' => $product]);
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_produk' => 'required|unique:tbl_produk,nama_produk,' . $id,
            'image' => 'nullable|image|max:5000|file|mimes:jpeg,jpg,png',
            'stock' => 'required|numeric',
            'harga' => 'required|numeric',
        ]);

        $produk = Produk::find($id);
        $produk->nama_produk = $request->input('nama_produk');
        $produk->stock = $request->input('stock');
        $produk->harga = $request->input('harga');

        // upload image
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $produk->image = $filename;
        }

        $produk->save();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diupdate');
    }

    public function destroy($id)
    {
        $produk = Produk::find($id);
        if ($produk) {
            // hapus image
            if (file_exists(public_path('images/' . $produk->image))) {
                unlink(public_path('images/' . $produk->image));
            }

            // hapus produk
            $produk->delete();

            return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus');
        } else {
            return redirect()->route('produk.index')->with('error', 'Produk tidak ditemukan');
        }
    }


}