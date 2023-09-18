<div>
    <!--div-->
    <div class="col-xl-12">
        @if (session()->has('message'))
            <h5 class="alert alert-success">{{ session('message') }}</h5>
        @endif
        <div class="card">
            <div class="card-header pb-0 ">
                <div class="d-flex justify-content-between">
                    {{-- <h4 class="card-title mg-b-0">Notification Table </h4> --}}


                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-outline-primary float-end" data-bs-toggle="modal"
                        data-bs-target="#notiModal"><i class="fas fa-plus "></i>
                        Add New Notification
                    </button>
                    <input type="search" wire:model="search" class="form-control float-end mx-2"
                        placeholder="Search..." style="width: 230px" />
                </div>



            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped mg-b-0 text-md-nowrap">
                        <thead style="background-color:rgb(210, 228, 228)">
                            <tr>
                                <th class="tx-20 " style="color:rgb(124, 126, 6)">ID</th>
                                <th class="tx-20 " style="color:rgb(124, 126, 6)">Title</th>
                                <th class="tx-20 " style="color:rgb(124, 126, 6)">Message</th>
                                <th class="tx-20 " style="color:rgb(124, 126, 6)" colspan="
                                2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($notifications) && count($notifications) > 0)
                                @foreach ($notifications as $notification)
                                    <tr>
                                        <th scope="row">{{ $notification->id }}</th>
                                        <td>{{ $notification->title }}</td>
                                        <td> {{ $notification->massages }}</td>
                                        <td>
                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#updateNotiModal"
                                                wire:click="editNoti({{ $notification->id }})" class="btn btn-primary">
                                                Edit
                                            </button>
                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#deleteNotiModal"
                                                wire:click="deleteNoti({{ $notification->id }})"
                                                class="btn btn-danger">Delete</button>
                                        </td>

                                    </tr>
                                @endforeach

                            @endif

                        </tbody>
                    </table>
                    <div class="text-center p-2">
                        {{ $notifications->links() }}
                    </div>
                </div><!-- bd -->
            </div><!-- bd -->
        </div><!-- bd -->
    </div>
    <!--/div-->





    <!-- Insert Modal -->
    <div wire:ignore.self class="modal fade" id="notiModal" tabindex="-1" aria-labelledby="notiModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h6 class="modal-title">Create Notification</h6><button wire:click="closeModal" aria-label="Close"
                        class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="saveNoti">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Notification  Title</label>
                            <input type="text" wire:model="title" class="form-control">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Notification Message</label>
                            <input type="text" wire:model="massages" class="form-control">
                            @error('massages')
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


    <!-- Update Notification Modal -->
    <div wire:ignore.self class="modal fade" id="updateNotiModal" tabindex="-1" aria-labelledby="updateNotiModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h6 class="modal-title">Update Notification</h6><button wire:click="closeModal" aria-label="Close"
                        class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="updateNoti">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Notification Title</label>
                            <input type="text" wire:model="title" class="form-control">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Notification Message</label>
                            <input type="text" wire:model="massages" class="form-control">
                            @error('massages')
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

    <!-- Delete Notification Modal -->
    <div wire:ignore.self class="modal fade" id="deleteNotiModal" tabindex="-1"
        aria-labelledby="deleteNotiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h6 class="modal-title">Delet Notification</h6><button wire:click="closeModal" aria-label="Close"
                        class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="destroyNoti">
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
</div></div>
