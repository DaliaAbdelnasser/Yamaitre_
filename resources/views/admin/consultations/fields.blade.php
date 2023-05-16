<!-- type Field -->
<div class="form-group col-sm-12 mt-5">
    {!! Form::label('feedback', ' طبيعة الاستشارة :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
    <p>{{$cons->type}}</p>
</div>

<!-- description Field -->
<div class="form-group col-sm-12 mt-5">
    {!! Form::label('feedback', ' طبيعة الاستشارة :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
    <p>{{$cons->description}}</p>
</div>

<!-- Feedback Field -->
<div class="form-group col-sm-12 mt-5">
    {!! Form::label('feedback', ' الاستشارة :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
    {!! Form::textarea('feedback', null, ['class' => 'form-control form-control-lg form-control-solid']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12 mt-5">
    {!! Form::submit('إرسال', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.consultations.index') }}" class="btn btn-secondary">إلغاء</a>
</div>
<!--  -->

