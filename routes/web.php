<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// Authenticated routes
// Remove normal dashboard for admin
Route::get('/dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes (removed Spatie permission middleware)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // User management routes
    Route::resource('users', AdminUserController::class);
    Route::get('users/{user}/duplicate', [AdminUserController::class, 'duplicate'])->name('users.duplicate');

    // Product management routes
    Route::get('/products', [AdminDashboardController::class, 'products'])->name('products.index');
    Route::get('/products/create', [AdminDashboardController::class, 'createProduct'])->name('products.create');
    Route::post('/products', [AdminDashboardController::class, 'storeProduct'])->name('products.store');
    Route::get('/products/{product}/edit', [AdminDashboardController::class, 'editProduct'])->name('products.edit');
    Route::patch('/products/{product}', [AdminDashboardController::class, 'updateProduct'])->name('products.update');
    Route::delete('/products/{product}', [AdminDashboardController::class, 'destroyProduct'])->name('products.destroy');

    // Testimonial management routes
    Route::resource("testimonials", \App\Http\Controllers\Admin\TestimonialController::class);
    Route::post("testimonials/{testimonial}/approve", [\App\Http\Controllers\Admin\TestimonialController::class, "approve"])->name("testimonials.approve");
});

// Publicly accessible Sales Area, filter inside
Route::get('/sales-area', function () {
    if (!Auth::check()) {
        // Show login form only
        return view('sales.guest');
    }
    // Show sales dashboard for any logged-in user
    return redirect()->route('sales.dashboard');
})->name('sales.area');

// Route to handle request to become a sales user (POST)
Route::post('/sales-area/request', function () {
    // Here you would handle the request, e.g., send notification to admin or update DB
    // For now, just show a success message
    return back()->with('status', 'Your request to become a sales user has been submitted!');
})->middleware('auth')->name('sales.area.request');

// Policy & Legal pages
Route::view('/privacy-policy', 'policy.privacy')->name('privacy.policy');
Route::view('/terms-of-service', 'policy.terms')->name('terms.service');
Route::view('/cookie-policy', 'policy.cookie')->name('cookie.policy');
Route::view('/penjelasan', 'penjelasan')->name('penjelasan');

require __DIR__.'/auth.php';


// Sales routes (publicly accessible after login)
Route::prefix("sales")->name("sales.")->group(function () {
    Route::get("/dashboard", [App\Http\Controllers\SalesDashboardController::class, "index"])->name("dashboard");
    Route::get("/profile", [App\Http\Controllers\SalesDashboardController::class, "profile"])->name("profile");
    Route::put("/profile", [App\Http\Controllers\SalesDashboardController::class, "updateProfile"])->name("profile.update");
    Route::get("/testimonials", [App\Http\Controllers\SalesDashboardController::class, "testimonials"])->name("testimonials");
    Route::post("/testimonials", [App\Http\Controllers\SalesDashboardController::class, "storeTestimonial"])->name("testimonials.store");
});

// Catch-all referral route (after all other routes)
Route::get('/{referral}', function ($referral) {
    // Prevent hijacking system routes
    $reserved = [
        'login','register','logout','profile','testimonials','products','contact','privacy-policy','terms-of-service','cookie-policy','sales-area','admin','dashboard'
    ];
    if (in_array(strtolower($referral), $reserved)) {
        abort(404);
    }
    session(['referral_name' => $referral]);
    return redirect('/');
})->where('referral', '^[a-zA-Z0-9-_]+$');


