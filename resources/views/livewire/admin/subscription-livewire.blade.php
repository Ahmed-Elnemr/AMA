<div>
    <!--div-->
    <div class="col-xl-12">
        @if (session()->has('message'))
            <h5 class="alert alert-success">{{ session('message') }}</h5>
        @endif
        <div class="card">
            <div class="card-header pb-0 ">
                <div class="d-flex justify-content-between">
                    {{-- <h4 class="card-title mg-b-0">Main Categories Table </h4> --}}
                </div>
                <div class="float-left">
                    <div class="card bg-info-gradient text-white">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="icon1 mt-2 text-center">
                                        <i class="fe fe-bar-chart-2 tx-40"></i>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="mt-0 text-center">
                                        <span class="text-white">Total Subscription</span>
                                        <h2 class="text-white mb-0">{{ $subCountUser }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="button" class="btn btn-outline-primary float-end" data-bs-toggle="modal"
                        data-bs-target="#subModal"><i class="fas fa-plus "></i>
                        Add Subscription Package
                    </button>

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped mg-b-0 text-md-nowrap">
                        @if (isset($subscriptions) && count($subscriptions) > 0)
                            <thead style="background-color:rgb(210, 228, 228)">
                                <tr>
                                    <th class="tx-18 " style="color:rgb(124, 126, 6)">ID</th>
                                    <th class="tx-18 " style="color:rgb(124, 126, 6)"> pkg name</th>
                                    <th class="tx-18 " style="color:rgb(124, 126, 6)"> Start</th>
                                    <th class="tx-18 " style="color:rgb(124, 126, 6)">End</th>
                                    <th class="tx-18 " style="color:rgb(124, 126, 6)">Days</th>
                                    <th class="tx-18 " style="color:rgb(124, 126, 6)">Business</th>
                                    <th class="tx-18 " style="color:rgb(124, 126, 6)">Created At</th>
                                    <th class="tx-18 " style="color:rgb(124, 126, 6)" colapse='2'>Actions</th>
                                </tr>
                            </thead>
                        @else
                            <div class="tx-center">
                                <h1 class="text-muted">Add Main Category Now</h1>
                            </div>
                        @endif

                        <tbody>
                            @if (isset($subscriptions)  && count($subscriptions) > 0)
                                @foreach ($subscriptions as $sub)
                                    <tr>
                                        {{-- @if (isset($pkgs))

                                        @endif --}}
                                        <th scope="row">{{ $sub->id }}</th>
                                        @if (empty($sub->subscriptionPkg->pkg_name ) )
                                        <td>Package Deleted</td>
                                        @else
                                        <td>{{ $sub->subscriptionPkg->pkg_name }}</td>
                                        @endif

                                        <td>{{ $sub->subscription_start }}</td>
                                        <td>{{ $sub->subscription_end }}</td>
                                        <td>{{ $sub->duration_in_days }}</td>
                                        <td>{{ $sub->business_information_id }}</td>
                                        <td>{{ $sub->created_at }}</td>
                                        <td class="pt-5">
                                            <a href="#" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                                data-bs-target="#updateSubscription"
                                                wire:click="editSubscription({{ $sub->id }})">
                                                <i class="las la-pen"></i>
                                            </a>

                                            <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteSubscription"
                                                wire:click="deleteSub({{ $sub->id }})">
                                                <i class="las la-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="text-center p-2">
                        {{-- {{ $subscriptions->links() }} --}}
                    </div>
                </div><!-- bd -->
            </div><!-- bd -->
        </div><!-- bd -->
    </div>
    <!--/div-->







    <!-- Insert Modal -->
    <div wire:ignore.self class="modal fade" id="subModal" tabindex="-1" aria-labelledby="subModal"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Create Subscription Package</h6><button wire:click="closeModal"
                        aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="saveSubscription">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label> Start Date </label>
                            <input type="date" wire:model="subscription_start" class="form-control ">
                            @error('subscription_start')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label> End Date </label>
                            <input type="date" wire:model="subscription_end" class="form-control ">
                            @error('subscription_end')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="">Duration In Days</label>
                            <input type="number" wire:model="duration_in_days" class="form-control">
                            @error('duration_in_days')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">  subscription_pkg_id</label>
                            <select class="form-control" wire:model="subscription_pkg_id">
                                <option selected="selected">
                                    select subscription Packges
                                </option>
                                @if (isset($pkgs) && $pkgs->count() > 0)
                                    @foreach ($pkgs as $pkg)
                                        <option value={{ $pkg->id }}>{{ $pkg->pkg_name }}</option>
                                    @endforeach
                                @else
                                    no subscription pkgs founded
                                @endif
                            </select>
                            @error('subscription_pkg_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Update Main Category Modal -->
    <div wire:ignore.self class="modal fade" id="updateSubscription" tabindex="-1" aria-labelledby="updateSubscription"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Edit Subscription Package</h6><button wire:click="closeModal" aria-label="Close"
                        class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="updateSubscription">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label> Start Date </label>
                            <input type="date" wire:model="subscription_start" class="form-control ">
                            @error('subscription_start')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label> End Date </label>
                            <input type="date" wire:model="subscription_end" class="form-control ">
                            @error('subscription_end')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="">Duration In Days</label>
                            <input type="number" wire:model="duration_in_days" class="form-control">
                            @error('duration_in_days')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">  subscription_pkg_id</label>
                            <select class="form-control" wire:model="subscription_pkg_id">
                                <option selected="selected">
                                    select subscription Packges
                                </option>
                                @if (isset($pkgs) && $pkgs->count() > 0)
                                    @foreach ($pkgs as $pkg)
                                        <option value={{ $pkg->id }}>{{ $pkg->pkg_name }}</option>
                                    @endforeach
                                @else
                                    no subscription pkgs founded
                                @endif
                            </select>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary" wire:click="closeModal"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Main Category Modal -->
    <div wire:ignore.self class="modal fade" id="deleteSubscription" tabindex="-1"
        aria-labelledby="deleteSubscription" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h6 class="modal-title">Delete Subbscription  Package</h6><button wire:click="closeModal"
                        aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="destroySub">
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
