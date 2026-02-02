<?php

namespace App\Http\Controllers;

// use App\Models\User;
use Illuminate\View\View;

class Dashboard extends Controller
{
    
    public function index(): View
    {
        $data = [
            'page' => [
                'title' => 'Dashboard'
            ],
        ];

        $data['content'] = view('dashboard/welcome', $data)->render();

        return view('frame/main', $data);
    }
}