<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Mail\MovieMail;
use Illuminate\Support\Facades\Mail;
use App\Services\MovieService;

class MovieController extends Controller
{
    private $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function registration()
    {
        return view('movie.registration');
    }

    public function complete(Request $request)
    {
        $movie_name = $request->input('movie_name');
        $cinema = $request->input('cinema');
        $email = $request->input('email');
        $comment = $request->input('comment');
        $datetime = new Carbon();
        $user_id = Auth::id();
        $token = Str::random(15);
        $this->movieService->storeMovie($movie_name,$cinema,$email,$comment,$datetime,$user_id,$token);

        Mail::send(new MovieMail($email, $token));
        
        return view('movie.complete');
    }
    
    public function finish($token)
    {
        $date = new Carbon;
        $date = $date->subMinute(30);
        $kari_data = $this->movieService->getByToken($token,$date);
        if (is_null($kari_data)){
            $rerult = $this->movieService->deleteByToken($token);
            if ($rerult === 0){
                abort(500);
            }
            return view('movie.faild');
        } else {
            return view('movie.finish');
        }
    }
}
