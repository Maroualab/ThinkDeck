<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'workspace_id' => 'required|exists:workspaces,id',
        ]);

        $page = Page::create([
            'title' => $request->title,
            'workspace_id' => $request->workspace_id,
            'id' => auth()->id(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Page created successfully!');
    }
}