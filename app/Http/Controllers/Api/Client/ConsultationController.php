<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Client;
use App\Models\Consultation;
use App\Models\Files;
use Carbon\Carbon;
use File;
use input;

class ConsultationController extends Controller
{

    public function store(Request $request)
    {

        $messages = $this->getMessages();

        //////////////////// Enum for each error /////////////////////////
        // title
        $titlevalid = Validator::make($request->all(), ['type' => 'required'], $messages);

        if ($titlevalid->fails()) {
            return response([
                'success' => false,
                'type' => 'noTitleAdded',
                'errors'=>$titlevalid->errors()->first(),
            ], 422);
        }

        // title length
        $titlelengthvalid = Validator::make($request->all(), ['type' => 'max:40'], $messages);

        if ($titlelengthvalid->fails()) {
            return response([
                'success' => false,
                'type' => 'exceededMaxTitleLength',
                'errors'=>$titlelengthvalid->errors()->first(),
            ], 422);
        }

        // title length
        $titlelengthminvalid = Validator::make($request->all(), ['type' => 'min:5'], $messages);

        if ($titlelengthminvalid->fails()) {
            return response([
                'success' => false,
                'type' => 'exceedeMinTitleLength',
                'errors'=>$titlelengthminvalid->errors()->first(),
            ], 422);
        }

        // description
        $descriptionvalid = Validator::make($request->all(), ['description' => 'required'], $messages);

        if ($descriptionvalid->fails()) {
            return response([
                'success' => false,
                'type' => 'noDescriptionAdded',
                'errors'=>$descriptionvalid->errors()->first(),
            ], 422);
        }

         // description
         $descriptionlenvalid = Validator::make($request->all(), ['description' => 'max:1500'], $messages);

         if ($descriptionlenvalid->fails()) {
             return response([
                'success' => false,
                'type' => 'exceededMaxDescriptionLength',
                'errors'=>$descriptionlenvalid->errors()->first(),
            ], 422);
         }

         // description length
        $deslengthminvalid = Validator::make($request->all(), ['description' => 'min:5'], $messages);

        if ($deslengthminvalid->fails()) {
            return response([
                'success' => false,
                'type' => 'exceedeMinDescriptionLength',
                'errors'=>$deslengthminvalid->errors()->first(),
            ], 422);
        }

         // image
         $imagevalid = Validator::make($request->all(), ['con_files' => 'required'], $messages);

         if ($imagevalid->fails()) {
             return response([
                'success' => false,
                'type' => 'noFilesAdded',
                'errors'=>$imagevalid->errors()->first(),
            ], 422);
         }


        //////////////////////////////////////////////////////////////////

        $user = auth()->user();
      
        if($user->userable_type == 'App\Models\Client')
        {
            $client = Client::where('id', $user->userable->id)->first();
            $confiles = $request->file('con_files');
            $consultation = Consultation::create($request->all());

            if($confiles != null){
                foreach ($confiles as $file) {
                    $consultation_files = Files::create([
                        'consultation_id' => $consultation->id,
                    ]);
                    $consultation_files->update(['file' => $consultation_files->setFileAttribute($file)]);
                }
                $consultation->created_at = Carbon::now('Africa/Cairo');
                $consultation->save();
                $client->consultations()->attach($consultation->id);  
            }

            $payment_data['name'] = $consultation->type;
            $payment_data['decription'] = $consultation->description;
            $payment_data['amount'] = $consultation->price;
            $payment_data['quantity'] = 1;

            return response()->json([
                'success'        => true,
                'message'        => __('messages.create_consultation'),
                'payment_data'   => $payment_data,
            ]); 
                
        }
       
        return response()->json([
            'success' => false,
            'type' =>  "maxUploadedNumber",
            'errors' => __('messages.articles_count'),
        ], 422);
           
    }

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

        $query = Consultation::query();

        if( request()->filled('offset') ){
            $query->offset( request('offset') );
        }

        $query->limit( request('limit') ?? 10 );

        $data['my consultations'] = $query->with('files')->orderBy('created_at', 'desc')->whereHas('clients', function ($query) use($user_id){
            $query->where('client_id', '=' , $user_id);
        })->get();

        return response()->json($data);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = auth()->user();
        $consult = $user->userable->consultations()->find($id);
        if($consult == null)
        {
            return response()->json([
                'success' => false,
                'type' => "noAccess",
                'errors' => 'ليست من إستشاراتك، أعد المحاولة'
            ], 403); 
        }

        return response()->json([
            'Consultation' => $consult
        ]);
    }

    protected function getMessages()
    {
        return $message = [
            'type.required'               => 'من فضلك أدخل عنوانا لإستشارتك',
            'files.required'  => 'برجاء إرفاق المستندات الخاصة بطلبك حتى يتمكن فريقنا من الرد على إستفسارك بصورة مهنية', 
            'description.required'        => 'من فضلك أضف وصفا لإستشارتك', 
            'files.mimes'         => 'الملف الذي أدخلته ليس ملفا صالحا',
        ];
    }
}
