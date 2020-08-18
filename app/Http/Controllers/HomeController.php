<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use Error;

class HomeController extends Controller
{
    public function getMediaFile(Request $request)
    {
        $media = $request->media;

        $file = $request->file;

        if (Storage::disk('public')->exists($file)) {
            return response()->file("storage/{$file}");
        }

        throw new Error("File Does not exists");
    }
}
