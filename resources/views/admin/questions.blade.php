@extends('layouts.master')

@section('title')
   questions
@stop
@section('css')

@endsection


@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto" style="color:rgb(82, 129, 230)">Questions </h4><span class="text mt-1 tx-13 mr-2 mb-0" style="color:rgb(37, 112, 161)">/
                    Questions & Answer</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection


@section('content')
@livewire('admin.quetion-livewire')
@endsection
{{-- Script --}}
@section('script')
<script>
    window.addEventListener('close-modal', event => {

        $('#quModal').modal('hide');
        $('#updateQuModal').modal('hide');
        $('#deleteQuModal').modal('hide');
    })
</script>
@endsection
