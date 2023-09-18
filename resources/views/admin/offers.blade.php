@extends('layouts.master')

@section('title')
    offers
@stop
@section('css')

@endsection


@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto" style="color:rgb(82, 129, 230)"> Offers</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">
                   </span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection


@section('content')
@livewire('admin.offer-livewire')
@endsection
{{-- Script --}}
@section('script')
<script>
    window.addEventListener('close-modal', event => {

        $('#offerModal').modal('hide');
        $('#updateOfferModal').modal('hide');
        $('#deleteOfferModal').modal('hide');
    })
</script>

@endsection
@section('js')
<!-- Moment js -->
<script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
<!-- Internal Piety js -->
<script src="{{URL::asset('assets/plugins/peity/jquery.peity.min.js')}}"></script>
<!-- Internal Chart js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>

@endsection
{{-- @push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js.2.29.1/moment.min.js"></script>

 <script></script>

<script src="https://cdn.jsdelivr.net/npm/pikaday.js"></script>
<script>

    new Pikaday ({
        field :document.getElementById('date')
        onSelect :function(){
            @this.set ('date',this.getMoment().format('Y-m-d'));
        }
    })
</script>

@endpush --}}
