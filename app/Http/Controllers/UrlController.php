<?php
namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UrlController extends Controller
{
    public function shorten(Request $request)
    {
        $request->validate([
            'url' => 'required|url|max:2048',
        ]);
        $originalUrl = $request->input('url');

        return response()->json([
            'status' => 'success',
            'message' => 'Data retrieved successfully!',
            'data' => [
                'short' => 'https://ur0.jp/'.Str::random(6),
                'original' => $originalUrl,
            ],
        ]);

        // Check if the URL already exists
        $existingUrl = Url::where('original_url', $originalUrl)->first();
        if ($existingUrl) {
            return response()->json([
                'short_url' => url($existingUrl->short_url),
                'message' => 'URL already exists'
            ]);
        }

        // Generate a unique short URL
        $shortUrl = $this->generateShortUrl();

        // Save the new URL
        Url::create([
            'original_url' => $originalUrl,
            'short_url' => $shortUrl,
        ]);

        return response()->json([
            'short_url' => url($shortUrl),
            'message' => 'URL shortened successfully'
        ]);
    }

    private function generateShortUrl()
    {
        do {
            $hash = Str::random(6);
        } while (Url::where('short_url', $hash)->exists());

        return $hash;
    }
}