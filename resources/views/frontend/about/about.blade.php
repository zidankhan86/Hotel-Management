 <!-- About Us Section Begin -->
 <section class="aboutus-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="about-text">
                    <div class="section-title">
                        <span>About Us</span>
                        @if ($about)
                            <h2>{{$about->tittle}}</h2>
                        @else
                            <p>No data available</p>
                        @endif

                    </div>
                    
                    @if ($about)
                        <p class="f-para">{{$about->description}}</p>
                    @else
                        <p>No Description available</p>
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-pic">
                    <div class="row">
                        @if ($about)
                        <div class="col-sm-12">
                            <img src="{{('/uploads/'.$about->image)}}" alt="About">
                        </div>
                    @else
                        <p>No Image available</p>
                    @endif
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Us Section End -->