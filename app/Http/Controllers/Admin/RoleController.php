<?php

namespace App\Http\Controllers\Admin;

use Flash;
use Response;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\Admin\CreateRoleRequest;
use App\Http\Requests\Admin\UpdateRoleRequest;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the Role.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Role $roles */
        $roles = Role::paginate(10);

        return view('admin.roles.index')
            ->with('roles', $roles);
    }

    /**
     * Show the form for creating a new Role.
     *
     * @return Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created Role in storage.
     *
     * @param CreateRoleRequest $request
     *
     * @return Response
     */
    public function store(CreateRoleRequest $request)
    {
        $input = $request->all();

        /** @var Role $role */
        $role = Role::create($input);

        $role->syncPermissions(request('permissions'));

        // Flash::success('Role saved successfully.');

        return redirect(route('admin.roles.index'));
    }

    /**
     * Display the specified Role.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Role $role */
        $role = Role::find($id);

        if (empty($role)) {
            // Flash::error('Role not found');

            return redirect(route('admin.roles.index'));
        }

        return view('admin.roles.show')->with('role', $role);
    }

    /**
     * Show the form for editing the specified Role.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Role $role */
        $role = Role::find($id);

        if (empty($role)) {
            // Flash::error('Role not found');

            return redirect(route('admin.roles.index'));
        }
        $permissions = Permission::all();

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified Role in storage.
     *
     * @param int $id
     * @param UpdateRoleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRoleRequest $request)
    {
        /** @var Role $role */
        $role = Role::find($id);

        if (empty($role)) {
            // Flash::error('Role not found');

            return redirect(route('admin.roles.index'));
        }

        $role->fill($request->all());
        $role->save();

        $role->syncPermissions(request('permissions'));

        // Flash::success('Role updated successfully.');

        return redirect(route('admin.roles.index'));
    }

    /**
     * Remove the specified Role from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Role $role */
        $role = Role::find($id);

        if (empty($role)) {
            // Flash::error('Role not found');

            return redirect(route('admin.roles.index'));
        }

        $role->delete();

        // Flash::success('Role deleted successfully.');

        return redirect(route('admin.roles.index'));
    }

    /**
     * Update permission.
     *
     * @param Request $request
     * @return void
     */
    public function updatePermissions(Request $request)
    {
        // clear permission cache
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        $collection = Route::getRoutes();

        $permissions = [];

        foreach ($collection as $route) {
            $routeName = $route->getName();
            $routePartials = explode('.', $routeName);
            if ($routeName && $routePartials[0] == 'admin' && !in_array($routeName, config('permission.excluded_routes'))) {
                $page = $routePartials[1];
                $action = $routePartials[2];

                switch (true) {
                    case in_array($action, ['index', 'show']):
                        $permissions[$page . '_view'] = $page . ' view';
                        break;

                    case in_array($action, ['create', 'store']):
                        $permissions[$page . '_create'] = $page . ' create';
                        break;

                    case in_array($action, ['edit', 'update']):
                        $permissions[$page . '_edit'] = $page . ' edit';
                        break;

                    case in_array($action, ['destroy']):
                        $permissions[$page . '_delete'] = $page . ' delete';
                        break;

                    default:
                        $permissions[$page . '_' . $action] = $page . ' ' . $action;
                        break;
                }
            }
        }
        // dd($permissions);

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission);
        }

        return back();
    }
}
