<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{route('dashboard')}}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-house"></i></div>
                    Dashboard
                </a>
               
                <a class="nav-link" href="{{route('room.index')}}" >
                    <div class="sb-nav-link-icon"><i class="fas fa-hotel"></i></div>
                    Rooms
                    
                </a>
               
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-building-wheat"></i></div>
                    Features & Facilities
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="{{route('features.index')}}"  aria-expanded="false" aria-controls="pagesCollapseAuth">
                            Features
                           
                        </a>
                        <a class="nav-link collapsed" href="{{route('facilities.index')}}"  aria-expanded="false" aria-controls="pagesCollapseAuth">
                            Facilities
                           
                        </a>
                     
                    </nav>
                </div>
                <a class="nav-link" href="charts.html">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-shopping"></i></div>
                    Booking
                </a>
                <a class="nav-link" href="{{route('setting.index')}}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-gears"></i></div>
                    Setting
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{auth()->user()->name}}
        </div>
    </nav>
</div>