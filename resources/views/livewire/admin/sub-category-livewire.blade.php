<div>
    <!--div-->
    <div class="col-xl-12">
        @if (session()->has('message'))
            <h5 class="alert alert-success">{{ session('message') }}</h5>
        @endif
        <div class="card">
            <div class="card-header pb-0 ">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">Sub Categories Table </h4>


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
                                        <span class="text-white">Sub Categories</span>
                                        <h2 class="text-white mb-0">{{ $allSub }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-outline-primary float-end" data-bs-toggle="modal"
                        data-bs-target="#subModal"><i class="fas fa-plus "></i>
                        Add Sub Category
                    </button>
                    <input type="search" wire:model="search" class="form-control float-end mx-2"
                        placeholder="Search...title" style="width: 230px" />
                </div>



            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped mg-b-0 text-md-nowrap">
                        <thead style="background-color:rgb(210, 228, 228)">
                            @if (isset($subs) && count($subs) > 0)
                                <tr>
                                    <th class="tx-20 " style="color:rgb(124, 126, 6)">ID</th>
                                    <th class="tx-20 " style="color:rgb(124, 126, 6)"> Title</th>
                                    <th class="tx-20 " style="color:rgb(124, 126, 6)"> Body</th>
                                    <th class="tx-20 " style="color:rgb(124, 126, 6)"> Category</th>
                                    <th class="tx-20 " style="color:rgb(124, 126, 6)">Image</th>
                                    <th class="tx-20 " style="color:rgb(124, 126, 6)">Actions</th>
                                </tr>
                            @else
                                <div class="tx-center">
                                    <h1 class="text-muted">Add Sub Category Now</h1>
                                </div>
                            @endif

                        </thead>
                        <tbody>
                            @if (isset($subs) && count($subs) > 0)
                                @foreach ($subs as $sub)
                                    <tr>
                                        <th scope="row">{{ $sub->id }}</th>
                                        <td>
                                            @if (isset($sub->subcategories_title ))
                                            {{ $sub->subcategories_title }}
                                            @else
                                            Sub category title not found
                                            @endif
                                            </td>
                                        <td>
                                            @if (isset($sub->subcategories_body))
                                                {{ $sub->subcategories_body }}
                                            @else
                                            Sub category body not found
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($sub->category->categories_title))
                                                {{ $sub->category->categories_title }}
                                            @else
                                                no append to category
                                            @endif
                                        </td>
                                        <td>
                                            @if (empty($sub->media->path))
                                                Un selected Image
                                            @else
                                                <img src="{{ $sub->media->path }}" alt="no image"
                                                    style="width: 100px ; height: 100px;">
                                            @endif
                                            {{-- @dd($sub->media->path) --}}

                                        </td>
                                        <td class="pt-5">
                                            <a href="#" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                                data-bs-target="#updateSubModal"
                                                wire:click="editSub({{ $sub->id }})">
                                                <i class="las la-pen"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteSubModal"
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
                        {{ $subs->links() }}
                    </div>
                </div><!-- bd -->
            </div><!-- bd -->
        </div><!-- bd -->
    </div>
    <!--/div-->







    <!-- Insert Modal -->
    <div wire:ignore.self class="modal fade" id="subModal" tabindex="-1" aria-labelledby="subModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Create Sub Category</h6><button wire:click="closeModal" aria-label="Close"
                        class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="saveSub">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Sub Category Title</label>
                            <input type="text" wire:model="subcategories_title" class="form-control">
                            @error('subcategories_title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Sub Category Body</label>
                            <input type="text" wire:model="subcategories_body" class="form-control">
                            @error('subcategories_body')
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
    <div wire:ignore.self class="modal fade" id="updateSubModal" tabindex="-1"
        aria-labelledby="updateSubModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h6 class="modal-title">Edit Sub Category</h6><button wire:click="closeModal" aria-label="Close"
                        class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="updateSub">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Sub Category Title</label>
                            <input type="text" wire:model="subcategories_title" class="form-control">
                            @error('subcategories_title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Sub Category Body</label>
                            <input type="text" wire:model="subcategories_body" class="form-control">
                            @error('subcategories_body')
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
    <div wire:ignore.self class="modal fade" id="deleteSubModal" tabindex="-1"
        aria-labelledby="deleteSubModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h6 class="modal-title">Delete Sub Category</h6><button wire:click="closeModal"
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
