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
                <form action="{{url($urls)}}" method="POST">
                    @csrf
                <div class="modal-body">
                  
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
        <tr>
            <td>1</td>
            <td>Name</td>
            <td>Status</td>
            <td>
                <button href="#" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#editData1">Edit <i class="fa fa-edit"></i></button>
                  {{-- Edit --}}

        <div class="modal fade" id="editData1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Edit {{$name}}</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{url($urls)}}" method="POST">
                    @method('PUT')
                    @csrf
                <div class="modal-body">
                  
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
              </div>
            </div>
          </div>

        {{-- end Edit --}}
                <button href="#" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#deleteData1">Remove <i class="fa fa-times"></i></button>
                {{-- Delete --}}

        <div class="modal fade" id="deleteData1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Edit {{$name}}</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{url($urls)}}" method="POST">
                    @method('DELETE')
                    @csrf
                <div class="modal-body">
                  
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
    </tbody>
</table>


{{-- Table End --}}
@endsection