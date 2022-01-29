@extends('admin.app')

@section('title') {{ $title }} @endsection

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-cogs"></i> {{ $title }}</h1>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('admin.users') }}" class="btn btn-primary text-white mr-1 mb-4" type="button">Back To Pages</a>
          <div class="tile">
            <div class="tile-body">
              <table class="table table-hover table-bordered" id="sampleTable">
                <tbody>
                    <tr><th>ID</th><td>{{ $users->id }}</td></tr>
                    <tr> <th>Name</th><td>{{ $users->profile }}</td></tr>                    
                    <tr> <th>Name</th><td>{{ $users->name }}</td></tr>                    
                    <tr><th>Email</th><td>{{ $users->email }}</td></tr>
                    <tr><th>Phone</th><td>{{ $users->phone }}</td></tr>
                    <tr><th>Address</th><td>{{ $users->address }}</td></tr>                  
                    <tr><th>City</th><td>{{ $users->city }}</td></tr>                  
                    <tr><th>State</th><td>{{ $users->state }}</td></tr>                  
                    <tr><th>Country</th><td>{{ $users->country }}</td></tr>                  
                    <tr><th>Zipcode</th><td>{{ $users->zipcode }}</td></tr>                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
@endsection
