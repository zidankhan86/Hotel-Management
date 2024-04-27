@extends('frontend.index')
@section('content')
<br>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />

<div class="container">
<div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="invoice-title">
                        <h4 class="float-end font-size-15">#{{ $inv->price }}{{ $inv->id }}67890<span class="badge bg-success font-size-12 ms-2">{{$inv->status}}</span></h4>
                        <div class="mb-4">
                           <h2 class="mb-1 text-muted">sea paradise.com</h2>
                        </div>
                        <div class="text-muted">
                            <p class="mb-1">{{$inv->address}}</p>
                            <p class="mb-1"><i class="uil uil-envelope-alt me-1"></i> sea paradise.com</p>
                            <p><i class="uil uil-phone me-1"></i>{{$inv->phone}}</p>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="text-muted">
                                <h5 class="font-size-16 mb-3">Billed To:</h5>
                                <h5 class="font-size-15 mb-2">{{$inv->name}}</h5>
                                <p class="mb-1">{{$inv->address}}</p>
                                <p class="mb-1">{{auth()->user()->email}}</p>
                                <p>{{$inv->phone}}</p>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-sm-6">
                            <div class="text-muted text-sm-end">
                                <div>
                                    <h5 class="font-size-15 mb-1">Invoice No:</h5>
                                    <p>#{{ $inv->price }}{{ $inv->id }}67890</p>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-15 mb-1">Invoice Date:</h5>
                                    <p>{{ $inv->created_at }}</p>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-15 mb-1">Order No:</h5>
                                    <p>#{{ $inv->price }}{{ $inv->id }}67890</p>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                    
                    <div class="py-2">
                        <h5 class="font-size-15">Order Summary</h5>

                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 70px;">No.</th>
                                        <th>Item</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th class="text-end" style="width: 120px;">Total</th>
                                    </tr>
                                </thead><!-- end thead -->
                                <tbody>
                                    <tr>
                                        <th scope="row">01</th>
                                        <td>
                                            <div>
                                                <h5 class="text-truncate font-size-14 mb-1">{{ $inv->name }}</h5>
                                               
                                            </div>
                                        </td>
                                        <td>{{ $inv->price }} Taka</td>
                                        <td>{{ $inv->total_rooms }}</td>
                                        <td class="text-end">{{ $inv->price }} Taka</td>
                                    </tr>
                                   
                                </tbody><!-- end tbody -->
                            </table><!-- end table -->
                        </div><!-- end table responsive -->
                        <div class="d-print-none mt-4">
                            <div class="float-end">
                                <a href="javascript:window.print()" class="btn btn-success me-1"><i class="fa fa-print"></i></a>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->
    </div>
</div><br>
<style>
    body{margin-top:20px;
background-color:#eee;
}

.card {
    box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: 1rem;
}
</style>
@endsection

