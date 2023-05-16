<?php

namespace App\Http\Controllers\Web\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consultation;
use App\Models\Client;


class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $client = Client::where('id', $user->userable_id)->first();
        $user_id = $client->id;

        // $query = Consultation::query();

        // if( request()->filled('offset') ){
        //     $query->offset( request('offset') );
        // }

        // $query->limit( request('limit') ?? 10 );

        $data['consultations'] = Consultation::with('files')->where('feedback', null)->orderBy('created_at', 'desc')->whereHas('clients', function ($query) use($user_id){
            $query->where('client_id', '=' , $user_id);
        })->paginate(10);

        $data['consults_feedback'] = Consultation::with('files')->where('feedback','!=', null)->orderBy('created_at', 'desc')->whereHas('clients', function ($query) use($user_id){
            $query->where('client_id', '=' , $user_id);
        })->get();

        return view('client.consults.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('client.consultations.create');

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
        return view('client.consultations.show');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('client.consultations.edit');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
