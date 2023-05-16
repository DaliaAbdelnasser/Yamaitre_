<!-- Name Field -->
<div class="form-group col-sm-6 mt-5">
    {!! Form::label('name', 'الاسم:', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
    {!! Form::text('name', null, ['class' => 'form-control form-control-lg form-control-solid']) !!}
</div>

<!-- Permissions Field -->
<div class="form-group col-sm-12 mt-5">
    {!! Form::label('permissions', 'المهام:', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}

    <div class="row">
        @foreach ($permissions as $permission)
            <div class="col-sm-3">
                {!! Form::checkbox('permissions[]', $permission->id, null, ['id' => 'permission-' . $permission->id, 'class' => 'form-check-input']) !!}
                {!! Form::label('permission-' . $permission->id, $permission->name, [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
            </div>
        @endforeach
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 mt-5">
    {!! Form::submit('حفظ', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">إلغاء</a>
</div>
