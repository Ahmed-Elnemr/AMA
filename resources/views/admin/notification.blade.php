@extends('layouts.master')

@section('title')
   notification
@stop
@section('css')

@endsection


@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"  style="color:rgb(82, 129, 230)">Notification</h4>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection


@section('content')
@livewire('admin.notification-livewire')
@endsection
{{-- Script --}}
@section('script')
<script>
    window.addEventListener('close-modal', event => {

        $('#notiModal').modal('hide');
        $('#updateNotiModal').modal('hide');
        $('#deleteNotiModal').modal('hide');
    })
</script>
@endsection
