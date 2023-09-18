@extends('layouts.master')

@section('title')
    user details

@stop
@section('css')

@endsection


@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto" style="color:rgb(82, 129, 230)">User Details</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">
                </span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection


@section('content')


    <div class="row row-sm">
        <div class="col-lg-4">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="pl-0">
                        <div class="main-profile-overview">
                            <div class="main-img-user profile-user">
                                @if (isset($user->profile_photo_url))
                                    <img alt="" src="{{ $user->profile_photo_path }}">
                                @else
                                @endif
                            </div>
                            <div class="d-flex justify-content-between mg-b-20">
                                <div>
                                    <h5 class="main-profile-name">{{ $user->name }}</h5>
                                    @if (isset($personalInfo->bio))
                                        <p class="main-profile-name-text">{{ $personalInfo->bio }}</p>
                                    @else
                                    @endif
                                </div>

                            </div>
                            @if ($user->role_id == 'VENDOR')
                                {{-- <h6>About</h6> --}}
                                {{-- <div class="main-profile-bio">

                                    {{ $businessInfo->legal_name }}
                                </div><!-- main-profile-bio --> --}}

                                {{-- ################ --}}
                                <div class="row">
                                    <div class="col-md-4 col mb20">
                                        <h5>{{ $followers }}</h5>
                                        <h6 class="text-small text-muted mb-0">Followers</h6>
                                    </div>

                                    <div class="col-md-4 col mb20">
                                        <h5>{{ $products }}</h5>
                                        <h6 class="text-small text-muted mb-0">Products</h6>
                                    </div>
                                    <div class="col-md-4 col mb20">
                                        <h5>{{ $posts }}</h5>
                                        <h6 class="text-small text-muted mb-0">Posts</h6>
                                    </div>
                                </div>
                            @elseif ($user->role_id == 'USER')
                                <div class="main-profile-bio">

                                </div><!-- main-profile-bio -->

                                {{-- ################ --}}
                                <div class="row">


                                    <div class="col-md-4 col mb20">
                                        <h5>{{ $followeing }}</h5>
                                        <h6 class="text-small text-muted mb-0">Followeing</h6>
                                    </div>
                                    <div class="col-md-4 col mb20">
                                        <h5>{{ $questions }}</h5>
                                        <h6 class="text-small text-muted mb-0">Questions</h6>
                                    </div>
                                    <div class="col-md-4 col mb20">
                                        <h5>{{ $answers }}</h5>
                                        <h6 class="text-small text-muted mb-0">Answers</h6>
                                    </div>
                                </div>
                            @endif

                            <hr class="mg-y-30">

                            @if (isset($contacts) && $contacts->count() > 0)
                                <label class="main-content-label tx-13 mg-b-20">Contact</label>
                                <div class="main-profile-social-list">
                                    @foreach ($contacts as $contact)
                                        <div class="media">
                                            <div class="media-icon bg-danger-transparent text-danger">
                                                <i class="icon ion-md-link"></i>
                                            </div>
                                            <div class="media-body">
                                                <span>{{ $contact->type }}</span> <a
                                                    href="">{{ $contact->value }}</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                            @endif


                            <!--skill bar-->
                        </div><!-- main-profile-overview -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">

            <div class="card">
                <div class="card-body">
                    <div class="tabs-menu ">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs profile navtab-custom panel-tabs">
                            <li class="active">
                                <a href="#home" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i
                                            class="las la-user-circle tx-16 mr-1"></i></span> <span class="hidden-xs">ABOUT
                                        ME</span> </a>
                            </li>
                            <li class="">
                                <a href="#profile" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i
                                            class="las la-images tx-15 mr-1"></i></span> <span
                                        class="hidden-xs">Address</span> </a>
                            </li>
                            @if ($user->role_id =='VENDOR')
                            <li class="">
                                <a href="#subscriptionPkg" data-toggle="tab" aria-expanded="false"> <span
                                        class="visible-xs"><i class="las la-cog tx-16 mr-1"></i></span> <span
                                        class="hidden-xs">Subscription </span> </a>
                            </li>
                            @else

                            @endif

                        </ul>
                    </div>
                    <div class="tab-content border-left border-bottom border-right border-top-0 p-4">
                        <div class="tab-pane active" id="home">
                            <h4 class="tx-15 text-uppercase mb-3">

                                @if ($user->role_id == 'VENDOR')
                                    <p class="main-profile-name-text">Vendor </p>
                                @elseif ($user->role_id == 'ADMIN')
                                    <p class="main-profile-name-text">Admin</p>
                                @elseif ($user->role_id == 'USER')
                                    <p class="main-profile-name-text">Customer</p>
                                @endif
                            </h4>
                            <p class="m-b-5">
                                @if (isset($personalInfo->first_name) && isset($personalInfo->last_name))
                                    Name : {{ $personalInfo->first_name }} &nbsp; {{ $personalInfo->last_name }}
                                @else777
                                @endif

                                <br>
                                @if (isset($personalInfo->gender))
                                    Gender : {{ $personalInfo->gender }}
                                @else
                                @endif

                                <br>
                                @if (isset($personalInfo->phone))
                                    Phone : {{ $personalInfo->phone }}
                                @else
                                @endif

                            </p>

                        </div>
                        <div class="tab-pane" id="profile">
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-striped mg-b-0 text-md-nowrap">
                                        <thead>
                                            @if (isset($address) && count($address) > 0)
                                                <tr>
                                                    <th>ID</th>
                                                    <th>country</th>
                                                    <th>city</th>
                                                    <th>street</th>
                                                    <th>landmark</th>
                                                    <th>building</th>
                                                    <th>floor</th>
                                                    <th>flat</th>
                                                </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($address as $addres)
                                                <tr>
                                                    <th scope="row">{{ $addres->id }}</th>
                                                    <td>{{ $addres->country }} </td>
                                                    <td>{{ $addres->city }}</td>
                                                    <td>{{ $addres->street }}</td>
                                                    <td>{{ $addres->landmark }}</td>
                                                    <td>{{ $addres->building }}</td>
                                                    <td>{{ $addres->floor }}</td>
                                                    <td>{{ $addres->flat }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            No Address Founded
                                            @endif

                                        </tbody>
                                    </table>
                                </div><!-- bd -->
                            </div>
                        </div>

                        @if ($user->role_id=='VENDOR')
                        <div class="tab-pane" id="subscriptionPkg">
                            <div class="row">
                                <div class="text-center">
                                    <div class=" pb-4">
                                        <a class="btn btn-outline-primary " href="{{ route('sub-details',['userId'=>$user->id]) }}">
                                            Subbscription Setting</a>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped mg-b-0 text-md-nowrap">
                                        <thead>
                                            @if (isset($subscriptions) && count($subscriptions) > 0)
                                                <tr>
                                                    <th>ID</th>
                                                    <th>pkg name</th>
                                                    <th>Start</th>
                                                    <th>End</th>
                                                    <th> Days</th>
                                                    <th>Business </th>
                                                    <th>Created At</th>
                                                </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($subscriptions as $sub)
                                                <tr>
                                                    <th scope="row">{{ $sub->id }}</th>
                                                    <td>{{ $sub->subscriptionPkg->pkg_name }}</td>
                                                    <td>{{ $sub->subscription_start }}</td>
                                                    <td>{{ $sub->subscription_end }}</td>
                                                    <td>{{ $sub->duration_in_days }}</td>
                                                    <td>{{ $sub->business_information_id }}</td>
                                                    <td>{{ $sub->created_at }}</td>

                                                </tr>
                                            @endforeach
                                        @else
                                            No Subscription Founded
                                            @endif

                                        </tbody>
                                    </table>
                                </div><!-- bd -->
                            </div>
                        </div>
                        @else

                        @endif



                    </div>
                </div>
            </div>
        </div>
    </div>





    </div>
    </div>






@endsection
{{-- Script --}}
