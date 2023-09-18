<div>
    <div class="continar">
        <div class="row row-sm">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            {{-- <h4 class="card-title mg-b-0">Room TABLE</h4> --}}
                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                        </div>
                        {{-- <p class="tx-12 tx-gray-500 mb-2">Example of Valex Simple Table. <a href="">Learn more</a></p> --}}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive border-top userlist-table">
                            <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                                @if (isset($rooms) && count($rooms) > 0)
                                <thead>
                                    <tr>
                                        <th class="wd-lg-8p"><span class="tx-15 " style="color:rgb(124, 126, 6)">id</span></th>
                                        <th class="wd-lg-20p"><span class="tx-15 " style="color:rgb(124, 126, 6)">Rome</span></th>
                                        <th class="wd-lg-20p"><span class="tx-15 " style="color:rgb(124, 126, 6)">Status </span></th>
                                        <th class="wd-lg-20p"><span class="tx-15 " style="color:rgb(124, 126, 6)">Owner</span></th>
                                        {{-- <th class="wd-lg-20p"><span></span></th> --}}
                                        <th class="wd-lg-20p"><span class="tx-15 " style="color:rgb(124, 126, 6)">Created At</span></th>
                                        <th class="wd-lg-20p tx-15" style="color:rgb(124, 126, 6)">Action</th>
                                    </tr>
                                </thead>
                                @else
                                <div class="tx-center">
                                    <h1>no chat yet</h1>
                                </div>
                                @endif

                                <tbody>
                                    {{-- @if ($rooms = !null && $rooms->count() > 0) --}}
                                    @foreach ($rooms as $room)
                                        <tr>
                                            <td>{{ $room->id }}</td>
                                            @if (isset($room->media->path))
                                            <td>

                                                <img alt="avatar" class="rounded-circle avatar-md ml-2"
                                                    src="{{ $room->media->path }}">
                                                    <span class="tx-primary tx-20"> {{ $room->room_name }}</span>
                                            </td>
                                            @else
                                            <td>
                                                <span class="tx-primary tx-20"> {{ $room->room_name }}</span>
                                            </td>
                                            @endif

                                            <td>

                                                @if ($room->room_is_private == 1)
                                                            <span class="text-danger ml-2">
                                                                Private
                                                            </span>
                                                        @else
                                                            <span class="text-primary ml-2">
                                                                Public
                                                            </span>
                                                        @endif
                                            </td>
                                            @if (isset($room->owner->name))
                                            {{-- <td>


                                            </td> --}}
                                                <td>
                                                    <a href="{{route('user-details', $room->owner->id)}}"><img alt="" class="rounded-circle avatar-sm mr-2 "
                                                        src="{{$room->owner->profile_photo_path }}"></a>
                                                    <a href="{{route('user-details', $room->owner->id)}}">{{ $room->owner->name }}</a>

                                                </td>
                                            @else
                                                <td>no owner</td>
                                            @endif
                                            <td>{{ $room->created_at }}</td>

                                            <td class=""><a class="remove-from-cart" href="#"
                                                    data-bs-toggle="modal" data-bs-target="#deleteRoomModal"
                                                    wire:click="deleteRoom({{ $room->id }})"><i
                                                        class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    {{-- @else
                                        No Rooms Found
                                    @endif --}}


                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div><!-- COL END -->
        </div>
        @if (!empty($rooms))
            <div class="text-center p-2">
                {{ $rooms->links() }}
            </div>
        @endif


    </div>


    <!-- Delete  Story Modal -->
    <div wire:ignore.self class="modal fade" id="deleteRoomModal" tabindex="-1" aria-labelledby="deleteStoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h6 class="modal-title">Delet Chat</h6><button wire:click="closeModal" aria-label="Close"
                        class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="destroyRoom">
                    <div class="modal-body">
                        <h4>?Are you sure you want to delete this Room </h4>
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
