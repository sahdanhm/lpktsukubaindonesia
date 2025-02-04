<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $contacts = Contact::all()->sortByDesc('created_at')->sortByDesc('status');
        // incoming
        // $contacts = '';
        // if (request()->get('query')) {
        //     $query = request('query');
        //     $contacts = Contact::where('name', 'like', '%' . $query . '%')->get();
        // } else {
        //     $contacts = Contact::latest()->get();
        // }
        // untill this
        return view(
            'contact',
            [
                'contacts' => $contacts
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'phone_number' => 'required|min:12|numeric',
            'email' => 'required|email|unique:users',
            'message' => 'required'
        ]);
        Contact::create($validateData);




        //  return redirect('')->with('success','data success created');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id = null)
    {
        try {
            $id = Crypt::decryptString($id);
        } catch (\Exception $e) {
            return view('error', ['message' => 'Data not found']);
        }
        $this->update($id);
        $contacts = Contact::all()->sortByDesc('created_at')->sortByDesc('status');
        $contactById = Contact::find($id);

        $countUnread = Contact::where('status', 'unread')->count();
        session(['countUnread' => $countUnread]);

        return view('contact', ['contactById' => $contactById, 'contacts' => $contacts]);
    }


    /**
     * Display the searche resource.
     */
    public function search(Request $request)
    {
        $keyword = $request->search;
        $contacts = Contact::where('name', 'like', '%' . $keyword . '%')
            ->orWhere('phone_number', 'like', '%' . $keyword . '%')
            ->orWhere('email', 'like', '%' . $keyword . '%')
            ->orWhere('message', 'like', '%' . $keyword . '%')
            ->get();
        $contacts = $contacts->sortByDesc('created_at')->sortByDesc('status');
        return view('contact', ['contacts' => $contacts]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // return view();

    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        $table = Contact::find($id);
        $table->status = 'read';
        $table->update();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $id = Crypt::decryptString($id);
        $table = Contact::find($id);
        $table->delete();
        return redirect('inbox')->with('success', 'data success deleted');
    }
}
