<nav class="side-nav">
    <ul>

        <li>
            <a href="{{route('home')}}" class="side-menu">
                <div class="side-menu__icon"> <img class="w-20" src="frontend/dist/images/icons/BringMe_Web_Operate_ICON-02.png" alt=""></div>
                <div class="side-menu__title"> Dashboard </div>
            </a>
        </li>

        <li>
            <a href="{{route('store-register')}}" class="side-menu">
                <div class="side-menu__icon"> <img class="w-20" src="frontend/dist/images/icons/BringMe_Web_Operate_ICON-04.png" alt=""></div>
                <div class="side-menu__title"> สมัครสมาชิก </div>
            </a>
        </li>


        <li>
            <a href="javascript:;" class="side-menu">
                <div class="side-menu__icon"> <img class="w-20" src="frontend/dist/images/icons/BringMe_Web_Operate_ICON-05.png" alt=""></div>
                <div class="side-menu__title">
                    จัดการสินค้า
                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="">
                <li>
                    <a href="{{route('products')}}" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> รายการสินค้า </div>
                    </a>
                </li>
                <li>
                    <a href="{{route('products-waitapproved')}}" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> รายการสินค้ายังไม่อนุมัติ </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{route('transaction')}}" class="side-menu">
                <div class="side-menu__icon"> <img class="w-20" src="frontend/dist/images/icons/BringMe_Web_Operate_ICON-06.png" alt=""></div>
                <div class="side-menu__title"> รายการการสั่งซื้อ </div>
            </a>
        </li>


        <li class="mt-10">
            <a href="{{route('user-store')}}" class="side-menu">
                <div class="side-menu__icon"> <img class="w-20" src="frontend/dist/images/icons/BringMe_Web_Operate_ICON-10.png" alt=""></div>
                <div class="side-menu__title"> จัดการร้านค้า </div>
            </a>
        </li>
        <li>
            <a href="{{route('orders')}}" class="side-menu">
                <div class="side-menu__icon"> <img class="w-20" src="frontend/dist/images/icons/BringMe_Web_Operate_ICON-11.png" alt=""></div>
                <div class="side-menu__title"> คำสั่งซื้อ </div>
            </a>
        </li>

        <li>
            <a href="{{route('profile-edit')}}" class="side-menu">
                <div class="side-menu__icon"> <img class="w-20" src="frontend/dist/images/icons/BringMe_Web_Operate_ICON-13.png" alt=""></div>
                <div class="side-menu__title"> ตั้งค่าโปรไฟล์</div>
            </a>
        </li>



        <li class="mt-10">
            <a href="{{route('receive-product')}}" class="side-menu">
            <div class="side-menu__icon"> <img class="w-20" src="frontend/dist/images/icons/BringMe_Web_Operate_ICON-14.png" alt=""></div>
                <div class="side-menu__title"> รับสินค้าเข้า</div>
            </a>
        </li>
        <li>
            <a href="{{route('orders')}}" class="side-menu">
            <div class="side-menu__icon"> <img class="w-20" src="frontend/dist/images/icons/BringMe_Web_Operate_ICON-15.png" alt=""></div>
                <div class="side-menu__title"> รายการการสั่งซื้อ</div>
            </a>
        </li>
        <li>
            <a href="{{route('products-awaiting-delivery')}}" class="side-menu">
            <div class="side-menu__icon"> <img class="w-20" src="frontend/dist/images/icons/BringMe_Web_Operate_ICON-16.png" alt=""></div>
                <div class="side-menu__title"> สินค้ารอจัดส่ง</div>
            </a>
        </li>



        <li>
            <a href="{{route('check-stock')}}" class="side-menu">
            <div class="side-menu__icon"> <img class="w-20" src="frontend/dist/images/icons/BringMe_Web_Operate_ICON-18.png" alt=""></div>
                <div class="side-menu__title"> ตรวจสอบสต็อก</div>
            </a>
        </li>


    </ul>
</nav>
