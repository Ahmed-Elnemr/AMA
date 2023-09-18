@extends('layouts.master')

@section('title')
    library
@stop
@section('css')

@endsection


@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto" style="color:rgb(82, 129, 230)">Library </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">
                     </span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection


@section('content')
@livewire('admin.library-livewire')
@endsection
{{-- Script --}}
@section('script')
<script>

    window.addEventListener('close-modal', event => {

        $('#libraryModal').modal('hide');
        $('#updateLibraryModal').modal('hide');
        $('#deleteLibraryModal').modal('hide');
    })
</script>
@endsection
