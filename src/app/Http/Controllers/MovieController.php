<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Mail\MovieMail;
use Illuminate\Support\Facades\Mail;

class MovieController extends Controller
{
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

        DB::table('movies')->insert(['movie_name' => $movie_name, 'user_id' => $user_id, 'cinema' => $cinema, 'email' => $email, 'comment' => $comment, 'token' => $token,'created_at' => $datetime, 'updated_at' => $datetime]);

        Mail::send(new MovieMail($email, $token));

        return view('movie.complete');
    }

    public function finish()
    {
        return view('movie.finish');
    }
}
