<div>


    <div class="col-xl-12">
        @if (session()->has('message'))
            <h5 class="alert alert-success">{{ session('message') }}</h5>
        @endif
        <div class="card">
            <div class="card-header pb-0 ">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0"> Subbscription Package Table </h4>


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
                                        <span class="text-white"> Packages</span>
                                        <h2 class="text-white mb-0">{{ $countPackages }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-outline-primary float-end" data-bs-toggle="modal"
                        data-bs-target="#addPackage"><i class="fas fa-plus "></i>
                        Add Package
                    </button>
                    {{-- <input type="search" wire:model="search" class="form-control float-end mx-2"
                        placeholder="Search...Title" style="width: 230px" /> --}}
                </div>



            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped mg-b-0 text-md-nowrap">
                        <thead style="background-color:rgb(210, 228, 228)">
                            @if (isset($packages) && count($packages) > 0)
                                <tr>
                                    <th class="tx-20 " style="color:rgb(124, 126, 6)">ID</th>
                                    <th class="tx-20 " style="color:rgb(124, 126, 6)"> Name</th>
                                    <th class="tx-20 " style="color:rgb(124, 126, 6)"> Main Categories</th>
                                    <th class="tx-20 " style="color:rgb(124, 126, 6)">Created at</th>
                                    <th class="tx-20 " style="color:rgb(124, 126, 6)">Actions</th>
                                </tr>
                            @else
                                <div class="tx-center">
                                    <h1 class="text-muted">Add Subscription Package Now</h1>
                                </div>
                            @endif

                        </thead>
                        <tbody>
                            @if (isset($packages) && count($packages) > 0)
                                @foreach ($packages as $pkg)
                                    <tr>
                                        <th scope="row">{{ $pkg->id }}</th>
                                        <td>{{ $pkg->pkg_name }}</td>
                                        @if (isset( $pkg->mainCategory->main_categories_title))
                                        <td> {{ $pkg->mainCategory->main_categories_title }}</td>
                                        @else
                                        <td> no main category title </td>
                                        @endif

                                        <td> {{ $pkg->created_at }}</td>
                                        <td class="pt-5">
                                            <a href="#" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                                data-bs-target="#updateSubscription"
                                                wire:click="editPkg({{ $pkg->id }})">
                                                <i class="las la-pen"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deletePkg" wire:click="deletePkg({{ $pkg->id }})">
                                                <i class="las la-trash"></i>
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach

                            @endif

                        </tbody>
                    </table>
                    <div class="text-center p-2">
                        {{-- {{ $packages->links() }} --}}
                    </div>
                </div><!-- bd -->
            </div><!-- bd -->
        </div><!-- bd -->
    </div>






    <!-- Insert Modal -->
    <div wire:ignore.self class="modal fade" id="addPackage" tabindex="-1" aria-labelledby="addPackage"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Create Package</h6><button wire:click="closeModal" aria-label="Close"
                        class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="savePkg">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Package Name</label>
                            <input type="number" wire:model="pkg_name" class="form-control" step="0.01">
                            @error('pkg_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Select Main Category</label>
                            <select class="form-control" wire:model="main_categories_id">
                                <option selected="selected">
                                    select Category
                                </option>
                                @foreach ($main_categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->main_categories_title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('main_categories_id')
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


    <!-- Update  Category Modal -->
    <div wire:ignore.self class="modal fade" id="updateSubscription" tabindex="-1" aria-labelledby="updateSubscription"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Edit Package</h6><button wire:click="closeModal" aria-label="Close"
                        class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="updatePkg">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Package Name</label>
                            <input type="number" wire:model="pkg_name" class="form-control" step="0.01">
                            @error('pkg_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="mb-3">
                            <label>Select Main Category</label>
                            <select class="form-control" wire:model="main_categories_id">
                                <option selected="selected">
                                    select Category
                                </option>
                                @foreach ($main_categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->main_categories_title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('main_categories_id')
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

    <!-- Delete Main Category Modal -->
    <div wire:ignore.self class="modal fade" id="deletePkg" tabindex="-1" aria-labelledby="deletePkg"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Delete Package</h6><button wire:click="closeModal" aria-label="Close"
                        class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="destroyPkg">
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
