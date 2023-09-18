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
                    <div class="text-center">
                        <button type="button" class="btn btn-outline-primary float-end" data-bs-toggle="modal"
                            data-bs-target="#offerModal"><i class="fas fa-plus "></i>
                            Add New Offer
                        </button>
                        <div class="mb-2">
                            <input type="search" wire:model="search" class="form-control float-end mx-2"
                                placeholder="Search...offer title" style="width: 230px" />
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row row-cards row-deck">
        @if (isset($offers) && $offers->count() > 0)
            @foreach ($offers as $offer)
                <div class="col-sm-12 col-lg-6">
                    <div class="card">
                        @if (isset($offer->media->path))
                            <img style="height:250px" src="{{ $offer->media->path }}" alt="">
                        @else
                        @endif

                        <div class="card-header pb-0">
                            <div class="card-title pb-0  mb-2 float-left text-muted">id: {{ $offer->id }}</div>
                            <div class="card-title pb-0   mb-2">{{ $offer->businessInfo->legal_name }}</div>
                           <div class="card-title pb-0  float-left mb-2"><span class="text-muted">discount :</span> <span class="text-danger tx-30">{{ $offer->offers_discount }}</span>  <span class="text-muted tx-5">EGP</span>  </div>

                            <p class="tx-20  mb-3 text-info">{{ $offer->offers_title }}</p>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col border-right text-center">
                                    <label class="tx-20 text-primary"> Start in</label>
                                    <p class="font-weight-bold tx-15">{{ $offer->offers_start }}</p>
                                </div><!-- col -->
                                <div class="col border-right text-center">
                                    <label class="tx-20   text-primary">End in</label>
                                    <p class="font-weight-bold tx-15">{{ $offer->offers_end }}</p>
                                </div><!-- col -->
                                <div class="col text-center border-right ">
                                    <label class="tx-20   text-primary">Code</label>
                                    <p class="font-weight-bold tx-15 ">{{ $offer->offers_code }}</p>
                                </div><!-- col -->
                                <div class="col border-right text-center">
                                    <label class="tx-20  text-primary">Limit</label>
                                    <p class="font-weight-bold tx-15">{{ $offer->offers_limits }}</p>
                                </div><!-- col -->
                                <div class="col border-right text-center ">
                                    {{-- <label class="tx-20">Created By Admin</label> --}}
                                   <span class="text-primary">Created By Admin</span>   <p>{{ Auth::user()->name }}</p>
                                    <label class="tx-15 text-primary">Created at</label>
                                    <p class="font-weight-bold tx-10">{{ $offer->created_at }}</p>
                                </div><!-- col -->
                            </div><!-- row -->
                            {{-- <div class="progress ht-20 mt-4">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary ht-20 w-50">50%</div>
                    </div> --}}
                            <div class="text-center">
                                <a href="#" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                    data-bs-target="#updateOfferModal" wire:click="editOffer({{ $offer->id }})">
                                    <i class="las la-pen"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteOfferModal" wire:click="deleteOffer({{ $offer->id }})">
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
                    No Offers Founded
                </h6>
            </div>

        @endif



    </div>
    <div class="text-center p-2">
        {{ $offers->links() }}
    </div>
    {{-- ####################### --}}


    <!-- Insert Modal -->
    <div wire:ignore.self class="modal fade" id="offerModal" tabindex="-1" aria-labelledby="offerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Create Offer</h6><button wire:click="closeModal" aria-label="Close"
                        class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="saveOffer">
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for=""> Title</label>
                            <input type="text" class="form-control" wire:model='offers_title' placeholder="TITLE">
                            @error('offers_title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label> Code</label>
                            <input type="text" wire:model="offers_code" class="form-control" placeholder="CODE">
                            @error('offers_code')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label> Start Date </label>
                            <input type="date" wire:model="offers_start" class="form-control ">
                            @error('offers_start')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- <div class="mb-3">
                            <label for=""> End Date</label>
                            <input  type="datetime-local" class="form-control " wire:model='offers_end' >
                            @error('offers_end')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> --}}
                        <div class="mb-3">
                            <label for=""> End Date</label>
                            <input type="date" class="form-control " wire:model='offers_end'>
                            @error('offers_end')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label> Discount</label>
                            <input type="number" wire:model="offers_discount" class="form-control">
                            @error('offers_discount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for=""> Limit</label>
                            <input type="number" class="form-control" wire:model='offers_limits'>
                            @error('offers_limits')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for=""> Bussinse Name</label>
                            <select class="form-control" wire:model="business_information_id">
                                <option selected="selected">
                                    select Business Name
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
                        <div class="mb-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile01"
                                        wire:model="media_id" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose Image </label>
                                </div>
                            </div>
                            @error('media_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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


    <!-- Update Offer Modal -->
    <div wire:ignore.self class="modal fade" id="updateOfferModal" tabindex="-1"
        aria-labelledby="updateUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Edit User</h6><button wire:click="closeModal" aria-label="Close"
                        class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="updateOffer">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for=""> Title</label>
                            <input type="text" class="form-control" wire:model='offers_title'
                                placeholder="TITLE">
                            @error('offers_title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label> Code</label>
                            <input type="text" wire:model="offers_code" class="form-control" placeholder="CODE">
                            @error('offers_code')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label> Start Date </label>
                            <input type="date" wire:model="offers_start" class="form-control ">
                            @error('offers_start')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- <div class="mb-3">
                            <label for=""> End Date</label>
                            <input  type="datetime-local" class="form-control " wire:model='offers_end' >
                            @error('offers_end')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> --}}
                        <div class="mb-3">
                            <label for=""> End Date</label>
                            <input type="date" class="form-control " wire:model='offers_end'>
                            @error('offers_end')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label> Discount</label>
                            <input type="number" wire:model="offers_discount" class="form-control">
                            @error('offers_discount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for=""> Limit</label>
                            <input type="number" class="form-control" wire:model='offers_limits'>
                            @error('offers_limits')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for=""> Bussinse Name</label>
                            <select class="form-control" wire:model="business_information_id">
                                <option selected="selected">
                                    select Business Name
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
                        <div class="mb-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile01"
                                        wire:model="media_id" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose Image </label>
                                </div>
                            </div>
                            @error('media_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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

    <!-- Delete offer Modal -->
    <div wire:ignore.self class="modal fade" id="deleteOfferModal" tabindex="-1"
        aria-labelledby="deleteOfferModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Delete Offer</h6><button wire:click="closeModal" aria-label="Close"
                        class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="destroyOffer">
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
