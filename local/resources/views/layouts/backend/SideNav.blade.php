<nav class="side-nav">
    <ul>

        <li>
            <a href="{{route('admin/home')}}" class="side-menu {{ (request()->is('admin/home')  ) ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <img class="w-20" src="{{asset('backend/dist/images/icons/BringMe_Web_Operate_ICON-01.png')}}" alt=""></div>
                <div class="side-menu__title"> Dashboard </div>
            </a>
        </li>

        <li>
            <a href="{{route('admin/employee')}}" class="side-menu {{ (request()->is('admin/employee')  ) ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <img class="w-20" src="{{asset('backend/dist/images/icons/BringMe_Web_Operate_ICON-02.png')}}" alt=""></div>
                <div class="side-menu__title"> รายการพนักงาน </div>
            </a>
        </li>

        <li>
            <a href="{{route('admin/permission')}}" class="side-menu {{ (request()->is('admin/permission')  ) ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <img class="w-20" src="{{asset('backend/dist/images/icons/BringMe_Web_Operate_ICON-03.png')}}" alt=""></div>
                <div class="side-menu__title"> รายการสิทธิ์การใช้งาน </div>
            </a>
        </li>

        <li>
            <a href="javascript:;" class="side-menu {{ (request()->is('admin/stores') || request()->is('admin/stores-waitapproved') || request()->is('admin/stores-detail') || request()->is('admin/users')    ) ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <img class="w-20" src="{{asset('backend/dist/images/icons/BringMe_Web_Operate_ICON-04.png')}}" alt=""></div>
                <div class="side-menu__title">
                    จัดการผู้ใช้
                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="{{ (request()->is('admin/stores') || request()->is('admin/stores-waitapproved') || request()->is('admin/users') || request()->is('admin/stores-detail')  ) ? 'side-menu__sub-open' : '' }}">
                <li>
                    <a href="{{route('admin/users')}}" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> รายการลูกค้า </div>
                    </a>
                </li>

                <li>
                    <a href="javascript:;" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="home"></i> </div>
                        <div class="side-menu__title">
                            จัดการร้านค้า
                            <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                        </div>
                    </a>
                    <ul class="{{ (request()->is('admin/stores') || request()->is('admin/stores-waitapproved') || request()->is('admin/stores-detail')   ) ? 'side-menu__sub-open' : '' }}">
                        <li>
                            <a href="{{route('admin/stores')}}" class="side-menu ">
                                <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                <div class="side-menu__title"> รายการร้านค้า </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin/stores-waitapproved')}}" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                <div class="side-menu__title"> รายการร้านค้ายังไม่อนุมัติ </div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="side-menu">
                <div class="side-menu__icon"> <img class="w-20" src="{{asset('backend/dist/images/icons/BringMe_Web_Operate_ICON-05.png')}}" alt=""></div>
                <div class="side-menu__title">
                    จัดการสินค้า
                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="">
                <li>
                    <a href="{{route('admin/products')}}" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> รายการสินค้า </div>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin/products-waitapproved')}}" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> รายการสินค้ายังไม่อนุมัติ </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{route('admin/transaction')}}" class="side-menu">
                <div class="side-menu__icon"> <img class="w-20" src="{{asset('backend/dist/images/icons/BringMe_Web_Operate_ICON-06.png')}}" alt=""></div>
                <div class="side-menu__title"> รายการการสั่งซื้อ </div>
            </a>
        </li>
        <li>
            <a href="{{route('admin/refund')}}" class="side-menu">
                <div class="side-menu__icon"> <img class="w-20" src="{{asset('backend/dist/images/icons/BringMe_Web_Operate_ICON-07.png')}}" alt=""></div>
                <div class="side-menu__title"> รายการขอคืนเงิน </div>
            </a>
        </li>
        <li>
            <a href="{{route('admin/campaign')}}" class="side-menu">
                <div class="side-menu__icon"> <img class="w-20" src="{{asset('backend/dist/images/icons/BringMe_Web_Operate_ICON-08.png')}}" alt=""></div>
                <div class="side-menu__title"> รายการแคมเปญ </div>
            </a>
        </li>
        <li>
            <a href="#" class="side-menu">
                <div class="side-menu__icon"> <img class="w-20" src="{{asset('backend/dist/images/icons/BringMe_Web_Operate_ICON-09.png')}}" alt=""></div>
                <div class="side-menu__title"> จัดการข้อมูลแสดงผลแอพพลิเคชั่น </div>
            </a>
        </li>


        <li class="mt-10">
            <a href="{{route('admin/user-store')}}" class="side-menu">
                <div class="side-menu__icon"> <img class="w-20" src="{{asset('backend/dist/images/icons/BringMe_Web_Operate_ICON-10.png')}}" alt=""></div>
                <div class="side-menu__title"> จัดการร้านค้า </div>
            </a>
        </li>
        <li>
            <a href="{{route('admin/orders')}}" class="side-menu">
                <div class="side-menu__icon"> <img class="w-20" src="{{asset('backend/dist/images/icons/BringMe_Web_Operate_ICON-11.png')}}" alt=""></div>
                <div class="side-menu__title"> คำสั่งซื้อ </div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="side-menu">
                <div class="side-menu__icon"> <img class="w-20" src="{{asset('backend/dist/images/icons/BringMe_Web_Operate_ICON-12.png')}}" alt=""></div>
                <div class="side-menu__title">
                    ส่งเสริมการขาย
                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="">
                <li>
                    <a href="{{route('admin/discount-code')}}" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> โค้ดส่วนลด </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title">
                            โปรโมชัน
                            <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                        </div>
                    </a>

                    <ul class="">
                        <li>
                            <a href="{{route('admin/promo-discount-product')}}" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                <div class="side-menu__title"> โปรโมชันส่วนลดสินค้า </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin/promo-free-gift')}}" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                <div class="side-menu__title"> โปรโมชันแถมสินค้า </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin/promo-bundle-deal')}}" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                <div class="side-menu__title"> โปรโมชัน Bundle Deal </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin/promo-add-on')}}" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                <div class="side-menu__title"> โปรโมชัน Add-on Deal </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                <div class="side-menu__title"> โปรโมชัน Follow Prize </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Flash sale ในร้านค้า </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> แคมเปญของ Bring Me </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{route('admin/profile-edit')}}" class="side-menu">
                <div class="side-menu__icon"> <img class="w-20" src="{{asset('backend/dist/images/icons/BringMe_Web_Operate_ICON-13.png')}}" alt=""></div>
                <div class="side-menu__title"> ตั้งค่าโปรไฟล์</div>
            </a>
        </li>



        <li class="mt-10">
            <a href="{{route('admin/receive-product')}}" class="side-menu">
            <div class="side-menu__icon"> <img class="w-20" src="{{asset('backend/dist/images/icons/BringMe_Web_Operate_ICON-14.png')}}" alt=""></div>
                <div class="side-menu__title"> รับสินค้าเข้า</div>
            </a>
        </li>
        <li>
            <a href="{{route('admin/orders')}}" class="side-menu">
            <div class="side-menu__icon"> <img class="w-20" src="{{asset('backend/dist/images/icons/BringMe_Web_Operate_ICON-15.png')}}" alt=""></div>
                <div class="side-menu__title"> รายการการสั่งซื้อ</div>
            </a>
        </li>
        <li>
            <a href="{{route('admin/products-awaiting-delivery')}}" class="side-menu">
            <div class="side-menu__icon"> <img class="w-20" src="{{asset('backend/dist/images/icons/BringMe_Web_Operate_ICON-16.png')}}" alt=""></div>
                <div class="side-menu__title"> สินค้ารอจัดส่ง</div>
            </a>
        </li>

        <li>
            <a href="javascript:;" class="side-menu">
            <div class="side-menu__icon"> <img class="w-20" src="{{asset('backend/dist/images/icons/BringMe_Web_Operate_ICON-17.png')}}" alt=""></div>
                <div class="side-menu__title">
                    ใบเบิก
                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>

            <ul>
                <li>
                    <a href="{{route('admin/create-bill-lading')}}" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> สร้างใบเบิก</div>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin/bill-lading')}}" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> รายการใบเบิก</div>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="{{route('admin/check-stock')}}" class="side-menu">
            <div class="side-menu__icon"> <img class="w-20" src="{{asset('backend/dist/images/icons/BringMe_Web_Operate_ICON-18.png')}}" alt=""></div>
                <div class="side-menu__title"> ตรวจสอบสต็อก</div>
            </a>
        </li>

        <!--<li>
            <a href="side-menu-light-point-of-sale.html" class="side-menu">
                <div class="side-menu__icon"> <i data-lucide="credit-card"></i> </div>
                <div class="side-menu__title"> Point of Sale </div>
            </a>
        </li>
        <li>
            <a href="side-menu-light-chat.html" class="side-menu">
                <div class="side-menu__icon"> <i data-lucide="message-square"></i> </div>
                <div class="side-menu__title"> Chat </div>
            </a>
        </li>
        <li>
            <a href="side-menu-light-post.html" class="side-menu">
                <div class="side-menu__icon"> <i data-lucide="file-text"></i> </div>
                <div class="side-menu__title"> Post </div>
            </a>
        </li>
        <li>
            <a href="side-menu-light-calendar.html" class="side-menu">
                <div class="side-menu__icon"> <i data-lucide="calendar"></i> </div>
                <div class="side-menu__title"> Calendar </div>
            </a>
        </li>
        <li class="side-nav__devider my-6"></li>
        <li>
            <a href="javascript:;" class="side-menu">
                <div class="side-menu__icon"> <i data-lucide="edit"></i> </div>
                <div class="side-menu__title">
                    Crud
                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="">
                <li>
                    <a href="side-menu-light-crud-data-list.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Data List </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-crud-form.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Form </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="side-menu">
                <div class="side-menu__icon"> <i data-lucide="users"></i> </div>
                <div class="side-menu__title">
                    Users
                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="">
                <li>
                    <a href="side-menu-light-users-layout-1.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Layout 1 </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-users-layout-2.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Layout 2 </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-users-layout-3.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Layout 3 </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="side-menu">
                <div class="side-menu__icon"> <i data-lucide="trello"></i> </div>
                <div class="side-menu__title">
                    Profile
                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="">
                <li>
                    <a href="side-menu-light-profile-overview-1.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Overview 1 </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-profile-overview-2.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Overview 2 </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-profile-overview-3.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Overview 3 </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="side-menu">
                <div class="side-menu__icon"> <i data-lucide="layout"></i> </div>
                <div class="side-menu__title">
                    Pages
                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="">
                <li>
                    <a href="javascript:;" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title">
                            Wizards
                            <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                        </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="side-menu-light-wizard-layout-1.html" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="zap"></i> </div>
                                <div class="side-menu__title">Layout 1</div>
                            </a>
                        </li>
                        <li>
                            <a href="side-menu-light-wizard-layout-2.html" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="zap"></i> </div>
                                <div class="side-menu__title">Layout 2</div>
                            </a>
                        </li>
                        <li>
                            <a href="side-menu-light-wizard-layout-3.html" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="zap"></i> </div>
                                <div class="side-menu__title">Layout 3</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title">
                            Blog
                            <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                        </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="side-menu-light-blog-layout-1.html" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="zap"></i> </div>
                                <div class="side-menu__title">Layout 1</div>
                            </a>
                        </li>
                        <li>
                            <a href="side-menu-light-blog-layout-2.html" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="zap"></i> </div>
                                <div class="side-menu__title">Layout 2</div>
                            </a>
                        </li>
                        <li>
                            <a href="side-menu-light-blog-layout-3.html" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="zap"></i> </div>
                                <div class="side-menu__title">Layout 3</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title">
                            Pricing
                            <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                        </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="side-menu-light-pricing-layout-1.html" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="zap"></i> </div>
                                <div class="side-menu__title">Layout 1</div>
                            </a>
                        </li>
                        <li>
                            <a href="side-menu-light-pricing-layout-2.html" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="zap"></i> </div>
                                <div class="side-menu__title">Layout 2</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title">
                            Invoice
                            <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                        </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="side-menu-light-invoice-layout-1.html" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="zap"></i> </div>
                                <div class="side-menu__title">Layout 1</div>
                            </a>
                        </li>
                        <li>
                            <a href="side-menu-light-invoice-layout-2.html" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="zap"></i> </div>
                                <div class="side-menu__title">Layout 2</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title">
                            FAQ
                            <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                        </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="side-menu-light-faq-layout-1.html" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="zap"></i> </div>
                                <div class="side-menu__title">Layout 1</div>
                            </a>
                        </li>
                        <li>
                            <a href="side-menu-light-faq-layout-2.html" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="zap"></i> </div>
                                <div class="side-menu__title">Layout 2</div>
                            </a>
                        </li>
                        <li>
                            <a href="side-menu-light-faq-layout-3.html" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="zap"></i> </div>
                                <div class="side-menu__title">Layout 3</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="login-light-login.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Login </div>
                    </a>
                </li>
                <li>
                    <a href="login-light-register.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Register </div>
                    </a>
                </li>
                <li>
                    <a href="main-light-error-page.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Error Page </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-update-profile.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Update profile </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-change-password.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Change Password </div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="side-nav__devider my-6"></li>
        <li>
            <a href="javascript:;" class="side-menu">
                <div class="side-menu__icon"> <i data-lucide="inbox"></i> </div>
                <div class="side-menu__title">
                    Components
                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="">
                <li>
                    <a href="javascript:;" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title">
                            Table
                            <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                        </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="side-menu-light-regular-table.html" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="zap"></i> </div>
                                <div class="side-menu__title">Regular Table</div>
                            </a>
                        </li>
                        <li>
                            <a href="side-menu-light-tabulator.html" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="zap"></i> </div>
                                <div class="side-menu__title">Tabulator</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title">
                            Overlay
                            <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                        </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="side-menu-light-modal.html" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="zap"></i> </div>
                                <div class="side-menu__title">Modal</div>
                            </a>
                        </li>
                        <li>
                            <a href="side-menu-light-slide-over.html" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="zap"></i> </div>
                                <div class="side-menu__title">Slide Over</div>
                            </a>
                        </li>
                        <li>
                            <a href="side-menu-light-notification.html" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="zap"></i> </div>
                                <div class="side-menu__title">Notification</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="side-menu-light-Tab.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Tab </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-accordion.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Accordion </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-button.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Button </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-alert.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Alert </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-progress-bar.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Progress Bar </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-tooltip.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Tooltip </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-dropdown.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Dropdown </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-typography.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Typography </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-icon.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Icon </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-loading-icon.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Loading Icon </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="side-menu">
                <div class="side-menu__icon"> <i data-lucide="sidebar"></i> </div>
                <div class="side-menu__title">
                    Forms
                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="">
                <li>
                    <a href="side-menu-light-regular-form.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Regular Form </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-datepicker.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Datepicker </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-tom-select.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Tom Select </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-file-upload.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> File Upload </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title">
                            Wysiwyg Editor
                            <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                        </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="side-menu-light-wysiwyg-editor-classic.html" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="zap"></i> </div>
                                <div class="side-menu__title">Classic</div>
                            </a>
                        </li>
                        <li>
                            <a href="side-menu-light-wysiwyg-editor-inline.html" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="zap"></i> </div>
                                <div class="side-menu__title">Inline</div>
                            </a>
                        </li>
                        <li>
                            <a href="side-menu-light-wysiwyg-editor-balloon.html" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="zap"></i> </div>
                                <div class="side-menu__title">Balloon</div>
                            </a>
                        </li>
                        <li>
                            <a href="side-menu-light-wysiwyg-editor-balloon-block.html" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="zap"></i> </div>
                                <div class="side-menu__title">Balloon Block</div>
                            </a>
                        </li>
                        <li>
                            <a href="side-menu-light-wysiwyg-editor-document.html" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="zap"></i> </div>
                                <div class="side-menu__title">Document</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="side-menu-light-validation.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Validation </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="side-menu">
                <div class="side-menu__icon"> <i data-lucide="hard-drive"></i> </div>
                <div class="side-menu__title">
                    Widgets
                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="">
                <li>
                    <a href="side-menu-light-chart.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Chart </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-slider.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Slider </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-image-zoom.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Image Zoom </div>
                    </a>
                </li>
            </ul>
        </li> -->
    </ul>
</nav>
