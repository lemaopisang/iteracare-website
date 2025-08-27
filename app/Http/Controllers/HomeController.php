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

    /**
     * Handle referral search submitted from the footer form.
     * If a matching active sales user is found, redirect to WhatsApp when available
     * or return back with the user's contact details in the session.
     */
    public function searchReferral(Request $request)
    {
        $request->validate([
            'referral_code' => 'required|string|max:255',
        ]);

        $search = trim($request->input('referral_code'));

        $user = \App\Models\User::where('role', 'sales')
            ->where('is_active', true)
            ->where(function ($q) use ($search) {
                $q->where('referral_code', $search)
                  ->orWhere('name', $search);
            })
            ->first();

        // If the client expects JSON (AJAX), return structured JSON instead of redirects
        if ($request->wantsJson()) {
            if ($user) {
                if (!empty($user->whatsapp)) {
                    $phone = preg_replace('/[^0-9]/', '', $user->whatsapp);
                    $waUrl = "https://wa.me/{$phone}";
                    return response()->json([
                        'found' => true,
                        'wa' => $waUrl,
                        'referral' => [
                            'name' => $user->name,
                            'phone' => $user->phone,
                            'email' => $user->email,
                        ],
                    ]);
                }

                return response()->json([
                    'found' => true,
                    'referral' => [
                        'name' => $user->name,
                        'phone' => $user->phone,
                        'email' => $user->email,
                    ],
                ]);
            }

            return response()->json(['found' => false, 'message' => 'Tidak ditemukan sales representative dengan nama atau kode referral tersebut'], 404);
        }

        if ($user) {
            // Prefer redirecting to WhatsApp if phone is available
            if (!empty($user->whatsapp)) {
                $phone = preg_replace('/[^0-9]/', '', $user->whatsapp);
                return redirect()->away("https://wa.me/{$phone}");
            }

            // Otherwise return back with the contact info so the UI can show it
            return back()->with('referral_result', [
                'name' => $user->name,
                'phone' => $user->phone,
                'email' => $user->email,
            ]);
        }

        return back()->with('error', 'Tidak ditemukan sales representative dengan nama atau kode referral tersebut');
    }
}
