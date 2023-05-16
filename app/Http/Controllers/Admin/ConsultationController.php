<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consultation;
use App\Models\User;
use Laracasts\Flash\Flash;
use App\Mail\NotifyMail;
use Illuminate\Support\Facades\Mail;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Consultation::query()->with('clients');

        if (request()->filled('search')) {
            $query
            ->where('type', 'LIKE', '%' . request('search') . '%')
            ->whereHas('clients.user', function ($query) {
                $query->where('first_name', 'LIKE', '%' . request('search') . '%')
                ->orWhere('last_name', 'LIKE', '%' . request('search') . '%')
                ->orWhere('email', 'LIKE', '%' . request('search') . '%');
            })->get();
        } 
        $consultations = $query->orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.consultations.index', compact('consultations'));   
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
        $cons = Consultation::with('clients')->find($id);
        return view('admin.consultations.edit', compact('cons'));
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

        $consultation = Consultation::find($id);

        $input = $request->validate([
            'feedback'        => 'required',
        ]);


        if($consultation->feedback == null)
        {
            $msg = 'تم الإطلاع على إستشارتك برجاء الاطلاع عليها في حسابك';
        }
        else
        {
            $msg = 'تم مراجعة الإستشارة وتعديلها برجاء الإطلاع عليها مرة أخرى';
        }

        $consultation->update([
            'feedback'  => $request->feedback,
        ]);

        app('App\Http\Controllers\NotificationController')->sendNotification($consultation->clients->first()->user->device_token,' الرد على طلب الإستشارة', $msg, $consultation->clients->first()->id, $consultation->clients->first()->id, 'client/consultations', 'consultation', $consultation->id);


        Mail::to($consultation->clients->first()->user->email)->send(new NotifyMail($consultation->clients->first()->user, 'emails.requestSomething', 'Consultation Confirmation', $msg));

        Flash::success('تم ارسال الاستشارة بنجاح');

        return redirect()->route('admin.consultations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $consultation = Consultation::find($id);
        // $user = User::where('id', $distress->users->first()->id)->first();
        // $user->distresses()->detach($distress->id);

        if (empty($consultation)) {
            Flash::error('الاستشارة غير موجودة');

            return redirect(route('admin.consultations.index'));
        }

        $consultation->delete();

        Flash::success('تم حذف الاستشارة بنجاح');
        
        return redirect()->route('admin.consultations.index');
    }
}
