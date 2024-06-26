@extends('backend.index')
@section('content')


<div>
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Booking List</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Booking List</li>
            </ol>
           
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Booking List
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th scope="col">Serial</th>
                                    <th scope="col"> Check In</th>
                                    <th scope="col"> Check Out</th>
                                    <th scope="col"> Name</th>
                                    <th scope="col"> Room Type</th>
                                    <th scope="col"> Price</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Note</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                    <th scope="col">Invoice</th>
                            </tr>
                        </thead>
                     
                        <tbody>
                            @php
                            $id = 1;
                            @endphp

                            @foreach ($orders as $item)
                            <tr>
                                <th scope="row">#{{ $id++ }}</th>

                                <td>{{ date('d M Y', strtotime($item->check_in)) }}</td>
                                <td>{{ date('d M Y', strtotime($item->check_out)) }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->room?->category_name }}</td>
                                <td>{{ $item->room?->price }} Tk.</td>
                                <td>{{ $item->user?->email }}</td>
                                <td>{{ $item->address }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->note }}</td>
                                <td>{{ $item->status }}</td>
                                <td style="border: 1px solid #ddd; padding: 8px;">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{$item->id}}"
                                                    class="dropdown-item"><i class="fas fa-edit"></i> Action</a></li>
                                            
                                        </ul>

                                    <td><a href="{{route('invoice.backend',$item->id)}}" class="btn btn-info">invoice</a></td>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                           
                            
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    
</div>

@foreach ($orders as $item)
<div class="modal fade" id="editModal{{$item->id}}" tabindex="-1" aria-labelledby="editModal{{$item->id}}Label"
    aria-hidden="true">
    <div class="modal-dialog" style="max-width: 20%; width: 20%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModal{{$item->id}}Label">Edit Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('booking.status', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="edit_status" class="col-form-label">Status</label>
                            <select name="status" id="edit_status" class="form-control">

                                <option value="confirmed" {{$item->status == 'confirmed' ? 'selected' : ''}}>Confirm</option>
                                <option value="pending" {{$item->status == 'pending' ? 'selected' : ''}}>Pending
                                </option>
                                <option value="cancel" {{$item->status == 'cancel' ? 'selected' : ''}}>Cancel</option>
                                <option value="closed" {{$item->status == 'closed' ? 'selected' : ''}}>Closed</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
