<div class="container-indent">
    <div class="container container-fluid-custom-mobile-padding">
        <div class="tt-block-title">
            <h1 class="tt-title">OUR CATEGORIES</h1>
        </div>
        <div class="tt-carousel-products row arrow-location-tab arrow-location-tab01 tt-alignment-img tt-collection-listing slick-animated-show-js">
            @if(count($categories) > 0)
                @foreach($categories as $cat)
                    <div class="col-2 col-md-4 col-lg-3">
                        <a href="#" class="tt-collection-item">
                            <div class="tt-image-box"><img src="/uploads/{{$cat->img}}" alt=""></div>
                            <div class="tt-description">
                                <h2 class="tt-title">{{$cat->name}}</h2>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
