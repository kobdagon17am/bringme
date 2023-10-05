<!DOCTYPE html>
<html>
<?php
// dd(asset('frontend/dist/fonts/THSarabunNew.ttf'));
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="{{ asset('frontend/dist/css/font.css')}}" rel="stylesheet" type="text/css" />
    <style>
        body,th,tr,table,td{
            font-family: 'THSarabunNew,Arial,sans-serif';
            font-size: 14px;
            font-weight: normal;
            /* line-height: 14px;
            margin-top: 0px;
            margin-left: 13px;
            margin-right: 33px;
            line-height: 13px; */
        }
        b,h5 {
            font-family: 'THSarabunNew-b,Arial,sans-serif';
            font-size: 16px;

        }
        @page {
            padding: 2px;
            size: 100mm 150mm;
            margin: 2px; /* Set margins to 0 if you want no margins */
        }
        .horizontal-line {
            border-top: 1px solid black;
            margin: 2px 0;
        }



    </style>
</head>

<body>

    <p style="text-align: center">รายการสินค้า</p>
    <table style="width: 100%;border: 0px;color:" border="0">
        <thead>
            <tr>
                <th align="left">  เลขที่ใบสั่งซื้อ 0420200000014
                </th>

                <th align="right">จำนวนสินค้า 3 รายการ 9 หน่วย

                </th>
            </tr>
        </thead>
    </table>

    <table style="width: 100%;border: 0px;color: black; padding: 0px" border="0">
        <thead>
            <tr>
                <td d colspan="4" ><div class="horizontal-line"></div></td>
            </tr>
            <tr>
                <th align="left" style=""> สินค้า
                </th>
                <th align="center" style="">ราคา/หน่วย

                </th>
                <th align="center" style="">จำนวนสินค้า

                </th>
                <th align="right" style="">ราคารวม

                </th>
            </tr>
        </thead>
        <tr>
            <td d colspan="4" ><div class="horizontal-line"></div></td>
        </tr>

         <tr>
                <td align="left" style="">
                    1. A003-3450 ฟิลม Fuj C4200 (135/35MM)
                 </td>
                 <td align="left" style="">
                    ฿ 200.00
                 </td>
                 <td align="center" style="">
                    2
                 </td>
                 <td align="right" style="">
                    ฿ 400.00
                 </td>

            </tr>

            <tr>
                <td align="left" style="">
                    2. A003-3450 ฟิลม Fuj C4200 (135/35MM)
                 </td>
                 <td align="left" style="">
                    ฿ 200.00
                 </td>
                 <td align="center" style="">
                    2
                 </td>
                 <td align="right" style="">
                    ฿ 400.00
                 </td>

            </tr>

            <tr>
                <td align="left" style="">
                    3. A003-3450 ฟิลม Fuj C4200 (135/35MM)
                 </td>
                 <td align="left" style="">
                    ฿ 200.00
                 </td>
                 <td align="center" style="">
                    2
                 </td>
                 <td align="right" style="">
                    ฿ 400.00
                 </td>


            </tr>
            <tr>
                <td d colspan="4" ><div class="horizontal-line"></div></td>
            </tr>


            {{-- <tr>
                <td align="left" style="" >
                    โปรโมชัน<br>
                    - B200 Discount Couponl<br>
                    - Discount Shipping!<br>
                 </td>
                 <td align="left" style="" colspan="3">
                    ddsdsd


                 </td>


            </tr> --}}


            <tr><td style="border: 0px;"></td><td colspan="2" style="border: 0px;">ยอดรวมสินค้า</td> <td align="right" style="border: 0px;">฿ 400.00</td></tr>
            <tr><td style="border: 0px;"></td><td colspan="2" style="border: 0px;">โปรโมขันส่วนลด</td><td align="right" style="border: 0px;">฿ 400.00</td></tr>
            <tr><td style="border: 0px;"></td><td colspan="2" style="border: 0px;">ค่าจัดส่งสินค้า</td><td align="right" style="border: 0px;">฿ 400.00</td></tr>
            <tr><td style="border: 0px;"></td><td colspan="2" style="border: 0px;">ส่วนลดค่าจัดส่งสินค้า</td><td align="right" style="border: 0px;">฿ 400.00</td></tr>
            <tr><td style="border: 0px;"></td><td colspan="2"  style="border: 0px;">ยอดรวมสุทธิ</td><td align="right" style="border: 0px;">฿ 400.00</td> </tr>

            <tr>
                <td style="border: 0px;"></td>
                <td d colspan="3" ><div class="horizontal-line"></div></td>
            </tr>
</table>


</body>
<html>
