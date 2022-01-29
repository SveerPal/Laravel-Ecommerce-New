@extends('admin.app')

@section('title') {{ $title }} @endsection

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fas fa-tag"></i> {{ $title }}</h1>
        </div>
    </div>
    
    
    @if(Session::has('success'))
    <div class="bs-component">
        <div class="alert alert-dismissible alert-success">
            <button class="close" type="button" data-dismiss="alert">×</button><strong></strong>{{Session::get('success')}}
        </div>
    </div>
    @else    
        @if ($errors->any())
        <div class="bs-component">
            <div class="alert alert-dismissible alert-danger">
                <button class="close" type="button" data-dismiss="alert">×</button><strong>Oh snap! </strong>Something went wrong. Please Check try again.
            </div>
        </div>
        @endif    
    @endif 
    
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('admin.orders.create') }}" class="btn btn-primary text-white mr-1 mb-4" type="button"><i class="fas fa-plus"></i> Create Order</a>
          <div class="tile">
            <div class="tile-body">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Order Id</th>                       
                    <th>Transaction Id</th>
                    <th>Amount</th>                 
                    <th>Status</th>                   
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->orderno }}</td>                      
                        <td>{{ $order->transaction_id }}</td>                       
                        <td>{{ $order->amount }}</td>                                               
                        <td>{{ $order->status }}</td>                        
                        <td>{{ $order->created_code }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show',['id'=>$order->id]) }}" class="btn btn-info text-white" type="button"><i class="fas fa-info-circle"></i></a>                           
                            <a href="{{ route('admin.orders.edit',['id'=>$order->id]) }}" class="btn btn-secondary text-white" type="button"><i class="fas fa-edit"></i></a>
                            <a href="{{ route('admin.orders.delete',['id'=>$order->id]) }}" class="btn btn-danger text-white" type="button"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach 
                </tbody>  
              </table>
            </div>
          </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
@endpush
