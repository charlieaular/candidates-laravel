<?php

use Illuminate\Support\Facades\Route;

Route::get("lead", "Lead\GetLeadsController")->middleware("jwt.verify");
Route::get("lead/{leadId}", "Lead\GetLeadByIdController");
Route::post("lead", "Lead\CreateLeadController")->middleware("jwt.verify");
