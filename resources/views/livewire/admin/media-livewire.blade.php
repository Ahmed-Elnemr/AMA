<div>

    <div class="demo-gallery">
        <ul id="lightgallery" class="list-unstyled row row-sm pr-0">
            @if ($media != null && $media->count() > 0)
                @foreach ($media as $m)
                    <li class="col-sm-6 col-lg-4" data-responsive="{{ $m->path }}"
                        data-src="{{ URL::asset('assets/img/photos/1.jpg') }}" data-sub-html="<h4>Gallery Image 1</h4>">
                        <a href="">
                            <img class="img-responsive" src="{{ $m->path }}" alt="Thumb-1">
                        </a>

                        <div class="  ">
                            {{-- <a href="#" class="btn  btn-primary">
                            <i class="las la-search"></i>
                        </a> --}}
                            <a href="#" class="btn btn-sm btn-info">
                                <i class="las la-pen"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-danger">
                                <a href="#" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                    data-bs-target="#updateCatModal" wire:click="editM({{ $m->id }})">
                                    <i class="las la-pen"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteMModal" wire:click="deleteM({{ $m->id }})">
                                    <i class="las la-trash"></i>
                                </a>
                        </div>
                    </li>
                @endforeach
            @else
                <h1 class="text-center">No Media Founded</h1>
            @endif


        </ul>

        <!-- /Gallery -->
    </div>


    <!-- Update  media Modal -->
    <div wire:ignore.self class="modal fade" id="updateMModal" tabindex="-1" aria-labelledby="updateMModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateMModalLabel">Edit Media</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                        aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="updateM">
                    <div class="modal-body">


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
                        <button type="button" class="btn btn-secondary" wire:click="closeModal"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Main Category Modal -->
    <div wire:ignore.self class="modal fade" id="deleteMModal" tabindex="-1" aria-labelledby="deleteMModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteMModalLabel">Delete Main Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                        aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="destroyM">
                    <div class="modal-body">
                        <h4>?Are you sure you want to delete this Image </h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Yes! Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- row closed -->
</div>
<!-- Container closed -->
</div>
</div>
