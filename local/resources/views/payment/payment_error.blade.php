<html>

<head>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
</head>
<style>
    body {
        text-align: center;
        padding: 40px 0;
        background: #EBF0F5;
    }

    h1 {
        color: #f04015;
        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
        font-weight: 900;
        font-size: 100px;
        margin-bottom: 10px;
    }

    p {
        color: #404F5E;
        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
        font-size: 50px;
        margin: 0;
    }

    i {
        color: #fc2f2f;
        font-size: 300px;
        line-height: 1.5;
        margin-left: -15px;
    }

    .card {
        background: white;
        padding: 60px;
        border-radius: 4px;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: 0 auto;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
</style>

<body>
    <div class="container">
        <div class="Centerdive">
            <div class="card">
                <div style="border-radius:500px; height:500px; width:500px; background: #F8FAF5; margin:0 auto;">
                    <i class="checkmark">X</i>
                </div>
                <h1 class="text_fam">{{ $result_status }}</h1>
                <p style="color:rgb(255, 66, 98);">BringMe ขอขอบคุณ<br /> <span
                        style="color:rgb(48, 48, 48);">ท่านทำรายการไม่สำเร็จ กรุณาปิดหน้าจอนี้และกลับไปยังแอพ</span></p>
            </div>
        </div>
    </div>
</body>

</html>
