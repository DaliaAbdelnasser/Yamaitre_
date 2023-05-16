<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Section;
use App\Models\ImageSection;
use App\Models\Faq;
use Laracasts\Flash\Flash;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::with('sections.images', 'faqs')->paginate(10);
        return view('admin.pages.index', compact('pages'));   
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
    public function store(Request $request, $id)
    {
        $page = Page::with('sections.images', 'faqs')->find($id);
        $section = Section::insert([
            'description' => $request->description,
            'page_id'     => $page->id,
        ]);

       

        return redirect()->route('admin.pages.index', compact('page'));

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
        $page = Page::with('sections.images', 'faqs')->find($id);
        // dd($page->sections[0]->description);
        return view('admin.pages.about', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::with('sections.images', 'faqs')->find($id);
        
        return view('admin.pages.edit', compact('page'));

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
        $page = Page::with('sections.images', 'faqs')->find($id); 
        $page->update([
            'title'         => $request['title'],
            'meta_title'    => $request['meta_title'],
            'meta_desc'     => $request['meta_desc'],
        ]);

        $sections = Section::where('page_id', $page->id)->get();

        foreach($sections as $section)
        {
            $section->update([
                'section_title' => $request["section_title".$section->id] ,
                'subtitle'      => $request["subtitle".$section->id],
                'description'   => $request["description".$section->id]
            ]);
            $image = ImageSection::where('section_id', $section->id)->first();
            
            $file = $request->file('img');

            // if ($file) {
            //     $originalName = $file->getClientOriginalName();
            //     $fileName = time() . '_' . $originalName;
            //     $file->move('uploads/', $fileName);
            //     $image->update([
            //         'img'   => $fileName,
            //     ]);
            // }
        }

        // dd($request);

        $faqs = Faq::where('page_id', $page->id)->get();
        foreach($faqs as $faq)
        {
            $faq->update([
                'question' => $request["question".$faq->id] ,
                'answer'      => $request["answer".$faq->id],
            ]);
        }

        Flash::success('تم تعديل الصفحة بنجاح');

        return redirect()->route('admin.pages.index');
        }


    // public function update_section(Request $request, $description)
    // {
    //     $section = Section::where('description', $description)->first(); 
    //     $section->update(['description' => $request->description]);
    //     $page = Page::with('sections', 'faqs')->where('id', $section->page_id)->first();
    //     return view('admin.pages.about', compact('page'));
    // }

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
