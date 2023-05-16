@if (@$records->hasPages())
@php
$currentRequest = '';
foreach (request()->except('page') as $key => $value) {
    try {
        //code...
        $currentRequest .= '&'.$key.'='.$value;
    } catch (\Throwable $th) {
        foreach ($value as  $val) {
            # code...
            $currentRequest .= '&'.$key.'%5B%5D='.$val;
        }
            // dd($currentRequest, request()->except('page'), $key, $value, request());
            //throw $th;
        }
    }
@endphp

<!-- Main Section -->
<div class="careerfy-main-section admin">
    <div class="container">
        <div class="row">
            <div class="col-md-12 careerfy-typo-wrap">
                <div class="careerfy-pagination-blog">
                    <ul class="page-numbers">

                        <li><a class="prev page-numbers" href="{{$records->previousPageUrl().$currentRequest}}"><span><i class="careerfy-icon careerfy-arrows4"></i></span></a></li>

                        @foreach ($records->links()->elements as $array)
                        
                            @if ($array != '...')
                            
                                @foreach ($array as $key => $url)
                                <li>
                                    @if (request('page',1)==$key)
                                        <span class="page-numbers current">{{$key}}</span>
                                    @else
                                        <a class="page-numbers" href="{{ $url . $currentRequest }}">{{$key}}</a>
                                    @endif
                                </li>
                                @endforeach
                            
                            @else
                                <li class="page-numbers"><b>...</b></li>
                            @endif
                        @endforeach

                        <li><a class="next page-numbers" href="{{$records->nextPageUrl().$currentRequest}}"><span><i class="careerfy-icon careerfy-arrows4"></i></span></a></li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Section -->
@endif

