<div>






    <div class="container-fluid">
        <div class="row no-gutter">
            <!-- The image half -->
            {{-- <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
                <div class="row wd-100p mx-auto text-center">
                    <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
                        <img src="{{URL::asset('assets/img/media/login.png')}}" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
                    </div>
                </div>
            </div> --}}
            <!-- The content half -->
            <div class="d-flex align-items-center">

            </div>
            <div class="col-md-12 col-lg-12 col-xl-12 bg-white">
                {{-- <h1 class="text-center text-danger pt-5 tx-italic">Delete Acount </h1> --}}

                <div class="login d-flex align-items-center py-2">
                    <!-- Demo content-->

                    <div class="container p-0">
                        <div class="row">
                            <div class="col-md-5 col-lg-5 col-xl-4 mx-auto">
                                <h1 class="text-center text-danger pt-5 tx-italic mb-5">Delete  Account </h1>
                                <div class="card-sigin">
                                    {{-- <div class="mb-5 d-flex"> <a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="sign-favicon ht-40" alt="logo"></a><h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">Va<span>le</span>x</h1></div> --}}
                                    @if (session()->has('message'))
                                        <div class="alert alert-danger tx-center">
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                    <div class="card-sigin">
                                        <div class="main-signup-header">
                                            <form wire:submit.prevent="deleteUser">
                                                <div class="form-group">
                                                    <label>Email</label> <input class="form-control"
                                                        placeholder="Enter your email" type="text"
                                                        wire:model="email">
                                                </div>
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <div class="form-group">
                                                    <label>Password</label> <input class="form-control"
                                                        placeholder="Enter your password" type="password"
                                                        wire:model="password">
                                                </div>
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <button type="submit" class="btn  btn-block btn-danger  ">

                                                    <i class="las la-trash"></i>
                                                    Delete Account </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End -->
                </div>
            </div><!-- End -->
        </div>
    </div>






    <div wire:ignore.self class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModal"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title"> <span class="tx-italic">Delete User Acount !</span> </h6><button
                        wire:click="closeModal" aria-label="Close" class="close" data-bs-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="destroyUser">
                    <div class="modal-body">
                        <h4 class="tx-danger">?Are you sure you want to delete Acount </h4>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Yes! Delete</button>
                        <button type="button" class="btn btn-secondary" wire:click="closeModal"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



</div>
