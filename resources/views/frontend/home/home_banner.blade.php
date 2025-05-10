@php
    $banner = App\Models\Banner::orderBy('banner_title','ASC')->limit(3)->get();
@endphp
    <div class="cv_banner">
        <div class="cv_banner_container">
            <div class="cv_banner_content">
                <div class="cv_banner_data">
                    @foreach($banner as $item)
                    <div class="cv_banner_img">
                        <img src="{{ asset('storage/' .$item->banner_image ) }}" alt="">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <style>
        .cv_banner {
            display: flex;
            justify-content: center;
            background: #0d1624;
        }
        .cv_banner_container {
            background: #0d1624;
            padding: 0 10%;
        }
    </style>
