<!DOCTYPE html>
<html>
<?php
// dd(asset('frontend/dist/fonts/THSarabunNew.ttf'));
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="{{ asset('frontend/dist/css/font.css')}}" rel="stylesheet" type="text/css" />
    <style>
        b,h5,h3,body,th,tr,table,td{
            font-family: 'THSarabunNew,Arial,sans-serif';
            border-collapse: collapse;
            font-size: 16px;
            font-weight: normal;
            /* line-height: 14px;
            margin-top: 0px;
            margin-left: 13px;
            margin-right: 33px;
            line-height: 13px; */
        }
        b,h5,h3{
            font-family: 'THSarabunNew-b,Arial,sans-serif';
            font-size: 16px;

        }
        /* @page {
            padding: 2px;
            size: 100mm 150mm;
            margin: 2px; /* Set margins to 0 if you want no margins */
        } */
        .horizontal-line {
            border-top: 1px solid black;
            margin: 2px 0;
        }

    </style>

</head>

<body>
    <p style="text-align: center; font-size: 20px;">รายการรอรับสินค้า</p>

    <table style="width: 100%;color: black; padding: 0px" border="1">
        <thead>

            <tr>

                <th> ลำดับ</th>
                <th> ชื่อสินค้า</th>
                <th> ประเภทสินค้า</th>
                <th> วันที่จัดส่งสินค้า</th>
                <th> Tracking</th>
                <th> ชื่อขนส่ง</th>
                <th> ประเภทการจัดส่ง</th>
                <th> จำนวนสินค้า</th>

            </tr>
        </thead>
        <tbody>
            <?php $i = 0; ?>
            @foreach($data['products_transfer'] as $value)
            <?php $i++; ?>
            <tr style="margin: 0px;">
                <td style="text-align: center;">
                    {{$i}}
                </td>


                <td style="text-align: center;">
                    <p style="margin: 0px">{{$value->name_th}}</p>
                </td>
                <td style="text-align: center;">
                     <p style="margin: 0px">{{$value->c_name_th}}</p>


                </td>
                <td style="text-align: center;">
                     <p style="margin: 0px">{{$value->shipping_date}}</p>

                </td>

                <td style="text-align: center;">
                     <p style="margin: 0px">{{$value->tracking}}</p>
                </td>

                <td style="text-align: center;">
                     <p style="margin: 0px">{{$value->shipping_name}}</p>
                </td>

                <td style="text-align: center;">
                    @if($value->shipping_type == 1 )
                      <p style="margin: 0px">ใช้ขนส่ง</p>
                    @elseif($value->shipping_type == 2)
                      <p style="margin: 0px">ขนส่งด้วยตนเอง</p>
                    @else
                    @endif

                </td>


                <td style="text-align: center;">
                    <p style="margin: 0px">{{$value->qty}}</p>
                </td>

            </tr>
            @endforeach
        </tbody>




</table>


</body>
<html>
