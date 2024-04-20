@extends('frontend.index')
@section('content')

   <!-- Contact Section Begin -->
   <section class="contact-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="contact-text">
                    <h2>Contact Info</h2>
                    <p>Welcome to sea paradise. Looking for somethin ? Message us for the best solution</p>
                    <table>
                        <tbody>
                            <tr>
                                <td class="c-o">Address:</td>
                                <td>Uttara, Dhaka</td>
                            </tr>
                            <tr>
                                <td class="c-o">Phone:</td>
                                <td>01712345678</td>
                            </tr>
                            <tr>
                                <td class="c-o">Email:</td>
                                <td>sea.paradise@gmail.com</td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-7 offset-lg-1">
                <form action="{{route('contact.store')}}" class="contact-form" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="text" placeholder="Your Name" name="name">
                        </div>
                        <div class="col-lg-6">
                            <input type="text" placeholder="Your Email" name="email">
                        </div>
                        <div class="col-lg-12">
                            <textarea placeholder="Your Message"  name="message"></textarea>
                            <button type="submit">Submit Now</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</section>
<!-- Contact Section End -->

@endsection