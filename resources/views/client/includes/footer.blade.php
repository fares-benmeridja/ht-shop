<!--Start Footer-->
<div class="footer" id="DownToAboutus">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-6">
                <div class="site-info">
                    <img src="{{ asset('img/logo.png') }}" width="150px" alt="">
                    <p>Crafty DZ is where the best Algerian Craftsmen & Artists gather to realize their Artwork and masterpieces for the purpose of promoting the vast Algerian culture linking it with the international market. therefore, providing high levels of professional products and services for all classes and destinations.
                        The core of the idea is to able clients and partners to connect directly with their desired merchandise or service provider with no difficulty, a very short process, flawless exchange, and most importantly, a Shining Smile on both ends of your call or contact.</p>
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