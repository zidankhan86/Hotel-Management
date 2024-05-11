@extends('frontend.index')
@section('content')

  <!-- Breadcrumb Section Begin -->
  <div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>Our Rooms</h2>
                    <div class="bt-option">
                        <a href="{{url('/')}}">Home</a>
                        <span>Rooms Details</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- Room Details Section Begin -->
<section class="room-details-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="room-details-item">
                    <img src="{{url('/uploads/'.$room_details->image)}}" alt="">
                    <div class="rd-text">
                        <div class="rd-title">
                            <h3>{{$room_details->category_name}}</h3>
                            <div class="rdt-right">
                                <div class="rating">

                                </div>

                            </div>
                        </div>
                        <h2>{{$room_details->price}} tk<span>/Pernight</span></h2>
                        <table>
                            <tbody>
                                <tr>
                                    <td class="r-o">Branch:</td>
                                    <td>{{$room_details->branch->branch_name}}</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Size:</td>
                                    <td>{{$room_details->area}}</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Capacity:</td>
                                    <td>{{$room_details->adult}} Adult</td>
                                </tr>

                                <tr>
                                    <td class="r-o">Capacity:</td>
                                    <td>{{$room_details->children}} Children</td>
                                </tr>

                                <tr>
                                    <td class="r-o">Services:</td>
                                    <td>Wifi, Television, Bathroom,...</td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="f-para">{!!$room_details->description!!}</p>

                    </div>
                </div>

            </div>
            <div class="col-lg-4">
                <div class="room-booking">
                    <h3>Your Reservation</h3>
                    <form action="{{ route('pay.now',$room_details->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $room_details->id }}">

                        <div class="check-date">
                            <label for="total_rooms">Total Room:</label>
                            <input type="number" min="1" id="total_rooms" name="total_rooms" placeholder="Total Room Quantity">
                            @error('total_rooms')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="check-date">
                            <label for="date-in">Check In:</label>
                            <input type="text" class="date-input" id="date-in" name="check_in_date" placeholder="Select check-in date" autocomplete="off">
                            <i class="icon_calendar"></i>
                            @error('check_in_date')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                        </div>
                        <div class="check-date">
                            <label for="date-out">Check Out:</label>
                            <input type="text" class="date-input" id="date-out" name="check_out_date" placeholder="Select check-out date" autocomplete="off">
                            <i class="icon_calendar"></i>
                            @error('check_out_date')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                        </div>

                        <div class="check-date">
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" placeholder="Your Name">
                            @error('name')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                        </div>
                        <div class="check-date">
                            <label for="address">Address:</label>
                            <input id="address" name="address" placeholder="Your Address"></input>
                            @error('address')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                        </div>
                        <div class="check-date">
                            <label for="phone">Phone:</label>
                            <input type="text" id="phone" name="phone" placeholder="Your Phone Number">
                            @error('phone')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                        </div>
                        <div class="check-date">
                            <label for="note">Note:</label>
                            <input id="note" name="note" placeholder="Any additional notes"></input>
                        </div>
                    <input type="hidden" name="transaction_id">
                    <input type="hidden" name="currency">
                    <input type="hidden" name="price" value="{{$room_details->price}}">
                    <input type="hidden" name="price" value="{{$room_details->branch->branch_name}}">
                        <button type="submit">Confirm Booking</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
</section>
<!-- Room Details Section End -->

@endsection
