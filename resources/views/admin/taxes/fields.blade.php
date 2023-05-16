<!-- type Field -->
<div class="form-group col-sm-6 mt-5">
    {!! Form::label('feedback', ' طبيعة الاستشارة :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
    <p>{{$tax->tax_name}}</p>
</div>

<!-- description Field -->
<div class="form-group col-sm-6 mt-5">
    {!! Form::label('feedback', ' رمز الأمان  :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
    <p>{{$tax->tax_password}}</p>
</div>

<!-- description Field -->
<div class="form-group col-sm-6 mt-5">
    {!! Form::label('feedback', ' ملاحظات  :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
    <p>{{$tax->notes}}</p>
</div>

<!-- description Field -->
<div class="form-group col-sm-6 mt-5">
    {!! Form::label('feedback', '  	الناشر :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
    <p>{{ $tax->lawyers->first()->user->first_name ?? ''}} {{ $tax->lawyers->first()->user->last_name ?? ''}}</p>
</div>


<!-- description Field -->
<div class="form-group col-sm-6 mt-5">
    {!! Form::label('feedback', ' 	رقم الهاتف  :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
    <p>{{ $tax->lawyers->first()->user->phone ?? ''}}</p>
</div>

<!-- Feedback Field -->
<div class="form-group col-sm-6 mt-5">
    {!! Form::label('email', ' البريد الإلكتروني :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
    <p>{{ $tax->lawyers->first()->user->email ?? ''}}</p>
</div>

<!-- Feedback Field -->
<div class="form-group col-sm-6 mt-5">
    {!! Form::label('tax_file', ' ملف الاقرار  :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
    @isset($tax->tax_file)
        <br><img src="{{ asset('uploads/' . $tax->tax_file ) }}" width="100%" height="auto" alt="tax" class="my-5" />
    @endisset
</div>


@isset($tax->feedback)
<!-- Feedback Field -->
<div class="form-group col-sm-6 mt-5">
    {!! Form::label('tax_file', ' الملف المرسل:', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
        <br><img src="{{ asset('uploads/' . $tax->feedback ) }}" width="100%" height="auto" alt="tax" class="my-5" />
</div>
@endisset


@if($tax->status == 'inprogress')
<!-- Feedback Field -->
<div class="form-group col-sm-12 mt-5">
    {!! Form::label('feedback', ' طبيعة الاستشارة :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
    {!! Form::file('feedback', null, ['class' => 'form-control form-control-lg form-control-solid']) !!}
</div>
@endif

<!-- Submit Field -->
<div class="form-group col-sm-12 mt-5">
    {!! Form::submit('إرسال', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.taxes.index') }}" class="btn btn-secondary">إلغاء</a>
</div>
<!--  -->

