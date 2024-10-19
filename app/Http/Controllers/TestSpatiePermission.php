<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class TestSpatiePermission extends Controller
{
    // ## Basic Usage
    // #Create A permission
    public function create()
    {
        return view('spatie.permission.create');
    }
    private function validateRequest(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name'
        ]);
    }
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $this->validateRequest($request);

        // Attempt to create the permission
        try {
            Permission::create(['name' => $validatedData['name']]);
            return redirect()->route('spatie.permission.create')
                ->with('success', 'Permission created successfully.');
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Error creating permission: ' . $e->getMessage());

            return redirect()->route('spatie.permission.create')
                ->with('error', 'An error occurred while creating the permission. Please try again.');
        }
    }

    /**
     * Validate the request data.
     *
     * @param Request $request
     * @return array
     */
    public function assignForm()
    {
        $roles = Role::all();
        $permissions = Permission::all();

        // return view('spatie.permission.assign', compact('roles', 'permissions'));
        return view('spatie.permission.assign', compact('roles', 'permissions'));
    }
    public function assign(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'role_id' => 'required|exists:roles,id',
            'permission_id' => 'required|exists:permissions,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Find the role and permission
        $role = Role::find($request->role_id);
        $permission = Permission::find($request->permission_id);

        try {
            // Assign the permission to the role
            $role->givePermissionTo($permission);

            return redirect()->route('permissions.assign')->with('success', 'Permission assigned successfully!');
        } catch (\Exception $e) {
            // Handle any errors that occur during the assignment
            return redirect()->back()->withErrors(['error' => 'Failed to assign permission: ' . $e->getMessage()])->withInput();
        }
    }
    // #Sync Permissions To A Role
    public function syncForm()
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('spatie.permission.sync', compact('roles', 'permissions'));
    }
    public function sync(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'role_id' => 'required|exists:roles,id',
            'permissions' => 'required|array|min:1',
            'permissions.*' => 'exists:permissions,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Find the role
        $role = Role::find($request->role_id);

        try {
            // Sync the permissions to the role
            $role->syncPermissions($request->permissions);

            return redirect()->route('permissions.sync')->with('success', 'Permissions synced successfully!');
        } catch (\Exception $e) {
            // Handle any errors that occur during the syncing
            return redirect()->back()->withErrors(['error' => 'Failed to sync permissions: ' . $e->getMessage()])->withInput();
        }
    }

    // #Remove Permission From A Role
    public function removeForm()
    {
        // Retrieve all roles and permissions
        $roles = Role::all();
        $permissions = Permission::all();

        return view('spatie.permission.remove', compact('roles', 'permissions'));
    }

    public function remove(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'role_id' => 'required|exists:roles,id',
            'permission_id' => 'required|exists:permissions,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Find the role and permission
        $role = Role::find($request->role_id);
        $permission = Permission::find($request->permission_id);

        try {
            // Remove the permission from the role
            $role->revokePermissionTo($permission);

            return redirect()->route('permissions.remove')->with('success', 'Permission removed successfully!');
        } catch (\Exception $e) {
            // Handle any errors that occur during the removal
            return redirect()->back()->withErrors(['error' => 'Failed to remove permission: ' . $e->getMessage()])->withInput();
        }
    }

    // Guard Name
    public function show($id)
    {
        $user = User::findOrFail($id);

        // Get permissions directly assigned to the user
        $permissionNames = $user->getPermissionNames(); // Collection of permission names
        $permissions = $user->permissions; // Collection of permission objects

        // Get all permissions for the user, either directly or from roles
        $directPermissions = $user->getDirectPermissions(); // Permissions directly assigned
        $permissionsViaRoles = $user->getPermissionsViaRoles(); // Permissions from roles
        $allPermissions = $user->getAllPermissions(); // All permissions

        // Get the names of the user's roles
        $roles = $user->getRoleNames(); // Collection of role names

        return view('spatie.users.show', compact('user', 'permissionNames', 'permissions', 'directPermissions', 'permissionsViaRoles', 'allPermissions', 'roles'));
    }

    public function giveForm()
    {
        // Retrieve all users and permissions
        $users = User::all();
        $permissions = Permission::all();
        return view('spatie.permissions.give', compact('users', 'permissions'));
    }

    // Direct Permissions to Users
    // A permission can be given to any user:
    public function give(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'permissions' => 'required|array|min:1',
            'permissions.*' => 'exists:permissions,name',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Find the user
        $user = User::find($request->user_id);

        try {
            // Assign the permissions to the user
            $user->givePermissionTo($request->permissions);

            return redirect()->route('permissions.give')->with('success', 'Permissions assigned successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to assign permissions: ' . $e->getMessage()])->withInput();
        }
    }

    // Direct Permissions
    // Direct Permissions to Users
    public function directPermissionGiveForm()
    {
        // Retrieve all users and permissions
        $users = User::all();
        $permissions = Permission::all();
        return view('spatie.permissions.give', compact('users', 'permissions'));
    }

    public function directPermissionGive(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'permissions' => 'required|array|min:1',
            'permissions.*' => 'exists:permissions,name',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Find the user
        $user = User::find($request->user_id);

        try {
            // Assign the permissions to the user
            $user->givePermissionTo($request->permissions);

            return redirect()->route('permissions.give')->with('success', 'Permissions assigned successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to assign permissions: ' . $e->getMessage()])->withInput();
        }
    }
}
