<div class="banner-box">
    <div class="owl-carousel main-banner">
        @foreach ($banners as $item)
        <div> 
            <a href="{{$item->url}}" target="_blank">
                <img class="d-block w-100" height="90px" src="{{ asset('uploads/'.$item->image) }}">
            </a>
        </div>
        @endforeach
        
        @auth
        @if(auth()->user()->userable_type == 'App\Models\Lawyer')
            @php $list = $lawyer_banners; @endphp 
        @else
            @php $list = $client_banners; @endphp 
        @endif
        @foreach ($list as $item)
        <div> 
            <a href="{{$item->url}}" target="_blank">
                <img class="d-block w-100" height="90px" src="{{ asset('uploads/'.$item->image) }}">
            </a>
        </div>
        @endforeach
        @endauth
      </div>
</div>



