<?php

namespace Bishopm\Lightworx\Http\Controllers;

use Bishopm\Lightworx\Models\Client;
use Bishopm\Lightworx\Models\Document;

class HomeController extends Controller
{

    public function home()
    {
        $data['clients']=Client::orderBy('client')->get();        
        return view('lightworx::web.home',$data);
    }
}
