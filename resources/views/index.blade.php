<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AJSC</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body{
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0%;
        }
        .header,.footer{
            background: #F8F9FA;
        }
        .header{
            text-align: center;
        }
        .main{
            text-align:center;
            height: 262px;
        }
        .footer
        {
            margin-top: auto;
            display: flex;
            justify-content:space-around;
        }
        #logo{
            width: 400px;   
        }
        .social-links{
            margin-top: 15px;
            margin-bottom: 18px;
        }
        .social-links a i{
            background: #51131c;
            color:white;
            border-radius:20px;
            padding:5px;
        }
        #login{
            border: 1px solid #51131c;
            text-decoration: none;
            background: #51131c;
            padding: 5px 15px 5px 15px;
            border-radius: 30px;
            color: white;
            margin-top: 100px;
        }
    </style>
</head>
<body>
    <header class="header">
        <img src="{{asset('logo/ajsc.png')}}" id="logo" alt="">
    </header>
    <main class="main">
        <h3 style="margin-top:50px; margin-bottom:70px;">به سیستم گزارش دهی آنلاین کمیته مصونیت خبرنگاران افغان خوش آمدید!</h3>
        <a href="{{route('login')}}" id="login">ورود به سیستم</a>
    </main>
    <footer class="footer">
            <div class="copy" >
                <p>CopyRight&copy; AJSC 2023</p>
            </div>
            <div style="margin-top : 3px; font-size:small;">
                <p>Developed by <a href="https://asoft-af.com" target="_blank" style="text-decoration: none;"> <span style="color: #e28818;">A</span>SOFT</a></p>
            </div>
            <div class="social-links">
                <a href="http://facebook.com/Safetycommittee" title="http://facebook.com/Safetycommittee" target="_blank"><i class="fa-brands fa-facebook" ></i></a>
                <a href="http://instagram.com/ajscafg" title="http://instagram.com/ajscafg" target="_blank"><i class="fa-brands fa-instagram" ></i></a>
                <a href="http://twitter.com/ajsc_af" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                <a href="http://ajsc.af/" title="http://ajsc.af/" target="_blank"><i class="fa-solid fa-link"></i></a>
            </div>
    </footer>
</body>
</html>