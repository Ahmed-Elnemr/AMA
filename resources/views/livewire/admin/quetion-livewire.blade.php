<div>
    <div class="row">
        @foreach ($questions as $question)
            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                <!--div-->
                <div class="card">
                    <div class="card-body">
                        <div class="main-content-label mg-b-5">
                            <a href="{{ route('user-details', $question->user->id) }}">
                                <img alt="avatar" class="rounded-circle avatar-sm ml-2 "
                                    src="{{ $question->user->profile_photo_path }}">
                                {{ $question->user->name }} </a>
                        </div>
                        <p class="mg-b-20">{{ $question->the_questions }}</p>
                        <div>
                            @if ($question->answers->count() > 0)
                            <a href="{{route('answers',$question->id)}}" class="btn  btn-success ">
                                SHOW ANSWERS ({{$question->answers->count()}}) <br>
                            </a>
                            @else
                            <a href="{{route('answers',$question->id)}}" class="btn  btn-success  disabled">
                                No Answer Founded <br>
                            </a>
                            @endif

                            <button class="btn  btn-danger " data-bs-toggle="modal" data-bs-target="#deleteQuModal"
                                wire:click="deleteQu({{$question->id}})">
                                <i class="las la-trash"></i>
                            </button>



                        </div>
                        {{-- <div class="table-responsive">
                        <table class="table main-table-reference text-nowrap mg-t-0 mb-0">
                            <thead>
                                <tr>
                                    <th class="wd-10p">Users</th>
                                    <th class="wd-90p">Answers</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><a href="">user</a></td>
                                    <td>Lorem, ipsum dolor sit amet consecte</td>
                                </tr>

                            </tbody>
                        </table>
                    </div> --}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="text-center p-2">
            {{ $questions->links() }}
        </div>
    </div>






    <!-- Delete  Question Modal -->
    <div wire:ignore.self class="modal fade" id="deleteQuModal" tabindex="-1"
        aria-labelledby="deleteQuModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Delet Question</h6><button wire:click="closeModal" aria-label="Close"
                        class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="destroyQu">
                    <div class="modal-body">
                        <h4>?Are you sure you want to delete this Question </h4>
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
