<div>
    <!--div-->
    <div class="col-xl-12">
        @if (session()->has('message'))
            <h5 class="alert alert-success">{{ session('message') }}</h5>
        @endif
        <div class="card">
            <div class="card-header pb-0 ">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0"> Categories Table </h4>


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
                                        <span class="text-white"> Categories</span>
                                        <h2 class="text-white mb-0">{{ $cats }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-outline-primary float-end" data-bs-toggle="modal"
                        data-bs-target="#catModal"><i class="fas fa-plus "></i>
                        Add Category
                    </button>
                    <input type="search" wire:model="search" class="form-control float-end mx-2"
                        placeholder="Search...Title" style="width: 230px" />
                </div>



            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped mg-b-0 text-md-nowrap">
                        <thead style="background-color:rgb(210, 228, 228)">
                            @if (isset($categories) && count($categories) > 0)
                                <tr>
                                    <th class="tx-20 " style="color:rgb(124, 126, 6)">ID</th>
                                    <th class="tx-20 " style="color:rgb(124, 126, 6)"> Title</th>
                                    <th class="tx-20 " style="color:rgb(124, 126, 6)"> Body</th>
                                    {{-- @if (isset( $category->mainCategory->main_categories_title)) --}}
                                    <th class="tx-20 " style="color:rgb(124, 126, 6)">Main Category</th>
                                    {{-- @else --}}
                                    {{-- @endif --}}
                                    <th class="tx-20 " style="color:rgb(124, 126, 6)">Created</th>
                                    <th class="tx-20 " style="color:rgb(124, 126, 6)">Image</th>
                                    <th class="tx-20 " style="color:rgb(124, 126, 6)">Actions</th>
                                </tr>
                            @else
                                <div class="tx-center">
                                    <h1 class="text-muted">Add Category Now</h1>
                                </div>
                            @endif

                        </thead>
                        <tbody>
                            @if (isset($categories) && count($categories) > 0)
                                @foreach ($categories as $category)
                                    <tr>
                                        <th scope="row">{{ $category->id }}</th>
                                        <td>{{ $category->categories_title }}</td>
                                        <td> {{ $category->categories_body }}</td>
                                        @if (isset($category->mainCategory->main_categories_title))
                                        <td> {{ $category->mainCategory->main_categories_title }}</td>
                                        @else
                                        no main category selected
                                        @endif
                                        <td>{{ $category->created_at }}</td>
                                        <td>
                                            @if (empty($category->media->path))
                                                Un selected Image
                                            @else
                                                <img src="{{ $category->media->path }}" alt="no image"
                                                    style="width: 100px ; height: 100px;">
                                            @endif

                                        </td>
                                        <td class="pt-5">
                                            <a href="#" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                                data-bs-target="#updateCatModal"
                                                wire:click="editCat({{ $category->id }})">
                                                <i class="las la-pen"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteCatModal"
                                                wire:click="deleteCat({{ $category->id }})">
                                                <i class="las la-trash"></i>
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach

                            @endif

                        </tbody>
                    </table>
                    <div class="text-center p-2">
                        {{ $categories->links() }}
                    </div>
                </div><!-- bd -->
            </div><!-- bd -->
        </div><!-- bd -->
    </div>
    <!--/div-->

    <!-- Insert Modal -->
    <div wire:ignore.self class="modal fade" id="catModal" tabindex="-1" aria-labelledby="catModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Create Category</h6><button wire:click="closeModal" aria-label="Close"
                        class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="saveCat">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Category Title</label>
                            <input type="text" wire:model="categories_title" class="form-control">
                            @error('categories_title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Category Body</label>
                            <input type="text" wire:model="categories_body" class="form-control">
                            @error('categories_body')
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


    <!-- Update  Category Modal -->
    <div wire:ignore.self class="modal fade" id="updateCatModal" tabindex="-1"
        aria-labelledby="updateCatModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Edit Category</h6><button wire:click="closeModal" aria-label="Close"
                        class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="updateCat">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Category Title</label>
                            <input type="text" wire:model="categories_title" class="form-control">
                            @error('categories_title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Category Body</label>
                            <input type="text" wire:model="categories_body" class="form-control">
                            @error('categories_body')
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
                                @endforeach
                            </select>
                            @error('main_categories_id')
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
    <div wire:ignore.self class="modal fade" id="deleteCatModal" tabindex="-1"
        aria-labelledby="deleteMcatModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Delete Category</h6><button wire:click="closeModal" aria-label="Close"
                        class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="destroyCat">
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
