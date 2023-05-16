
<div class="row">
@if($page->sections->first() != null)
<!-- Section Field -->
<div class="form-group col-sm-12 mt-5">
    {!! Form::label('section', 'فقرة جديدة :',   [ 'class' => 'form-label fs-6 fw-bolder text-dark ']) !!}
    {!! Form::textarea('description', null, [
                    'class' => 'form-control form-control-lg form-control-solid',
                    'rows'       => 4,
                    'name'       => 'description',
                    'id'         => 'description',
                    'onkeypress' => "return nameFunction(event);"
                ]) !!}
</div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 mt-5">
    {!! Form::submit('إضافة', ['class' => 'btn btn-primary']) !!}
</div>
@endif