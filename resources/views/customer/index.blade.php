@extends('layouts.admin')
@section('content')
    <div class="row mt-2">
        <div class="col-md-12">
            <h2 class="text-center">{{ $name }}</h2>
            <button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i
                    class="fa fa-plus"></i> Create new {{ $name }} </button>
                    <a href="{{url('customersbulk')}}" class="btn btn-info text-white">Bulk Upload</a>
            {{-- create --}}

            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">new {{ $name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ url($urls) }}" method="POST" autocomplete="off">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter your Name" name="name"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Enter your Email" name="email"
                                        required>
                                </div>
                                <label for="user">User Group</label>
                                <select class="form-select mb-3" aria-label="User Group" name="user" id="user">
                                    @foreach ($usergroups as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <label for="status">Status</label>
                                <select class="form-select" aria-label="Select Status" name="status">
                                    <option value="1">Enable</option>
                                    <option value="0">Disable</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- end create --}}
        </div>
    </div>
    {{-- Table --}}

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>User Group</th>
                <th>status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @php
                $c = 1;
            @endphp
            @if (count($datas) < 1)
                <tr>
                    <td colspan="4" align="center">No Datas</td>
                </tr>
            @endif
            @foreach ($datas as $data)


                <tr>
                    <td>{{ $c++ }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ \App\Models\UserGroup::find($data->user_group)->value('name') }}</td>
                    <td>
                        @if ($data->status == 1)
                            <span class="text-success">Enabled</span>
                        @else
                            <span class="text-danger">Disabled</span>
                        @endif
                    </td>
                    <td>
                        <button href="#" class="btn btn-info text-white" data-bs-toggle="modal"
                            data-bs-target="#editData{{ $data->id }}">Edit <i class="fa fa-edit"></i></button>
                        {{-- Edit --}}

                        <div class="modal fade" id="editData{{ $data->id }}" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Edit {{ $name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ url($urls, $data->id) }}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="name" placeholder="Enter your Name" name="name"
                                                    required value="{{$data->name}}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" placeholder="Enter your Email" name="email"
                                                    required value="{{$data->email}}">
                                            </div>
                                            <label for="user">User Group</label>
                                            <select class="form-select mb-3" aria-label="User Group" name="user" id="user">
                                                @foreach ($usergroups as $user)
                                                    <option value="{{ $user->id }}" {{ $data->user_group == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="status">Status</label>
                                            <select class="form-select" aria-label="Select Status" name="status">
                                                <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>Enable</option>
                                                <option value="0" {{ $data->status == 0 ? 'selected' : '' }}>Disable</option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- end Edit --}}
                        <button href="#" class="btn btn-danger text-white" data-bs-toggle="modal"
                            data-bs-target="#deleteData{{ $data->id }}">Remove <i class="fa fa-times"></i></button>
                        {{-- Delete --}}

                        <div class="modal fade" id="deleteData{{ $data->id }}" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Edit {{ $name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ url($urls, $data->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <div class="modal-body">
                                            <p>Are you sure to Remove <strong>{{ $data->name }}</strong> ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-danger">Remove</button>
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


    {{-- Table End --}}
@endsection
