<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Application;
use \Illuminate\Contracts\Foundation\Application as ContractsApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class HomeController extends Controller
{
    public function index(Request $request): ContractsApplication| Application| RedirectResponse| Redirector
    {
        return redirect(config('link.home_redirect'));
    }
}
