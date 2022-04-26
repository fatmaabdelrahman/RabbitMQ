<?php

namespace App\Http\Controllers;

use App\Jobs\testJob;
use App\Models\User;
use Illuminate\Http\Request;

class TestRabbitController extends Controller
{
    public function index(){

        $users=User::all();
        print_r($users->toJson());
        testJob::dispatch($users->toArray());
    }
}
