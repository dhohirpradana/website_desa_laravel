<?php

namespace App\Http\Controllers;

use App\Desa;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VideoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $desa = Desa::find(1);
        Video::truncate();
        $apiUrl = "https://www.googleapis.com/youtube/v3/search?";
        $part = "part=snippet";
        $channelId = "&channelId={$desa->channel_id}";
        $key = "&key={$desa->api_key}";
        $maxResults = "&maxResults=50";
        $nextPageToken = "&pageToken=";
        $reload = true;

        $youtube = Http::get("{$apiUrl}{$part}{$channelId}{$key}{$maxResults}{$nextPageToken}");
        $youtubeList = $youtube->json();

        if (array_key_exists('items',$youtubeList)) {
            if (array_key_exists('nextPageToken',$youtubeList)) {
                $nextPageToken = "&pageToken={$youtubeList['nextPageToken']}";
            } else {
                $reload = false;
            }

            for ($i=1; $i < count($youtubeList['items']) ; $i++) {
                Video::create([
                    'gambar'        => $youtubeList['items'][$i]['snippet']['thumbnails']['high']['url'],
                    'video_id'      => $youtubeList['items'][$i]['id']['videoId'],
                    'caption'       => $youtubeList['items'][$i]['snippet']['title'],
                    'published_at'  => date('Y-m-d H:i:s',strtotime($youtubeList['items'][$i]['snippet']['publishedAt'])),
                ]);
            }

            while ($reload) {
                $youtube = Http::get("{$apiUrl}{$part}{$channelId}{$key}{$maxResults}{$nextPageToken}");
                $youtubeList = $youtube->json();
                if (array_key_exists('nextPageToken',$youtubeList)) {
                    $nextPageToken = "&pageToken={$youtubeList['nextPageToken']}";
                } else {
                    $reload = false;
                }

                for ($i=0; $i < count($youtubeList['items']) ; $i++) {
                    Video::create([
                        'gambar'        => $youtubeList['items'][$i]['snippet']['thumbnails']['high']['url'],
                        'video_id'      => $youtubeList['items'][$i]['id']['videoId'],
                        'caption'       => $youtubeList['items'][$i]['snippet']['title'],
                        'published_at'  => date('Y-m-d H:i:s',strtotime($youtubeList['items'][$i]['snippet']['publishedAt'])),
                    ]);
                }
            }

            return back()->with('success', 'Video berhasil disinkronisasi');
        } else {
            return back()->with('api_error', $youtubeList['error']['message']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        $data = $request->validate([
            'channel_id'    => ['nullable', 'string' ,'max:64'],
            'api_key'       => ['nullable', 'string' ,'max:128']
        ]);
        $desa = Desa::find(1);

        $desa->update($data);

        return back()->with('success', 'Video berhasil diperbarui');
    }
}
