<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Info;
use Laracasts\Flash\Flash;
use Response;

class SettingsController extends Controller
{
    /**
     * Display a listing of the Info.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Info $info */
        $query = Info::query();
    
        $infos = $query->orderBy('created_at', 'DESC')->get();
        
        return view('admin.settings.edit', compact('infos'));
    }

    /**
     * Show the form for creating a new Info.
     *
     * @return Response
     */
    
    public function create()
    {
        //
    }

    /**
     * Store a newly created Info in storage.
     *
     * @param CreateAdminRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified Info.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
       //
    }

    /**
     * Show the form for editing the specified Info.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit()
    {
        /** @var Info $info */

        $query = Info::query();
    
        $infos = $query->orderBy('created_at', 'DESC')->get();
        
        return view('admin.settings.edit', compact('infos'));
    }

    /**
     * Update the specified Info in storage.
     *
     * @param int $id
     * @param UpdateInfoRequest $request
     *
     * @return Response
     */

    public function updateInfo(Request $request){

        // dd($request);
        $messages = $this->getMessages();

        $input = $request->validate([
            'location'     => 'url',
            'phone'      =>   'string|regex:/(01)[0-9]{9}/',
            'email'     => 'email',
            'facebook'     => 'url',
            'youtube'     => 'url',
            'linkedin'     => 'url',
            'instagram'     => 'url',
            'cash_in'     => 'numeric',
            'refund'     => 'numeric',
            'tax_cost'     => 'numeric',
            'consultation_cost'     => 'numeric',
        ], $messages);

        $infos = Info::all();

        foreach($infos as $key => $value){

            $info = Info::find($value->id);
            $name = $info->info_name;
            $info->info_value = $request->$name;
            $info->save();

            // dd($name);
        }
       

        Flash::success('تم تحديث الاعدادات بنجاح');

        return redirect()->back();
    }

    public function update(Request $request)
    {
        /** @var Info $info */
        $info = Info::all();

        if (empty($info)) {
            Flash::error('المسؤول غير موجود');

            return redirect(route('admin.settings.edit'));
        }

        $info->fill($request->all());
        $info->save();

        Flash::success('تم تحديث المسؤول بنجاح');

        return redirect(route('admin.settings.edit'));
    }

    /**
     * Remove the specified Info from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
       //
    }

    public function getMessages()
    {
        return $messages = [
            'location.url'      => "من فضلك أدخل الرابط على صورته الصحيحة",
            'phone.digits'        => "رقم الهاتف ناقصا",
            'phone.regex'        => "رقم الهاتف ليس على صورته الصحيحة، أعد المحاولة",
            'email.email'       => "من فضلك أدخل البريد الإلكتروني على صورته الصحيحة ",   
            'facebook.url'       => "من فضلك أدخل الرابط على صورته الصحيحة",     
            'youtube.url'       => "من فضلك أدخل الرابط على صورته الصحيحة",     
            'linkedin.url'       => "من فضلك أدخل الرابط على صورته الصحيحة",     
            'instagram.url'       => "من فضلك أدخل الرابط على صورته الصحيحة",     
            'instagram.url'       => "من فضلك أدخل الرابط على صورته الصحيحة",     
            'cash_in.numeric'    => 'من فضلك أدخل قيمة عددية',
            'refund.numeric'    => 'من فضلك أدخل قيمة عددية',
            'tax_cost.numeric'    => 'من فضلك أدخل قيمة عددية',
            'consultation_cost.numeric'    => 'من فضلك أدخل قيمة عددية',
         

        ];
    }

}
