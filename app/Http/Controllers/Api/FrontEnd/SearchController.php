<?php

namespace App\Http\Controllers\Api\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lawyer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    // get all lawyers
    public function lawyers_list()
    {
        $lawyers = User::with('userable')->where('userable_type', 'App\Models\Lawyer')->get();
        return response()->json([
            'data' => $lawyers,
        ]);
    }

    public function search_lawyer(Request $request) { 
        $user = auth()->user();

        $query = User::query()->where('userable_type', 'App\Models\Lawyer');

        if( request()->filled('rate') )
        {
            $query->with('userable')
            ->join('lawyers', 'users.id', '=', 'lawyers.id')
            ->select('users.*')
            ->orderBy('rate', request('rate'))
            ->get();
        }

        elseif( request()->filled('governorates')){
            $query->whereHas('userable', function ($query) {
                $query->where('governorates', request('governorates'));
            })->whereNotIn('id', [$user->id])->get();
        }

        if( request()->filled('offset') ){
            $query->offset( request('offset') );
        }

        $query->limit( request('limit') ?? 10 );

        $data['lawyers'] = $query->orderBy('created_at', 'desc')->with('userable')->get();
        return response()->json($data);
    }


}
