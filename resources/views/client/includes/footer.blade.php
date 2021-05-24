<!--Start Footer-->
<div class="footer" id="DownToAboutus">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-6">
                <div class="site-info">
                    <img src="{{ asset('images/logos/logo.png') }}" width="150px" alt="">
                    <p>High-tech shop is a company specializing in the supply of computers and electronic components.  We offer a wide range of custom-made or personalized computers.  We offer the customer to customize their desktop computer with a wide range of compatible and quality components.</p>
                    <a href="{{ route('contact.create') }}" target="_blank">Team & support</a>
                </div>
            </div>
            <div class="col-sm col-lg">
                <div class="contact">
                    <h2>Contact us</h2>
                    <ul class="list-unstyled">
                        <li>Algeria</li>
                        <li>CEO : {{ env('CEO') }}</li>
                        <li>Costumer service: {{ env('CUSTOMER_SERVICE_ONE') }} / {{ env('CUSTOMER_SERVICE_TWO') }} / {{ env('CUSTOMER_SERVICE_THREE') }}</li>
                        <li>Email: <a href="{{ 'mailto:'.env('email') }}">{{ env('email') }}</a></li>
                    </ul>
                </div>
            </div>

            </div>
        </div>
    </div>
</div>
<!--End Footer-->

<!--Start Copyright-->
<div class="copyright">
    <div class="container">
        <div class="text-center">
            &copy; 2021 ht-shop - All rights reserved
        </div>
    </div>
</div>
<!--End Copyright-->