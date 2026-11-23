<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil kata kunci pencarian
        $search = $request->query('search', '');

        // 2. Ambil parameter 'perPage' dari URL/request, default 10 jika tidak ada
        $perPage = (int) $request->query('perPage', 10);

        // 3. Validasi agar nilai perPage hanya boleh 5, 10, atau 25
        if (! in_array($perPage, [5, 10, 25], true)) {
            $perPage = 10;
        }

        // 4. Eksekusi query dengan paginate($perPage) dinamis
        $posts = Post::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage) // <-- PASTI KAN MENGGUNAKAN VARIABEL $perPage DI SINI
            ->withQueryString();

        // 5. Kirim variabel $perPage ke view Blade
        return view('posts.index', compact('posts', 'search', 'perPage'));
    }
}