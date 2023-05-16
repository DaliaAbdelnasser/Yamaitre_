<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Laracasts\Flash\Flash;
use Response;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the Admin.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Admin $admins */
        $query = Admin::query();

        if (request()->filled('search')) {
            $query
            ->where('name', 'LIKE', '%' . request('search') . '%')
            ->orWhere('email', 'LIKE', '%' . request('search') . '%');
        }
    
        $admins = $query->orderBy('created_at', 'DESC')->paginate(10);
        
        return view('admin.admins.index')
            ->with('admins', $admins);
    }

    /**
     * Show the form for creating a new Admin.
     *
     * @return Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id');

        return view('admin.admins.create', compact('roles'));
    }

    /**
     * Store a newly created Admin in storage.
     *
     * @param CreateAdminRequest $request
     *
     * @return Response
     */
    public function store(CreateAdminRequest $request)
    {
        $input = $request->all();

        /** @var Admin $admin */
        $admin = Admin::create($input);

        $admin->syncRoles(request('roles'));

        Flash::success('تم حفظ المسؤول بنجاح');

        return redirect(route('admin.admins.index'));
    }

    /**
     * Display the specified Admin.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Admin $admin */
        $admin = Admin::find($id);

        if (empty($admin)) {
            Flash::error('المسؤول غير موجود');

            return redirect(route('admin.admins.index'));
        }

        return view('admin.admins.show')->with('admin', $admin);
    }

    /**
     * Show the form for editing the specified Admin.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Admin $admin */
        $admin = Admin::with('roles')->find($id);

        if (empty($admin)) {
            Flash::error('المسؤول غير موجود');

            return redirect(route('admin.admins.index'));
        }

        $roles = Role::pluck('name', 'id');

        return view('admin.admins.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified Admin in storage.
     *
     * @param int $id
     * @param UpdateAdminRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAdminRequest $request)
    {
        /** @var Admin $admin */
        $admin = Admin::find($id);

        if (empty($admin)) {
            Flash::error('المسؤول غير موجود');

            return redirect(route('admin.admins.index'));
        }

        $admin->fill($request->all());
        $admin->save();

        $admin->syncRoles(request('roles'));

        Flash::success('تم تحديث المسؤول بنجاح');

        return redirect(route('admin.admins.index'));
    }

    /**
     * Remove the specified Admin from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Admin $admin */
        $admin = Admin::find($id);

        if (empty($admin)) {
            Flash::error('المسؤول غير موجود');

            return redirect(route('admin.admins.index'));
        }

        $admin->delete();

        Flash::success('تم حذف المسؤول بنجاح');

        return redirect(route('admin.admins.index'));
    }
}
