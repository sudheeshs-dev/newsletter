@extends('layouts.admin')
@section('content')
    <div class="row mt-2">
        <div class="col-md-12">
          <h2 class="text-center">{{$name}}</h2>
                <button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa fa-plus"></i> Create new {{$name}} </button>
        {{-- create --}}

        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">new {{$name}}</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{url($urls)}}" method="POST" autocomplete="off">
                    @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="editors" name="name" required>
                      </div>
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
            <th width="10%">#</th>
            <th width="40%">Name</th>
            <th width="30%">status</th>
            <th width="20%"></th>
        </tr>
    </thead>
    <tbody>
        @php
            $c=1;
        @endphp
        @if(count($datas) < 1 )
        <tr>
            <td colspan="4" align="center">No Datas</td>
        </tr>    
        @endif
        @foreach ($datas as $data)
            
       
        <tr>
            <td>{{$c++}}</td>
            <td>{{$data->name}}</td>
            <td>@if ($data->status == 1)
                <span class="text-success">Enabled</span>
                @else 
                <span class="text-danger">Disabled</span>
            @endif
        </td>
            <td>
                <button href="#" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#editData{{$data->id}}">Edit <i class="fa fa-edit"></i></button>
                  {{-- Edit --}}

        <div class="modal fade" id="editData{{$data->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Edit {{$name}}</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{url($urls,$data->id)}}" method="POST">
                    @method('PUT')
                    @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="editors" name="name" value="{{$data->name}}" required>
                      </div>
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
                <button href="#" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#deleteData{{$data->id}}">Remove <i class="fa fa-times"></i></button>
                {{-- Delete --}}

        <div class="modal fade" id="deleteData{{$data->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Edit {{$name}}</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{url($urls,$data->id)}}" method="POST">
                    @method('DELETE')
                    @csrf
                <div class="modal-body">
                  <p>Are you sure to Remove <strong>{{$data->name}}</strong> ?</p>
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