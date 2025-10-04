<?php

use App\Http\Controllers\EduzzWebhookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('webhook/eduzz', EduzzWebhookController::class);
