<?php

    namespace App\Http\Controllers;

    use App\Models\User;
    use Illuminate\Http\Request;
    use Spatie\Permission\Models\Role;

    class UserController extends Controller
    {
        public function index()
        {
            $users = User::all();
            return view('users.index', compact('users'));
        }

        public function create()
        {
            return view('users.create');
        }

        public function store(Request $request)
        {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'role' => 'required|string|in:admin,teacher,student',
            ]);

            $user = User::create($validated);
            $role = Role::findByName($validated['role']);
            $user->assignRole($role);

            return redirect()->route('users.index');
        }

        public function show(User $user)
        {
            return view('users.show', compact('user'));
        }

        public function edit(User $user)
        {
            return view('users.edit', compact('user'));
        }

        public function update(Request $request, User $user)
        {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:8|confirmed'
            ]);

            if ($request->filled('password')) {
                $validated['password'] = bcrypt($request->password);
            } else {
                unset($validated['password']);
            }

            $user->update($validated);

            return redirect()->route('users.index');
        }

        public function destroy(User $user)
        {
            $user->delete();

            return redirect()->route('users.index');
        }
    }
