@extends('layouts.master')

@section('title')
    media
@stop
@section('css')

@endsection


@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Media </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">
                     </span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection


@section('content')
@livewire('admin.media-livewire')
@endsection
{{-- Script --}}
@section('script')
<script>

    window.addEventListener('close-modal', event => {

        $('#storyModal').modal('hide');
        $('#updateStoryModal').modal('hide');
        $('#deleteStoryModal').modal('hide');
    })
</script>
@endsection
