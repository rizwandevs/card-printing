<div class="container-indent nomargin">
    <div class="container-fluid">
        <div class="row">
            <div class="slider-revolution revolution-default">
                <div class="tp-banner-container">
                    <div class="tp-banner revolution">
                        <ul>
                            @foreach(session('web_session')['home_slider'] as $i)
                                <li data-thumb="/uploads/{{$i->img}}" data-transition="fade" data-slotamount="1" data-masterspeed="1000" data-saveperformance="off"  data-title="Slide">
                                    <img src="/uploads/{{$i->img}}"  alt="slide1"  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" >
                                    <div class="tp-caption tp-caption1 lft stb"
                                         data-x="center"
                                         data-y="center"
                                         data-hoffset="0"
                                         data-voffset="0"
                                         data-speed="600"
                                         data-start="900"
                                         data-easing="Power4.easeOut"
                                         data-endeasing="Power4.easeIn">
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>