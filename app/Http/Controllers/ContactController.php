<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $contact = Contact::with('User')->first();
        // dd($contact->toArray());
        // return view('contact.index',compact('contact'));

        // $user = User::with('Contact')->first();
        // dd($user->toArray());
        // return $user->Contact()->first();

        //  hasMany
        // $user = User::with('contact','posts')->find(1);
        // dd($user->toArray());
        // return $user->toArray();


        // $post = Post::all();
        // dd($post->toArray());
        // return view('contact.index',compact('post'));



       // Retrieve users with post counts
        $users = User::select('name')->withCount('posts as posts')->get();

        // Dump and die to inspect the retrieved users
        // dd($users);

        // Create a new collection with keys and values based on post counts
        $users = $users->mapWithKeys(function ($item, $key) {
            return [$item->name => $item->posts];
        });
        // dd($keyed);
        return view('contact.index', compact('users'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
