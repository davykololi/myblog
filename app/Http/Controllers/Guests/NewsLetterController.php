<?php

namespace App\Http\Controllers\Guests;

use Artisan;
use Newsletter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsLetterController extends Controller
{
    //
    public function store(Request $request)
    {
    	if(!Newsletter::isSubscribed($request->email)){
    		Newsletter::subscribePending($request->email);

            $this->clear();

    		return redirect()->back()->withSuccess('Thanks For Subscribing');
    	}
        $this->clear();

    	return redirect()->back()->withError('Sorry! You have already subscribed');
    }

    public function clear()
    {
        $clear = Artisan::call('cache:clear');

        return $clear;
    }
}
