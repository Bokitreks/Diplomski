<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Exception;
use Illuminate\Http\Request;


class ReviewController extends BaseController
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function writeReviewAction(Request $request)
    {
        $validatedData = $request->validate([
            'comment' => 'required|string',
            'stars' => 'required|integer|min:1|max:5',
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
        ]);

        try {
            Review::create([
                'user_id' => $validatedData['user_id'],
                'product_id' => $validatedData['product_id'],
                'review' => $validatedData['comment'],
                'stars' => $validatedData['stars']
            ]);
            return response()->json('Komentar postavljen', 201);
        } catch(Exception $e) {
            return response()->json($e, 400);
        }
    }

    public function deleteReviewAction(Request $request) {
        $reviewId = $request->input('reviewId');
        try {
            Review::destroy($reviewId);
            return response()->json('Komentar uspesno obrisan', 200);
        }
        catch(Exception $e) {
            return response()->json('Greska prilikom brisanja komentara', 500);
        }
    }
}
