<div>




    <div class="row">
        @if ($stories != null && $stories->count() > 0)
            @foreach ($stories as $story)
                <div class="col-xl-3 col-md-3">
                    <div class="card custom-card text-center">

                        @if ($story->stories_type == 'TEXT')
                            <p class="card-img-top w-100 bg-{{ $story->stories_background }}">
                                {{ $story->stories_captions }}
                            </p>
                        @elseif ($story->stories_type == 'VIDEO')
                            @if (isset($story->media->path))
                                <video class="card-img-top w-100" controls>
                                    <source src="{{ $story->media->path }}" type="video/mp4">
                                    <source src="{{ $story->media->path }}" type="video/ogg">
                                    Your browser does not support HTML video.
                                </video>
                            @endif
                        @elseif ($story->stories_type == 'IMAGE')
                            @if (isset($story->media->path))
                                <img class="card-img-top w-100 bg-{{ $story->stories_background }}"
                                    src="{{ $story->media->path }}" alt="">
                            @endif
                        @endif
                        <div class="card-body">
                            <div>
                                <a href="{{route('user-details',$story->user->id)}}" class="text-default ">
                                    @if (isset($story->user->name))
                                        {{ $story->user->name }}
                                    @endif

                                </a>

                                <small class="d-block text-muted">Start in : {{ $story->stories_start_date }}</small>
                                <small class="d-block text-muted">End in : {{ $story->stories_end_date }}</small>
                            </div>
                            <br>
                            <h4 class="card-title">
                                @if (isset($story->businessInfo->legal_name))
                                    {{ $story->businessInfo->legal_name }}
                                @endif
                            </h4>
                            {{-- <p class="card-text">{{ $story->stories_captions }}</p> --}}

                            <button class="btn  btn-danger " data-bs-toggle="modal" data-bs-target="#deleteStoryModal"
                                wire:click="deleteStory({{ $story->id }})">
                                <i class="las la-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-center">
                <h1>There are no Stories currently</h1>
            </div>

        @endif

    </div>
    <div class="row">
        <div class="text-center p-2">
            {{ $stories->links() }}
        </div>
    </div>








    <!-- Delete  Story Modal -->
    <div wire:ignore.self class="modal fade" id="deleteStoryModal" tabindex="-1"
        aria-labelledby="deleteStoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h6 class="modal-title">Delet Story</h6><button wire:click="closeModal" aria-label="Close"
                        class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="destroyStory">
                    <div class="modal-body">
                        <h4>?Are you sure you want to delete this Story </h4>
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
<!-- Container closed -->
</div>

</div>
