@extends('backend.index')
@section('content')

<div class="container">
    <div class="container">
        <div class="container">
            <div class="container">
                <div class="container">
                    <div class="container">
                    <br>
                    <h4 class="text-success text-center">Booking List</h4>
                    <br>
                    <table class="table">
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

                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $id = 1;
                            @endphp

                        @foreach ($orders as $item)
                        <tr>
                            <th scope="row">{{ $id++ }}</th>
                            
                            <td>{{ $item->check_in }}</td>
                            <td>{{ $item->check_out }}</td>
                            <td>{{ $item->name }}</td>  
                            <td>{{ $item->category_name }}</td>
                            <td>{{ $item->price }} Tk.</td>
                            <td>{{ $item->address }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->note }}</td>
                            <td>{{ $item->status }}</td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                 </div>
            </div>
        </div>
    </div>
</div>

@endsection
