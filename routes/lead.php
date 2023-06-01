<?php

use Illuminate\Support\Facades\Route;

Route::get("lead", 'Lead\GetLeadsController')->middleware("jwt.verify");
Route::get("lead/{leadId}", 'Lead\GetLeadByIdController');
