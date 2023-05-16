<!-- Period Field -->
<div class="form-group col-sm-6 mt-5">
    {!! Form::label('period', 'مدة الإعلان : (بالأيام)', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
    {!! Form::text('period', null , ['class' => 'form-control form-control-lg form-control-solid']) !!}
</div>

<!-- Period Field -->
<div class="form-group col-sm-6 mt-5">
    {!! Form::label('price', 'تكلفة الإعلان :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
    {!! Form::text('price', null , ['class' => 'form-control form-control-lg form-control-solid']) !!}
</div>

<!-- status Field -->
<div class="form-group col-sm-6 mt-5">
    {!! Form::label('status', 'حالة الإعلان :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
    {!! Form::select('status', ['0' => 'معلق', '1' => ' نشر ', '2' => 'منتهي'], $announcement->status, ['class' => 'form-control form-control-lg form-control-solid form-select', 'placeholder' => 'حدد حالة الاعلان']) !!}
</div>

<!-- url Field -->
<div class="form-group col-sm-6 mt-5 cs-ads-link">
    {!! Form::label('url', ' الرابط :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
    @if($announcement->url == null)
    {!! Form::text('url', 'https://'  , ['class' => 'form-control form-control-lg form-control-solid']) !!}
    @else
    {!! Form::text('url', $announcement->url  , ['class' => 'form-control form-control-lg form-control-solid']) !!}
    @endif
</div>

<div class="form-group col-sm-12 mt-5">
    {!! Form::label('usertype',' المسموح له بالإطلاع :', ['class'  => 'form-label fs-6 fw-bolder text-dark']) !!}
    {!! Form::select('usertype', [ 'all' => 'اظهار للكل', 'lawyer' => 'اظهار للمحامين', 'client' => 'اظهار للموكلين' ], $announcement->usertype ?? '', ['class' => 'form-control form-control-lg form-control-solid', 'placeholder' => 'من فضلك اختر']) !!}

</div>

<!-- Image Field -->
<div class="form-group col-sm-6 mt-5">
    {!! Form::label('image', 'صورة الإعلان :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
    {!! Form::file('image', ['class' => 'form-control form-control-lg form-control-solid']) !!}
    {{-- @if($announcement->image)
    <br><img src="{{ asset('uploads/' . $announcement->image) }}" alt="announcement" class="my-5 ads-img-wb" />
    @endif --}}
    <small> المساحة الاعلانية يجب ان تكون (1000x124 px)</small>
</div>


<!-- Mob Image Field -->
<div class="form-group col-sm-6 mt-5">
    {!! Form::label('mob_image', 'صورة الإعلان للموبايل :', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
    {!! Form::file('mob_image', ['class' => 'form-control form-control-lg form-control-solid', 'value' => $announcement->mob_image]) !!}
    {{-- @if($announcement->mob_image)
    <br><img src="{{ asset('uploads/' . $announcement->mob_image) }}" alt="announcement" class="my-5 ads-img-mob" />
    @endif --}}
    <small> المساحة الاعلانية يجب ان تكون (1024x296 px)</small>
</div>


<div class="form-group col-sm-12 mt-5">
    @if($announcement->image)
    <br><img src="{{ asset('uploads/' . $announcement->image) }}" alt="announcement" class="my-5 ads-img-wb" />
    @endif
</div>

<div class="form-group col-sm-12 mt-5">
    @if($announcement->mob_image)
    <br><img src="{{ asset('uploads/' . $announcement->mob_image) }}" alt="announcement" class="my-5 ads-img-mob" />
    @endif
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 mt-5">
    {!! Form::submit('حفظ', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.announcements.index') }}" class="btn btn-secondary">إلغاء</a>
</div>
