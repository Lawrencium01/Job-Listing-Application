<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //show all listings
    public function index() {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    //show single listings
    public function show (Listing $listing) {
        //dd($listing->company);
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    //show create form
    public function create (){
        return view('listings.create');
    }

    //Store listings Data
    public function store(Request $request){
        $formFields = $request->validate([
            'title' => 'required',
            'tags' => 'required',
            'company' => ['required', Rule::unique('listings','company')],
            'location' => 'required',
            'email' => ['required', 'email'],
            'website' => 'required',
            'description' => 'required',
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created successfully!');
    }

    //Edit Listing Data
    public function edit (Listing $listing) {
        //dd($listing->title);
        return view('listings.edit', [
            'listing' => $listing
        ]);
    }

    //Update Listing Data
    public function update(Request $request, Listing $listing){

        if($listing->user_Id != auth()->id()){
            abort(403, 'Unauthorized Action'); 
        }

        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'tags' => 'required',
            'email' => ['required', 'email'],
            'description' => 'required',
            'location' => 'required',
            'website' => 'required'
        ]);

        
        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return back()->with('message', 'Listing Updated Successfully');
    }

    //Delete Listing Data
    public function delete(Listing $listing){

        if($listing->user_Id != auth()->id()){
            abort(403, 'Unauthorized Action'); 
        }

        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully');
    }

    //Manage Listings Data
    public function manage() {
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}


