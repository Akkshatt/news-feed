<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NewsController extends Controller
{
    public function index()
    {
        $url = 'https://timesofindia.indiatimes.com/rssfeeds/-2128838597.cms?feedtype=json';
        $response = Http::get($url);
        $data = $response->json();
        $items = $data['channel']['item'] ?? [];

        return view('news.index', compact('items'));
    }
}
