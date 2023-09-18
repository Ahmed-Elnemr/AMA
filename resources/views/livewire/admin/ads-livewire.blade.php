<div>


    <div class="col-12">
        @if (session()->has('message'))
            <h5 class="alert alert-success">{{ session('message') }}</h5>
        @endif
    </div>
    <div class="row row-sm">


        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
            <div class="card">
                <div class="card-header pb-0 ">
                    <div class="d-flex justify-content-between">
                        {{-- <h4 class="card-title mg-b-0">Users Table </h4> --}}
                    </div>
                    <div class="text-center mb-3">
                        <button type="button" class="btn btn-outline-primary float-end" data-bs-toggle="modal"
                            data-bs-target="#adsModal"><i class="fas fa-plus "></i>
                            Add New Ads
                        </button>
                        {{-- <div class="mb-2">
                            <input type="search" wire:model="search" class="form-control float-end mx-2"
                                placeholder="Search...offer title" style="width: 230px" />
                        </div> --}}

                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row row-cards row-deck">
        @if (isset($adss) && $adss->count() > 0)
            @foreach ($adss as $ads)
                <div class="col-sm-12 col-lg-6">
                    <div class="card">
                        @if (isset($ads->businessInfo->logoMedia->path))
                            <img style="height:250px" src="{{ $ads->businessInfo->logoMedia->path }}" alt="">
                        @else
                        @endif

                        <div class="card-header pb-0">
                            <div class="card-title pb-0  mb-2 float-left text-muted">id: {{ $ads->id }}</div>
                            {{-- <div class="card-title pb-0   mb-2">{{ $ads->businessInfo->legal_name }}</div> --}}

                            <p class="tx-20  mb-3 text-success">{{ $ads->businessInfo->legal_name }}</p>
                        </div>
                        <div class="">
                            <a href="{{route('user-details',$ads->user->id)}}">
                                <img alt="" class="rounded-circle avatar-md mr-2 "
                                src="{{ $ads->user->profile_photo_path }}">
                            </a>
                            <SPAN>
                                <a href="{{route('user-details',$ads->user->id)}}"><span class="tx-30">{{ $ads->user->name }}</a></span>
                            </SPAN>
                        </div>

                        <div class="card-body">
                            <div class="row">

                                <div class="col border-right text-center">
                                    <label class="tx-20 text-primary"> Start in</label>
                                    <p class="font-weight-bold tx-15">{{ $ads->start_date }}</p>
                                </div><!-- col -->
                                <div class="col border-right text-center">
                                    <label class="tx-20   text-primary">End in</label>
                                    <p class="font-weight-bold tx-15">{{ $ads->end_date }}</p>
                                </div><!-- col -->
                                <div class="col text-center border-right ">
                                    <label class="tx-20   text-primary">view_count</label>
                                    <p class="font-weight-bold tx-15 ">{{ $ads->view_count }}</p>
                                </div><!-- col -->
                                <div class="col border-right text-center">
                                    <label class="tx-20  text-primary">fund_source</label>
                                    <p class="font-weight-bold tx-15">{{ $ads->fund_source }}</p>
                                </div><!-- col -->

                            </div><!-- row -->
                            <div class="row">
                                <div class="col border-right text-center">
                                    <label class="tx-20  text-primary">fund_amount</label>
                                    <p class="font-weight-bold tx-15">{{ $ads->fund_amount }}</p>
                                </div><!-- col -->
                                <div class="col border-right text-center">
                                    <label class="tx-20  text-primary">day_price</label>
                                    <p class="font-weight-bold tx-15">{{ $ads->day_price }}</p>
                                </div><!-- col -->
                                <div class="col border-right text-center">
                                    <label class="tx-20  text-primary">view_price</label>
                                    <p class="font-weight-bold tx-15">{{ $ads->view_price }}</p>
                                </div><!-- col -->

                            </div>
                            {{-- <div class="progress ht-20 mt-4">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary ht-20 w-50">50%</div>
                    </div> --}}
                            <div class="text-center">
                                <a href="#" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                    data-bs-target="#updateAdsModal" wire:click="editAds({{ $ads->id }})">
                                    <i class="las la-pen"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteAdsModal" wire:click="deleteAds({{ $ads->id }})">
                                    <i class="las la-trash"></i>
                                </a>
                            </div>


                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-center">
                <h6>
                    No Ads Founded
                </h6>
            </div>

        @endif



    </div>
    <div class="text-center p-2">
        {{ $adss->links() }}
    </div>
    {{-- ####################### --}}


    <!-- Insert Modal -->
    <div wire:ignore.self class="modal fade" id="adsModal" tabindex="-1" aria-labelledby="adsModal"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Create Ads</h6><button wire:click="closeModal" aria-label="Close"
                        class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="saveAds">
                    <div class="modal-body">
                        {{-- <input class="form-control" type="datetime-local" name="timestamp" value="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i:s') }}"> --}}
                        <div class="mb-3">
                            <label for=""> Fund Source</label>
                            <input type="text" class="form-control" wire:model='fund_source' placeholder="">
                            @error('fund_source')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for=""> Fund Amount</label>
                            <input type="number" class="form-control" wire:model='fund_amount' placeholder="">
                            @error('fund_amount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label> Start Date </label>
                            <input type="date" wire:model="start_date" class="form-control ">
                            @error('start_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label> End Date </label>
                            <input type="date" wire:model="end_date" class="form-control ">
                            @error('end_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label> day_price</label>
                            <input type="number" wire:model="day_price" class="form-control">
                            @error('day_price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label> view_price</label>
                            <input type="number" wire:model="view_price" class="form-control">
                            @error('view_price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>



                        <div class="mb-3">
                            <label for=""> Bussinse Information</label>
                            <select class="form-control" wire:model="business_profile_id">
                                <option selected="selected">
                                    select Business Info
                                </option>
                                @if (isset($business) && $business->count() > 0)
                                    @foreach ($business as $bu)
                                        <option value={{ $bu->id }}>{{ $bu->legal_name }}</option>
                                    @endforeach
                                @else
                                    no business founded
                                @endif

                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" wire:click="closeModal"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <!-- Update Ads Modal -->
    <div wire:ignore.self class="modal fade" id="updateAdsModal" tabindex="-1" aria-labelledby="updateAdsModal"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Edit User</h6><button wire:click="closeModal" aria-label="Close"
                        class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="updateAds">
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for=""> Fund Source</label>
                            <input type="text" class="form-control" wire:model='fund_source' placeholder="">
                            @error('fund_source')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for=""> Fund Amount</label>
                            <input type="number" class="form-control" wire:model='fund_amount' placeholder="">
                            @error('fund_amount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label> Start Date </label>
                            <input type="date" wire:model="start_date" class="form-control ">
                            @error('start_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label> End Date </label>
                            <input type="date" wire:model="end_date" class="form-control ">
                            @error('end_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label> day_price</label>
                            <input type="number" wire:model="day_price" class="form-control">
                            @error('day_price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label> view_price</label>
                            <input type="number" wire:model="view_price" class="form-control">
                            @error('view_price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>



                        <div class="mb-3">
                            <label for=""> Bussinse Information</label>
                            <select class="form-control" wire:model="business_profile_id">
                                <option selected="selected">
                                    select Business Info
                                </option>
                                @if (isset($business) && $business->count() > 0)
                                    @foreach ($business as $bu)
                                        <option value={{ $bu->id }}>{{ $bu->legal_name }}</option>
                                    @endforeach
                                @else
                                    no business founded
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

    <!-- Delete  ads Modal -->
    <div wire:ignore.self class="modal fade" id="deleteAdsModal" tabindex="-1"
        aria-labelledby="deleteProModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Delete Data</h6><button wire:click="closeModal" aria-label="Close"
                        class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="destroyAds">
                    <div class="modal-body">
                        <h4>?Are you sure you want to delete this data </h4>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Yes! Delete</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            wire:click="closeModal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




</div>
</div>
</div>
