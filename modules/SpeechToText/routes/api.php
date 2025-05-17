<?php

use Illuminate\Support\Facades\Route;
use Modules\SpeechToText\app\Http\Controllers\SpeechToTextController;


Route::middleware(['auth:sanctum'])->prefix('v1/speechToText/')->group(function () {
    Route::post('file/submit', [SpeechToTextController::class, 'submitAudio']);
    Route::post('file/{id}/status', [SpeechToTextController::class, 'checkAudioStatus']);
    Route::post('file/{id}/retrieve', [SpeechToTextController::class, 'retrieveTranscript']);
});
