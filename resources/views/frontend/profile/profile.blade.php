@extends('frontend.index')
@section('content')


<style>
    body{
    color: #6F8BA4;
    margin-top:20px;
}
.section {
    padding: 100px 0;
    position: relative;
}
.gray-bg {
    background-color: #f5f5f5;
}
img {
    max-width: 100%;
}
img {
    vertical-align: middle;
    border-style: none;
}
/* About Me
---------------------*/
.about-text h3 {
  font-size: 45px;
  font-weight: 700;
  margin: 0 0 6px;
}
@media (max-width: 767px) {
  .about-text h3 {
    font-size: 35px;
  }
}
.about-text h6 {
  font-weight: 600;
  margin-bottom: 15px;
}
@media (max-width: 767px) {
  .about-text h6 {
    font-size: 18px;
  }
}
.about-text p {
  font-size: 18px;
  max-width: 450px;
}
.about-text p mark {
  font-weight: 600;
  color: #20247b;
}

.about-list {
  padding-top: 10px;
}
.about-list .media {
  padding: 5px 0;
}
.about-list label {
  color: #20247b;
  font-weight: 600;
  width: 88px;
  margin: 0;
  position: relative;
}
.about-list label:after {
  content: "";
  position: absolute;
  top: 0;
  bottom: 0;
  right: 11px;
  width: 1px;
  height: 12px;
  background: #20247b;
  -moz-transform: rotate(15deg);
  -o-transform: rotate(15deg);
  -ms-transform: rotate(15deg);
  -webkit-transform: rotate(15deg);
  transform: rotate(15deg);
  margin: auto;
  opacity: 0.5;
}
.about-list p {
  margin: 0;
  font-size: 15px;
}

@media (max-width: 991px) {
  .about-avatar {
    margin-top: 30px;
  }
}

.about-section .counter {
  padding: 22px 20px;
  background: #ffffff;
  border-radius: 10px;
  box-shadow: 0 0 30px rgba(31, 45, 61, 0.125);
}
.about-section .counter .count-data {
  margin-top: 10px;
  margin-bottom: 10px;
}
.about-section .counter .count {
  font-weight: 700;
  color: #20247b;
  margin: 0 0 5px;
}
.about-section .counter p {
  font-weight: 600;
  margin: 0;
}
mark {
    background-image: linear-gradient(rgba(252, 83, 86, 0.6), rgba(252, 83, 86, 0.6));
    background-size: 100% 3px;
    background-repeat: no-repeat;
    background-position: 0 bottom;
    background-color: transparent;
    padding: 0;
    color: currentColor;
}
.theme-color {
    color: #fc5356;
}
.dark-color {
    color: #20247b;
}

</style>
<section class="section about-section gray-bg" id="about">
    <div class="container">
        <div class="row align-items-center flex-row-reverse">
            <div class="col-lg-6">
                <div class="about-text go-to">
                    <h3 class="dark-color">{{ (auth()->user()->name) }}</h3>

                    <div class="row about-list">
                        <div class="col-md-6">
                            <div class="media">
                                <label>Name</label>
                                <p style="color: blue;">{{ (auth()->user()->name) }}</p>
                            </div>
                            <div class="media">
                                <label>Phone</label>
                                <p style="color: blue;">{{ (auth()->user()->phone) }}</p>
                            </div>
                            <div class="media">
                                <label>Email</label>
                                <p style="color: blue;">{{ (auth()->user()->email) }}</p>
                            </div>
                            <div class="media">
                                <label>Address</label>
                                <p style="color: blue;">{{ (auth()->user()->address) }}</p>
                            </div>
                        </div>

                    </div><br><br>

                                <!-- Booking History -->
                    <h3>Booking History</h3><br>

                   
                  
                            </div>
                            
                        </div>

                        
                        <div class="col-lg-6">
                            <div class="about-avatar">
                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" title="" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="table-container">
                      <table class="table">
                          <thead>
                              <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Booking Name</th>
                                  <th scope="col">Order ID</th>
                                  <th scope="col">Pay</th>
                                  <th scope="col">Placed On</th>
                                  <th scope="col">Transaction No</th>
                                  <th scope="col">Order Status</th>
                                  <th scope="col">Action</th>
                                  <th scope="col">Invoice</th>
                              </tr>
                          </thead>
                          <tbody>
                              @if (empty($booked_hotel))
                              <tr>
                                  <td colspan="8">No Booking History</td>
                              </tr>
                              @else
                              @foreach ($booked_hotel as $index => $item)
                              <tr>
                                  <th scope="row">{{ $index + 1 }}</th>
                                  <td>{{ $item->room->category_name }}</td>
                                  <td>#{{ $item->price }}{{ $item->id }}67890</td>
                                  <td>BDT {{ $item->room->price }}</td>
                                  <td>{{ $item->created_at }}</td>
                                  <td>{{ $item->transaction_id }}</td>
                                  <td>{{ $item->status }}</td>
                                  <td>
                                      @if($item->status == 'Pending')
                                      <a href="{{ route('cancel.hotel', $item->id) }}" class="btn btn-danger">Cancel Booking</a>
                                      @elseif($item->status == 'Canceled')
                                      <button class="genric-btn danger circle" style="color: rgb(223, 13, 48);">Booking Canceled</button>
                                      @endif
                                  </td>
                                  <td><a href="{{route('invoice',$item->id)}}" class="btn btn-info">Invoice</a></td>
                              </tr>
                              @endforeach
                              @endif
                          </tbody>
                      </table>
                  </div>
                </div>
</section>
@endsection