<div>




    <div class="col-xl-12">
        <div class="card-header pb-0 ">
            @if (session()->has('message'))
            <h5 class="alert alert-success">{{ session('message') }}</h5>
        @endif
            <div class="text-center pb-3">
                <a href="{{route('create-top-ranked')}}" type="button" class="btn btn-outline-primary float-end"
                    ><i class="fas fa-plus "></i>
                    Add New Top Ranked
                </a>

            </div>
        </div>

    </div>
    <div class="m-2"></div>
    <div class="row">
        @if (isset($topRankeds) && $topRankeds->count() > 0)
        @foreach ($topRankeds as $ranked)
        <div class="col-lg-3">
        <div class="card item-card">
            <div class="card-body pb-0 h-100">
                @if (isset($ranked->logoMedia ->path))
                <div class="text-center">
                    <img src="{{ $ranked->logoMedia ->path }}" alt="img"
                        class="img-fluid">
                </div>
                @else

                @endif

                <div class="card-body cardbody relative">
                    <div class="cardtitle">
                        @if (isset($ranked->businessInfo->legal_name))
                        <span class="tx-20 text-success"> {{$ranked->businessInfo->legal_name}}</span>
                        @else

                        @endif

                        {{-- <strong>{{$ranked->user->name}}</strong> --}}

                        @if (isset($ranked->user->name))
                        <span class=" float-left tx-20 "> <a class="text-primary"
                                href="{{ route('user-details', $ranked->user->id) }}">{{ $ranked->user->name }}</a>
                        </span>
                    @else
                    @endif
                    @if (isset($ranked->user->profile_photo_path))
                        <span class="pt-3"><a
                                href="{{ route('user-details', $ranked->user->id) }}">
                                <img alt="" class="rounded-circle avatar-md mr-2 "
                                    src="{{ $ranked->user->profile_photo_path }}">
                            </a></span>
                    @else
                    @endif

                    </div>
                </div>
            </div>
            {{-- @if () --}}
            <div class="text-center border-top pt-3 pb-3 pl-2 pr-2 ">
                <a href="#" wire:click="deleterank({{ $ranked->id }})" class="btn btn-danger"
                    data-bs-toggle="modal" data-bs-target="#deleteRankedModal"
                    > Delete
                    </a>
            </div>
            {{-- @else --}}

            {{-- @endif --}}

        </div>
    </div>
@endforeach
@else
No Top Ranked Founded
@endif

    </div>




    {{-- <div wire:ignore.self class="modal fade" id="deleteRankedModal" tabindex="-1" aria-labelledby="deleteRankedModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Delete Ranke</h6><button wire:click="closeModal" aria-label="Close"
                    class="close" data-bs-dismiss="modal" type="button"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form wire:submit.prevent="destroyUser">
                <div class="modal-body">
                    <h4>?Are you sure you want to delete this data </h4>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"  >Yes! Delete</button>
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>

                </div>
            </form>
        </div>
    </div>
</div> --}}







</div>
</div>
</div>
