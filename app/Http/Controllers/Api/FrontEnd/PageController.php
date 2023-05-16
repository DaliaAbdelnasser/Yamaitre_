<?php

namespace App\Http\Controllers\Api\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Section;
use App\Models\User;
use App\Models\Info;

class PageController extends Controller
{
    public function about_page()
    {
        // $page = Page::where('id', '2')->with('sections')->get();
        // $page = Section::all();
        $app_url = env('APP_URL');
        $page_slug = 'about-us';
        $page = $app_url.'/'.$page_slug;

        return response()->json([
            'data' => $page,
        ]);
    }

    public function terms_page()
    {
        // $page = Page::where('id', '3')->with('sections')->get();

        $app_url = env('APP_URL');
        $page_slug = 'terms';
        $page = $app_url.'/'.$page_slug;

        return response()->json([
            'data' => $page,
        ]);
    }

    public function privacy_page()
    {
        // $page = Page::where('id', '4')->with('sections')->get();

        $app_url = env('APP_URL');
        $page_slug = 'privacy-policy';
        $page = $app_url.'/'.$page_slug;

        return response()->json([
            'data' => $page,
        ]);
    }


    public function help_page()
    {
        $page = Page::where('id', '5')->with('faqs')->get();
        return response()->json([
            'data' => $page,
        ]);
    }

    public function agreement_page()
    {
        $data['page'] = Page::where('id', '6')->with('sections')->get();
        $data['costs'] = Info::where('info_name', 'tax_cost')->orWhere('info_name', 'consultation_cost')->get();
        $data['cost_fees'] = Info::where('info_name', 'cash_in')->first()->info_value . "%";
        $data['refund_fees'] = Info::where('info_name', 'refund')->first()->info_value . "%";
        $user = auth()->user();

        if($user->accept_terms == 2){
            return response()->json([
                'accept-terms' => true,
                'success' => true,
                'data' => $data,
            ]);
        }
        else{
            return response()->json([
                'accept-terms' => false,
                'success' => true,
                'data' => $data,
            ]);
        }
       
    }

    public function set_accept_terms(Request $request)
    {
        $user = auth()->user();
        // $client = Client::where('id', $user->userable->id)->first();

        if($request->accept_terms == 'yes' && $user->accept_terms == 1)
            {
                if($user->userable_type == 'App\Models\Lawyer')
                {
                    $message = 'لقد تمت الموافقة على شروط الخصوصية بنجاح يمكنك الان الذهاب لنشر مهمتك';
                }
                else
                {
                    $message = 'لقد تمت الموافقة على شروط الخصوصية بنجاح يمكنك الان الذهاب لإضافة بيانات المساعدة المطلوبة';
                }
                $user->accept_terms += 1;
                $user->save();
                return response()->json([
                    'success' => true,
                    'message' => $message,
                ]);
            }
        else if($user->accept_terms == 2)
        {
            return response()->json([
                'success' => false,
                'type'    => "alreadyAccepted",
                'message' => "لقد وافقت بالفعل",
            ]);
        }
        return response()->json([
            'success' => false,
            'type'    => "notAcceptedYet",
            'message' => "مازلت لم توافق على شروط الخصوصية بعد",
        ], 422);
    }


    public function contact_us()
    {
        // $data['title'] = 'تواصل معنا';
        // $data['subtitle'] = Page::where('id', 7)->with('sections')->first()->sections->first()->subtitle;
        // $data['description'] = Page::where('id', 7)->with('sections')->first()->sections->first()->description;
        // $data['address'] = Info::where('info_name', 'address')->first()->info_value;
        // $data['location'] = Info::where('info_name', 'location')->first()->info_value;
        // $data['phone'] = Info::where('info_name', 'phone')->first()->info_value;
        // $data['email'] = Info::where('info_name', 'email')->first()->info_value;

        $app_url = env('APP_URL');
        $page_slug = 'contact-us';
        $page = $app_url.'/'.$page_slug;

        return response()->json([
            'data' => $page,
        ]);
    }

}
