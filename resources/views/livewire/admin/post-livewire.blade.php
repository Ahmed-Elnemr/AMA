<div>

    <div class="col-xl-12">
        @if (session()->has('message'))
            <h5 class="alert alert-success">{{ session('message') }}</h5>
        @endif
        <div class="pb-3">
            <input type="search" wire:model="search" class="form-control float-end mx-2" placeholder="Search... play load"
                style="width: 230px;" />
        </div>
        {{-- <div class="card">
            <div class="card-header pb-0 ">
                <div class="d-flex justify-content-between m-3">
                    <h4 class="card-title mg-b-0">Organization Table </h4>

                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-outline-primary float-end" data-bs-toggle="modal"
                        data-bs-target="#orgModal"><i class="fas fa-plus "></i>
                        Add Organization
                    </button>
                    <div class="pb-3">
                        <input type="search" wire:model="search" class="form-control float-end mx-2"
                            placeholder="Search... name" style="width: 230px;" />
                    </div>

                </div>
            </div>
        </div> --}}

    </div>


    <div class="row">
        @if (isset($posts) && $posts->count() > 0)
            @foreach ($posts as $post)
                <div class="col-sm-12 col-xl-4 col-lg-12">
                    <div class="card user-wideget user-wideget-widget widget-user">
                        <div class="widget-user-header bg-primary">
                            <div class="mb-2">
                                <h3 class="widget-user-desc">{{ $post->businessInfo->legal_name }}</h3>
                            </div>
                            <img alt="avatar" class="rounded-circle avatar-md mr-2"
                                src="{{ $post->user->profile_photo_url }}">

                            {{ $post->user->name }}
                        </div>

                        @if (isset($post->media->path))
                            <img style="height: 200px ;wight:200px" class="card-img-top w-100"
                                src="{{ $post->media->path }}" alt="imge">
                        @else
                            <video class="card-img-top w-100" controls>
                                <source src="{{ $post->media->path }}" type="video/mp4">
                                <source src="{{ $post->media->path }}" type="video/ogg">
                                Your browser does not support HTML video.
                            </video>
                        @endif
                        <div class="user-wideget-footer">
                            <div class="col">
                                @if (isset($post->post_playload))
                                    <p>{{ $post->post_playload }}</p>
                                @else
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-sm-4 border-left">
                                    <div class="description-block">
                                        @php
                                            $likes = count($post->likes);
                                        @endphp
                                        <h5 class="description-header">{{ $likes }}</h5>

                                        <span class="description-text">Likes</span>
                                    </div>
                                </div>
                                <div class="col-sm-4 border-left">
                                    <div class="description-block">
                                        @php
                                            $comments = count($post->comments);
                                        @endphp
                                        <h5 class="description-header">{{ $comments }}</h5>
                                        <a href="{{ route('comment-post', $post->id) }}"
                                            class="description-text">COMMENTS</a>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="description-block">
                                        @php
                                            $report = count($post->report);
                                        @endphp
                                        <h5 class="description-header">{{ $report }}</h5>
                                        <span class="description-text">REPORT</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                {{-- <div class=" flex-row d-flex justify-content-center mb-2">
                                            <a href="#" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                            data-bs-target="#updateOrgModal" wire:click="editOrg({{ $post->id }})">
                                            <i class="las la-pen"></i>Update
                                        </a><br> --}}
                                <div class="m-1 text-center">
                                    <a href="#" class="btn btn-sm btn-danger " data-bs-toggle="modal"
                                        data-bs-target="#deletePostModal" wire:click="deletePost({{ $post->id }})">
                                        <i class="las la-trash"></i>Delete
                                    </a>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        @else
        @endif
    </div>

    <div wire:ignore.self class="modal fade" id="deletePostModal" tabindex="-1" aria-labelledby="deleteStoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            {{-- <div class="modal-header">
             <h5 class="modal-title" id="deleteStoryModal">Delete Post </h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                 aria-label="Close"></button>
         </div> --}}
            <div class="modal-header">
                <h6 class="modal-title">Delet Post</h6><button wire:click="closeModal" aria-label="Close" class="close"
                    data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form wire:submit.prevent="destroyPost">
                <div class="modal-body">
                    <h4>?Are you sure you want to delete this Post </h4>
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
<!-- Delete  Post Modal -->

</div>

</div>
</div>
</div>
