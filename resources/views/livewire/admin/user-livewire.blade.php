<div>
    <div class="row row-sm ">
        <div class="col-lg-6 col-xl-4 col-md-6 col-12">
            <div class="card bg-success-gradient text-white ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="icon1 mt-2 text-center">
                                <i class="fe fe-users tx-40"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mt-0 text-center">
                                <span class="text-white">Admins</span>
                                <h2 class="text-white mb-0">{{$admins}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-4 col-md-6 col-12">
            <div class="card bg-warning-gradient text-white ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="icon1 mt-2 text-center">
                                <i class="fe fe-users tx-40"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mt-0 text-center">
                                <span class="text-white">Vendors</span>
                                <h2 class="text-white mb-0">{{$vendors}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-4 col-md-6 col-12">
            <div class="card bg-secondary-gradient text-white ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="icon1 mt-2 text-center">
                                <i class="fe fe-users tx-40"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mt-0 text-center">
                                <span class="text-white">Customers</span>
                                <h2 class="text-white mb-0">{{$cusomers}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div>
    <!--div-->
    <div class="col-xl-12">
        @if (session()->has('message'))
            <h5 class="alert alert-success">{{ session('message') }}</h5>
        @endif

        <div class="row row-sm">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
                <div class="card">
                    <div class="card-header pb-0 ">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mg-b-0">Users Table </h4>
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-outline-primary float-end" data-bs-toggle="modal"
                                data-bs-target="#userModal"><i class="fas fa-plus "></i>
                                Add New User
                            </button>
                            <input type="search" wire:model="search" class="form-control float-end mx-2"
                                placeholder="Search...name" style="width: 230px" />
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive border-top userlist-table">
                            <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                                <thead style="background-color:rgb(210, 228, 228)">
                                    <tr>
                                        <th class="wd-lg-8p "><span class="tx-20 " style="color:rgb(124, 126, 6)">Id</span></th>
                                        <th class="wd-lg-8p"><span class="tx-20 " style="color:rgb(124, 126, 6)">User</span></th>
                                        <th class="wd-lg-20p"><span class="tx-20 " style="color:rgb(124, 126, 6)"></span></th>
                                        <th class="wd-lg-20p"><span class="tx-20 " style="color:rgb(124, 126, 6)">Created</span></th>
                                        <th class="wd-lg-20p"><span class="tx-20 " style="color:rgb(124, 126, 6)">Role</span></th>
                                        <th class="wd-lg-20p"><span class="tx-20 " style="color:rgb(124, 126, 6)">Email</span></th>
                                        <th class="wd-lg-20p" colapse='2' > <span class="tx-20 " style="color:rgb(124, 126, 6)"> Action</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($users) && count($users) > 0)
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>
                                                    <a href="{{route('user-details',$user->id)}}">
                                                        <img alt="avatar" class="rounded-circle avatar-md mr-2 "
                                                        src="{{ $user->profile_photo_path }}">
                                                    </a>

                                                </td>
                                                <td> <a href="{{route('user-details',$user->id)}}"><span class="tx-30">{{ $user->name }}</span></a> </td>
                                                <td>
                                                    {{ $user->created_at }}
                                                </td>
                                                <td class="text-center">
                                                    <span class="label text-muted d-flex">
                                                        @if ($user->role_id == 'ADMIN')
                                                            <div class="dot-label bg-success ml-1"></div>
                                                            {{ $user->role_id }}
                                                        @elseif($user->role_id == 'VENDOR')
                                                            <div class="dot-label bg-warning ml-1"></div>
                                                            {{ $user->role_id }}
                                                        @else
                                                            <div class="dot-label bg-gray-300 ml-1"></div>
                                                            {{ $user->role_id }}
                                                        @endif
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="https://mail.google.com/"
                                                        target='_blank'>{{ $user->email }}</a>
                                                </td>
                                                <td>
                                                    <a href="{{route('user-details',$user->id)}}" class="btn btn-sm btn-primary">
                                                        <i class="las la-search"></i>
                                                    </a>
                                                        <a href="#" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                                            data-bs-target="#updateUserModal"
                                                            wire:click="editUser({{ $user->id }})">
                                                            <i class="las la-pen"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-sm btn-danger"
                                                            data-bs-toggle="modal" data-bs-target="#deleteUserModal"
                                                            wire:click="deleteUser({{ $user->id }})">
                                                            <i class="las la-trash"></i>
                                                        </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <div class="text-center p-2">
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- COL END -->
        </div>
    </div><!-- bd -->
</div>
<!--/div-->





<!-- Insert Modal -->
<div wire:ignore.self class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Create User</h6><button wire:click="closeModal" aria-label="Close"
                    class="close" data-bs-dismiss="modal" type="button"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form wire:submit.prevent="saveUser">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>User Name</label>
                        <input type="text" wire:model="name" class="form-control">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label> Email</label>
                        <input type="email" wire:model="email" class="form-control" placeholder="email" autocomplete='false' >
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Password</label>
                        <input type="password" class="form-control" wire:model='password' autocomplete='new-password'
                            placeholder="Password">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label> Role</label>
                        <select class="form-control" wire:model="role_id">
                            <option selected="selected">
                                select Role
                            </option>
                            <option value="USER">User</option>
                            <option value="VENDOR">Vendor</option>
                            <option value="ADMIN">Admin</option>
                        </select>
                        @error('role_id')
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


<!-- Update User Modal -->
<div wire:ignore.self class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Edit User</h6><button wire:click="closeModal" aria-label="Close"
                    class="close" data-bs-dismiss="modal" type="button"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form wire:submit.prevent="updateUser">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>User Name</label>
                        <input type="text" wire:model="name" class="form-control">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>User Email</label>
                        <input type="text" wire:model="email" class="form-control">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <label>User Role</label>
                    <select class="form-control" wire:model="role_id">
                        <option selected="selected">
                          select role
                        </option>
                        <option value="USER">User</option>
                        <option value="VENDOR">Vendor</option>
                        <option value="ADMIN">Admin</option>
                    </select>
                    @error('role_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="p-2">
                        <label>Password</label>
                        <input class="form-control" type="password">
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

<!-- Delete User Modal -->
<div wire:ignore.self class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Delete Student</h6><button wire:click="closeModal" aria-label="Close"
                    class="close" data-bs-dismiss="modal" type="button"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form wire:submit.prevent="destroyUser">
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
</div>

</div>
