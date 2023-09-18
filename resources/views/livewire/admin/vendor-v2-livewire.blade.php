<div>

    <div>
        <!--div-->
        <div class="col-xl-12">
            @if (session()->has('message'))
                <h5 class="alert alert-success">{{ session('message') }}</h5>
            @endif

            <div class="row row-sm">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
                    <div class="card">
                        <div class="card-header pb-0 ">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title mg-b-0">Vendors Table </h4>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-outline-primary float-end" data-bs-toggle="modal"
                                    data-bs-target="#vendorModal"><i class="fas fa-plus "></i>
                                    Add New Vendor
                                </button>
                                <input type="search" wire:model="search" class="form-control float-end mx-2"
                                    placeholder="Search...name" style="width: 230px" />
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive border-top userlist-table">
                                <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                                    <thead style="background-color:rgb(210, 228, 228)">
                                        <tr>
                                            <th class="wd-lg-8p "><span class="tx-20 "
                                                    style="color:rgb(124, 126, 6)">Id</span></th>
                                            <th class="wd-lg-8p tx-center"><span class="tx-20 "
                                                    style="color:rgb(124, 126, 6)">User</span></th>

                                            <th class="wd-lg-20p"><span class="tx-20 "
                                                    style="color:rgb(124, 126, 6)"></span></th>
                                                    <th class="wd-lg-8p text-center"><span class="tx-20 "
                                                        style="color:rgb(124, 126, 6)">Category</span></th>
                                            <th class="wd-lg-20p tx-center"><span class="tx-20 "
                                                    style="color:rgb(124, 126, 6)">Legal Name </span></th>
                                            <th class="wd-lg-20p tx-center"><span class="tx-20 "
                                                    style="color:rgb(124, 126, 6)">Logo </span></th>
                                            <th class="wd-lg-20p tx-center"><span class="tx-20 "
                                                    style="color:rgb(124, 126, 6)">Cover</span></th>
                                            <th class="wd-lg-20p"><span class="tx-20 "
                                                    style="color:rgb(124, 126, 6)">Created</span></th>
                                            <th class="wd-lg-20p" colapse='2'> <span class="tx-20 "
                                                    style="color:rgb(124, 126, 6)"> Action</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($businessInfo) && count($businessInfo) > 0)
                                            @foreach ($businessInfo as $bInfo)
                                                <tr>
                                                    <td>{{ $bInfo->id }}</td>
                                                    <td>
                                                        <a href="{{ route('user-details', $bInfo->id) }}">
                                                            <img alt="" class="rounded-circle avatar-md mr-2 "
                                                                src="{{ $bInfo->profile_photo_path }}">
                                                        </a>

                                                    </td>
                                                    <td> <a href="{{ route('user-details', $bInfo->id) }}"><span
                                                                class="tx-30">{{ $bInfo->name }}</span></a> </td>
                                                    <td>
                                                        @if (isset($bInfo->categories_title))
                                                        <span class="tx-20 text-center">{{ $bInfo->categories_title }}</span>
                                                        @else
                                                        <span class="tx-20 text-center"> un select category </span>
                                                        @endif

                                                    </td>
                                                    <td>
                                                        @if (isset($bInfo->legal_name ))
                                                        <span class="tx-20">{{$bInfo->legal_name }}</span>
                                                        @else
                                                        <span class="tx-20">un selected legal name</span>
                                                        @endif

                                                    </td>


                                                    <td class="text-center">
                                                        @if (empty($bInfo->logoMedia->path))
                                                            Un selected Image
                                                        @else
                                                            <img src="{{ $bInfo->logoMedia->path }}"
                                                                alt="no image" style="width: 100px ; height: 100px;">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (empty($bInfo->coverMedia->path))
                                                            Un selected Image
                                                        @else
                                                            <img src="{{ $bInfo->coverMedia->path }}"
                                                                alt="no image" style="width: 100px ; height: 100px;">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ date('d/m/Y', strtotime($bInfo->created_at)) }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('user-details', $bInfo->id) }}"
                                                            class="btn btn-sm btn-primary">
                                                            <i class="las la-search"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-sm btn-info"
                                                            data-bs-toggle="modal" data-bs-target="#updateVendorModal"
                                                            wire:click="editVendor({{ $bInfo->id }})">
                                                            <i class="las la-pen"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-sm btn-danger"
                                                        data-bs-toggle="modal" data-bs-target="#deleteVendorModal"
                                                        wire:click="deleteVendor({{ $bInfo->id }})">
                                                        <i class="las la-trash"></i>
                                                    </a>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                <div class="text-center p-2">
                                    {{ $businessInfo->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- COL END -->
            </div>
        </div><!-- bd -->
    </div>
    <!--/div-->





    <!-- Insert Modal -->
    <div wire:ignore.self class="modal fade" id="vendorModal" tabindex="-1" aria-labelledby="vendorModal"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Create Vendor</h6><button wire:click="closeModal" aria-label="Close"
                        class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="saveVendor">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>User Name</label>
                            <input type="text" wire:model="name" class="form-control">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label> Email</label>
                            <input type="email" wire:model="email" class="form-control" placeholder="email"
                                autocomplete='false'>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Password</label>
                            <input type="password" class="form-control" wire:model='password'
                                autocomplete='new-password' placeholder="Password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Legal Name</label>
                            <input type="text" wire:model="legal_name" class="form-control">
                            @error('legal_name')
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
                                        wire:model="logo_media" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="inputGroupFile01">Logo Photo </label>
                                </div>
                            </div>
                            @error('logo_media')
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
                                        wire:model="cover_media" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="inputGroupFile01">Cover Photo </label>
                                </div>
                            </div>
                            @error('cover_media')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Select Category</label>
                            <select class="form-control" wire:model="category_id">
                                <option selected="selected">
                                    select Category
                                </option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->categories_title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
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


    <!-- Update User Modal -->
    <div wire:ignore.self class="modal fade" id="updateVendorModal" tabindex="-1"
        aria-labelledby="updateVendorModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Edit Vendor</h6><button wire:click="closeModal" aria-label="Close"
                        class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="updateVendor">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>User Name</label>
                            <input type="text" wire:model="name" class="form-control">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label> Email</label>
                            <input type="email" wire:model="email" class="form-control" placeholder="email"
                                autocomplete='false'>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- <div class="mb-3">
                            <label for="">Password</label>
                            <input type="password" class="form-control" wire:model='password'
                                autocomplete='new-password' placeholder="Password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> --}}
                        <div class="mb-3">
                            <label>Legal Name</label>
                            <input type="text" wire:model="legal_name" class="form-control">
                            @error('legal_name')
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
                                        wire:model="update_logo_media" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="inputGroupFile01">Logo Photo </label>
                                </div>
                            </div>
                            @error('update_logo_media')
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
                                        wire:model="update_cover_media" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="inputGroupFile01">Cover Photo </label>
                                </div>
                            </div>
                            @error('update_cover_media')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Select Category</label>
                            <select class="form-control" wire:model="category_id">
                                <option selected="selected">
                                    Select Category
                                </option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->categories_title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
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

    <!-- Delete Vendor Modal -->
    <div wire:ignore.self class="modal fade" id="deleteVendorModal" tabindex="-1"
        aria-labelledby="deleteUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Delete Vendor</h6><button wire:click="closeModal" aria-label="Close"
                        class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="destroyVendor">
                    <div class="modal-body">
                        <h4>?Are you sure you want to delete this Vendor </h4>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Yes! Delete</button>
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
