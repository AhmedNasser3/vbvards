@php

$slider = App\Models\Slider::orderBy('slider_title','ASC')->get();
@endphp
{{--
<section class="home-slider position-relative mb-30">
        <div class="container">
            <div class="home-slide-cover mt-30">
                <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">

                @foreach($slider as $item)
                    <div class="single-hero-slider single-animation-wrap" style="background-image: url({{ asset('storage/'.$item->slider_image ) }})">
                        <div class="slider-content">
                            <h1 class="mb-40 display-2">
                                {{ $item->slider_title }}
                            </h1>
                            <p class="mb-65">{{ $item->short_title }}</p>
                            <form class="form-subcriber d-flex">
                                <input type="email" placeholder="Your emaill address" />
                                <button class="btn" type="submit">Subscribe</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="slider-arrow hero-slider-1-arrow"></div>
            </div>
        </div>
    </section>  --}}

    <div class="vb_banner" style="padding: 0 0 0 0; display: grid;">
        <div class="vb_banner_container">
            <div class="vb_banner_content">
                <div class="vb_banner_data">
                    @foreach($slider as $item)
                    <div class="vb_banner_img"  style="padding: 5% 0 0 0; ">
                        <img src="{{ asset('storage/'.$item->slider_image ) }}" alt="">
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

    <style>
        .vb_banner {
            display: flex;
            justify-content: center;
            background: #0d1624;
        }
        .vb_banner_container {
            background: #0d1624;
            padding: 0 10%;
        }
    </style>
