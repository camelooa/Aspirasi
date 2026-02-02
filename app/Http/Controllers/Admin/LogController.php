<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\aspirasi;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    public function index()
    {
        $logs = aspirasi::with('user', 'kategori')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.log', [
            'logs' => $logs,
            'user' => Auth::user()
        ]);
    }
}
