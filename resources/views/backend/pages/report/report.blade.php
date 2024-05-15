@extends('backend.index')

@section('content')

<h1>Booking Report</h1>

<form action="{{route('order.report.search')}}" method="get">

<div class="container">
        <div class="row align-items-end">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="from_date">From date:</label>
                    <input name="from_date" type="date" class="form-control" id="from_date">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="to_date">To date:</label>
                    <input name="to_date" type="date" class="form-control" id="to_date">
                </div>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-success btn-block">Search</button>
            </div>
        </div>
    </div>

</form>
<div id="orderReport">

<h1>Booking Reports- {{date('Y-m-d')}}</h1>
    <table class="table table-striped">
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

                        @foreach ($booking as $item)
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
                             
                            </td>
                        </tr>
                        @endforeach
      
        </tbody>
    </table>
</div>
<button onclick="printDiv('orderReport')" class="btn btn-success">Print</button>


<script>
    function printDiv(divId){
        var printContents = document.getElementById(divId).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>

@endsection
