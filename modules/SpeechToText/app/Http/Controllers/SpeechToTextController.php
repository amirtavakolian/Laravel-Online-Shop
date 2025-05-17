<?php

namespace Modules\SpeechToText\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ApiResponse\ApiResponseFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Modules\SpeechToText\app\Http\Resources\SpeechToTextResource;
use Modules\SpeechToText\app\Http\Resources\SpeechToTextResultResource;

class SpeechToTextController extends Controller
{
    private string $token = '';
    private string $url = '';

    public function __construct()
    {
        $this->token = env('REV_AI_TOKEN');
        $this->url = 'https://api.rev.ai/speechtotext/v1/jobs/';
    }

    public function submitAudio(Request $request)
    {
        //todo: move it to queue
        $response = Http::withToken($this->token)
            ->attach(
                'media',
                fopen($request->file('mp3'), 'r'),
                basename($request->file('mp3'))
            )
            ->post($this->url);

        return ApiResponseFacade::setData(new SpeechToTextResource($response->json()))->build()->response();
    }

    public function checkAudioStatus(string $id)
    {
        $response = Http::withToken($this->token)->get($this->url . $id);

        return ApiResponseFacade::setData(new SpeechToTextResource($response->json()))->build()->response();
    }

    public function retrieveTranscript(string $id)
    {
        $response = Http::withToken($this->token)->get($this->url . $id . '/transcript');

        $sentence = collect($response->json()['monologues'][0]['elements'])
            ->pluck('value')
            ->filter(function ($value) {
                return !preg_match('/[<>,. ]/', $value);
            });

        return ApiResponseFacade::setData($sentence)->build()->response();
    }

}
