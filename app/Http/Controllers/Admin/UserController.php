<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Log an activity for the current user.
     */
    protected function logActivity($action, $model = null, $description = null)
    {
        $user = Auth::user();
        ActivityLog::create([
            'user_id' => $user ? $user->id : null,
            'action' => $action,
            'model_type' => $model ? get_class($model) : null,
            'model_id' => $model ? ($model->id ?? null) : null,
            'description' => $description,
            'ip_address' => request()->ip(),
        ]);
    }
    public function index()
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super') {
            abort(403, 'Unauthorized');
        }
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function create()
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super') {
            abort(403, 'Unauthorized');
        }
        return view('admin.user_create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super') {
            abort(403, 'Unauthorized');
        }
        $validated = $request->validate([
            'given_name' => 'required|string|max:255',
            'surname' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => ['required', Rule::in(['super','admin','staff'])],
            'password' => 'required|string|confirmed|min:6',
        ]);
        $validated['password'] = Hash::make($validated['password']);
    $newUser = User::create($validated);
    $this->logActivity('create', $newUser, 'Created user: ' . $newUser->email);
    return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $authUser = Auth::user();
        if (!$authUser || $authUser->role !== 'super') {
            abort(403, 'Unauthorized');
        }
        return view('admin.user_edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $authUser = Auth::user();
        if (!$authUser || $authUser->role !== 'super') {
            abort(403, 'Unauthorized');
        }
        $validated = $request->validate([
            'given_name' => 'required|string|max:255',
            'surname' => 'nullable|string|max:255',
            'email' => ['required','email',Rule::unique('users','email')->ignore($user->id)],
            'role' => ['required', Rule::in(['super','admin','staff'])],
            'password' => 'nullable|string|confirmed|min:6',
        ]);
        if ($validated['password']) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }
    $user->update($validated);
    $this->logActivity('update', $user, 'Updated user: ' . $user->email);
    return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $authUser = Auth::user();
        if (!$authUser || $authUser->role !== 'super') {
            abort(403, 'Unauthorized');
        }
    $this->logActivity('delete', $user, 'Deleted user: ' . $user->email);
    $user->delete();
    return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
