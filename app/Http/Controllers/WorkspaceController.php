<?php
// filepath: c:\laragon\www\notion_clone\app\Http\Controllers\WorkspaceController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workspace;

class WorkspaceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $workspace = Workspace::create([
            'name' => $request->name,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Workspace created successfully!');
    }
}