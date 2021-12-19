<?php 
namespace App\Interfaces\Front;
use App\Http\Requests\Front\BreederReviewRequest;

interface BreederReviewInterface 
{ 

    /*
    to create the Breeder_review 
    @method POST api/breeder_review/create
    */
    public function createBreederReview(BreederReviewRequest $request);
    public function getBreederCountByReviewRange();
}

