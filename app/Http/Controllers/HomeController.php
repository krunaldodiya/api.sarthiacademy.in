<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use Error;

class HomeController extends Controller
{
    public function getLanguages(Request $request)
    {
        $countries = Country::all();

        return response(['countries' => $countries], 200);
    }

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
