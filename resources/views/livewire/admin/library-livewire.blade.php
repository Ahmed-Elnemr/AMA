<div>

    <div class="row">
        <div class="col-xl-12">
            @if (session()->has('message'))
                <h5 class="alert alert-success">{{ session('message') }}</h5>
            @endif
            <div class="card">
                <div class="card-header pb-0 ">

                    <div class="text-center pb-3">
                        <button type="button" class="btn btn-outline-primary float-end" data-bs-toggle="modal"
                            data-bs-target="#libraryModal"><i class="fas fa-plus "></i>
                            Add Library
                        </button>
                        {{-- <div class="pb-3">
                            <input type="search" wire:model="search" class="form-control float-end mx-2"
                            placeholder="Search... name" style="width: 230px;" />
                        </div> --}}

                    </div>
                </div>
            </div>

        </div>
    </div>


    <div class="row">
        @if (isset($library) && count($library) > 0)
            @foreach ($library as $libra)
                <div class="col-lg-3">
                    <div class="card item-card">
                        <div class="card-body pb-0 h-100">
                            @if (isset( $libra->media->path))
                            <div class="">
                                <img src="{{ $libra->media->path }}" alt="img" class="img-fluid" style="width:200px ;height:200px">
                            </div>
                            @else
                            <div class="text-center">
                                no image
                                <img src="{{URL::asset('assets/img/faces/3.jpg') }}" alt="img" class="img-fluid" style="width:200px ;hight:200px">
                            </div>
                            @endif

                            <div class="card-body cardbody relative">
                                <div class="">
                                    <a href="{{$libra->url}}"> <span class="tx-20">{{ $libra->librarys_title }}</span></a>
                                    {{-- <span>{{ $libra->librarys_text }}</span> --}}
                                </div>
                                {{-- <div class="cardprice">
                                    <span class="type--strikethrough">$999</span>
                                    <span>$799</span>
                                </div> --}}
                            </div>
                        </div>
                        <div class="text-center border-top pt-3 pb-3 pl-2 pr-2 ">
                            {{-- <a href="#" class="btn btn-primary"> View More</a>
                             <a href="#" class="btn btn-success"><i class="fa fa-shopping-cart"></i> Add to cart</a> --}}
                            <a class="remove-from-cart" href="#" data-bs-toggle="modal"
                                data-bs-target="#deleteLibraryModal" wire:click="deleteLibrary({{ $libra->id }})"><i
                                    class="fa fa-trash"></i></a>

                        </div>

                    </div>
                </div>
            @endforeach
        @else
            no library found
        @endif
    </div>
    <div class="text-center p-2">
        {{ $library->links() }}
    </div>
    <!-- Insert Modal -->
    <div wire:ignore.self class="modal fade" id="libraryModal" tabindex="-1" aria-labelledby="libraryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Create Library </h6><button wire:click="closeModal" aria-label="Close"
                        class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="saveLibrary">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label> Title</label>
                            <input type="text" wire:model="librarys_title" class="form-control">
                            @error('librarys_title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label> Url</label>
                            <input type="text" wire:model="url" class="form-control">
                            @error('url')
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
    <!-- Delete  Story Modal -->
    <div wire:ignore.self class="modal fade" id="deleteLibraryModal" tabindex="-1" aria-labelledby="deleteLibraryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Delete Data</h6><button wire:click="closeModal" aria-label="Close"
                        class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="destroyLibrary">
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
