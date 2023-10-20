<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Web Bringme</title>
    {{-- <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css"
    /> --}}

    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/tailwind.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/slide.css') }}" />
    <link rel="stylesheet" href="{{ asset('aos/aos.css') }}" />
    <link rel="stylesheet" href="{{ asset('slick/slick.css') }}" />
    <link rel="stylesheet" href="{{ asset('slick/slick-theme.css') }}" />
</head>

<body>
    <!-- Header -->
    <div class="gradient-box w-full h-10"></div>
    <header class="w-full">
        <!-- Header Bar -->
        <nav
            class="header w-full h-12 md:h-24 py-4 pl-7 sm:pr-2 md:pl-14 md:pr-20 flex justify-between items-center bg-white">
            <a class="text-3xl font-bold leading-none" href="#">
                <img class="h-6 md:h-12" src="{{ asset('assets/img/BringMe_logo.png') }}" alt="Bringme" />
            </a>

            <div class="btn-navbar lg:hidden">
                <button class="navbar-burger flex justify-center items-center">
                    <img class="w-1/3" src="{{ asset('assets/img/Navbar.png') }}" />
                </button>
            </div>

            <ul class="header-menu mb-0 hidden lg:text-xl lg:flex uppercase">
                <li>
                    <a href="#">HOME</a>
                </li>
                <li>
                    <a href="#">ABOUT US</a>
                </li>
                <li>
                    <a href="#">HOW TO ‘BRING’</a>
                </li>
                <li>
                    <a href="#">PARTNER</a>
                </li>
                <li>
                    <a href="#">FAQ</a>
                </li>
                <li>
                    <a href="{{ url('register_partner') }}">Register</a>
                </li>
                <li>
                    <a href="{{ url('login') }}">Login</a>
                </li>
            </ul>
        </nav>
        <!-- Navbar Button -->
        <div class="navbar-menu relative z-50 hidden">
            <div class="navbar-backdrop fixed inset-0 bg-gray-800 opacity-25"></div>
            <nav
                class="fixed top-0 left-0 bottom-0 flex flex-col w-5/6 max-w-sm py-6 px-6 bg-white border-r overflow-y-auto">
                <div class="flex justify-between items-center mb-8">
                    <img class="h-8 md:h-12" src="{{ asset('assets/img/BringMe_logo.png') }}" alt="Bringme" />
                    <button class="navbar-close">
                        <svg class="h-6 w-6 text-gray-400 cursor-pointer hover:text-gray-500"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div>
                    <ul>
                        <li class="mb-1">
                            <a class="block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded"
                                href="#">Home</a>
                        </li>
                        <li class="mb-1">
                            <a class="block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded"
                                href="#">About Us</a>
                        </li>
                        <li class="mb-1">
                            <a class="block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded"
                                href="#">Services</a>
                        </li>
                        <li class="mb-1">
                            <a class="block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded"
                                href="#">Pricing</a>
                        </li>
                        <li class="mb-1">
                            <a class="block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded"
                                href="#">Contact</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <!-- START: Spin Animation -->
    <div class="w-full front-items absolute top-[42rem] flex justify-center">
        <div class="container-1 fade-in w-[48rem] h-[48rem] rounded-full hidden md:block">
            <div class="circle-1 free-shipping my-8 absolute top-0 right-0 text-center">
                <img src="{{ asset('assets/img/Free_Shipping.png') }}" alt="ส่งฟรี" />
                <p class="text-xl md:text-4xl font-medium">ส่งฟรี</p>
            </div>
        </div>
    </div>

    <div class="w-full front-items absolute top-[36rem] flex justify-center">
        <div class="container-2 fade-in w-[56rem] h-[56rem] rounded-full hidden md:block">
            <div
                class="circle-2 good-qual my-8 absolute bottom-[6rem] right-0 flex flex-col justify-center items-center">
                <img class="w-36" src="{{ asset('assets/img/Good_quality.png') }}" alt="ดูแลสินค้าอย่างดี" />
                <p class="text-xl md:text-4xl font-medium">ดูแลสินค้าอย่างดี</p>
            </div>
        </div>
    </div>

    <div class="w-full front-items absolute top-[40rem] flex justify-center">
        <div class="container-3 fade-in w-[54rem] h-[54rem] rounded-full hidden md:block">
            <div
                class="circle-3 easy-order my-8 relative bottom-[9rem] left-0 md:absolute text-center flex flex-col justify-center items-center">
                <img class="w-36" src="{{ asset('assets/img/Easy_Order.png') }}" alt="สั่งง่าย" />
                <p class="text-2xl md:text-4xl font-medium">สั่งง่าย</p>
            </div>
        </div>
    </div>

    <!-- END: Spin Animation -->

    <!-- Content -->
    <div class="body-section">
        <div class="first-section w-full flex">
            <img class="b-group w-14 md:w-20 md:w-64 absolute top-44 md:top-44"
                src="{{ asset('assets/img/Group.png') }}" />
            <div class="text-container w-full text-center text-xl md:text-5xl mt-32 md:mt-60">
                <p class="fade-in-from-left">
                    We <span>Bring</span> Good Things to Life
                </p>
            </div>
        </div>

        <div class="second-section w-full flex flex-row justify-center items-end">
            <div class="text-center text-2xl md:text-4xl">
                <div
                    class="green-circle-1 w-[16rem] md:w-[30rem] h-[16rem] md:h-[30rem] mt-56 md:mt-96 mx-auto rounded-full">
                    <img class="mobile_main w-40 md:w-80 md:h-[40rem] bottom-8 md:bottom-16"
                        src="{{ asset('assets/img/Mobile_main.png') }}" alt="" />
                </div>
                <img class="snow snow-1 hidden md:block md:relative md:bottom-24 md:-right-[31rem]"
                    src="{{ asset('assets/img/Sonw_Flake.png') }}" alt="" />
                <img class="snow snow-2 hidden md:block md:relative md:bottom-24 md:-right-[15rem]"
                    src="{{ asset('assets/img/Sonw_Flake.png') }}" alt="" />
                <div class="main-context mt-6 md:mt-48">
                    <p class="title-context md-2 md:mb-12 text-2xl md:text-[2.5rem]">
                        Lifestyle Online Shopping Store
                    </p>
                    <div class="text-center mt-4 text-sm md:text-2xl hidden md:block">
                        <p>แหล่งรวมสินค้าหลากหลายหมวดหมู่ให้ลูกค้าได้เลือกสรร</p>
                        <p class="mt-2">
                            และสามารถส่งพร้อมกันได้ในออเดอร์เดียว เช่น ขนมเบเกอรี่
                            เครื่องดื่ม อาหาร สินค้าเพื่อสุขภาพ
                        </p>
                        <p class="mt-2">
                            รวมไปถึงของใช้สัตว์เลี้ยง สินค้าแม่และเด็กอื่นๆ
                            เรามีความตั้งใจให้ลูกค้าได้รับความสะดวก รวดเร็ว
                        </p>
                        <p class="content-2 mt-2 text-sm md:text-2xl">
                            ในการช้อปปิ้งออนไลน์ ได้รับสินค้าภายในไม่กี่ชั่วโมง
                            ที่สำคัญ<span class="text-2xl md:text-4xl">
                                ฟรี! ค่าขนส่ง* </span>ทั่วประเทศ
                        </p>
                    </div>
                    <div class="text-center px-7 mt-4 text-sm md:text-2xl block md:hidden">
                        <p>
                            แหล่งรวมสินค้าหลากหลายหมวดหมู่ให้ลูกค้าได้เลือกสรร
                            และสามารถส่งพร้อมกันได้ในออเดอร์เดียว เช่น ขนมเบเกอรี่
                            เครื่องดื่ม อาหาร สินค้าเพื่อสุขภาพ รวมไปถึงของใช้สัตว์เลี้ยง
                            สินค้าแม่และเด็กอื่นๆ เรามีความตั้งใจให้ลูกค้าได้รับความสะดวก
                            รวดเร็ว
                        </p>
                        <p class="content-2 mt-2 text-sm md:text-2xl">
                            ในการช้อปปิ้งออนไลน์ ได้รับสินค้าภายในไม่กี่ชั่วโมง<br />ที่สำคัญ<span
                                class="text-2xl md:text-4xl">
                                ฟรี! ค่าขนส่ง* </span>ทั่วประเทศ
                        </p>
                    </div>

                    <img class="left-cloud w-36 md:w-80 absolute top-96 md:top-2/4 md:top-[110%] md:left-0"
                        data-aos="fade-right" data-aos-duration="1500"
                        src="{{ asset('assets/img/Left_Cloud.png') }}" alt="" />
                    <img class="right-cloud absolute right-0 top-[76%] md:right-0 md:top-[130%] w-24 md:w-40"
                        data-aos="fade-left" data-aos-duration="1500"
                        src="{{ asset('assets/img/Right_Cloud.png') }}" alt="" />
                </div>
            </div>
        </div>

        <div class="block md:hidden">
            <div class="free-shipping my-8 relative top-0 left-0 md:absolute text-center flex flex-col justify-center items-center"
                data-aos="fade-right" data-aos-duration="1500">
                <img class="w-36" src="{{ asset('assets/img/Free_Shipping.png') }}" alt="ส่งฟรี" />
                <p class="text-xl md:text-4xl font-medium">ส่งฟรี</p>
            </div>
            <div class="good-qual mt-8 relative top-0 left-0 md:absolute flex flex-col justify-center items-center"
                data-aos="fade-left" data-aos-duration="1500">
                <img class="w-36" src="{{ asset('assets/img/Good_quality.png') }}" alt="ดูแลสินค้าอย่างดี" />
                <p class="text-xl md:text-4xl font-medium">ดูแลสินค้าอย่างดี</p>
                <img class="snow snow-1 absolute bottom-24 right-20" src="{{ asset('assets/img/Sonw_Flake.png') }}"
                    alt="" />
                <img class="snow snow-2 absolute bottom-12 left-24" src="{{ asset('assets/img/Sonw_Flake.png') }}"
                    alt="" />
            </div>
            <div class="easy-order my-8 relative top-0 left-0 md:absolute text-center flex flex-col justify-center items-center"
                data-aos="fade-right" data-aos-duration="1500">
                <img class="w-36" src="{{ asset('assets/img/Easy_Order.png') }}" alt="สั่งง่าย" />
                <p class="text-xl md:text-4xl font-medium">สั่งง่าย</p>
            </div>
        </div>

        <!-- Healthy Food & Lifestyle Category: Web -->
        <div class="flex justify-center mt-24">
            <div class="hidden md:block w-3/4 flex flex-column justify-center">
                <div class="categories-box text-center shadow-lg bg-white flex-col justify-center rounded-[3rem]">
                    <img src="{{ asset('assets/img/Categories.png') }}" />
                    <p class="text-2xl">Healthy Food & Lifestyle Category</p>
                </div>
            </div>
        </div>

        <!-- Healthy Food & Lifestyle Category: Mobile -->
        <div class="third-section inline-block md:hidden w-full flex flex-column justify-center" data-aos="fade-up"
            data-aos-duration="2000">
            <div
                class="categories-box text-center shadow-lg bg-white flex-col justify-center items-center px-12 py-6 rounded-3xl">
                <p class="categories-title text-2xl">
                    Healthy Food &<br />Lifestyle Category
                </p>
                <div class="healthy-bakery-box flex flex-col">
                    <div class="healthy-bakery flex justify-center items-center shadow-md">
                        <img class="healthy-bakery-pic" src="{{ asset('assets/img/Healthy Bakery.png') }}"
                            alt="" />
                    </div>
                    <p class="category-name">HEALTHY BAKERY</p>
                </div>
                <div class="bakery-box flex flex-col">
                    <div class="bakery flex justify-center items-center shadow-md">
                        <img class="bakery-pic" src="{{ asset('assets/img/Bakery.png') }}" alt="" />
                    </div>
                    <p class="category-name">BAKERY</p>
                </div>
                <div class="healthy-food-box flex flex-col">
                    <div class="healthy-food flex justify-center items-center shadow-md">
                        <img class="healthy-food-pic" src="{{ asset('assets/img/Healthy Food.png') }}"
                            alt="" />
                    </div>
                    <p class="category-name">HEALTHY FOOD</p>
                </div>
                <div class="drink-box flex flex-col">
                    <div class="drink flex justify-center items-center shadow-md">
                        <img class="drink-pic" src="{{ asset('assets/img/Drink.png') }}" alt="" />
                    </div>
                    <p class="category-name">DRINK</p>
                </div>
                <div class="pet-stuff-box flex flex-col">
                    <div class="pet-stuff flex justify-center items-center shadow-md">
                        <img class="pet-stuff-pic" src="{{ asset('assets/img/Pet Stuff.png') }}" alt="" />
                    </div>
                    <p class="category-name">PET STUFF</p>
                </div>
                <div class="snack-box flex flex-col">
                    <div class="snack flex justify-center items-center shadow-md">
                        <img class="snack-pic" src="{{ asset('assets/img/Snack.png') }}" alt="" />
                    </div>
                    <p class="category-name">SNACK</p>
                </div>
                <div class="mom-kids-box flex flex-col">
                    <div class="mom-kids flex justify-center items-center shadow-md">
                        <img class="mom-kids-pic" src="{{ asset('assets/img/Mom & Kids.png') }}" alt="" />
                    </div>
                    <p class="category-name">MOM & KIDS</p>
                </div>
                <div class="fashion-box flex flex-col">
                    <div class="fashion flex justify-center items-center shadow-md">
                        <img class="fashion-pic" src="{{ asset('assets/img/Fashion.png') }}" alt="" />
                    </div>
                    <p class="category-name">FASHION</p>
                </div>
            </div>
        </div>

        <!-- Slideshow -->
        <div class="slideshow-section mt-7 w-full text-center">
            <p class="mx-10 md:mx-0 my-4 py-4 md:px-0 text-2xl md:text-4xl">
                We can ‘bring’ it to you easily in <span>1</span> order
            </p>

            <div class="wrapper px-8 md:px-24">
                <div class="my-slider overflow-hidden px-16 md:px-16 py-4">
                    <img src="{{ asset('assets/img/Mobile_slideshow_1.png') }}" alt="" />
                    <img src="{{ asset('assets/img/Mobile_slideshow_2.png') }}" alt="" />
                    <img src="{{ asset('assets/img/Mobile_slideshow_3.png') }}" alt="" />
                    <img src="{{ asset('assets/img/Mobile_slideshow_4.png') }}" alt="" />
                    <img src="{{ asset('assets/img/Mobile_slideshow_2.png') }}" alt="" />
                </div>
            </div>
        </div>

        <!-- Download -->
        <div class="forth-section w-full justify-center mt-40 md:mt-20 -mb-4">
            <div
                class="download-box w-5/6 h-1/2 md:h-full flex flex-col md:flex-row px-10 md:px-24 pt-4 pb-8 md:py-14 rounded-3xl md:rounded-[4rem]">
                <img class="wink-left" src="{{ asset('assets/img/Wink_left.png') }}" />
                <img class="wink-center" src="{{ asset('assets/img/Wink_center.png') }}" />
                <img class="wink-right" src="{{ asset('assets/img/Wink_right.png') }}" />
                <img class="forest-vector" src="{{ asset('assets/img/Forest_Vector.png') }}" />
                <div class="box-left order-last md:order-first mt-6 md:mt-0">
                    <p
                        class="lg:text-start text-2xl md:text-[2.75rem] font-medium leading-2 md:leading-normal md:mb-4">
                        เริ่มต้นสิ่งดีๆด้วยการเลือกสิ่งที่ดี<br /><span
                            class="text-xl md:text-4xl">ดาวน์โหลดได้แล้ววันนี้</span>
                    </p>
                    <div class="flex justify-start mt-4 md:mt-0">
                        <img class="w-2/6 mr-3" src="{{ asset('assets/img/AppStore.png') }}"
                            alt="ดาวน์โหลดที่ App Store" />
                        <img class="w-2/6" src="{{ asset('assets/img/GooglePlay.png') }}"
                            alt="ดาวน์โหลดที่ GooglePlay" />
                    </div>
                    <img class="w-2/6 md:w-48 mt-2 lg:mt-4" src="{{ asset('assets/img/exploreQR.png') }}" />
                </div>
                <div class="box-right order-first md:order-last">
                    <img data-aos="fade-right" data-aos-duration="1500"
                        class="mobile-download w-80 md:w-[34rem] absolute top-0 md:-top-[6.5rem] right-4 md:right-2 -mt-44 md:mt-0"
                        src="{{ asset('assets/img/smartphone_1.1.png') }}" />
                    <img data-aos="fade-left" data-aos-duration="1500"
                        class="mobile-download w-80 md:w-[34rem] absolute top-0 md:-top-[6.5rem] right-4 md:right-2 -mt-44 md:mt-0"
                        src="{{ asset('assets/img/smartphone_1.2.png') }}" />
                    <div class="w-full flex justify-center">
                        <div class="green-circle-2 rounded-full right-0 w-56 md:w-96 h-56 md:h-96 -mt-28 md:mt-0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div
        class="footer-page w-full flex flex-col md:flex-row justify-center rounded-t-[3rem] md:rounded-t-[10rem] px-12 py-12 md:py-24 gap-4 md:gap-10 text-white md:leading-relaxed">
        <img class="absolute right-0 bottom-0" src="{{ asset('assets/img/Footer_right_bottom_corner.png') }}" />
        <div class="address-box md:leading-normal">
            <p class="mb-2 text-sm md:text-base">CONTACT US</p>
            <div class="address-data flex">
                <img class="w-3 h-3 mr-3 mt-1" src="{{ asset('assets/img/Footer_Dots.png') }}" />
                <p class="w-5/6 md:w-full mb-4 text-xs break-normal whitespace-normal">
                    บริษัท บริงมีย์ จำกัด <br />เลขที่ 6 ซอยรัตนาธิเบศร์ 28
                    ถนนรัตนาธิเบศร์ ตำบลบางกระสอ อำเภอเมืองนนทบุรี นนทบุรี 11000
                </p>
            </div>
            <div class="address-data flex">
                <img class="w-3 h-3 mr-3 mt-1" src="{{ asset('assets/img/Footer_Dots.png') }}" />
                <p class="text-xs">partners@bringme.asia</p>
            </div>
        </div>
        <div class="w-auto h-px bg-white block md:hidden"></div>
        <div class="flex flex-row gap-2 md:gap-20">
            <div class="about-us-box w-[55%] flex flex-col text-xs leading-normal">
                <p class="mb-2 text-sm md:text-base">ABOUT US</p>
                <a href="#">ติดต่อเรา</a>
                <a href="#">Terms & Conditions</a>
                <a href="#">นโยบายความเป็นส่วนตัว</a>
                <a href="#">นโยบายคุกกี้</a>
            </div>
            <div class="contact-us-box flex flex-col justify-center md:justify-start text-xs md:text-base">
                <p class="follow-me mb-8 md:mb-14" href="#">
                    ติดตามเราช่องทางอื่นๆ ได้ที่
                </p>
                <p class="link" href="#">เริ่มสำรวจประสบการณ์ใหม่ๆ ได้ที่นี่!</p>
                <div class="flex mt-2">
                    <a class="mr-3" href="#">
                        <img class="h-5 md:h-9" src="{{ asset('assets/img/AppStore.png') }}" />
                    </a>
                    <a href="#">
                        <img class="h-5 md:h-9" src="{{ asset('assets/img/GooglePlay.png') }}" />
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- <script src="/js/wow.min.js"></script> -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <!-- <script src="/js/wow.js"></script> -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/tailwind.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('slick/slick.min.js') }}"></script>
</body>

</html>
