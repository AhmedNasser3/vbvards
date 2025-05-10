@php
$categories = App\Models\Category::orderBy('category_name','ASC')->get();
@endphp


<section class="popular-categories section-padding" style="background:#0d1624">
        <div class="container wow animate__animated animate__fadeIn">
            <div class="section-title">

                <div class="slider-arrow slider-arrow-2 flex-right carausel-10-columns-arrow" id="carausel-10-columns-arrows"></div>
            </div>
            <div class="carausel-10-columns-cover position-relative">
                <div class="carausel-10-columns" id="carausel-10-columns">

                    @foreach($categories as $category)
                    <div class="card-2 wow animate__animated animate__fadeInUp" data-wow-delay=".1s" style="background:transparent; border:none;width : 200px">
                        <figure class="overflow-hidden img-hover-scale">
<a href="{{ url('product/category/'.$category->id.'/'.$category->category_slug) }}" ><img style="max-width: 110px" src="{{ asset('storage/' . $category->category_image ) }}" alt="" /></a>
                        </figure>
                        <h6><a href="{{ url('product/category/'.$category->id.'/'.$category->category_slug) }}" style="color: white">{{ $category->category_name }}</a></h6>

    @php
    $products = App\Models\Product::where('category_id',$category->id)->get();
    @endphp

                        <span>{{ count($products) }} منتجات</span>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
