@extends('layouts.master')

@section('title')
   posts
@stop
@section('css')
.gallery {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
  }

  .gallery img {
    width: 200px;
    height: 200px;
    margin: 10px;
    object-fit: cover;
    cursor: pointer;
  }

  .sub-gallery {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
  }

  .sub-gallery img {
    width: 200px;
    height: 200px;
    margin: 10px;
    object-fit: cover;
  }
  .hidden {
    display: none;
  }
@endsection


@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">posts</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">
                    </span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection


@section('content')
@livewire('admin.product-report-livewire')
@endsection
{{-- Script --}}
@section('script')
<script>
    window.addEventListener('close-modal', event => {

        $('#postModal').modal('hide');
        $('#updatePostModal').modal('hide');
        $('#deletePostModal').modal('hide');
    })
</script>
@endsection
