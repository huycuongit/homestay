<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;

 
class ContactController extends Controller
{
    /**
     * Create data for contacts
     *
     * @param  \App\Http\Requests\StoreContactRequest  $request
     * @return status
     */
    // public function store(Request $request)
    public function store(StoreContactRequest $request)
    {
        $data = $request->only([
            'full_name',
            'phone',
            'branch_id'
        ]);
        
        $row = Contact::create($data);
        return back()->with('success', 'Data saved successfully');
    }   
}