<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function getMediaFile(Request $request)
    {
        $media = $request->media;

        $file = $request->file;

        if (Storage::disk('public')->exists($file)) {
            return response()->file("storage/{$file}");
        }

        return response()->file("storage/{$media}.png");
    }
}
