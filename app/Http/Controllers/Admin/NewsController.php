<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use Laracasts\Flash\Flash;


class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $query = News::query();

        if (request()->filled('search')) {
            $query
            ->where('news', 'LIKE', '%' . request('search') . '%');
        } 

        $newss = $query->orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.news.index', compact('newss'));   
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        if($request->usertype == 'lawyer')
        {
            $type = 'lawyer';
        }
        elseif($request->usertype == 'client')
        {
            $type = 'client';
        }
        else
        {
            $type = 'all';
        }
        $news = News::create($request->all());  
        $news->update(['usertype' => $type]); 

        Flash::success('تم اضافة الخبر بنجاح');

        return redirect()->route('admin.news.index');

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
        /** @var News $news */
        $news = News::find($id);

        if (empty($news)) {
            Flash::error('الخبر غير موجود');

            return redirect(route('admin.news.index'));
        }

        return view('admin.news.edit', compact('news'));
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
         /** @var News $news */
         $news = News::find($id);

         if (empty($news)) {
             Flash::error('الخبر غير موجود');
 
             return redirect(route('admin.news.index'));
         }
 
         $news->fill($request->all());
         $news->save();
 
 
         Flash::success('تم تحديث الخبر بنجاح');
 
         return redirect(route('admin.news.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          /** @var Admin $admin */
        $news = News::find($id);

        if (empty($news)) {
            Flash::error('الخبر غير موجود');

            return redirect(route('admin.news.index'));
        }

        $news->delete();

        Flash::success('تم حذف الخبر بنجاح');

        return redirect(route('admin.news.index'));
    }
}
