<div {{ $attributes->merge(['class' => '']) }}>
    <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="max-h-96 swiper mySwiper2">
        <div class="swiper-wrapper">
            @foreach($collection->getMedia('examples') as $media)
                <div class="swiper-slide">
                    <img class="max-h-96 w-full object-cover" src="{{$media->getUrl()}}"/>
                </div>
            @endforeach

        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    <div thumbsSlider="" class="swiper mt-2 mySwiper">
        <div class="swiper-wrapper">
            @foreach($collection->getMedia('examples') as $media)
                <div class="cursor-pointer swiper-slide">
                    <img src="{{$media->getUrl()}}"/>
                </div>
            @endforeach
        </div>
    </div>
</div>


@push('page-js')
    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesProgress: true,
        });
        var swiper2 = new Swiper(".mySwiper2", {
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: swiper,
            },
        });
    </script>
@endpush
