<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Announcement;
use App\Models\Article;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\Info;
use App\Models\Consultation;
use App\Models\Distress;
use App\Models\Lawyer;
use App\Models\News;
use App\Models\Task;
use App\Models\Tax;
use App\Models\User;
use Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $site_data['tagline'] = Info::where('info_name', 'tag_line')->first()->info_value;
        $site_data['site_address'] = Info::where('info_name', 'address')->first()->info_value;
        $site_data['location'] = Info::where('info_name', 'location')->first()->info_value;
        $site_data['footer_description'] = Info::where('info_name', 'footer_description')->first()->info_value;
        $site_data['site_phone'] = Info::where('info_name', 'phone')->first()->info_value;
        $site_data['site_email'] = Info::where('info_name', 'email')->first()->info_value;
        $site_data['tax_cost'] = Info::where('info_name', 'tax_cost')->first()->info_value;
        $site_data['consultation_cost'] = Info::where('info_name', 'consultation_cost')->first()->info_value;
        $site_data['cash_out'] = Info::where('info_name', 'cash_out')->first()->info_value;
        $site_data['cash_in'] = Info::where('info_name', 'cash_in')->first()->info_value;
        $site_data['refund'] = Info::where('info_name', 'refund')->first()->info_value;
        $site_data['facebook'] = Info::where('info_name', 'facebook')->first()->info_value;
        $site_data['twitter'] = Info::where('info_name', 'twitter')->first()->info_value;
        $site_data['linkedin'] = Info::where('info_name', 'linkedin')->first()->info_value;
        $site_data['instagram'] = Info::where('info_name', 'instagram')->first()->info_value;
        $site_data['youtube'] = Info::where('info_name', 'youtube')->first()->info_value;

        $site_data['alladmins'] = Admin::all();
        $site_data['admin_short_list'] = Admin::take(10)->get();

        $site_data['alllawyers'] = User::where('userable_type', 'App\Models\Lawyer')->get();
        $site_data['activelawyers'] = Lawyer::where('status', '1')->get();

        $site_data['lawyers_short_list'] = User::orderBy('created_at', 'DESC')->where('userable_type', 'App\Models\Lawyer')
        ->whereHas('userable', function ($query) {
            // $query->where('status', '1');
        })
        ->take(10)->get();

        $site_data['allclients'] = User::where('userable_type', 'App\Models\Client')->get();
        $site_data['clients_short_list'] = User::where('userable_type', 'App\Models\Client')->take(10)->get();

        $site_data['alltasks'] = Task::all();
        $site_data['alltodotasks'] = Task::where('status', 'todo')->get();
        $site_data['tasks_short_list'] = Task::take(10)->get();

        $site_data['places'] = Announcement::places();
        $site_data['allannouncements'] = Announcement::where('status', 0)->get();
        $site_data['announ_short_list'] = Announcement::where('status', 0)->take(10)->get();


        $site_data['allarticles'] = Article::where('status', 0)->where('author_name', '!=', 'admin')->get();
        $site_data['activearticles'] = Article::where('status', 1)->get();
        $site_data['article_short_list'] = Article::orderBy('created_at', 'DESC')->where('status', 0)->where('author_name', '!=', 'admin')->take(10)->get();

        $site_data['allsos'] = Distress::all();
        $site_data['cons_short_list'] = Distress::orderBy('created_at', 'DESC')->take(10)->get();

        $site_data['allcons'] = Consultation::where('feedback', null)->get();
        $site_data['cons_short_list'] = Consultation::orderBy('created_at', 'DESC')->where('feedback', null)->take(10)->get();

        $site_data['alltax'] = Tax::where('feedback', null)->get();
        $site_data['tax_short_list'] = Tax::orderBy('created_at', 'DESC')->where('feedback', null)->take(10)->get();

        $site_data['govs'] = Lawyer::governorates();


        $site_data['allnews'] = News::all();
        $query = Announcement::query()->where('status' , 1);

        if(Request::is('/')){
            $site_data['banners'] = $query->where('place' , 'home')->orWhere('usertype' , 'all')->get();
            $site_data['lawyer_banners'] = $query->where('place' , 'home')->orWhere('usertype' , 'lawyer')->get();
            $site_data['client_banners'] = $query->where('place' , 'home')->orWhere('usertype' , 'client')->get();
        }
        else if(!Request::is('/')){
            $site_data['banners'] = $query->where('place' , 'pages')->orWhere('usertype' , 'all')->get();
            $site_data['lawyer_banners'] = $query->where('place' , 'pages')->orWhere('usertype' , 'lawyer')->get();
            $site_data['client_banners'] = $query->where('place' , 'pages')->orWhere('usertype' , 'client')->get();
        }
        else if(Request::is('/') || !Request::is('/')){
            $site_data['banners'] = $query->where('place' , 'all')->orWhere('usertype' , 'all')->get();
            $site_data['lawyer_banners'] = $query->where('place' , 'all')->orWhere('usertype' , 'lawyer')->get();
            $site_data['client_banners'] = $query->where('place' , 'all')->orWhere('usertype' , 'client')->get();
        }

        // dd($site_data);
        // dd($site_data['banners']);
        // elseif(Request::is('lawyers')){
        //     $site_data['banners'] = $query->where('place', 'lawyers')->get();
        // }
        // elseif(Request::is('articles')){
        //     $site_data['banners'] = $query->where('place', 'articles')->get();
        // }
        // elseif(Request::is('article/*')){
        //     $site_data['banners'] = $query->where('place', 'articles/')->get();
        // }
        // elseif(Request::is('distresses')){
        //     $site_data['banners'] = $query->where('place', 'distresses')->get();
        // }
        // elseif(Request::is('distress/*')){
        //     $site_data['banners'] = $query->where('place', 'distresses/')->get();
        // }
        // $site_data['task_banners'] = $query->where('place', 'tasks/')->get();
        // $site_data['sos_banners'] = $query->where('place', 'distresses/')->get();
        // $site_data['article_banners'] = $query->where('place', 'articles/')->get();

        $site_data['person'] = User::all();

        View::share($site_data);
    }
}
