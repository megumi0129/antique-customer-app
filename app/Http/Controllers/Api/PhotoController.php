<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('public/photos');
            $url = Storage::url($path);
            return response()->json(['url' => $url]);
        }

        return response()->json(['error' => 'No photo uploaded'], 400);
    }

    public function index()
    {
        $files = Storage::files('public/photos');
        $urls = array_map(fn($file) => Storage::url($file), $files);
        return response()->json(['photos' => $urls]);
    }
}

