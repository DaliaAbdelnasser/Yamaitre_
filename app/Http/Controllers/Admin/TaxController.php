<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tax;
use App\Models\User;
use Laracasts\Flash\Flash;
use App\Mail\NotifyMail;
use Illuminate\Support\Facades\Mail;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $query = Tax::query()->with('lawyers');

        if (request()->filled('search')) {
            $query
            ->where('tax_name', 'LIKE', '%' . request('search') . '%');
        } 

        $taxes = $query->orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.taxes.index', compact('taxes'));   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tax = Tax::with('lawyers')->find($id);
        return view('admin.taxes.edit', compact('tax'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $tax = Tax::with('lawyers')->find($id);
    

        $input = $request->validate([
            'feedback'        => 'required',
        ]);
        
      
        $tax->setFeedbackFileAttribute($request->file('feedback'));
        $tax->status = 'completed';
        $tax->save();


        $msg = 'تم الإطلاع على إقراراك وسيتم التواصل معك في أقرب وقت';
        app('App\Http\Controllers\NotificationController')->sendNotification($tax->lawyers->first()->user->device_token,'الرد على الإقرار الضريبي', $msg, $tax->lawyers->first()->user->id, $tax->lawyers->first()->user->id, 'lawyer/taxes', 'tax', $tax->id);

        Mail::to($tax->lawyers->first()->user->email)->send(new NotifyMail($tax->lawyers->first()->user, 'emails.requestSomething', 'Tax Confirmation', 'تم الإطلاع على إقراراك وسيتم التواصل معك في أقرب وقت.'));


        Flash::success('تم ارسال الاقرار بنجاح');

        return redirect()->route('admin.taxes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tax = Tax::find($id);

        if (empty($tax)) {
            Flash::error('الاقرار غير موجود');

            return redirect(route('admin.taxes.index'));
        }

        $tax->delete();

        Flash::success('تم حذف الاقرار بنجاح');
        
        return redirect()->route('admin.taxes.index');
    }
}
