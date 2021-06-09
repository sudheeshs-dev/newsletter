@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mx-auto m-2" style="width: 70%">
                <div class="card-body">
                    <div class="card-title">
                        <h2>Users Bulk Upload</h2>
                        <a href="datas/users_csv.csv" class="btn btn-link">Download CSV</a>
                    </div>
                    <form action="{{url('getcsvfile')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" class="form-control">
                        <div class="d-grid gap-2 col-6 mx-auto m-3">
                            <button class="btn btn-success" type="submit">Upload</button>
                          </div>
                    </form> 
                 
                </div>
              </div>
        </div>
    </div>
@endsection