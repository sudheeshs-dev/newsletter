@extends('layouts.admin')
@section('content')
<h1>On Processing Queue</h1>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>status</th>
            <th>Mailing Status</th>
            <th>User Group</th>
            <th>Start Date</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @php
            $c = 1;
        @endphp
        @if (count($datas) < 1)
            <tr>
                <td colspan="8" align="center">No Datas</td>
            </tr>
        @endif
        @foreach ($datas as $data)


            <tr>
                <td>{{ $c++ }}</td>
                <td>{{ $data->name }}</td>
                <td>
                    @if ($data->status == 1)
                        <span class="text-success">Enabled</span>
                    @else
                        <span class="text-danger">Disabled</span>
                    @endif
                </td>
                <td>
                    @if ($data->mailing_status == 1)
                        <span class="text-success">Enabled</span>
                    @else
                        <span class="text-danger">Disabled</span>
                    @endif
                </td>
                <td>{{ \App\Models\UserGroup::find($data->user_group)->value('name') }}</td>
                <td>{{$data->start_date}}</td>
               
                <td>
                    <button href="#" class="btn btn-danger text-white" data-bs-toggle="modal"
                        data-bs-target="#deleteData{{ $data->id }}">Force Process <i class="fa fa-work"></i></button>
                    {{-- Delete --}}

                    <div class="modal fade" id="deleteData{{ $data->id }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Force Immediately </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ url('forcejob') }}" method="POST">
                                   
                                    @csrf
                                    <div class="modal-body">
                                        <input type="hidden" name="uId" value="{{$data->id}}">
                                        <p>Are you sure to Remove <strong>{{ $data->name }}</strong> ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">Process Now</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- end Delete --}}
                </td>
               
            </tr>
        @endforeach
    </tbody>
</table>
@endsection