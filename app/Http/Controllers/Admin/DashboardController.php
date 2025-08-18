<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\ReferralCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'sales_users' => User::where('role', 'sales')->count(),
            'admin_users' => User::where('role', 'admin')->count(),
            'active_users' => User::where('is_active', true)->count(),
            'total_products' => Product::count(),
            'active_products' => Product::where('is_active', true)->count(),
            'featured_products' => Product::where('is_featured', true)->count(),
            'total_testimonials' => Testimonial::count(),
            'featured_testimonials' => Testimonial::where('is_featured', true)->count(),
            'total_referral_codes' => ReferralCode::count(),
            'active_referral_codes' => ReferralCode::where('is_active', true)->count(),
        ];

        $recent_users = User::where('role', '!=', 'admin')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        $recent_testimonials = Testimonial::orderBy('created_at', 'desc')->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_users', 'recent_testimonials'));
    }

    // User Management Methods
    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => ['required', 'string', Rule::in(['admin', 'sales', 'user'])],
            'is_active' => ['boolean'],
            'phone' => ['nullable', 'string', 'max:20'],
            'whatsapp' => ['nullable', 'string', 'max:20'],
            'bio' => ['nullable', 'string', 'max:500'],
            'instagram' => ['nullable', 'url'],
            'facebook' => ['nullable', 'url'],
            'referral_code' => ['nullable', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->update($request->all());

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil diperbarui!');
    }

    public function destroyUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus!');
    }

    // Testimonial Management Methods (already exists, ensuring direct access)
    public function testimonials()
    {
        $testimonials = Testimonial::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function approveTestimonial(Testimonial $testimonial)
    {
        $testimonial->is_approved = true;
        $testimonial->save();
        return back()->with('success', 'Testimoni berhasil disetujui!');
    }

    public function rejectTestimonial(Testimonial $testimonial)
    {
        $testimonial->is_approved = false;
        $testimonial->save();
        return back()->with('success', 'Testimoni berhasil ditolak!');
    }

    public function destroyTestimonial(Testimonial $testimonial)
    {
        $testimonial->delete();
        return back()->with('success', 'Testimoni berhasil dihapus!');
    }

    public function createTestimonial()
    {
        return view('admin.testimonials.create');
    }

    public function storeTestimonial(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'content' => 'required|string',
            'video_url' => 'nullable|url',
            'rating' => 'required|integer|min:1|max:5',
            'user_id' => 'nullable|exists:users,id',
        ]);

        Testimonial::create($request->all());

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil ditambahkan!');
    }

    public function editTestimonial(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function updateTestimonial(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'content' => 'required|string',
            'video_url' => 'nullable|url',
            'rating' => 'required|integer|min:1|max:5',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $testimonial->update($request->all());

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil diperbarui!');
    }
}

