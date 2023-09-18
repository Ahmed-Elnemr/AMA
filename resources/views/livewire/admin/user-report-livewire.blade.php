<div>

    <div class="col-xl-12">
        @if (session()->has('message'))
            <h5 class="alert alert-success">{{ session('message') }}</h5>
        @endif

        <div class="row row-sm">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
                <div class="card">
                    <div class="card-header pb-0 ">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mg-b-0">Users Report Table </h4>
                        </div>
                        {{-- <div class="text-center">
                                <input type="search" wire:model="search" class="form-control float-end mx-2"
                                    placeholder="Search...name" style="width: 230px" />
                            </div> --}}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive border-top userlist-table">
                            <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="wd-lg-8p"><span>Id</span></th>
                                        <th class="wd-lg-20p"><span>Status</span></th>
                                        <th class="wd-lg-8p"><span>By</span></th>
                                        <th class="wd-lg-20p"><span></span></th>
                                        <th class="wd-lg-8p"><span>For</span></th>
                                        <th class="wd-lg-20p"><span></span></th>
                                        <th class="wd-lg-20p"><span>Reson</span></th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($reports) && $reports->count() > 0)
                                        @foreach ($reports as $report)
                                            <tr>
                                                <td>{{ $report->id }}</td>
                                                <td>
                                                    <label > {{ $report->status }}</label><br>
                                                    <input type="checkbox" wire:click='status({{ $report->id }})'
                                                        {{ $report->status == 'aproved' ? 'checked' : '' }}>
                                                </td>
                                                <td>

                                                    @if (isset($report->byUser->profile_photo_path))
                                                        <img alt="avatar" class="rounded-circle avatar-md mr-2"
                                                            src="{{ $report->byUser->profile_photo_path }}">
                                                    @else
                                                        <img alt="avatar" class="rounded-circle avatar-md mr-2"
                                                            src="{{ URL::asset('assets/img/faces/1.jpg') }}">
                                                    @endif

                                                </td>
                                                <td>
                                                    @if (isset($report->byUser->name))
                                                        {{ $report->byUser->name }}
                                                    @else
                                                    @endif
                                                </td>
                                                <td>

                                                    @if (isset($report->forUser->profile_photo_path))
                                                        <img alt="avatar" class="rounded-circle avatar-md mr-2"
                                                            src="{{ $report->forUser->profile_photo_path }}">
                                                    @else
                                                        <img alt="avatar" class="rounded-circle avatar-md mr-2"
                                                            src="{{ URL::asset('assets/img/faces/1.jpg') }}">
                                                    @endif
                                                </td>

                                                <td>
                                                    @if (isset($report->forUser->name))
                                                        {{ $report->forUser->name }}
                                                    @else
                                                    @endif

                                                </td>
                                                <td>
                                                    {{ $report->reson }}
                                                </td>


                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <div class="text-center p-2">
                                {{ $reports->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- COL END -->
        </div>
    </div><!-- bd -->




</div>
</div>
</div>
