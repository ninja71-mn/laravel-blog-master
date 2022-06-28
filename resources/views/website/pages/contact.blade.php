@extends('website.template.master')

@section('content')
    <section class="title-section text-right text-sm-center">
        <h1>در <span>تماس </span> باشید</h1>
        <span class="title-bg">contact</span>
    </section>
    <section class="main-content contact">
        <div class="container d-sm-pt-1">
            @include('partials.alert')
            <div class="row rtl">
                <div class="col-12 col-lg-4">
                    <h3 class="text-uppercase custom-title mb-0 ft-wt-600 pb-3">Don't be shy !</h3>
                    <p class="irsans mb-3">Feel free to get in touch with me. I am always open to discussing new projects, creative ideas or opportunities to be part of your visions.</p>
                    <p class="irsans custom-span-contact position-relative">
                        <i class="fa fa-envelope-open position-absolute"></i>
                        <span class="d-block">mail me</span><span class="ltr">steve@mail.com</span>
                    </p>
                    <p class="irsans custom-span-contact position-relative">
                        <i class="fa fa-phone-square position-absolute"></i>
                        <span class="d-block">call me</span><a class="text-var" href="tel:+989362656364">09362656364</a>
                    </p>
                    <ul class="social list-unstyled pt-1 mb-5">
                        <li class="facebook"><a title="Facebook" href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li class="twitter"><a title="Twitter" href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li class="youtube"><a title="Youtube" href="#"><i class="fa fa-youtube"></i></a>
                        </li>
                        <li class="dribbble"><a title="Dribbble" href="#"><i class="fa fa-dribbble"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-lg-8">
                        {!! Form::open(['route' => 'contact.submit', 'method' => 'post','class'=>'contactform']) !!}

                        <div class="contactform">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <input type="text" name="name" placeholder="YOUR NAME" required>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input type="email" name="email" placeholder="YOUR EMAIL" required>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input type="text" name="subject" placeholder="YOUR SUBJECT" required>
                                </div>
                                <div class="col-12">
                                    <textarea name="message" placeholder="YOUR MESSAGE" required></textarea>
                                    <button type="submit" class="btn btn-contact"><span data-hover="Send Message">Send Message</span></button>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@endsection

