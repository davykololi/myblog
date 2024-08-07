<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    public function contacts()
    {
        $contacts = Contact::latest('id')->get();
        $title = "Information From Clients";
        return Inertia::render('Admin/Contacts/Contacts',compact('contacts','title'));
    }

    public function deleteContacts($id)
    {
        try{
            $contact = Contact::findOrFail($id);
            $contact->delete();
            return back()->with('message','The Contact deleted successfully');
        } catch(error){
            throw new Error('An error occured. Please try again', error);
        }
    }
}
