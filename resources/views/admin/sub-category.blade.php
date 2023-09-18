@extends('layouts.master')

@section('title')
    sub-categories
@stop
@section('css')

@endsection


@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto" style="color:rgb(82, 129, 230)">All Categories </h4><span class="text mt-1 tx-15 mr-2 mb-0" style="color:rgb(37, 112, 161)">/
                    Sub Category</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection


@section('content')
@livewire('admin.sub-category-livewire')
@endsection
{{-- Script --}}
@section('script')
<script>
    window.addEventListener('close-modal', event => {

        $('#subModal').modal('hide');
        $('#updateSubModal').modal('hide');
        $('#deleteSubModal').modal('hide');
    })
</script>
@endsection
