@extends('layouts.master')

@section('title')
    product
@stop
@section('css')

@endsection


@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto" style="color:rgb(82, 129, 230)">Product </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">
                     </span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection


@section('content')
@livewire('admin.productlivewire')
@endsection
{{-- Script --}}
@section('script')
<script>

    window.addEventListener('close-modal', event => {

        $('#productModal').modal('hide');
        $('#updateProModal').modal('hide');
        $('#deleteProModal').modal('hide');
    })
</script>

@endsection
@section('js')
<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('assets/js/select2.js')}}"></script>
<!-- Internal Nice-select js-->
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js')}}"></script>
@endsection
