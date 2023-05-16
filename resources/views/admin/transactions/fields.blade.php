<!-- Name Field -->
<div class="form-group col-sm-6 mt-5">
    {!! Form::label('name', 'الاسم :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
    {!! Form::text('name', null, ['class' => 'form-control form-control-lg form-control-solid']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6 mt-5">
    {!! Form::label('email', 'البريد الالكتروني :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
    {!! Form::email('email', null, ['class' => 'form-control form-control-lg form-control-solid']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6 mt-5">
    {!! Form::label('password', 'الرمز السري:', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
    {!! Form::password('password', ['class' => 'form-control form-control-lg form-control-solid']) !!}
</div>

<!-- Password Confirmation Field -->
<div class="form-group col-sm-6 mt-5">
    {!! Form::label('password', ' تأكيد الرمز السري :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control form-control-lg form-control-solid']) !!}
</div>

<!-- Roles Field -->
<div class="form-group col-sm-6 mt-5 d-none">
    {!! Form::label('roles', 'المهام :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
    {!! Form::select('roles', $roles, null, ['class' => 'form-control form-control-lg form-control-solid']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 mt-5">
    {!! Form::submit('حفظ', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.admins.index') }}" class="btn btn-secondary">إلغاء</a>
</div>
