<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ReferralCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Exclude the main admin (yourself) and all admin users from the list
        $users = User::where('role', '!=', 'admin')
            ->with(['referralCode', 'roles'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,name',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:1000',
            'instagram' => 'nullable|string|max:100',
            'facebook' => 'nullable|string|max:100',
            'whatsapp' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        // Only allow admin role for the main admin email
        if ($request->role === 'admin' && $request->email !== 'prifeindonesia@gmail.com') {
            return redirect()->back()->withErrors(['role' => 'Only the main admin account can have the admin role.']);
        }

        // Generate unique referral code
        $referralCode = strtoupper(substr($request->name, 0, 6) . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT));
        while (User::where('referral_code', $referralCode)->exists()) {
            $referralCode = strtoupper(substr($request->name, 0, 6) . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT));
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'bio' => $request->bio,
            'instagram' => $request->instagram,
            'facebook' => $request->facebook,
            'whatsapp' => $request->whatsapp,
            'referral_code' => $referralCode,
            'is_active' => $request->has('is_active'),
        ]);

        // Assign role using Spatie
        $user->assignRole($request->role);

        // Create referral code entry for sales users
        if ($request->role === 'sales') {
            ReferralCode::create([
                'user_id' => $user->id,
                'code' => $referralCode,
                'name' => $user->name,
                'usage_count' => 0,
                'is_active' => true,
            ]);
        }

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->load(['referralCode', 'salesPage', 'roles', 'permissions']);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $user->load('roles');
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|exists:roles,name',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:1000',
            'instagram' => 'nullable|string|max:100',
            'facebook' => 'nullable|string|max:100',
            'whatsapp' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'referral_code' => 'nullable|string|max:255|unique:users,referral_code,' . $user->id,
        ]);

        // Prevent any user except the main admin from being assigned the admin role
        if ($request->role === 'admin' && $user->email !== 'prifeindonesia@gmail.com') {
            return redirect()->back()->withErrors(['role' => 'Only the main admin account can have the admin role.']);
        }

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'bio' => $request->bio,
            'instagram' => $request->instagram,
            'facebook' => $request->facebook,
            'whatsapp' => $request->whatsapp,
            'is_active' => $request->has('is_active'),
            'referral_code' => $request->referral_code,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $user->update($updateData);

        // Update role using Spatie
        $user->syncRoles([$request->role]);

        // Handle referral code for sales users
        if ($request->role === 'sales' && !$user->referralCode) {
            // Create referral code if user is now sales and doesn't have one
            ReferralCode::create([
                'user_id' => $user->id,
                'code' => $user->referral_code,
                'name' => $user->name,
                'usage_count' => 0,
                'is_active' => true,
            ]);
        } elseif ($request->role !== 'sales' && $user->referralCode) {
            // Remove referral code if user is no longer sales
            $user->referralCode->delete();
        } elseif ($user->referralCode && $user->name !== $request->name) {
            // Update referral code name if changed
            $user->referralCode->update(['name' => $request->name]);
        }

        // Update the referral code in the ReferralCode model if it exists
        if ($user->referralCode) {
            $user->referralCode->update(['code' => $request->referral_code]);
        }

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Delete associated referral code
        if ($user->referralCode) {
            $user->referralCode->delete();
        }

        // Delete associated sales page
        if ($user->salesPage) {
            $user->salesPage->delete();
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    /**
     * Duplicate a user (admin only)
     */
    public function duplicate(User $user)
    {
        // Prevent duplicating the main admin
        if ($user->email === 'prifeindonesia@gmail.com') {
            return redirect()->route('admin.users.index')->with('error', 'You cannot duplicate the main admin account.');
        }
        $newUser = $user->replicate(['password', 'remember_token', 'email', 'referral_code']);
        $newUser->email = $this->generateUniqueEmail($user->email);
        $newUser->referral_code = $this->generateUniqueReferralCode();
        $newUser->password = bcrypt('defaultpassword');
        $newUser->is_active = false;
        $newUser->save();
        return redirect()->route('admin.users.index')->with('success', 'User duplicated successfully.');
    }

    private function generateUniqueEmail($email)
    {
        // Generate a unique email by appending a timestamp
        return pathinfo($email, PATHINFO_FILENAME) . '+' . time() . '@' . pathinfo($email, PATHINFO_EXTENSION);
    }

    private function generateUniqueReferralCode()
    {
        // Generate a unique referral code
        return strtoupper(Str::random(6)) . '-' . rand(100, 999);
    }
}
