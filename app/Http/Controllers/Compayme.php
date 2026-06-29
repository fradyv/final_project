<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Compayme extends Controller
{
    public function index()
    {
        /**
     * Menampilkan daftar produk (Hanya bisa diakses jika lolos middleware)
     */
    };
    public function index()
    {
        return response()->json([
            'status' => true,
            'message' => 'Berhasil memuat data produk.',
            'data' => [
                ['id' => 1, 'name' => 'Laptop Asus', 'price' => 15000000],
                ['id' => 2, 'name' => 'Mouse Logitech', 'price' => 300000]
            ]
        ]);
    }
}
