<?php

namespace App\Repositories;

use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\DB;

class MovieRepository
{
    /**
     * @param string $movie_name
     * @param string $cinema
     * @param string $email
     * @param string $comment
     * @param string $datetime
     * @param int $user_id
     * @param string $token
     * @return bool true|false
     */
    public function storeMovie(string $movie_name, string $cinema, string $email, string $comment, string $datetime, int $user_id, string $token)
    {
        try {
            $result = DB::table('movies')->insert(['movie_name' => $movie_name, 'user_id' => $user_id, 'cinema' => $cinema, 'email' => $email, 'comment' => $comment, 'token' => $token, 'created_at' => $datetime, 'updated_at' => $datetime]);
            return $result;
        } catch (QueryException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * トークンが発行されてから30分以内にアクセスされたらデータを返却する
     * @param string $token
     * @param string $date
     * @return object $result
     */
    public function getByToken($token,$date)
    {
        try {
            $result = DB::table('movies')
                ->where('token', '=', $token)
                ->where('created_at','>=',$date)
                ->first();
            return $result;
        } catch (QueryException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
