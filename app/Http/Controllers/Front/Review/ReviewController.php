<?php

namespace App\Http\Controllers\Front\Review;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\Front\BreederReviewInterface;
use App\Http\Requests\Front\BreederReviewRequest;


class ReviewController extends Controller
{
    protected $breeder_reviewInterface;
    public function __construct(BreederReviewInterface $breeder_reviewInterface)
    {
        $this->breeder_reviewInterface = $breeder_reviewInterface;
    }

    public function create( BreederReviewRequest $request ){
        $data = $this->breeder_reviewInterface->createBreederReview( $request );
        return response()->json( $data );
    }
}
