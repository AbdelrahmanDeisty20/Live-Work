<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Services\HomeService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $homeService;
    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }
    public function index()
    {
        return $this->homeService->index();
    }
}
