<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::with("user")->orderBy("created_at", "desc")->paginate(10);
        return view("admin.testimonials.index", compact("testimonials"));
    }

    public function create()
    {
        $users = User::all(); // For assigning testimonials to users
        return view("admin.testimonials.create", compact("users"));
    }

    public function store(Request $request)
    {
        $request->validate([
            "customer_name" => "required|string|max:255",
            "title" => "required|string|max:255",
            "content" => "required|string",
            "video_url" => "nullable|url",
            "video_file" => "nullable|file|mimes:mp4,webm,ogg|max:51200", // max 50MB
            "rating" => "required|integer|min:1|max:5",
            "user_id" => "nullable|exists:users,id",
            "is_approved" => "boolean",
        ]);

        $data = $request->all();
        if ($request->hasFile('video_file')) {
            $data['video_file'] = $request->file('video_file')->store('testimonials/videos', 'public');
        }
        Testimonial::create($data);

        return redirect()->route("admin.testimonials.index")->with("success", "Testimoni berhasil ditambahkan!");
    }

    public function edit(Testimonial $testimonial)
    {
        $users = User::all();
        return view("admin.testimonials.edit", compact("testimonial", "users"));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            "customer_name" => "required|string|max:255",
            "title" => "required|string|max:255",
            "content" => "required|string",
            "video_url" => "nullable|url",
            "video_file" => "nullable|file|mimes:mp4,webm,ogg|max:51200",
            "rating" => "required|integer|min:1|max:5",
            "user_id" => "nullable|exists:users,id",
            "is_approved" => "boolean",
        ]);
        $data = $request->all();
        if ($request->hasFile('video_file')) {
            $data['video_file'] = $request->file('video_file')->store('testimonials/videos', 'public');
        }
        $testimonial->update($data);

        return redirect()->route("admin.testimonials.index")->with("success", "Testimoni berhasil diperbarui!");
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route("admin.testimonials.index")->with("success", "Testimoni berhasil dihapus!");
    }

    public function approve(Testimonial $testimonial)
    {
        $testimonial->update(["is_approved" => true]);
        return redirect()->route("admin.testimonials.index")->with("success", "Testimoni berhasil disetujui!");
    }
}


