<?php

namespace App\Http\Controllers;

use App\Models\Regulation;
use Illuminate\Http\Request;

class RegulationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regulations = Regulation::get();
        // return view('',compact('regulations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' =>'required|max:255',
            'icon' => 'required|mimetypes:text/plain,image/png,image/jpeg,image/svg',
            'email' => 'required|email|unique:users',
        
        ]);
        Regulation::create($validateData);

        Regulation::create($request->all());
        return redirect('')->with('success','data success created');
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
        // return view('');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $table = Regulation::find($id);
        $table->title = $request->title;
        $table->icon = $request->icon;
        $table->update();
        return redirect('')->with('success','data success updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $table = Regulation::find($id);
        $table->delete();
        return redirect()->back()->with('success','data success deleted');

     }
}
