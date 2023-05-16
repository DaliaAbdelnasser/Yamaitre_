<!-- Name Field -->
<div class="form-group col-sm-12 mt-5">
    {!! Form::label('usertype',' المسموح له بالإطلاع :', ['class'  => 'form-label fs-6 fw-bolder text-dark']) !!}
    {!! Form::select('usertype', [ 'all' => 'اظهار للكل', 'lawyer' => 'اظهار للمحامين', 'client' => 'اظهار للموكلين' ], $news->usertype ?? '', ['class' => 'form-control form-control-lg form-control-solid', 'placeholder' => 'من فضلك اختر']) !!}

</div>


<!-- Description Field -->
<div class="form-group col-sm-12 mt-5">
    {!! Form::label('news', 'الخبر :', ['class'  => 'form-label fs-6 fw-bolder text-dark']) !!}
    {!! Form::textarea('news', null, ['class' => 'form-control form-control-lg form-control-solid']) !!}
</div>



<!-- Submit Field -->
<div class="form-group col-sm-12 mt-5">
    {!! Form::submit('حفظ', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">إلغاء</a>
</div>
