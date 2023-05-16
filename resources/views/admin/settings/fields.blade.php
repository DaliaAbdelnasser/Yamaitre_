@foreach ($infos as $info )
    <div class="form-group col-sm-12 mt-5">
        @if($info->info_name == 'tag_line')
        {!! Form::label($info->info_name, ' عنوان الموقع:', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
        @elseif ($info->info_name == 'footer_description')
        {!! Form::label($info->info_name, ' الوصف:', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
        @elseif ($info->info_name == 'address')
        {!! Form::label($info->info_name, ' العنوان:', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
        @elseif ($info->info_name == 'location')
        {!! Form::label($info->info_name, ' لينك الخريطة:', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
        @elseif ($info->info_name == 'phone')
        {!! Form::label($info->info_name, ' رقم الهاتف:', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
        @elseif ($info->info_name == 'email')
        {!! Form::label($info->info_name, ' البريد الالكتروني:', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
        @elseif ($info->info_name == 'facebook')
        {!! Form::label($info->info_name, ' حساب فيسبوك:', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
        @elseif ($info->info_name == 'youtube')
        {!! Form::label($info->info_name, ' حساب يوتيوب:', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
        @elseif ($info->info_name == 'twitter')
        {!! Form::label($info->info_name, ' حساب تويتر:', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
        @elseif ($info->info_name == 'instagram')
        {!! Form::label($info->info_name, ' حساب انستجرام:', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
        @elseif ($info->info_name == 'linkedin')
        {!! Form::label($info->info_name, ' حساب لينكدان:', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
        @elseif ($info->info_name == 'cash_in')
        {!! Form::label($info->info_name, ' عمولة التحويل من المستخدم: (.%)', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
        @elseif ($info->info_name == 'refund')
        {!! Form::label($info->info_name, ' عمولة الاسترجاع  : (.%)', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
        @elseif ($info->info_name == 'cash_out')
        {!! Form::label($info->info_name, ' عمولة التحويل الى المستخدم: (.%)', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
        @elseif ($info->info_name == 'tax_cost')
        {!! Form::label($info->info_name, ' رسوم الاقرار الضريبي:', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
        @elseif ($info->info_name == 'consultation_cost')
        {!! Form::label($info->info_name, ' رسوم الاستشارة:', [ 'class' => 'form-label fs-6 fw-bolder text-dark']) !!}
        @endif
        @if($info->info_name == 'footer_description')
        {!! Form::textarea($info->info_name, $info->info_value, ['class' => 'form-control form-control-lg form-control-solid']) !!}
        @else
        {!! Form::text($info->info_name, $info->info_value, ['class' => 'form-control form-control-lg form-control-solid']) !!}
        @endif
    </div>
@endforeach

<!-- Submit Field -->
<div class="form-group col-sm-12 mt-5">
    {!! Form::submit('حفظ', ['class' => 'btn btn-primary']) !!}
</div>
