<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\ServicesWebsite;
use App\Models\Footer;
use App\Models\Gallery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function index()
    {
        // Fetch reviews with user information
        $reviews = Review::with('user')->get();

        $data = [
            'page_open' => 'review',
            'page_title' => 'review',
            'user' => Auth::user(),
            'reviews' => $reviews,
        ];

        return view('admin.review', $data);
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'comment' => 'required',
            // 'rating' => 'required|integer|min:1|max:5',
        ]);
    
        // Check if the user has already submitted a review
        $existingReview = Review::where('user_id', auth()->user()->id)->first();
    
        if ($existingReview) {
            // User has already submitted a review, you can choose to handle this as needed
            return redirect()->back()->with('error', 'You have already submitted a review.');
        }
    
        // Create a new review
        $review = new Review();
        $review->comment = $request->input('comment');
        // $review->rating = $request->input('rating');
        $review->user_id = auth()->user()->id;
        $review->save();
    
        // Redirect to the index route or another appropriate route
        return redirect()->route('admin.review')->with('success', 'Review submitted successfully!');
    }
    
    
    

public function update(Request $request, Review $review)
{
    $validatedData = $request->validate([
        'update_comment' => 'required|max:255',
    ]);

    $review->update([
        
        'comment' => $request->input('update_comment'), 
        // 'update_rating'=> $request->input('update_rating')
    ]);

    return redirect()->route('admin.review');
}
public function destroy(Review $review)
{
    // Ensure that the authenticated user owns the review before deleting
    if (auth()->user()->id === $review->user_id) {
        $review->delete();
        return redirect()->route('admin.review')->with('success', 'Review deleted successfully!');
    } else {
        return redirect()->route('admin.review')->with('error', 'You do not have permission to delete this review.');
    }
}
public function post_web()
    {
        $data['user'] = Auth::user();
        $footers = Footer::all();
        // Fetch reviews with user information
        $reviews = Review::with('user')->get();
        $services = ServicesWebsite::all();
        return view('user.home', ['user' => $data['user'], 'reviews' => $reviews, 'services'=>$services, 'footers' => $footers]);
    }
    public function post_services()
    {
        $data['user'] = Auth::user();
        $gallery = Gallery::all();
        $services = ServicesWebsite::all();
        $footers = Footer::all();
        return view('user.services', ['user' => $data['user'], 'services'=>$services, 'gallery'=>$gallery, 'footers'=>$footers]);
    }
    public function post_about()
    {
        $data['user'] = Auth::user();
        // $about = Footer::all();
        $footers = Footer::all();
        return view('user.about', ['user' => $data['user'], 'footers'=>$footers]);
    }
    public function post_contact()
    {
        $data['user'] = Auth::user();
        // $about = Footer::all();
        $footers = Footer::all();
        return view('user.contact', ['user' => $data['user'], 'footers'=>$footers]);
    }


    
}