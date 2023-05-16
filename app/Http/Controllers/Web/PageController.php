<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Section;
use App\Models\Info;
use App\Models\User;
use App\Models\Lawyer;
use App\Models\Slider;
use App\Models\Article;
use App\Models\Contact;
use App\Models\Distress;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;

class PageController extends Controller
{

    public function home()
    {
        $data['page']  = Page::where('id', 1)->with('sections.images')->first();
        $data['infos'] = Info::all();
        $data['slider'] = Slider::first();
        $data['articles'] = Article::orderBy('created_at', 'desc')->where('status', '1')->get();
        $data['tasks'] = Task::with('user.userable')->where('status', 'todo')->get()->take(12);
        $data['governorates'] = Lawyer::groupBy('governorates')->pluck('governorates');
        return view('home', compact('data'));
    }

    public function about()
    {
        $data['page'] = Page::where('id', 2)->with('sections.images')->first();
        $data['slider'] = Slider::find(3);
        return view('frontend.pages.about',  compact('data'));
    }

    public function terms()
    {
        $data['page'] = Page::where('id', 3)->with('sections')->first();
        $data['slider'] = Slider::find(3);
        return view('frontend.pages.terms',  compact('data'));
    }

    public function policy()
    {
        $data['page'] = Page::where('id', 4)->with('sections.images')->first();
        $data['slider'] = Slider::find(2);
        return view('frontend.pages.privacy',  compact('data'));
    }

    public function contact()
    {
        $data['page'] = Page::where('id', 7)->with('sections')->first();
        $infos = Info::all();
        return view('frontend.pages.contact-us', compact('data', 'infos'));
    }

    public function store_contacts_data(Request $request)
    {
        $messages = $this->getMessages();

        $input = $request->validate([
            'name' => 'required',
            'email' => 'required|email|regex:/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}/',
            'phone' => 'required|regex:/[0-9][0-9]{9}/',
            'subject' => 'required',
            'message' => 'required',
        ], $messages);

        DB::beginTransaction();
        $contact = Contact::create($request->all());
        DB::commit();

        Flash::success('تم إرسال رسالتك بنجاح. سوف نعود اليك قريبا');
        return redirect()->back();
    }


    public function faq()
    {
        $data['page'] = Page::where('id', 5)->with('sections', 'faqs')->first();
        $data['slider'] = Slider::find(3);
        return view('frontend.pages.help',  compact('data'));
    }


    public function tasks()
    {
        $data['page'] = Page::where('id', 8)->with('faqs')->first();
        $data['slider'] = Slider::find(4);

        $query = Task::query();
        // By City
        if ( request()->filled('city') ) {
            $query->where('governorates', '=', request('city'));
        }

        // Order By
        if ( request()->filled('order_by') && request('order_by') == 'lowest price' ) {
            $query->orderBy('price', 'asc');
        }

        if ( request()->filled('order_by') && request('order_by') == 'highest price' ) {
            $query->orderBy('price', 'desc');
        }

        if ( request()->filled('order_by') && request('order_by') == 'newest' ) {
            $query->orderBy('created_at', 'desc');
        }

        if ( request()->filled('order_by') && request('order_by') == 'oldest' ) {
            $query->orderBy('created_at', 'asc');
        }

        $data['tasks'] = $query->orderBy('created_at', 'desc')->with('user.userable')->where('status', 'todo')->paginate(16);

        $data['governorates'] = Task::groupBy('governorates')->pluck('governorates');

        return view('frontend.tasks.index',  compact('data'));   
    }

    public function show_task($id)
    {
        $data['page'] = Page::where('id', 9)->first();
        $data['slider'] = Slider::find(5);
        $data['task'] = Task::with('user.userable')->find($id);
        $tasks = Task::where('court', $data['task']->court)->with('user.userable')->get();
        $data['related_tasks'] = $tasks->where('status', 'todo')->whereNotIn('id', $id)->take(2);

        if($data['task']->status != 'todo'){
            abort(404);
        }
    
        
        return view('frontend.tasks.single-task',  compact('data'));   
    }

    public function lawyers()
    {
        $data['page'] = Page::where('id', 10)->first();
        $data['slider'] = Slider::find(6);
        // $data['users'] = User::with('userable')->where('userable_type', 'App\Models\Lawyer')->get();
        

        $query = User::query()->where('userable_type', 'App\Models\Lawyer');
        
        

        if( request()->filled('rate') )
        {
            $query->with('userable')
            ->join('lawyers', 'users.id', '=', 'lawyers.id')
            ->select('users.*')
            ->where('status', '1')
            ->orderBy('rate', request('rate'))
            ->get();
        }

        elseif( request()->filled('governorates')){
            $query->whereHas('userable', function ($query) {
                $query->where('governorates', request('governorates'));
            })->get();
        }

        if( !request()->filled('rate') )
        {
            $query->with('userable')
                ->join('lawyers', 'users.id', '=', 'lawyers.id')
                ->where('status', '1')
                ->get();
        }
        
        $data['users'] = $query->latest('users.created_at')->paginate(16);

        // available tasks for recommendation
        if(auth()->user() != null)
        {
            $user_id = auth()->user()->id;
            $tasks = Task::where('status', 'todo')->with('user.userable')->withCount('applicantlawyers')->whereHas('user', function ($query) use($user_id){
                $query->where('user_id', '=' , $user_id);
            })->orderBy('created_at', 'desc')->get();
            $titles= [];
            foreach($tasks as $key => $task)
            {
                $titles[$task->id] = $task->title;
            }
            $data['titles'] = $titles;
        }
        $data['governorates'] = Lawyer::groupBy('governorates')->pluck('governorates');
        
        return view('frontend.lawyers.index',  compact('data'));   
    }

    public function articles()
    {
        $data['page'] = Page::where('id', 11)->first();
        $data['slider'] = Slider::find(7);
        $data['articles'] = Article::orderBy('created_at', 'desc')->with('users.userable')->where('status', '1')->paginate(16); 
        if(!count($data['articles'])){
            abort(404);   
        }
        return view('frontend.articles.index',  compact('data'));   
    }

    public function show_article($id)
    {
        $data['page'] = Page::where('id', 11)->with('sections')->first();
        $data['slider'] = Slider::find(7);
        $data['article'] = Article::with('users.userable')->find($id); 
        // get previous article
        $data['previous'] = Article::where('id', '<', $id)->orderBy('id','desc')->first();
        // get next article 
        $data['next'] = Article::where('id', '>', $id)->orderBy('id','asc')->first();

        $articles = Article::with('users.userable')->get();
        $data['few_articles'] = $articles->sortByDesc('created_at')->take(4);
        $data['recent_articles'] = $articles->whereNotIn('id', $id)->sortByDesc('created_at')->take(10);
        return view('frontend.articles.single-article',  compact('data'));   
    }
    
    public function distresses()
    {
        $data['page'] = Page::where('id', 12)->first();
        $data['slider'] = Slider::find(8);

        $data['distresses'] = Distress::with('users.userable')->orderBy('created_at','desc')->paginate(16); 

        if(auth()->user()->userable_type == 'App\Models\Client'){
            abort(404);
        }

        return view('frontend.sos.index',  compact('data'));   

    }

    public function show_distress($id)
    {
        $data['page'] = Page::where('id', 12)->first();
        $data['slider'] = Slider::find(9);

        $data['distress'] = Distress::with('users.userable')->find($id); 
        $data['distresses'] = Distress::with('users.userable')->where('id','!=', $id)->orderBy('created_at','desc')->get(); 
        if(auth()->user()->userable_type == 'App\Models\Client'){
            abort(404);
        }
        return view('frontend.sos.single-sos',  compact('data'));   
    }

    public function statement()
    {
        $data['page'] = Page::where('id', 6)->with('sections')->first();
        $data['slider'] = Slider::find(10);
        return view('frontend.pages.statement',  compact('data'));
    }

    protected function getRules()
    {
        return $rules = [
            'name'         => 'required|regex:/^(?![\s.]+$)[a-zA-Z\s.]*$/|max:100|min:2',
            'phone'        => 'required|max:11|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|unique:lawyers',
            'whatsapp'     => 'required|max:11|regex:/^([0-9\s\-\+\(\)]*)$/|min:8',
            'email'        => 'required|email|unique:users',
            'governorates' => 'required|max:100',
            'court_name'   => 'required|max:100',
            'password'     => 'required|confirmed', 
        ];
    }

    public function getMessages()
    {
        return $messages = [
            'phone.required'      => "من فضلك أدخل الهاتف",
            'phone.unique'        => "هذا الهاتف موجود مسبقًا",
            'phone.numeric'       => "الهاتف يجب أن يتكون من أرقام",
            'phone.digits'        => "رقم الهاتف ناقصا",
            'phone.regex'        => "رقم الهاتف ليس على صورته الصحيحة، أعد المحاولة",
            'email.required'      => "من فضلك أدخل البريد الالكتروني",
            'email.email'           => "الحساب الذي أدخلته ليس صالحا",
            'email.regex'           => ' البريد الالكتروني يجب أن يتكون من رموز معينة ويتضمن @ بين تلك الرموز',
            'phone.numeric'       => "الهاتف يجب أن يتكون من أرقام",
            'subject.required'       => " من فضلك أدخل عنوانا لرسالتك",
            'message.required'       => "من فضلك أدخل رسالتك",
            'name.required'       => "من فضلك أدخل إسمك",
        ];
    }


}
