<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use URL;
use Exception;


class DashboardController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $data = [];
        return view('admin.dashboard.index', $data);
    }
}
