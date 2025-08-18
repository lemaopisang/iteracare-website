<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;

class HomeController extends Controller
{
    /**
     * Display the home page with recommendations and testimonials
     */
    public function index(Request $request)
    {
        // Get testimonials with video for landing page (limit to 4-5)
        $testimonials = Testimonial::whereNotNull('video_url')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('home', compact('testimonials'));
    }

    /**
     * Display the contact page
     */
    public function contact()
    {
        return view('contact');
    }

    /**
     * Handle contact form submission
     */
    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Here you would typically send an email or store the message
        // For now, we'll just redirect back with a success message

        return back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}
