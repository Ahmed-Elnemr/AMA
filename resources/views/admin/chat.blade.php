@extends('layouts.master')

@section('title')
    chat
@stop
@section('css')

@endsection


@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto" style="color:rgb(82, 129, 230)">Chat</h4>
                {{-- <span class="text mt-1 tx-15 mr-2 mb-0" style="color:rgb(37, 112, 161)">/
                    Chat</span> --}}
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection


@section('content')
@livewire('admin.chat-livewire')
@endsection
{{-- Script --}}
@section('script')
<script>
    window.addEventListener('close-modal', event => {

        $('#roomModal').modal('hide');
        $('#updateRoomModal').modal('hide');
        $('#deleteRoomModal').modal('hide');
    })
</script>
@endsection
