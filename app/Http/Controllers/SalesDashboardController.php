<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Testimonial;

class SalesDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->role !== 'sales') {
                abort(403, 'Akses ditolak. Hanya untuk sales.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $user = Auth::user();

        // Get basic stats for dashboard
        $stats = [
            'total_testimonials' => Testimonial::where('user_id', $user->id)->count(),
        ];

        // Get recent testimonials
        $recentTestimonials = Testimonial::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return view('sales.dashboard', compact('user', 'stats', 'recentTestimonials'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('sales.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:500',
            'instagram' => 'nullable|url',
            'facebook' => 'nullable|url',
            'referral_code' => 'nullable|string|max:50|unique:users,referral_code,' . Auth::id(),
        ]);

        Auth::user()->update($request->only([
            'email', 'phone', 'whatsapp', 'bio', 'instagram', 'facebook', 'referral_code'
        ]));

        return redirect()->route('sales.dashboard')->with('success', 'Profil berhasil diperbarui!');
    }

    public function testimonials()
    {
        $testimonials = Testimonial::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('sales.testimonials', compact('testimonials'));
    }

    public function storeTestimonial(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'video_url' => 'nullable|url',
            'video_file' => 'nullable|file|mimes:mp4,webm,ogg|max:51200',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $data = [
            'customer_name' => $request->customer_name,
            'title' => $request->title,
            'content' => $request->content,
            'video_url' => $request->video_url,
            'rating' => $request->rating,
            'user_id' => Auth::id(),
            'author' => Auth::user()->name,
        ];
        if ($request->hasFile('video_file')) {
            $data['video_file'] = $request->file('video_file')->store('testimonials/videos', 'public');
        }
        Testimonial::create($data);
        return redirect()->route('sales.testimonials')->with('success', 'Testimoni berhasil dikirim!');
    }
}

