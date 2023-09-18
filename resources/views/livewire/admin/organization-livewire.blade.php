<div>
    <div class="row">
        <div class="col-xl-12">
            @if (session()->has('message'))
                <h5 class="alert alert-success">{{ session('message') }}</h5>
            @endif
            <div class="card">
                <div class="card-header pb-0 ">
                    <div class="d-flex justify-content-between">
                        {{-- <h4 class="card-title mg-b-0">Organization Table </h4> --}}
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn btn-outline-primary float-end" data-bs-toggle="modal"
                            data-bs-target="#orgModal"><i class="fas fa-plus "></i>
                            Add Organization
                        </button>
                        <div class="pb-3">
                            <input type="search" wire:model="search" class="form-control float-end mx-2"
                            placeholder="Search... name" style="width: 230px;" />
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>




    <div class="row">
        @if (isset($organizations) && count($organizations))
            @foreach ($organizations as $organize)
                <div class="col-xl-4 col-md-4">
                    <div class="card custom-card text-center">
                        @if (isset($organize->media->path))
                            <img style="height: 200px ;wight:200px" class="card-img-top w-100" src="{{ $organize->media->path }}" alt="imge">
                        @else
                            no image
                        @endif
                        <div class="card-body">
                            <h3 class="card-title text-primary">{{ $organize->organizations_name }}</h3>
                            <h6><span class="text-muted">Acount :</span><span class="text-info"> {{ $organize->organizations_bank_account }}</span></h6>
                            <h6><span class="text-muted">Phone :</span>  <span class="text-info"> {{ $organize->organizations_phone }}</span> </h6>
                            <p class="card-text">{{ $organize->organizations_txt_body }}
                            </p>
                            <a class="btn ripple btn-outline-secondary btn-sm" href="{{ $organize->url }}">Go To
                                Link </a>
                        </div>
                        <div class=" flex-row d-flex justify-content-center mb-2">
                            <a href="#" class="btn btn-sm btn-info" data-bs-toggle="modal"
                            data-bs-target="#updateOrgModal" wire:click="editOrg({{ $organize->id }})">
                            <i class="las la-pen"></i>Update
                        </a><br>
                        <div class="m-1"></div>
                        <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteOrgModal" wire:click="deleteOrg({{ $organize->id }})">
                            <i class="las la-trash"></i>Delete
                        </a>
                        </div>

                    </div>

                </div>
            @endforeach
        @else
            <div class="text-center">
                No organize founded
            </div>
        @endif
        <div class="text-center p-2">
            {{ $organizations->links() }}
        </div>
    </div>




    <!-- Insert Modal -->
    <div wire:ignore.self class="modal fade" id="orgModal" tabindex="-1" aria-labelledby="orgModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Create Organization </h6><button wire:click="closeModal" aria-label="Close"
                        class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="saveOrg">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label> Name</label>
                            <input type="text" wire:model="organizations_name" class="form-control">
                            @error('organizations_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label> descreption</label>
                            <textarea placeholder="" cols="4" wire:model="organizations_txt_body" class="form-control"></textarea>
                            @error('organizations_txt_body')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Phone</label>
                            <input type="text" wire:model="organizations_phone" class="form-control">
                            @error('organizations_phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>URL</label>
                            <input type="text" wire:model="url" class="form-control">
                            @error('url')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Account</label>
                            <input type="text" wire:model="organizations_bank_account" class="form-control">
                            @error('organizations_bank_account')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile01"
                                        wire:model="image_file" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose Image </label>
                                </div>
                            </div>
                            @error('image_file')
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







    <!-- Update Main Category Modal -->
    <div wire:ignore.self class="modal fade" id="updateOrgModal" tabindex="-1"
        aria-labelledby="updateOrgModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Edit Organization </h6><button wire:click="closeModal" aria-label="Close"
                        class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="updateOrg">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label> Name</label>
                            <input type="text" wire:model="organizations_name" class="form-control">
                            @error('organizations_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label> descreption</label>
                            <textarea placeholder="" cols="4" wire:model="organizations_txt_body" class="form-control"></textarea>
                            @error('organizations_txt_body')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Phone</label>
                            <input type="text" wire:model="organizations_phone" class="form-control">
                            @error('organizations_phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>URL</label>
                            <input type="text" wire:model="url" class="form-control">
                            @error('url')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Account</label>
                            <input type="text" wire:model="organizations_bank_account" class="form-control">
                            @error('organizations_bank_account')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile01"
                                        wire:model="image_file_update" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose Image </label>
                                </div>
                            </div>
                            @error('image_file_update')
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




    <!-- Delete  Organization Modal -->
    <div wire:ignore.self class="modal fade" id="deleteOrgModal" tabindex="-1"
        aria-labelledby="deleteOrgModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h6 class="modal-title">Delete Organization </h6><button wire:click="closeModal"
                        aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="destroyOrg">
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
