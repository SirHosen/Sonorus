<?php
// app/Http/Controllers/Admin/ComposerController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Composer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ComposerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function index()
    {
        $composers = Composer::orderBy('id')->paginate(10);
        return view('admin.composers.index', compact('composers'));
    }

    public function create()
    {
        return view('admin.composers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'biography' => 'nullable|string',
            'birth_year' => 'nullable|integer|min:1000|max:' . (date('Y') + 1),
            'death_year' => 'nullable|integer|min:1000|max:' . (date('Y') + 1),
            'country' => 'nullable|string|max:100',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('photo');

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('composers', 'public');
            $data['photo'] = $photoPath;
        }

        Composer::create($data);

        return redirect()->route('admin.composers.index')
            ->with('success', 'Composer created successfully!');
    }

    public function show(Composer $composer)
    {
        return view('admin.composers.show', compact('composer'));
    }

    public function edit(Composer $composer)
    {
        return view('admin.composers.edit', compact('composer'));
    }

    public function update(Request $request, Composer $composer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'biography' => 'nullable|string',
            'birth_year' => 'nullable|string|max:10',
            'death_year' => 'nullable|string|max:10',
            'country' => 'nullable|string|max:100',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $data = $request->except('photo');

            if ($request->hasFile('photo')) {
                // Delete old photo if exists
                if ($composer->photo) {
                    try {
                        Storage::disk('public')->delete($composer->photo);
                    } catch (\Exception $e) {
                        Log::warning('Failed to delete old composer photo: ' . $e->getMessage());
                    }
                }
                
                $photoPath = $request->file('photo')->store('composers', 'public');
                $data['photo'] = $photoPath;
            }

            $composer->update($data);

            return redirect()->route('admin.composers.index')
                ->with('success', 'Composer updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error updating composer: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update composer. Please try again.');
        }
    }

    public function destroy(Composer $composer)
    {
        try {
            // Delete photo if exists
            if ($composer->photo) {
                try {
                    Storage::disk('public')->delete($composer->photo);
                } catch (\Exception $e) {
                    Log::warning('Failed to delete composer photo: ' . $e->getMessage());
                }
            }
            
            $composer->delete();

            return redirect()->route('admin.composers.index')
                ->with('success', 'Composer deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error deleting composer: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Failed to delete composer. Please try again.');
        }
    }
}
