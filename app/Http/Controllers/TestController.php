<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class TestController extends Controller
{
    public function index(){
        return Carbon::now()->addMinutes(30);
    }
}
