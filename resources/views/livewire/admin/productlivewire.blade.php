<div>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">

            <div class="card-header  ">

                @if (session()->has('message'))
                    <h5 class="alert alert-success">{{ session('message') }}</h5>
                @endif
                {{-- <div class="float-left "> --}}
                    <div class="float-left">
                        <div class="card bg-info-gradient text-white mt-0 mb-1">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="icon1 mt-2 text-center">
                                            <i class="fe fe-bar-chart-2 tx-40"></i>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="mt-0 text-center">
                                            <span class="text-white"> Products</span>
                                            <h2 class="text-white mb-0">{{$sumProduct}}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- </div> --}}
                <div class="text-center">
                    <button type="button" class="btn btn-outline-primary float-end" data-bs-toggle="modal"
                        data-bs-target="#productModal"><i class="fas fa-plus "></i>
                        Add New Product
                    </button>
                    <input type="search" wire:model="search" class="form-control float-end mx-2"
                        placeholder="Search...name" style="width: 230px" />

                </div>




            </div>
        </div>
    </div>



    <div class="row">

        @if (isset($products) && count($products) > 0)
            @foreach ($products as $product)
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body h-100 ">
                            <div class="row  row-sm">
                                <div class="carousel slide carousel-fade" data-ride="carousel" id="carouselExample5">
                                    {{-- <ol class="carousel-indicators">
                                        <li class="active" data-slide-to="0" data-target="#carouselExample5"></li>
                                        <li data-slide-to="1" data-target="#carouselExample5"></li>
                                        <li data-slide-to="2" data-target="#carouselExample5"></li>
                                    </ol> --}}

                                    <div class="card custom-card ">
                                        <div class="card-body ht-100p ">
                                            {{-- <div>
                                                <h6 class="card-title mb-1">With Controls</h6>
                                                <p class="text-muted card-sub-title">Adding in the previous and next controls.</p>
                                            </div> --}}
                                            @if (isset($product->media) && $product->media->count() > 0)
                                                <div>
                                                    <div class="carousel slide" data-ride="carousel"
                                                        id="carouselExample1">
                                                        <div class="carousel-inner">
                                                            @foreach ($product->media as $pmedia)
                                                                @if (isset($pmedia->path))
                                                                    <div
                                                                        class="carousel-item   @if ($loop->first) active @endif ">
                                                                        <img style="width:300px;height:250px"
                                                                            alt="img" class="d-block "
                                                                            src="{{ $pmedia->path }}">
                                                                    </div>
                                                                @else
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                        <a class="carousel-control-prev" href="#carouselExample1"
                                                            role="button" data-slide="prev">
                                                            <i class="fa fa-angle-left fs-30" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="carousel-control-next" href="#carouselExample1"
                                                            role="button" data-slide="next">
                                                            <i class="fa fa-angle-right fs-30" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            @else
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <p class="price  float-left pb-1 text-muted tx-12"> Price: <span
                                            class="h6 ml-2 text-success">{{ $product->products_price }} </span>&nbsp;EGP
                                    <h4 class="product-title mb-1 text-right text-primary">{{ $product->products_name }}
                                    </h4>
                                    </p>


                                    @if (isset($product->mainCategory->main_categories_title))
                                        <span class="text-muted tx-20">Main Category
                                            :</span> {{ $product->mainCategory->main_categories_title }}
                                    @else
                                        <span class="text-muted tx-20">Main Category
                                            :</span>main category deleted
                                    @endif

                                    @if (isset($product->category->categories_title))
                                        <p class="product-description"> <span class="text-muted tx-17"> Category
                                                :</span>{{ $product->category->categories_title }}</p>
                                    @else
                                        <p class="product-description"> <span class="text-muted tx-17"> Category
                                                :</span>category deleted</p>
                                    @endif

                                    @if (isset($product->subCategory->subcategories_title))
                                        <p class="product-description"><span class="text-muted tx-14">Sub Category
                                                :</span>{{ $product->subCategory->subcategories_title }}</p>
                                    @else
                                        <p class="product-description"><span class="text-muted tx-14">Sub Category
                                                :</span>sub category deleted</p>
                                    @endif

                                    <p><span class="text-muted tx-14">Unit Name :</span>
                                        {{ $product->products_unite_name }}</p>
                                    <p><span class="text-muted tx-14"> Uinites</span> {{ $product->products_uinites }}
                                    </p>

                                </div>
                                <div>

                                </div>

                                {{-- <p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p> --}}

                                <div class="action row">
                                    <button class="add-to-cart btn btn-success" type="button" data-bs-toggle="modal"
                                        data-bs-target="#updateProModal"
                                        wire:click="editPro({{ $product->id }})">Update</button>
                                    <button class="add-to-cart btn btn-danger m-2" type="button" data-bs-toggle="modal"
                                        data-bs-target="#deleteProModal"
                                        wire:click="deletepro({{ $product->id }})">Delet</button>
                                    <div>
                                        <label for="vehicle2"> Is Featured</label><br>
                                        <input class="float-left" type="checkbox"
                                            wire:click='isFeatured({{ $product->id }})'
                                            {{ $product->is_featured == 1 ? 'checked' : '' }}>


                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            no Product found
        @endif


    </div>
    <div class="text-center p-2">
        {{ $products->links() }}
    </div>
    {{-- ################ --}}

    <div wire:ignore.self class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Create Product</h6><button wire:click="closeModal" aria-label="Close"
                        class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="saveProduct">
                    <div class="modal-body">

                        <div class="mb-3">
                            <label> Product Name</label>
                            <input type="text" wire:model="products_name" class="form-control"
                                placeholder="Product Name" autocomplete='false'>
                            @error('products_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label> Unit Name</label>
                            <input type="text" wire:model="products_unite_name" class="form-control"
                                placeholder="Unit Name" autocomplete='false'>
                            @error('products_unite_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Price</label>
                            <input type="number" class="form-control" wire:model='products_price'
                                placeholder="Price">
                            @error('products_price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Uinites</label>
                            <input type="text" class="form-control" wire:model='products_uinites'
                                placeholder="Uinites">
                            @error('products_uinites')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label> Business Inforamtion</label>
                            <select class="form-control" wire:model="business_information_id">
                                <option selected="selected">
                                    Select Business Information
                                </option>
                                @foreach ($businessInformations as $businessInfo)
                                    <option value="{{ $businessInfo->id }}">{{ $businessInfo->legal_name }}</option>
                                @endforeach
                            </select>
                            @error('business_information_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label> Main Categopory</label>
                            <select class="form-control" wire:model="main_categories_id">
                                <option selected="selected">
                                    Select Main Category
                                </option>
                                @foreach ($mainCategoreis as $mainCategory)
                                    <option value="{{ $mainCategory->id }}">
                                        {{ $mainCategory->main_categories_title }}</option>
                                @endforeach
                            </select>
                            @error('main_categories_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label> Category</label>
                            <select class="form-control" wire:model="categories_id">
                                <option selected="selected">
                                    Select Category
                                </option>
                                @foreach ($categoreis as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->categories_title }}</option>
                                @endforeach
                            </select>
                            @error('categories_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label> Sub Category</label>
                            <select class="form-control" wire:model="subcategories_id">
                                <option selected="selected">
                                    Select Sub Category
                                </option>
                                @foreach ($subCategoreis as $subCat)
                                    <option value="{{ $subCat->id }}">{{ $subCat->subcategories_title }}</option>
                                @endforeach
                            </select>
                            @error('subcategories_id')
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
                                        wire:model="image" aria-describedby="inputGroupFileAddon01" multiple>
                                    <label class="custom-file-label" for="inputGroupFile01">Choose Image </label>
                                </div>
                            </div>
                            @error('image')
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
    <!-- Update  Product Modal -->
    <div wire:ignore.self class="modal fade" id="updateProModal" tabindex="-1"
        aria-labelledby="updateProModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Edit Product</h6><button wire:click="closeModal" aria-label="Close"
                        class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="updatePro">
                    <div class="modal-body">

                        <div class="mb-3">
                            <label> Product Name</label>
                            <input type="text" wire:model="products_name" class="form-control"
                                placeholder="Product Name" autocomplete='false'>
                            @error('products_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label> Unit Name</label>
                            <input type="text" wire:model="products_unite_name" class="form-control"
                                placeholder="Unit Name" autocomplete='false'>
                            @error('products_unite_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Price</label>
                            <input type="number" class="form-control" wire:model='products_price'
                                placeholder="Price">
                            @error('products_price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Uinites</label>
                            <input type="text" class="form-control" wire:model='products_uinites'
                                placeholder="Uinites">
                            @error('products_uinites')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label> Business Inforamtion</label>
                            <select class="form-control" wire:model="business_information_id">
                                <option selected="selected">
                                    Select Business Information
                                </option>
                                @foreach ($businessInformations as $businessInfo)
                                    <option value="{{ $businessInfo->id }}">{{ $businessInfo->legal_name }}</option>
                                @endforeach
                            </select>
                            @error('business_information_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label> Main Categopory</label>
                            <select class="form-control" wire:model="main_categories_id">
                                <option selected="selected">
                                    Select Main Category
                                </option>
                                @foreach ($mainCategoreis as $mainCategory)
                                    <option value="{{ $mainCategory->id }}">
                                        {{ $mainCategory->main_categories_title }}</option>
                                @endforeach
                            </select>
                            @error('main_categories_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label> Category</label>
                            <select class="form-control" wire:model="categories_id">
                                <option selected="selected">
                                    Select Category
                                </option>
                                @foreach ($categoreis as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->categories_title }}</option>
                                @endforeach
                            </select>
                            @error('categories_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label> Sub Category</label>
                            <select class="form-control" wire:model="subcategories_id">
                                <option selected="selected">
                                    Select Sub Category
                                </option>
                                @foreach ($subCategoreis as $subCat)
                                    <option value="{{ $subCat->id }}">{{ $subCat->subcategories_title }}</option>
                                @endforeach
                            </select>
                            @error('subcategories_id')
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
                                        wire:model="image" aria-describedby="inputGroupFileAddon01" multiple>
                                    <label class="custom-file-label" for="inputGroupFile01">Choose Image </label>
                                </div>
                            </div>
                            @error('image')
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
    <!-- Delete  Product Modal -->
    <div wire:ignore.self class="modal fade" id="deleteProModal" tabindex="-1"
        aria-labelledby="deleteProModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Delete Data</h6><button wire:click="closeModal" aria-label="Close"
                        class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="destroyProduct">
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
</div>
