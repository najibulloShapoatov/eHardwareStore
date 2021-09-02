<?php

namespace App\Http\Controllers\Site;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class ReviewController extends Controller
{
    public function addReview(Request $request)
    {
        if ($request->ajax())
        {
            $input = $request->all();

            $review = new Review();
            $data = $review->addReview($input);

            $html = View::make('site.catalog._reviews', compact('data'))->render();

            return response()->json(['html' => $html], 200);
        }
    }
}
