@extends('layouts.master')

@section('title')
    answers
@stop
@section('css')

@endsection


@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto" style="color:rgb(32, 98, 240)">Answer</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">
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


                        @if ($answers != null && $answers->count() > 0)

                                <th class="wd-10p">created</th>
                                <th>updated at</th>
                                <th class="wd-80p">Answers </th>
                        @else
                        @endif

                    </tr>

                </thead>
                <tbody>
                    @if ($answers != null && $answers->count() > 0)
                        @foreach ($answers as $answer)
                            <tr>
                                <td><a href="{{ route('user-details', $answer->user->id) }}">
                                        <img alt="avatar" class="rounded-circle avatar-sm ml-2 "
                                            src="{{ $answer->user->profile_photo_path }}">{{ $answer->user->name }}

                                    </a></td>
                                @if (@isset($answer->created_at))
                                    <td>{{ $answer->created_at }}</td>
                                @else
                               <td> no time for create</td>
                                @endif

                                @if (isset($answer->updated_at) )
                                    <td>{{ $answer->updated_at }}</td>
                                @else
                               <td> no time for update</td>
                                @endif
                                <td><mark>{{ $answer->answers_text }}</mark> </td>
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
