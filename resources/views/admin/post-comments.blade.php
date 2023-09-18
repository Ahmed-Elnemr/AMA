@extends('layouts.master')

@section('title')
    comments
@stop
@section('css')

@endsection


@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"style="color:rgb(82, 129, 230)">Comments</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">
                </span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection


@section('content')
    <div class="row">
        <div class="table-responsive">
            <table class="table main-table-reference text-nowrap mg-t-0 mb-0">
                <thead>



                    <tr>
                        <th class="wd-10p">Users</th>
                        <th class="wd-10p">created</th>
                        @if ($comments != null && $comments->count() > 0)
                            @foreach ($comments as $comment)
                                @if ($comment->updated_at !=null)
                                    <th>updated at</th>
                                @else
                                @endif
                            @endforeach
                        @else
                        @endif

                        <th class="wd-80p">Comments </th>
                    </tr>

                </thead>
                <tbody>
                    @if ($comments != null && $comments->count() > 0)
                        @foreach ($comments as $comment)
                            <tr>

                                <td>
                                    <img alt="avatar" class="rounded-circle avatar-sm mr-2 "
                                                        src="{{ $comment->user->profile_photo_path }}">
                                    <a href="{{ route('user-details', $comment->user->id) }}">{{ $comment->user->name }}</a>
                                </td>
                                <td>{{ $comment->created_at }}</td>
                                @if ($comment->updated_at !=null)
                                    <td>{{ $comment->updated_at }}</td>
                                @else
                                @endif
                                <td><mark>{{ $comment->comments_posts_text }}</mark> </td>
                            </tr>
                        @endforeach
                    @else
                        <h1 class="text-center "> No Answers Founded</h1>
                    @endif


                </tbody>
            </table>
        </div>

    </div>
    </div>
    </div>
@endsection



{{-- Script --}}
@section('script')

@endsection
