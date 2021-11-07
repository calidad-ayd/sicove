<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\PruebaMail;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //  $this->middleware('auth');
    }

    public static function getImage($path)
    {
        if (!is_null($path) || strlen($path)>0) {
            $url = Storage::cloud()->temporaryUrl($path, \Carbon\Carbon::now()->addMinutes(20));
        } else {
            $url = $url = Storage::cloud()->temporaryUrl('pets/null.png', \Carbon\Carbon::now()->addMinutes(20));
        }
        
        return $url;
    }
}
