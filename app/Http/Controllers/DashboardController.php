<?php

namespace App\Http\Controllers;

use App\Models\Workspace;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $workspaces = Workspace::with('pages') 
            ->where('id', auth()->id())
            ->get();
        dd($workspaces);

        return view('admin.dashboard', compact('workspaces'));
    }
}
