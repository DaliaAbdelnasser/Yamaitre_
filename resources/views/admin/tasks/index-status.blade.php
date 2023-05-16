@extends('layouts.admin-app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Tasks List</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        @if($tasks[0]->status == 'inprogress')
                            <div class="card-header">
                                <h2>Inprogress Tasks</h2>
                            </div>
                            <div class="card-body">
                                    @include('admin.tasks.table-status')
                            </div>
                        @elseif($tasks[0]->status == 'inreview')
                            <div class="card-header">
                                <h2>Inreview Tasks</h2>
                            </div>
                            <div class="card-body">
                                @include('admin.tasks.table-status')
                            </div>
                        @elseif($tasks[0]->status == 'completed')
                            <div class="card-header">
                                <h2>Completed Tasks</h2>
                            </div>
                            <div class="card-body">
                                @include('admin.tasks.table-status')
                            </div>      
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
