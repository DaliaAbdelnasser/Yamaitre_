<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Distress;
use App\Models\User;
use Laracasts\Flash\Flash;


class DistressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Distress::query()->with('users');

        if (request()->filled('search')) {
            $query->whereHas('users', function ($query) {
                $query->where('first_name', 'LIKE', '%' . request('search') . '%')
                ->orWhere('last_name', 'LIKE', '%' . request('search') . '%')
                ->orWhere('email', 'LIKE', '%' . request('search') . '%');
            })->get();
        } 

        $distresses = $query->orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.distresses.index', compact('distresses'));   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $distress = Distress::with('users')->find($id);
        return view('admin.distresses.show', compact('distress'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $distress = Distress::with('users')->find($id);
        // $user = User::where('id', $distress->users->first()->id)->first();
        // $user->distresses()->detach($distress->id);

        if (empty($distress)) {
            Flash::error('الاستغاثة غير موجودة');

            return redirect(route('admin.distresses.index'));
        }

        $distress->delete();

        Flash::success('تم حذف الاستغاثة بنجاح');
        
        return redirect()->route('admin.distresses.index');
    }
}
