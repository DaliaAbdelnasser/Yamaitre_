<div class="banner-box">
    <div class="owl-carousel main-banner">
        @foreach ($task_banners as $item)
        <div> 
            <a href="{{$item->url}}" target="_blank">
                <img class="d-block w-100" height="90px" src="{{ asset('uploads/'.$item->image) }}">
            </a>
        </div>
        @endforeach
      </div>
</div>



