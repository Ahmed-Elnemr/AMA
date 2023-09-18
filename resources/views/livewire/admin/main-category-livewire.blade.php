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
                <div class="float-left" >
                    <div class="card bg-info-gradient text-white" >
                        <div class="card-body">
                            <div class="row" >
                                <div class="col-4">
                                    <div class="icon1 mt-2 text-center">
                                        <i class="fe fe-bar-chart-2 tx-40"></i>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="mt-0 text-center">
                                        <span class="text-white">Main Categories</span>
                                        <h2 class="text-white mb-0">{{$allMain}}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="button" class="btn btn-outline-primary float-end" data-bs-toggle="modal"
                        data-bs-target="#mCatModal"><i class="fas fa-plus "></i>
                        Add Main Category
                    </button>
                    <input type="search" wire:model="search" class="form-control float-end mx-2"
                        placeholder="Search... Title" style="width: 230px;" />
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped mg-b-0 text-md-nowrap">
                        @if (isset($main_categories) && count($main_categories) > 0)
                        <thead style="background-color:rgb(210, 228, 228)" >
                            <tr>
                                <th class="tx-20 " style="color:rgb(124, 126, 6)">ID</th>
                                <th class="tx-20 " style="color:rgb(124, 126, 6)"> Title</th>
                                <th class="tx-20 " style="color:rgb(124, 126, 6)"> Body</th>
                                <th class="tx-20 " style="color:rgb(124, 126, 6)">Created</th>
                                <th class="tx-20 " style="color:rgb(124, 126, 6)">Image</th>
                                <th class="tx-20 " style="color:rgb(124, 126, 6)" colapse='2'>Actions</th>
                            </tr>
                        </thead>
                        @else
                        <div class="tx-center">
                            <h1 class="text-muted">Add Main Category Now</h1>
                        </div>
                        @endif

                        <tbody>
                            @if (isset($main_categories) && count($main_categories) > 0)
                                @foreach ($main_categories as $category)
                                    <tr>
                                        <th scope="row">{{ $category->id }}</th>
                                        <td>{{ $category->main_categories_title }}</td>
                                        <td> {{ $category->main_categories_body }}</td>
                                        <td>{{ $category->created_at}}</td>
                                        <td>
                                            @if (empty($category->media->path))
                                                Un selected Image
                                            @else
                                                <img src="{{ $category->media->path }}" alt="no image"
                                                    style="width: 100px ; height: 100px;">
                                                {{-- {{URL::asset('{{$category->media->path}}')}} --}}
                                            @endif
                                        </td>
                                        <td class="pt-5">
                                            <a href="#" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                                data-bs-target="#updateMcatModal"
                                                wire:click="editMcat({{ $category->id }})">
                                                <i class="las la-pen"></i>
                                            </a>

                                            <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteMcatModal"
                                                wire:click="deleteMcat({{ $category->id }})">
                                                <i class="las la-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="text-center p-2">
                        {{ $main_categories->links() }}
                    </div>
                </div><!-- bd -->
            </div><!-- bd -->
        </div><!-- bd -->
    </div>
    <!--/div-->







    <!-- Insert Modal -->
    <div wire:ignore.self class="modal fade" id="mCatModal" tabindex="-1" aria-labelledby="mCatModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Create Main Category</h6><button wire:click="closeModal" aria-label="Close"
                        class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="saveMcat">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Category Title</label>
                            <input type="text" wire:model="main_categories_title" class="form-control">
                            @error('main_categories_title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Category Body</label>
                            <input type="text" wire:model="main_categories_body" class="form-control">
                            @error('main_categories_body')
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
                        <button type="button" class="btn btn-secondary" wire:click="closeModal"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Update Main Category Modal -->
    <div wire:ignore.self class="modal fade" id="updateMcatModal" tabindex="-1" aria-labelledby="updateMcatModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Edit Main Category</h6><button wire:click="closeModal" aria-label="Close"
                        class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="updateMcat">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Category Title</label>
                            <input type="text" wire:model="main_categories_title" class="form-control">
                            @error('main_categories_title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Category Body</label>
                            <input type="text" wire:model="main_categories_body" class="form-control">
                            @error('main_categories_body')
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
                            @error('image_file')
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
    <div wire:ignore.self class="modal fade" id="deleteMcatModal" tabindex="-1"
        aria-labelledby="deleteMcatModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h6 class="modal-title">Delete Main Category</h6><button wire:click="closeModal"
                        aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="destroyMcat">
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
