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
            font-size: 16px;
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
            padding: 10px;
            size: 170mm 500mm;
            margin: 10px; /* Set margins to 0 if you want no margins */
        }



    </style>
</head>

<body>
    <p style="text-align: end">Tracking No. MWE15230000072811</p>
    <table style="width: 100%;border: 1px;color: black;" border="2">
        <thead>
            <tr>
                <th align="left" style="padding: 10px">ชื่อผู้ส่ง(Sender)
                   <p> ชื่อ นิติพล เล่าเปี่ยม Moomike Shop <br>
                    โทร 078-123-4567 โทร 087-676-5394 <br>
                    ที่อยู่ 600 ซอยป้าไม้4 สุขุมวิท77/1 พระโขนง  <br>
                    คลองเตย กรุงเทพมหานคร <br>
                    11130</p>
                </th>
                <th align="left" style="padding: 10px">ผู้รับ(Receiver)

                    <p> ชื่อ นิติพล เล่าเปี่ยม Moomike Shop <br>
                        โทร 078-123-4567 โทร 087-676-5394 <br>
                        ที่อยู่ 600 ซอยป้าไม้4 สุขุมวิท77/1 พระโขนง  <br>
                        คลองเตย กรุงเทพมหานคร <br>
                        11130</p>
                </th>
            </tr>
            <tr>
                <th align="left" style="padding: 10px">
                    <p style="padding: 0px"> เลขที่ใบสั่งซื้อ 0420200000014 <br>
                        วันที่สั่งซื้อ 17 Apr 2020 16:40 <br>
                        วิธีการจัดส่ง Flash </p>
                 </th>
                 <th style="">
                    การชำระเงิน
                     <p>โอนเงินผ่านบัญชีธนาคาร<br>
                        (ชำระเงินแล้ว)
                     </p>
                 </th>
            </tr>
        </thead>
    </table>
    <p>*หากมีปัญหาเกี่ยวกับสินค้า กรุณาติตต่อบริษัทที่ท่านสั่งซื้อสินคำโดยตรง และหากหัสดุดีกลับกรุณานำส่งตามชื่อผู้ฝากส่งรายการสินค้า</p>

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
    <table style="width: 100%;border: 1px;color: black;" border="2">
        <thead>
            <tr>
                <th align="left" style="padding: 10px"> สินค้า
                </th>
                <th align="center" style="padding: 10px">ราคา/หน่วย

                </th>
                <th align="center" style="padding: 10px">จำนวนสินค้า

                </th>
                <th align="right" style="padding: 10px">ราคารวม

                </th>
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


            <tr><td></td><td colspan="2">ยอดรวมสินค้า</td> <td align="right" style="">฿ 400.00</td></tr>
            <tr><td></td><td colspan="2">โปรโมขันส่วนลด</td><td align="right" style="">฿ 400.00</td></tr>
            <tr><td></td><td colspan="2">ค่าจัดส่งสินค้า</td><td align="right" style="">฿ 400.00</td></tr>
            <tr><td></td><td colspan="2">ส่วนลดค่าจัดส่งสินค้า</td><td align="right" style="">฿ 400.00</td></tr>
            <tr><td></td><td colspan="2">ยอดรวมสุทธิ</td><td align="right" style="">฿ 400.00</td></tr>




        </thead>
    </table>


</body>
<html>
