@extends('layouts.master')

@section('title')
    Subbscription PKG
@stop
@section('css')

@endsection


@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto" style="color:rgb(82, 129, 230)" >Subbscription Package</h4>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection


@section('content')
@livewire('admin.subbscriotion-pkg-livewire')
@endsection
{{-- Script --}}
@section('script')
<script>
    window.addEventListener('close-modal', event => {

        $('#addPackage').modal('hide');
        $('#updateSubscription').modal('hide');
        $('#deletePkg').modal('hide');
    })
</script>
@endsection
