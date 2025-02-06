<?php

namespace App\Http\Controllers;

use App\Models\Benefit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class BenefitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $benefits = Benefit::latest()->get();
        return view('benefits.benefits', compact('benefits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('benefits.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'title' => 'required',
                'icon' => 'required'
            ]
        );

        Benefit::create(['title' => $validated['title'], 'icon' => $validated['icon']]);
        return redirect('/benefits')->with('success', 'Benefit created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id = Crypt::decryptString($id);
        $benefit = Benefit::find($id);
        return view('benefits.edit', compact('benefit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $id = Crypt::decryptString($id);
        $table = Benefit::find($id);
        $table->title = $request->title;
        $table->icon = $request->icon;
        $table->update();
        return redirect('/benefits')->with('success', 'Benefit updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $id = Crypt::decryptString($id);
        $table = Benefit::find($id);
        $table->delete();
        return redirect()->back()->with('success', 'Benefit deleted successfully!!');
    }
}
