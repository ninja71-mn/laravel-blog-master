@extends('website.template.master')

@section('content')
    <section class="title-section text-right text-sm-center">
        <h1>ABOUT <span>ME</span></h1>
        <span class="title-bg">resume</span>
    </section>
    <section class="main-content">
        <div class="container d-sm-pt-1">
            <div class="row rtl">
                <div class="col-12 col-xl-6 col-lg-6">
                    <div class="row">
                        <div class="col-12 irsans mb-3">اطلاعات شخصی</div>
                        <div class="col-12 d-block d-sm-none">
                            <img src="img/img-mobile.jpg" class="img-fluid main-img-mobile" alt="my picture">
                        </div>
                        <div class="col-12 col-md-5 d-sm-pr-3">
                            <ul class="about-list list-unstyled irsans pr-0">
                                <li class="mb-3"> <span class="title">نام :</span> <span class="value d-sm-inline-block d-lg-block d-xl-inline-block">محمد</span> </li>
                                <li class="mb-3"> <span class="title">نام خانوادگی :</span> <span class="value d-sm-inline-block d-lg-block d-xl-inline-block">دریاکش</span> </li>
                                <li class="mb-3"> <span class="title">سن :</span> <span class="value d-sm-inline-block d-lg-block d-xl-inline-block">28 سال</span> </li>
                                <li class="mb-3"> <span class="title">استان :</span> <span class="value d-sm-inline-block d-lg-block d-xl-inline-block">خوزستان</span> </li>
                                <li class="mb-3"> <span class="title">شهر :</span> <span class="value d-sm-inline-block d-lg-block d-xl-inline-block">دزفول</span> </li>
                            </ul>
                        </div>
                        <div class="col-12 col-md-7 d-sm-pr-3">
                            <ul class="about-list list-unstyled irsans pr-0">
                                <li class="mb-3"> <span class="title">وضعیت تاهل :</span> <span class="value d-sm-inline-block d-lg-block d-xl-inline-block">مجرد</span> </li>
                                <li class="mb-3"> <span class="title">سربازی :</span> <span class="value d-sm-inline-block d-lg-block d-xl-inline-block">پایان خدمت</span> </li>
                                <li class="mb-3"> <span class="title">ایمیل :</span> <span class="value d-sm-inline-block d-lg-block d-xl-inline-block">mohammad.dryksh@gmail.com</span> </li>
                                <li class="mb-3"> <span class="title">همراه :</span> <span class="value d-sm-inline-block d-lg-block d-xl-inline-block">09362656364</span> </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

