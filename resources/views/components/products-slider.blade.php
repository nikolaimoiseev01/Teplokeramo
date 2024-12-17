<style>
    .swiper {
        width: 100%;
        height: 100%;
    }

    /*.swiper-slide img {*/
    /*    display: block;*/
    /*    width: 100%;*/
    /*    height: 100%;*/
    /*    object-fit: cover;*/
    /*}*/

    .swiper-slide {
         display: flex !important;
    }

</style>

<!-- Swiper -->
<div class="swiper productSlider">
    <div class="swiper-wrapper">
        @foreach($products as $key => $product)
            <x-cards.product :product="$product"/>
        @endforeach
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>

@push('page-js')
    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".productSlider", {
            slidesPerView: 3,
            spaceBetween: 60,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
@endpush
