<div>
    <div>

        <div class="row">
            <div class="col-xl-12">
                @if (session()->has('message'))
                    <h5 class="alert alert-success">{{ session('message') }}</h5>
                @endif
                <div class="card">
                    <div class="card-header pb-0 ">
                        <div class="d-flex justify-content-between">
                            {{-- <h4 class="card-title mg-b-0">Organization Table </h4> --}}

                        </div>
                        <div class="float-right">
                            <div class="pb-3">
                                <input type="search" wire:model="search" class="form-control float-end mx-2"
                                    placeholder="Search... legal name" style="width: 230px;" />
                            </div>

                        </div>
                        <div class="  text-center pb-2">
                            <a class="btn btn-outline-primary float-end" href="{{ route('top-ranked') }}"><strong> Top
                                    Ranked</strong></a>
                        </div>
                    </div>
                </div>
                {{-- <div class="row"> --}}

            </div>
        </div>

        <div class="row">
            @if (isset($topRankeds) && $topRankeds->count() > 0)
                @foreach ($topRankeds as $ranked)
                    <div class="col-lg-3">
                        <div class="card item-card">
                            <div class="card-body pb-0 h-100">
                                @if (isset($ranked->logoMedia->path))
                                    <div class="text-center">
                                        <img src="{{ $ranked->logoMedia->path }}" alt="img" class="img-fluid">
                                    </div>
                                @else
                                @endif

                                <div class="card-body cardbody relative">
                                    <div class="cardtitle">
                                        <span class="tx-20 text-success"> {{ $ranked->legal_name }}</span>

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

                            <div class="text-center border-top pt-3 pb-3 pl-2 pr-2 ">
                                <a href="#" wire:click="addRank({{ $ranked->id }})" class="btn btn-success">
                                    Add To Top
                                    Ranked</a>
                            </div>

                        </div>
                    </div>
                @endforeach
            @else
                No Top Ranked Founded
            @endif

            <div class="text-center p-2">
                {{ $topRankeds->links() }}
            </div>
            {{-- </div> --}}

        </div>


    </div>




</div>
</div>
</div>
