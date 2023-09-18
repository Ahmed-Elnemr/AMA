<div>


    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1 text-capitalize" style="color: #d3d00e;">Hi, welcome
                    back <span class="text-uppercase" style="color: #9b9b23;"> {{ Auth::user()->name }}</span></h2>
                {{-- <p class="mg-b-0">You are Admin  monitoring dashboard template.</p> --}}
            </div>
        </div>
        <div class="main-dashboard-header-right">
            {{-- <div>
                <label class="tx-13">Customer Ratings</label>
                <div class="main-star">
                    <i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star"></i> <span>(14,873)</span>
                </div>
            </div> --}}
            <div>
                <label style="color: #d3d00e;" class="tx-13">Top Ranked </label>
                <h5 class="rounded "> <span style="color: hsl(64, 71%, 32%);">{{ $topRankedCount }}</span> </h5>
            </div>

            {{-- <div>
                <label class="tx-13">Offline Sales</label>
                <h5>783,675</h5>
            </div> --}}
        </div>
    </div>
    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-primary-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-15 text-white">Customers</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ $customer }}</h4>
                                <p class="mb-0 tx-12 text-white op-7">Compared to last week</p>
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-up text-white"></i>
                                <span class="text-white op-7"> +{{ $lastsCustomerIn7Day }}</span>
                            </span>
                        </div>
                    </div>
                </div>
                {{-- <span id="compositeline" class="pt-1">10,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span> --}}
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-danger-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h4 class="mb-3 tx-12 text-white">VENDOR</h4>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h6 class="tx-20 font-weight-bold mb-1 text-white">{{ $vendor }}</h6>
                                <p class="mb-0 tx-12 text-white op-7">Compared to last week</p>
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-up text-white"></i>
                                <span class="text-white op-7"> +{{ $lastsVendorIn7Day }}</span>
                            </span>
                        </div>
                    </div>
                </div>
                {{-- <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span> --}}
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-success-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h4 class="mb-3 tx-12 text-white">ADMINS</h4>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h6 class="tx-20 font-weight-bold mb-1 text-white">{{ $admin }}</h6>
                                <p class="mb-0 tx-12 text-white op-7">Compared to last week</p>
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-up text-white"></i>
                                <span class="text-white op-7"> +{{ $lastsAdminIn7Day }}</span>
                            </span>
                        </div>
                    </div>
                </div>
                {{-- <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span> --}}
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-secondary-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h4 class="mb-3 tx-12 text-white">PRODUCTS</h4>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ $products }}</h4>
                                <p class="mb-0 tx-12 text-white op-7">Compared to last week</p>
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-up text-white"></i>
                                <span class="text-white op-7"> +{{ $lastsProductsIn7Day }}</span>
                            </span>
                        </div>
                    </div>
                </div>
                {{-- <span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span> --}}
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-info-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h4 class="mb-3 tx-12 text-white">QUESTIONS</h4>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ $questions }}</h4>
                                <p class="mb-0 tx-12 text-white op-7">Compared to last week</p>
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-up text-white"></i>
                                <span class="text-white op-7"> +{{ $lastsQuestionsIn7Day }}</span>
                            </span>
                        </div>
                    </div>
                </div>
                {{-- <span id="compositeline2" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span> --}}
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-warning-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h4 class="mb-3 tx-12 text-white">ROOMS</h4>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ $rooms }}</h4>
                                <p class="mb-0 tx-12 text-white op-7">Compared to last week</p>
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-up text-white"></i>
                                <span class="text-white op-7"> +{{ $lastsRoomsIn7Day }}</span>
                            </span>
                        </div>
                    </div>
                </div>
                {{-- <span id="compositeline2" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span> --}}
            </div>
        </div>
    </div>
    <!-- row closed -->

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-md-12 col-lg-12 col-xl-7">
            <div class="card">
                <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">Order status</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <p class="tx-12 text-muted mb-0">Order Status and Tracking. Track your order from ship date to
                        arrival.</p>
                </div>
                <div class="card-body">
                    <div class="total-revenue">

                        <div>
                            <h4>{{ $completed }}</h4>
                            <label><span class="bg-primary"></span>completed</label>
                        </div>
                        <div>
                            <h4>{{ $pending }}</h4>
                            <label><span class="bg-warning"></span>Pending</label>
                        </div>
                        <div>
                            <h4>{{ $cancelld }}</h4>
                            <label><span class="bg-danger"></span>Cancelld</label>
                        </div>
                        <div>
                            <h4>{{ $approved }}</h4>
                            <label><span class="bg-secondary"></span>approved</label>
                        </div>
                    </div>
                    <div id="bar" class="sales-bar mt-4"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-sm-6 col-md-6">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="feature widget-2 text-center mt-0 mb-3">
                                <i class="ti-pulse  project bg-teal-transparent mx-auto text-teal "></i>
                            </div>
                            <h6 class="mb-1 text-muted">Total prices of completed orders </h6>
                            <h3 class="font-weight-semibold">{{ $totalOrderCompletedPrice }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-sm-6 col-md-6">
                    <div class="card text-center">
                        <div class="card-body ">
                            <div class="feature widget-2 text-center mt-0 mb-3">
                                <i class="ti-bar-chart project bg-primary-transparent mx-auto text-primary "></i>
                            </div>
                            <h6 class="mb-1 text-muted">Total Offer</h6>
                            <h3 class="font-weight-semibold">{{ $totalOffer }}</h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{-- <div class="col-lg-12 col-xl-5">
						<div class="card card-dashboard-map-one">
							<label class="main-content-label">Sales Revenue by Customers in USA</label>
							<span class="d-block mg-b-20 text-muted tx-12">Sales Performance of all states in the United States</span>
							<div class="">
								<div class="vmap-wrapper ht-180" id="vmap2"></div>
							</div>
						</div>
					</div> --}}
        <div class="col-lg-12 col-xl-5">
            <div class="card">
                <div class="card-header pb-1">
                    <h3 class="card-title mb-2">ROOMS</h3>
                    <p class="tx-12 mb-0 text-muted">The last five rooms are available for chatting</p>
                </div>
                <div class="card-body p-0 customers mt-1">
                    <div class="list-group list-lg-group list-group-flush">
                        @if (isset($lastFiveRomms))
                            @foreach ($lastFiveRomms as $room)
                                <div class="list-group-item list-group-item-action" href="#">
                                    <div class="media mt-0">
                                        @if (isset($room->media->path))
                                            <img class="avatar-lg rounded-circle ml-3 my-auto"
                                                src="{{ $room->media->path }}" alt="Image description">
                                        @else
                                        @endif
                                        <div class="media-body">
                                            <div class="d-flex align-items-center">
                                                <div class="mt-0">
                                                    <h5 class="mb-1 tx-15">
                                                        @if (isset($room->room_name))
                                                            {{ $room->room_name }}
                                                        @else
                                                        @endif


                                                    </h5>
                                                    {{-- @if ($room->created_at != null)
                                                        @livewire('admin.dashboard-livewire',[$rId=>$room->id])
                                                        {{$rId}}
                                                    <p><span class="text-muted">Member</span> {{ count($room->rlog) }}</p>
                                                    @else
                                                    @endif --}}


                                                    <p class="mb-0 tx-13 text-muted">Owner
                                                        @if (isset($room->user->id))
                                                            ID:
                                                            {{ $room->user->id }}
                                                        @else
                                                        @endif

                                                        @if (isset($room->user->name))
                                                            <span class="text-success ml-2">Owner
                                                                -> {{ $room->user->name }}</span>
                                                        @else
                                                        @endif
                                                        @if (isset($room->room_is_private))
                                                            @if ($room->room_is_private == 1)
                                                                <span class="text-danger ml-2">
                                                                    Private
                                                                </span>
                                                            @else
                                                                <span class="text-primary ml-2">
                                                                    Public
                                                                </span>
                                                            @endif
                                                        @else
                                                        @endif

                                                        @if ($room->created_at != null)
                                                            <p><span class="text-muted">Created</span>
                                                                {{ date('d-m-Y', strtotime($room->created_at)) }}</p>
                                                        @else
                                                        @endif

                                                    </p>
                                                </div>
                                                <span class="mr-auto wd-45p fs-16 mt-2">
                                                    {{-- <div id="spark1" class="wd-100p"></div> --}}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- row closed -->

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-4 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header pb-1">
                    <h3 class="card-title mb-2">Order</h3>
                    <p class="tx-12 mb-0 text-muted">The last five orders </p>
                </div>
                <div class="card-body p-0 customers mt-1">
                    <div class="list-group list-lg-group list-group-flush">
                        @if (isset($orders))
                            @foreach ($orders as $order)
                                <div class="list-group-item list-group-item-action" href="#">
                                    <div class="media mt-0">
                                        @if (isset($order->media->path))
                                            <img class="avatar-lg rounded-circle ml-3 my-auto"
                                                src="{{ $order->media->path }}" alt="Image description">
                                        @else
                                        @endif
                                        <div class="media-body">
                                            <div class="d-flex align-items-center">
                                                <div class="mt-0">
                                                    <h5 class="mb-1 tx-15">{{ $order->user->name }}</h5>
                                                    <p class="mb-0 tx-13 text-muted">User ID: {{ $order->user->id }}
                                                        @if (isset($order->status) && $order->status == 'completed')
                                                            <span class="text-success ml-2">completed </span>
                                                    </p>
                                                @elseif ($order->status == 'pending')
                                                    <span class="text-warning ml-2">pending</span></p>
                                                @elseif ($order->status == 'cancelld')
                                                    <span class="text-danger ml-2">cancelld</span></p>
                                                @elseif ($order->status == 'approved')
                                                    <span class="text-secondary ml-2">approved</span></p>
                            @endif
                    </div>
                    <span class="mr-auto wd-45p fs-16 mt-2">
                        {{-- <div id="spark1" class="wd-100p"></div> --}}
                    </span>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@else
    @endif





    {{-- <div class="list-group-item list-group-item-action" href="#">
										<div class="media mt-0">
											<img class="avatar-lg rounded-circle ml-3 my-auto" src="{{URL::asset('assets/img/faces/11.jpg')}}" alt="Image description">
											<div class="media-body">
												<div class="d-flex align-items-center">
													<div class="mt-1">
														<h5 class="mb-1 tx-15">Jimmy Changa</h5>
														<p class="mb-0 tx-13 text-muted">User ID: #1234 <span class="text-danger ml-2">Pending</span></p>
													</div>
													<span class="mr-auto wd-45p fs-16 mt-2">
														<div id="spark2" class="wd-100p"></div>
													</span>
												</div>
											</div>
										</div>
									</div>
									<div class="list-group-item list-group-item-action" href="#">
										<div class="media mt-0">
											<img class="avatar-lg rounded-circle ml-3 my-auto" src="{{URL::asset('assets/img/faces/17.jpg')}}" alt="Image description">
											<div class="media-body">
												<div class="d-flex align-items-center">
													<div class="mt-1">
														<h5 class="mb-1 tx-15">Gabe Lackmen</h5>
														<p class="mb-0 tx-13 text-muted">User ID: #1234<span class="text-danger ml-2">Pending</span></p>
													</div>
													<span class="mr-auto wd-45p fs-16 mt-2">
														<div id="spark3" class="wd-100p"></div>
													</span>
												</div>
											</div>
										</div>
									</div>
									<div class="list-group-item list-group-item-action" href="#">
										<div class="media mt-0">
											<img class="avatar-lg rounded-circle ml-3 my-auto" src="{{URL::asset('assets/img/faces/15.jpg')}}" alt="Image description">
											<div class="media-body">
												<div class="d-flex align-items-center">
													<div class="mt-1">
														<h5 class="mb-1 tx-15">Manuel Labor</h5>
														<p class="mb-0 tx-13 text-muted">User ID: #1234<span class="text-success ml-2">Paid</span></p>
													</div>
													<span class="mr-auto wd-45p fs-16 mt-2">
														<div id="spark4" class="wd-100p"></div>
													</span>
												</div>
											</div>
										</div>
									</div>
									<div class="list-group-item list-group-item-action br-br-7 br-bl-7" href="#">
										<div class="media mt-0">
											<img class="avatar-lg rounded-circle ml-3 my-auto" src="{{URL::asset('assets/img/faces/6.jpg')}}" alt="Image description">
											<div class="media-body">
												<div class="d-flex align-items-center">
													<div class="mt-1">
														<h5 class="mb-1 tx-15">Sharon Needles</h5>
														<p class="b-0 tx-13 text-muted mb-0">User ID: #1234<span class="text-success ml-2">Paid</span></p>
													</div>
													<span class="mr-auto wd-45p fs-16 mt-2">
														<div id="spark5" class="wd-100p"></div>
													</span>
												</div>
											</div>
										</div>
									</div> --}}
</div>
</div>
</div>
</div>

<div class="col-xl-4 col-md-12 col-lg-6">
    <div class="card card-dashboard-eight pb-2">
        <div class="row">
            <div class="col-xl-6">
                <h6 class="card-title"> Last six Top Ranked Now</h6>

            </div>
            <div class="  text-center h-10 ">
                <div class="col-xl-6 ">
                    <a class="btn btn-outline-primary " href="{{ route('top-ranked') }}"><strong> Show
                            Ranked</strong></a>
                </div>

            </div>
        </div>
        {{-- <span class="d-block mg-b-10 text-muted tx-12">Last six Top Ranked Now
            </span> --}}


        <div class="list-group">
            @if (isset($topRankeds) && $topRankeds->count() > 0)
                @foreach ($topRankeds as $rank)
                    <div class="list-group-item border-top-0">
                        {{-- @dd($rank->media->path) --}}

                        @if (isset($rank->media->path))
                            {{-- <img class="avatar-lg rounded-circle ml-3 my-auto" src="{{ $rank->media->path }}"
                        alt="Image description"> --}}
                            <div class="media">
                                <div class="card-aside-img">
                                    <img src="{{ $rank->media->path }}" alt="img" class="h-60 w-60">
                                </div>
                            </div>
                        @else
                        @endif
                        @if (isset($rank->businessInfo->legal_name))
                            <p> {{ $rank->businessInfo->legal_name }} </p><span></span>
                        @else
                        @endif

                    </div>
                @endforeach
            @else
            @endif
            {{-- <div class="text-center p-2 ">
                {{ $topRankeds->links() }}
            </div> --}}

        </div>
    </div>
</div>
{{-- </div> --}}
<div class="col-xl-4 col-md-12 col-lg-6  pb-4">
    <div class="card w-100 h-100">
        <div class="card-header pb-0">
            <h3 class="card-title mb-2">Recent Orders</h3>
            <p class="tx-12 mb-0 text-muted">The percentage of completion of the order</p>
        </div>
        <div class="card-body sales-info ot-0 pt-0 pb-0">
            <div id="chart" class="ht-150"></div>
            <div class="row sales-infomation pb-0 mb-0 mx-auto wd-100p">
                <div class="col-md-6 col">
                    <p class="mb-0 d-flex"><span class="legend bg-primary brround"></span>Completed</p>
                    <h3 class="mb-1">{{ $completed }}</h3>
                    <div class="d-flex">
                        {{-- <p class="text-muted ">Last 6 months</p> --}}
                    </div>
                </div>
                <div class="col-md-6 col">
                    <p class="mb-0 d-flex"><span class="legend bg-info brround"></span>Cancelled</p>
                    <h3 class="mb-1">{{ $cancelld }}</h3>
                    <div class="d-flex">
                        {{-- <p class="text-muted">Last 6 months</p> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="card ">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="d-flex align-items-center pb-2">
                        <p class="mb-0">Total Sales</p>
                    </div>
                    <h4 class="font-weight-bold mb-2">$7,590</h4>
                    <div class="progress progress-style progress-sm">
                        <div class="progress-bar bg-primary-gradient wd-80p" role="progressbar" aria-valuenow="78"
                            aria-valuemin="0" aria-valuemax="78"></div>
                    </div>
                </div>
                <div class="col-md-6 mt-4 mt-md-0">
                    <div class="d-flex align-items-center pb-2">
                        <p class="mb-0">Active Users</p>
                    </div>
                    <h4 class="font-weight-bold mb-2">$5,460</h4>
                    <div class="progress progress-style progress-sm">
                        <div class="progress-bar bg-danger-gradient wd-75" role="progressbar" aria-valuenow="45"
                            aria-valuemin="0" aria-valuemax="45"></div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>



</div>

<div class="row">
    <div class="col-md-12 col-lg-12 col-xl-12">
        <div class="card card-table-two">
            <div class="d-flex justify-content-between">
                <h4 class="card-title mb-1"></h4>
                <i class="mdi mdi-dots-horizontal text-gray"></i>
            </div>
            <span class="tx-30 tx-muted mb-3 tx-center tx-color-red "> Last ten order </span>
            <div class="table-responsive country-table">
                <table class="table table-striped table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap">
                    <thead>
                        <tr>
                            <th class="wd-lg-3p">Order ID</th>
                            <th class="wd-lg-25p tx-center">User</th>
                            <th class="wd-lg-30p tx-center">Business</th>
                            <th class="wd-lg-20p tx-center">Address</th>
                            <th class="wd-lg-7p tx-center">Status</th>
                            <th class="wd-lg-8p tx-center">created at </th>
                            <th class="wd-lg-8p tx-center "> Total</th>

                            <th class="wd-lg-6p tx-center"> Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($lastOrders) && $lastOrders->count() > 0)
                            @foreach ($lastOrders as $order)
                                <div>
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>
                                            <div class="media">
                                                <a href="{{ route('user-details', $order->user->id) }}">
                                                    <div class="card-aside-img">
                                                        <img src="{{ $order->user->profile_photo_path }}"
                                                            alt="img" class="rounded-circle avatar-md mr-2 ">
                                                    </div>
                                                </a>

                                                <div class="media-body">
                                                    <div class="card-item-desc mt-0">
                                                        <h6 class="font-weight-semibold mt-0 text-uppercase"> <a
                                                                href="{{ route('user-details', $order->user->id) }}">{{ $order->user->name }}</a>
                                                        </h6>

                                                        {{-- <dl class="card-item-desc-1">
                                                        <dt>Color: </dt>
                                                        <dd>LightGray color</dd>
                                                    </dl> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-muted text-center">
                                            <div class="media">
                                                @if (isset($order->businessInfo->logoMedia->path))
                                                    <div class="card-aside-img">
                                                        <img src="{{ $order->businessInfo->logoMedia->path }}"
                                                            alt="img" class="h-60 w-60">
                                                    </div>
                                                @else
                                                    no image founded
                                                @endif
                                                <div class="media-body">
                                                    <div class="card-item-desc mt-0">
                                                        <h6 class="font-weight-semibold mt-0 text-uppercase">

                                                            @if (isset($order->businessInfo->legal_name))
                                                                <p> {{ $order->businessInfo->legal_name }} </p>
                                                                <span></span>
                                                            @else
                                                            @endif
                                                        </h6>

                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center text-lg text-medium">
                                            <dl class="card-item-desc-1">
                                                {{-- <dt>Address </dt> --}}
                                                @if (isset($order->address->city))
                                                    <dd><strong>{{ $order->address->city }}</strong></dd>
                                                    ,
                                                @else
                                                @endif
                                                @if (isset($order->address->country))
                                                    <dd><strong>{{ $order->address->country }}</strong></dd>
                                                    <br>
                                                @else
                                                @endif
                                                @if (isset($order->address->landmark))
                                                    <dd>{{ $order->address->landmark }}</dd>
                                                    <mark>landmark</mark>
                                                    <br>
                                                @else
                                                @endif
                                                @if (isset($order->address->building))
                                                    <dd>{{ $order->address->building }}</dd>
                                                    <mark>building</mark>
                                                    <br>
                                                @else
                                                @endif

                                                @if (isset($order->address->floor))
                                                    <dd>{{ $order->address->floor }}</dd>
                                                    <mark>floor</mark>
                                                    <br>
                                                @else
                                                @endif
                                                @if (isset($order->address->flat))
                                                    <dd>{{ $order->address->flat }}</dd>
                                                    <mark>flat</mark>
                                                @else
                                                @endif

                                            </dl>
                                        </td>
                                        <td class="text-center text-lg text-medium">
                                            @if (isset($order->status))
                                                @if ($order->status == 'completed')
                                                    <div class="dot-label bg-success ml-1"></div>
                                                    <h6>{{ $order->status }}</h6>
                                                @elseif($order->status == 'pending')
                                                    <div class="dot-label bg-warning "></div>
                                                    <h6>{{ $order->status }}</h6>
                                                @elseif ($order->status == 'approved')
                                                    <div class="dot-label bg-primary"></div>
                                                    <h6>{{ $order->status }}</h6>
                                                @elseif ($order->status == 'cancelld')
                                                    <div class="dot-label bg-danger"> </div>
                                                    <h6>{{ $order->status }}</h6>
                                                @endif
                                            @else
                                                no status founded
                                            @endif


                                        </td>
                                        <td>{{ $order->created_at }}</td>
                                        <td class="text-success">
                                            {{ $order->total }}
                                        </td>
                                        <td>
                                            <div class="float-center pt-5">
                                                <a href="{{ route('order-details', $order->id) }}" target="_blank"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="las la-search"></i>
                                                </a>
                                            </div>

                                        </td>


                                    </tr>
                                </div>
                            @endforeach
                        @else
                        @endif


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- row close -->

<!-- row opened -->
{{-- <div class="row row-sm row-deck">
    <div class="col-md-12 col-lg-4 col-xl-4">
        <div class="card card-dashboard-eight pb-2">
            <h6 class="card-title">Your Top Countries</h6><span class="d-block mg-b-10 text-muted tx-12">Sales
                performance revenue based by country</span>
            <div class="list-group">
                <div class="list-group-item border-top-0">
                    <i class="flag-icon flag-icon-us flag-icon-squared"></i>
                    <p>United States</p><span>$1,671.10</span>
                </div>
                <div class="list-group-item">
                    <i class="flag-icon flag-icon-nl flag-icon-squared"></i>
                    <p>Netherlands</p><span>$1,064.75</span>
                </div>
                <div class="list-group-item">
                    <i class="flag-icon flag-icon-gb flag-icon-squared"></i>
                    <p>United Kingdom</p><span>$1,055.98</span>
                </div>
                <div class="list-group-item">
                    <i class="flag-icon flag-icon-ca flag-icon-squared"></i>
                    <p>Canada</p><span>$1,045.49</span>
                </div>
                <div class="list-group-item">
                    <i class="flag-icon flag-icon-in flag-icon-squared"></i>
                    <p>India</p><span>$1,930.12</span>
                </div>
                <div class="list-group-item border-bottom-0 mb-0">
                    <i class="flag-icon flag-icon-au flag-icon-squared"></i>
                    <p>Australia</p><span>$1,042.00</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-8 col-xl-8">
        <div class="card card-table-two">
            <div class="d-flex justify-content-between">
                <h4 class="card-title mb-1">Your Most Recent Earnings</h4>
                <i class="mdi mdi-dots-horizontal text-gray"></i>
            </div>
            <span class="tx-12 tx-muted mb-3 ">This is your most recent earnings for today's date.</span>
            <div class="table-responsive country-table">
                <table class="table table-striped table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap">
                    <thead>
                        <tr>
                            <th class="wd-lg-25p">Date</th>
                            <th class="wd-lg-25p tx-right">Sales Count</th>
                            <th class="wd-lg-25p tx-right">Earnings</th>
                            <th class="wd-lg-25p tx-right">Tax Witheld</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>05 Dec 2019</td>
                            <td class="tx-right tx-medium tx-inverse">34</td>
                            <td class="tx-right tx-medium tx-inverse">$658.20</td>
                            <td class="tx-right tx-medium tx-danger">-$45.10</td>
                        </tr>
                        <tr>
                            <td>06 Dec 2019</td>
                            <td class="tx-right tx-medium tx-inverse">26</td>
                            <td class="tx-right tx-medium tx-inverse">$453.25</td>
                            <td class="tx-right tx-medium tx-danger">-$15.02</td>
                        </tr>
                        <tr>
                            <td>07 Dec 2019</td>
                            <td class="tx-right tx-medium tx-inverse">34</td>
                            <td class="tx-right tx-medium tx-inverse">$653.12</td>
                            <td class="tx-right tx-medium tx-danger">-$13.45</td>
                        </tr>
                        <tr>
                            <td>08 Dec 2019</td>
                            <td class="tx-right tx-medium tx-inverse">45</td>
                            <td class="tx-right tx-medium tx-inverse">$546.47</td>
                            <td class="tx-right tx-medium tx-danger">-$24.22</td>
                        </tr>
                        <tr>
                            <td>09 Dec 2019</td>
                            <td class="tx-right tx-medium tx-inverse">31</td>
                            <td class="tx-right tx-medium tx-inverse">$425.72</td>
                            <td class="tx-right tx-medium tx-danger">-$25.01</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> --}}
<!-- /row -->
</div>
</div>
<!-- Container closed -->


</div>
