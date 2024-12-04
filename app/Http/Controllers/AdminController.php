<?php
    
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $recentUsers = User::latest()->take(5)->get();
        return view('admin.AdminDashboard', compact('totalUsers', 'recentUsers'));
    }

    public function users()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function createUser()
    {
        return view('admin.users.create');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'first_name' => ['nullable', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Password::defaults()],
            'role' => ['required', 'in:admin,user'],
            'program' => ['required', 'string', 'in:' . implode(',', array_keys(User::PROGRAMS))], // Add program validation
            'signature' => ['nullable', 'file', 'mimes:jpeg,png,jpg', 'max:2048']
        ]);

        $userData = [
            'username' => $request->username,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'program' => $request->program // Add program to user data
        ];

        if ($request->hasFile('signature')) {
            $path = $request->file('signature')->store('signatures', 'public');
            $userData['signature_path'] = $path;
        }

        $user = User::create($userData);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully');
    }

    public function editUser(User $user)
    {
        // Get paginated users for the index table
        $users = User::paginate(10);
        
        // Pass both users and the user to edit
        return view('admin.users.index', compact('users', 'user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role' => ['required', 'in:admin,user'],
            'program' => ['required', 'string', 'in:' . implode(',', array_keys(User::PROGRAMS))], // Add program validation
            'signature' => ['nullable', 'file', 'mimes:jpeg,png,jpg', 'max:2048']
        ]);

        $userData = [
            'username' => $request->username,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'role' => $request->role,
            'program' => $request->program // Add program to user data
        ];

    if ($request->filled('password')) {
        $request->validate([
            'password' => ['confirmed', Password::defaults()]
        ]);
        $userData['password'] = Hash::make($request->password);
    }

    if ($request->hasFile('signature')) {
        $path = $request->file('signature')->store('signatures', 'public');
        $userData['signature_path'] = $path;
    }

    $user->update($userData);

    return redirect()->route('admin.users.index')
        ->with('success', 'User updated successfully');
}

    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully');
    }

    public function ajaxUpdateUser(Request $request, User $user)
    {
        try {
            $request->validate([
                'username' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('users')->ignore($user->id)
                ],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique('users')->ignore($user->id)
                ],
                'role' => ['required', 'in:admin,user'],
                'program' => ['required', 'string', 'in:' . implode(',', array_keys(User::PROGRAMS))],
                'fullname' => ['sometimes', 'string', 'max:255'],
            ]);

            // Split fullname into components if provided
            if ($request->has('fullname')) {
                $nameParts = explode(' ', $request->fullname);
                $userData = [
                    'first_name' => $nameParts[0] ?? '',
                    'middle_name' => count($nameParts) > 2 ? $nameParts[1] : null,
                    'last_name' => count($nameParts) > 2 ? end($nameParts) : ($nameParts[1] ?? ''),
                ];
            }

            $userData = array_merge($userData ?? [], [
                'username' => $request->username,
                'email' => $request->email,
                'role' => $request->role,
                'program' => $request->program,
            ]);

            $user->update($userData);

            return response()->json([
                'success' => true,
                'message' => 'User updated successfully',
                'user' => $user->fresh()
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the user'
            ], 500);
        }
    }

    /**
     * Update the user route for form submission (existing method update)
     */
  

    /**
     * Delete the user and return JSON response
     */
    

}
