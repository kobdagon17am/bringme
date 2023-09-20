<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>


   <style>
        /* Set the page size to 40x30mm */
        @page {
            size: 100mm 20mm;
            margin: 0; /* Set margins to 0 if you want no margins */
        }

        /* Your other CSS styles for content */

        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            /* Optional: You can add background or text styles here */
        }

        /* Add other styles as needed */
    </style>
</head>
<body style=" text-align: center;">

    <b>COD: test  test</b>
    <div style="margin-left: 10px; ">
        
        
        <img src="{!!DNS1D::getBarcodePNG('111111111111', 'I25',3,33)!!}}" alt="barcode"   />
        {!! DNS1D::getBarcodePNGPath("111111111111", 'I25',3,33) !!}</div>
</body>
</html>
