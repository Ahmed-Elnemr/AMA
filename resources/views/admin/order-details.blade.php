@extends('layouts.master')
@section('css')
    <style>
        @media print {
            #print_Button {
                display: none;
            }
        }
    </style>
@endsection
@section('title')
    order details
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Order Details </h4>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice" id="print">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <h1 class="invoice-title">AMA Order Details </h1>
                            <div class="billed-from">
                                <h5> Customer Details </h5>

                                @if (is_null($personalInfo))
                                @else
                                    <li>{{ $personalInfo->first_name . ' ' . $personalInfo->last_name }}</li>

                                    <li> {{ $personalInfo->phone }}</li>
                                @endif

                                <li>
                                    <h6>Address</h6>
                                </li>
                                <div class="tx-20">
                                    <p>
                                        @if (is_null($order->address))
                                        @else
                                            {{ $order->address->country }}
                                            ,
                                            {{ $order->address->city }}
                                            <mark>street</mark>
                                            {{ $order->address->street }} <br>
                                            <mark>landmark</mark>
                                            {{ $order->address->landmark }}
                                            <mark>building</mark>
                                            {{ $order->address->building }} <br>
                                            <mark>floor</mark>
                                            {{ $order->address->floor }}
                                            <mark>flat</mark>
                                            {{ $order->address->flat }} <br>
                                        @endif
                                    </p>
                                </div>

                            </div><!-- billed-from -->
                        </div><!-- order-header -->
                        <div class="row mg-t-20 float-right">

                            <div class="col-md">
                                <h6>
                                    <p>معلومات الطلب</p>
                                </h6>
                                <p class="invoice-info-row"><span>رقم الفاتورة</span>
                                    <span>{{ $order->id }}</span>
                                </p>
                                <p class="invoice-info-row"><span> الحاله</span>
                                    <span>{{ $order->status }}</span>
                                </p>

                                <p class="invoice-info-row"><span>تاريخ الاصدار</span>
                                    <span>{{ $order->created_at }}</span>
                                </p>

                            </div>
                        </div>


                        <div class="table-responsive mg-t-40 pt-4">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="wd-20p">العناصر</th>
                                        <th class="wd-20p">الكميه</th>
                                        <th class="wd-40p">مبلغ العنصر الواحد ( ب الجنيه )</th>
                                        <th class="tx-center">المبلغ الكلي للعنصر </th>
                                        {{-- <th class="tx-right">مبلغ العمولة</th>
                            <th class="tx-right">الاجمالي</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderDdetails as $orderD)
                                    @if (isset($orderD->product))
                                    <tr>
                                        <td>{{ $orderD->product->products_name }}</td>
                                        <td>{{ $orderD->quantity }}</td>
                                        <td> {{ $orderD->item_price  }}  <span class="float-center text-muted tx-12">EGP</span></td>
                                        <td class="tx-center"> {{ $orderD->total_price  }} <span class="float-center text-muted tx-12">EGP</span></td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @endif

                                    @endforeach
                                    <tr>
                                        <td class="tx-center tx-uppercase tx-bold tx-inverse"> <strong>الاجمالي</strong>
                                        </td>
                                        <td class="tx-center" colspan="2">
                                            <h4 class="tx-primary tx-bold">{{ $order->total  }} <span class="float-center text-muted tx-12">EGP</span> </h4>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                        <hr class="mg-b-40">



                        <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> <i
                                class="mdi mdi-printer ml-1"></i>Print Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>


    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>

@endsection
