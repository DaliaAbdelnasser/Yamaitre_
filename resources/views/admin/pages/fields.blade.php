
<!-- Title Field -->
<div class="form-group col-sm-12 mt-5">
    {!! Form::label('title', 'عنوان الصفحة :',   [ 'class' => 'form-label fs-6 fw-bolder text-dark ']) !!}
    {!! Form::text('title', null, ['class' => 'form-control form-control-lg form-control-solid']) !!}
</div>

@foreach($page->sections as $section)

<div class="form-group col-sm-12 mt-5">
    {{-- {!! Form::label('section_id', 'رقم القسم :',   [ 'class' => 'form-label fs-6 fw-bolder text-dark ']) !!} --}}
    {!! Form::hidden('section_id' .$section->id, $section->id, ['class' => 'form-control form-control-lg form-control-solid']) !!}
</div>

@isset($section->section_title)
    <div class="form-group col-sm-6 mt-5">
        {!! Form::label('section_title', 'العنوان الرئيسي للقسم :',   [ 'class' => 'form-label fs-6 fw-bolder text-dark ']) !!}
        {!! Form::text('section_title'.$section->id, $section->section_title, ['class' => 'form-control form-control-lg form-control-solid']) !!}
    </div>
@endisset

@isset($section->subtitle)
<div class="form-group col-sm-6 mt-5">
    {!! Form::label('subtitle', 'العنوان الفرعي :',   [ 'class' => 'form-label fs-6 fw-bolder text-dark ']) !!}
    {!! Form::text('subtitle' .$section->id, $section->subtitle, ['class' => 'form-control form-control-lg form-control-solid']) !!}
</div>
@endisset


@isset($section->description)
<div class="form-group col-sm-12 mt-5 mb-8">
    {!! Form::label('description', ' المحتوى:',   [ 'class' => 'form-label fs-6 fw-bolder text-dark ']) !!}
    {!! Form::textarea('description'.$section->id, $section->description , ['class' => 'form-control form-control-lg form-control-solid ckeditor']) !!}
</div>
@endisset


@if ($section->images != null)
@foreach ($section->images as $img)
<div class="form-group col-sm-8 mt-5 mb-4">
    {!! Form::label('img', 'صورة القسم :',  [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
    {!! Form::file('img', array_merge(['class' => 'form-control form-control-lg form-control-solid', 'accept' => ".png, .jpg, .jpeg"])) !!}
</div>
<div class="form-group col-sm-4 mt-2 mb-10">
        <img src="{{ asset('uploads/' .  $img->img) }}" width="100%">
</div>
@endforeach
@endif

@endforeach

@foreach($page->faqs as $faq)
    @if($faq)
    <div class="form-group col-sm-12 mt-5">
        {!! Form::label('question', 'السؤال :',   [ 'class' => 'form-label fs-6 fw-bolder text-dark ']) !!}
        {!! Form::text('question' . $faq->id, $faq->question, ['class' => 'form-control form-control-lg form-control-solid']) !!}
    </div>
    <!-- Section Field -->
    <div class="form-group col-sm-12 mt-5">
        {!! Form::label('answer', 'الإجابة :',   [ 'class' => 'form-label fs-6 fw-bolder text-dark ']) !!}
        {!! Form::textarea('answer' . $faq->id, "$faq->answer ", [
                        'class'      => 'form-control form-control-lg form-control-solid',
                        'rows'       => 4, 
                        'name'       => 'answer' . $faq->id,
                        'id'         => 'answer' . $faq->id,
                        'onkeypress' => "return nameFunction(event);"
                    ]) !!}
    </div>
    @endif
@endforeach


<div class="row mb-8">
    <div class="form-group col-sm-6 mt-5">
        {!! Form::label('meta_title', 'العنوان عبر محركات البحث :',   [ 'class' => 'form-label fs-6 fw-bolder text-dark ']) !!}
        {!! Form::text('meta_title', $page->meta_title , ['class' => 'form-control form-control-lg form-control-solid']) !!}
    </div>
    <div class="form-group col-sm-6 mt-5">
        {!! Form::label('meta_desc', 'الوصف عبر محركات البحث :',   [ 'class' => 'form-label fs-6 fw-bolder text-dark ']) !!}
        {!! Form::text('meta_desc', $page->meta_desc, ['class' => 'form-control form-control-lg form-control-solid']) !!}
    </div>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12 mt-5">
    {!! Form::submit('تحديث', ['class' => 'btn btn-primary']) !!}
</div>
