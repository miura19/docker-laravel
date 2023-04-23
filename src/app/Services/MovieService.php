<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Mail\MovieMail;
use Illuminate\Support\Facades\Mail;
use App\Repositories\MovieRepository;

class MovieService
{
    private $MovieRepository;

    public function __construct(MovieRepository $MovieRepository)
    {
        $this->MovieRepository = $MovieRepository;
    }

    public function storeMovie($movie_name,$cinema,$email,$comment,$datetime,$user_id,$token)
    {
        $this->MovieRepository->storeMovie($movie_name,$cinema,$email,$comment,$datetime,$user_id,$token);
    }

    public function getByToken($token,$date)
    {
        $data = $this->MovieRepository->getByToken($token,$date);
        return $data;
    }

    /**
     * @param string $token
     * @return int $result 1|0
     */
    public function deleteByToken($token)
    {
        $result = $this->MovieRepository->deleteByToken($token);
        return $result;
    }

    
}
