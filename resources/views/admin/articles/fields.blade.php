<!-- Name Field -->
<div class="form-group col-sm-12 mt-5">
    {!! Form::hidden('author_name', 'admin' , ['class' => 'form-control form-control-lg form-control-solid']) !!}
</div>

<!-- Title Field -->
<div class="form-group col-sm-12 mt-5">
    {!! Form::label('title', 'عنوان المقال :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
    {!! Form::text('title', null, ['class' => 'form-control form-control-lg form-control-solid']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 mt-5">
    {!! Form::label('description', 'الوصف :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control ckeditor']) !!}
</div>


<!-- ID Photo Field -->
<div class="form-group col-sm-12 mt-5">
    {!! Form::label('images[]', 'الصور المراد إرفاقها :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
    {!! Form::file('images[]', array_merge(['multiple' => true], ['class' => 'form-control form-control-lg form-control-solid'])) !!}
    <small>المقاس المرغوب للصور 1200x675px</small>
</div>

@isset($article->articles_images)
    
<div class="form-group col-sm-12 mt-5">
{!! Form::label('imgs', 'صور المقال :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
</div>
@foreach ( $article->articles_images as $img )
<div class="col-sm-{{count($article->articles_images)}}">
    <img src="{{ asset('uploads/' . $img->image ) }}" width="100%" height="auto" alt="announcement" class="my-5" />
</div>
@endforeach
@endisset

<!-- Submit Field -->
<div class="form-group col-sm-12 mt-5">
    {!! Form::submit('حفظ', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">إلغاء</a>
</div>
