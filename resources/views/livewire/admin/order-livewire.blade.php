<div>
    {{-- Stop trying to control. --}}



    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <!-- Shopping Cart-->
                    <div class="product-details table-responsive text-nowrap">
                        <table class="table table-bordered table-hover mb-0 text-nowrap table-striped   ">
                            <thead>
                                @if (isset($orders) && $orders->count() > 0)
                                <tr>
                                    <th>ID</th>
                                    <th class="text-right">User</th>
                                    <th class="text-right">Business</th>
                                    <th class="w-150">Address</th>
                                    <th>Status</th>
                                    <th>created at</th>
                                    <th colspan="2">Action</th>
                                </tr>
                                @else

                                @endif

                            </thead>
                            <tbody>
                                @if (isset($orders) && $orders->count() > 0)
                                    @foreach ($orders as $order)
                                    <a href="{{route('order-details',$order->id)}}">
                                        <div>
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td>
                                                    <div class="media">
                                                        <a href="{{ route('user-details', $order->user->id) }}">
                                                            <div class="card-aside-img">
                                                                <img src="{{ $order->user->profile_photo_path }}"
                                                                    alt="img"  class="rounded-circle avatar-md mr-2 ">
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
                                                <td>
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
                                                                    {{ $order->businessInfo->legal_name }}
                                                                </h6>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center text-lg text-medium">
                                                    <dl class="card-item-desc-1">
                                                        {{-- <dt>Address </dt> --}}
                                                        <dd><strong>{{ $order->address->city }}</strong></dd>
                                                        ,
                                                        <dd><strong>{{ $order->address->country }}</strong></dd>
                                                        <br>
                                                        <dd>{{ $order->address->landmark }}</dd>
                                                        <mark>landmark</mark>
                                                        <br>
                                                        <dd>{{ $order->address->building }}</dd>
                                                        <mark>building</mark>
                                                        <br>
                                                        <dd>{{ $order->address->floor }}</dd>
                                                        <mark>floor</mark>
                                                        <br>
                                                        <dd>{{ $order->address->flat }}</dd>
                                                        <mark>flat</mark>
                                                    </dl>
                                                </td>
                                                <td class="text-center text-lg text-medium">

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
                                                </td>
                                                <td>{{$order->created_at}}</td>
                                                <td>
                                                    <a href="{{route('order-details',$order->id)}}" target="_blank" class="btn btn-sm btn-primary">
                                                        <i class="las la-search"></i>
                                                    </a>
                                                </td>
                                                <td class="text-center"><a class="remove-from-cart" href="#" wire:click='deleteOrder({{$order->id}})'
                                                        data-toggle="deleteOrderModal" title="" data-bs-target="#deleteOrderModal"  data-bs-toggle="modal"
                                                        data-original-title="Remove Order"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        </div>

                                    </a>

                                    @endforeach
                                @else
                                <div class="tx-center ">
                                  <h5>! No Order Founded Yet</h5>
                                </div>
                                @endif

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>




<!-- Delete Order Modal -->
<div wire:ignore.self class="modal fade" id="deleteOrderModal" tabindex="-1" aria-labelledby="deleteOrderModal"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Delete Order</h6><button wire:click="closeModal" aria-label="Close"
                    class="close" data-bs-dismiss="modal" type="button"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form wire:submit.prevent="destroyOrder">
                <div class="modal-body">
                    <h4>?Are you sure you want to delete this data </h4>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Yes! Delete</button>
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>

                </div>
            </form>
        </div>
    </div>
</div>





</div>
</div>
</div>
