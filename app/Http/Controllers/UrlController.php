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

        if ($this->isUrlDangerousWithVirusTotal($originalUrl, env('VIRUSTOTAL_APIKEY')))
            return response()->json(['status' => 'error', 'message' => 'URL is potentially dangerous']);

        // Check if the URL already exists
        $existingUrl = Url::where('original_url', $originalUrl)->first();
        if ($existingUrl) {
            return response()->json([
                'short_url' => url($existingUrl->short_url),
                'message' => 'URL already exists'
            ]);
        }

        // Generate a unique short hash-URL
        do {
            $shortUrl = Str::random(6);
        } while (Url::where('short_url', $shortUrl)->exists());

        // Save the new URL
        Url::create([
            'original_url' => $originalUrl,
            'short_url' => $shortUrl,
        ]);

        return response()->json([
            'status' => 'success',
            'short_url' => url($shortUrl),
            'message' => 'URL shortened successfully'
        ]);
    }

    public function redirect($hash)
    {
        $url = Url::where('short_url', $hash)->firstOrFail();
        return redirect($url->original_url);
    }


    private function isUrlDangerousWithVirusTotal($url, $apiKey) {
        $apiUrl = "https://www.virustotal.com/vtapi/v2/url/report?apikey={$apiKey}&resource=" . urlencode($url);

        $response = file_get_contents($apiUrl);
        if ($response === FALSE) {
            return "Error checking URL.";
        }

        $result = json_decode($response, true);

        if ($result['response_code'] === 1 && $result['positives'] > 0) {
            return true;
        } else {
            return false;
        }
    }

//        return response()->json([
//            'status' => 'success',
//            'message' => 'Data retrieved successfully!',
//            'data' => [
//                'short' => 'https://ur0.jp/'.Str::random(6),
//                'original' => $originalUrl,
//            ],
//        ]);

    private function generateShortUrl()
    {
        do {
            $hash = Str::random(6);
        } while (Url::where('short_url', $hash)->exists());

        return $hash;
    }
}