<!--begin::Body-->
<div class="card-body p-lg-17">
    <!--begin::About-->
    <div class="mb-18">
        <!--begin::Wrapper-->
        <div class="mb-10">
            <!--begin::Top-->
            <div class="text-center mb-15">
                <!--begin::Title-->
                <div class="pull-right">
                    
                </div>
                <h3 class="fs-2hx text-dark mb-5">{{$page->title}}</h3>
                <!--end::Title-->
                <!--begin::Text-->
                <div class="fs-5 text-muted fw-bold"></div>
                <!-- Modal -->
                <div class="modal fade" id="addSection{{ $page->id }}" role="dialog">
                    <div class="modal-dialog">
                    
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add Section</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                
                            </div>
                            <div class="modal-body">
                                <div class="card">
                                    <div class="card-body">
                                    {!! Form::open(['route' => ['admin.pages.store', $page->id], 'method' => 'post']) !!}
                                        <div class="row">
                                            @include('admin.pages.section-fields')
                                        </div>
                                    {!! Form::close() !!}
                                    <br>
                                    </div>
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    
                    </div>
                </div>
                
                <!--end::Text-->
            </div>
            <!--end::Top-->
            
        </div>
        <!--end::Wrapper-->
        <!--begin::Description-->
        <div class="fs-5 fw-bold text-gray-600">
            <!--begin::Text-->
            @if($page->id != 4)
            @foreach($page->sections as $section)
                
                <br><br>
                <div class="text-center">
                    <p class="mb-8">{{$section->description}}</p>
                    <div class="align-items-center"><hr></div>
                    
                </div>
            @endforeach
            @else
            @foreach($page->faqs as $faq)
                
                <div class="text-center">
                    <h4 class="pull-right">{{ $faq->question }}</h4>
                    <br>
                    <div class="align-items-center"><hr></div>
                    <p class="mb-8">{{$faq->answer}}</p>
                </div>
            @endforeach
            
            @endif
        </div>
        <!--end::Description-->
    </div>
    <!--end::About-->
</div>
<!--end::Body-->