<div class="form-group col-sm-12 mt-5">
    <h2>{{ $article->title }}</h2>
</div>

<div class="form-group col-sm-12 mt-5">
    {!! Form::label('description', ' الوصف :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
    <p>{!! $article->description !!}</p>
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

<div class="form-group col-sm-12 mt-5">
    <div class="col-6 border-right">
        {!! Form::label('author', ' الناشر :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
        <p>{{ $article->author_name }}</p>
    </div>
</div>


<div class="form-group col-sm-12 mt-5">
    <div class="col-6 border-right">
        {!! Form::label('author', ' تاريخ النشر :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
        <p>{{ $article->created_at }}</p>
    </div>
</div>







