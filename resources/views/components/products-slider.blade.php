<div class="flex relative">
    <div class="swiper-button-next text-green-500"></div>
    <div class="swiper  productSlider">
        <div class="swiper-wrapper">
            @foreach($products as $key => $product)
                <div class="swiper-slide">
                    <x-cards.product :product="$product"/>
                </div>
            @endforeach
        </div>
    </div>
    <div class="swiper-button-prev text-green-500"></div>
</div>

<style>
    .swiper {
        width: 90%;
        height: 100%;
    }

    @media(max-width: 648px) {
        .swiper {
            width: 80%;
        }
    }

    .swiper-wrapper {
        display: flex;
    }

    .swiper-slide {
        /*flex-shrink: 0; !* Убедитесь, что слайды не сжимаются *!*/
        /*width: 100%;    !* Один слайд на всю ширину *!*/
    }
</style>

<script>
    var swiper2 = new Swiper(".productSlider", {
        slidesPerView: "auto",
        centeredSlides: true,
        centerInsufficientSlides: true,
        spaceBetween: 20,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 40,
                centeredSlides: false
            },
        },
    });
</script>
