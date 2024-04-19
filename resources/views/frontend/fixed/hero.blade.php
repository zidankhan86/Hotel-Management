 <!-- Hero Section Begin -->
 <section class="hero-section">

    @php
        $hero = App\Models\Banner::first(); 
    @endphp

    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="hero-text">
                   
                @if (empty($hero))
                    <h1>Sea Paradise</h1>
                @else
                    <h1>{{ $hero->tittle }}</h1>
                @endif

                @if (empty($hero))
                <p>Here are the best hotel booking sites, including recommendations for international
                    travel and for finding low-priced hotel rooms.</p>
                @else
                <p>{{ $hero->description }}</p>
                @endif
                    
                    <a href="#" class="primary-btn">Discover Now</a>
                </div>
            </div>
           
        </div>
    </div>
    @if (empty($hero))
        <div class="hero-slider owl-carousel">
            <div class="hs-item set-bg" data-setbg="{{asset('frontend/img/hero/hero-1.jpg')}}"></div>
        </div>
    @else
        <div class="hero-slider owl-carousel">
            <div class="hs-item set-bg" data-setbg="{{asset('/uploads/'.$hero->image)}}"></div>
        </div>
    @endif
    
</section>
<!-- Hero Section End -->