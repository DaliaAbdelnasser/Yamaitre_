<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;
use App\Models\ArticlesImage;
use Illuminate\Support\Facades\Validator;
use File;
use Laracasts\Flash\Flash;
use Carbon\Carbon;
use App\Mail\NotifyMail;
use Illuminate\Support\Facades\Mail;

class ArticleController extends Controller
{


    public function index()
    {
        $query = Article::query()->with('users.userable');

        if (request()->filled('search')) {
            $query
            ->where('title', 'LIKE', '%' . request('search') . '%');
        } 


        $articles = $query->orderBy('created_at', 'DESC')->paginate(10);
        // dd($articles[0]->users->first()->userable->profile_image);
        return view('admin.articles.index', compact('articles'));
    }

    //
    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {

        $input = $request->validate([
            // 'title'        => 'required|max:20|min:5',
            // 'description'  => 'required|max:500|min:5', 
            'images'     => 'required'
        ]);

        $images = $request->file('images');
        $article = Article::create($request->all());
        if($images){
            foreach ($images as $image) {
                $article_image = ArticlesImage::create([
                    'article_id' => $article->id,
                ]);
                $article_image->update(['image' => $article_image->setFileAttribute($image)]);
            }
            $article->image_feature = $article->setFileAttribute($images[0]);
        }
       
        $article->author_name = 'يامتر';
        $article->status = true;
        $article->created_at = Carbon::now('Africa/Cairo');
        $article->save();

        Flash::success('تم حفظ المقال بنجاح');

        return redirect()->route('admin.articles.index');
    }

    public function show($id)
    {
        $article = Article::with('users')->find($id);
        $articleImages = ArticlesImage::where('article_id',$article->id)->get();
        return view('admin.articles.show', compact('article', 'articleImages'));
    }


    public function edit($id)
    {
        $article = Article::with('articles_images')->find($id);
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
    $validateArticle = Validator::make(
        $request->all(),
        [
            // 'title'        => 'required|max:20|min:5',
            // 'description'  => 'required|max:500|min:5',
        ]);

        $article = Article::with('articles_images')->find($id); 
        $images = $request->file('images');
        $article->update($request->all());
        $article_image = ArticlesImage::where('article_id', $article->id)->get();
        if($images != null){
            foreach ($images as $index => $image) {
                $article_image[$index]->update(['image' => $article_image[$index]->setFileAttribute($image)]);
            }
            $article->update(['image_feature' => $article->setFileAttribute($images[0])]);
        }
        $article->author_name = 'admin';
        $article->updated_at = Carbon::now('Africa/Cairo');

        Flash::success('تم تعديل المقال بنجاح');

        return redirect()->route('admin.articles.index');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        //delete article image
        if ($article->image_feature) {
            $oldPath = public_path('uploads') . $article->image_feature;
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }
        }
        $articleImages = ArticlesImage::where('article_id', $article->id)->get();
        foreach ($articleImages  as $image)
        {
            $image->delete();
        }

        $article->delete();
        
        return redirect()->route('admin.articles.index');
    }

    public function activate($id)
    {
        $article = Article::with('users')->find($id);


        if (empty($article)) {
            Flash::error('المقال غير موجود');

            return redirect(route('admin.articles.index'));
        }

        if ($article->status == true) {
            Flash::error('تم تفعيل المقال من قبل');

            return redirect(route('admin.articles.index'));
        }

        $article->status = true;
        $article->save();
        

        // Mail::to($article->users[0]->email)->send(new NotifyMail($article->users[0], 'emails.requestSomething', 'Article Activation', 'قد تم نشر مقالك بنجاح'));
        // $msg = "قام المحامي ". $article->users[0]->first_name ." بنشر مقالة جديدة.";
        // app('App\Http\Controllers\NotificationController')->sendNotificationToTopic('تم نشر مقالة جديدة', $msg, 'articles'); 
        Flash::success('تم تفعيل المقال بنجاح');

        return redirect()->route('admin.articles.index');

    }
}
