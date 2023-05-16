<?php

namespace App\Http\Controllers\Api\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function get_user_news()
    {
        $user = auth()->user();
        if($user->userable_type == 'App\Models\Lawyer'){
            $news = News::where('usertype', 'lawyer')->orWhere('usertype', 'all')->get();
        }
        elseif($user->userable_type == 'App\Models\Client'){
            $news = News::where('usertype', 'client')->orWhere('usertype', 'all')->get();
        }
        return response()->json([
            'user news' => $news
        ]);
    }
}
