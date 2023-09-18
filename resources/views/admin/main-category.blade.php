@extends('layouts.master')

@section('title')
    main categories
@stop
@section('css')

@endsection


@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        {{-- <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto " style="color:rgb(221, 170, 58)" > All Categories</h4>
                <span  class="text mt-1 tx-15 mr-2 mb-0" style="color:rgb(201, 143, 35)" >/
                    Main Categories</span>
            </div>
        </div> --}}
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto " style="color:rgb(82, 129, 230)" > All Categories</h4>
                <span  class="text mt-1 tx-15 mr-2 mb-0" style="color:rgb(37, 112, 161)" >/
                    Main Categories</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection


@section('content')
@livewire('admin.main-category-livewire')
@endsection
{{-- Script --}}
@section('script')
<script>
    window.addEventListener('close-modal', event => {

        $('#mCatModal').modal('hide');
        $('#updateMcatModal').modal('hide');
        $('#deleteMcatModal').modal('hide');
    })
</script>
@endsection
