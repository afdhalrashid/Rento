<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('img/logo tab browser.ico') }}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body {
            background: #222D32;
            font-family: 'Roboto', sans-serif;
            /* The image used */
            background-image: url('{{ asset('img/0904 - bc-04 new.jpg') }}');

            /* Full height */
            height: 100%;

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: repeat-y;
            background-size: cover;
        }

        body,
        html {
            height: 100%;
            margin: 0;
        }

        .bg {
            /* The image used */
            /* background-image: url('{{ asset('img/0904 - bc-04 new.jpg') }}'); */

            /* Full height */
            height: 100%;

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: repeat-y;
            background-size: cover;
        }

        .layer {
            background-color: rgba(2, 2, 2, 0.118);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: auto;
        }

        .login-box {
            margin-top: 55px;
            height: auto;
            background: #ffffff;
            text-align: center;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
            border-radius: 45px;
            padding-bottom: 20px;
        }

        .login-key {
            height: 100px;
            font-size: 80px;
            line-height: 100px;
            background: -webkit-linear-gradient(#27EF9F, #0DB8DE);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .login-title {
            margin-top: 15px;
            text-align: center;
            font-size: 30px;
            letter-spacing: 2px;
            margin-top: 15px;
            font-weight: bold;
            color: #ECF0F5;
        }

        .login-form {
            margin-top: 5px;
            text-align: left;
        }

        input[type=email] {
            background-color: #f1f1f1 !important;
            border: none;
            /* border-bottom: 2px solid #695600; */
            border-top: 0px;
            border-radius: 5px;
            /* font-weight: bold; */
            outline: 0;
            margin-bottom: 20px;
            padding-left: 0.75rem;
            color: #070707;
            letter-spacing: 1px;
            font-size: 16px;

            box-shadow: inset 3px 3px #b9b9b9;
            -moz-box-shadow: inset 3px 3px #b9b9b9;
            -webkit-box-shadow: inset 3px 3px #b9b9b9;
        }

        input[type=password] {
            background-color: #f1f1f1 !important;
            border: none;
            /* border-bottom: 2px solid #deb80d; */
            border-top: 0px;
            /* border-radius: 0px; */
            /* font-weight: bold; */
            outline: 0;
            /* padding-left: 0px; */
            margin-bottom: 20px;
            color: #020202;
            font-size: 16px;
            letter-spacing: 3px;

            box-shadow: inset 3px 3px #b9b9b9;
            -moz-box-shadow: inset 3px 3px #b9b9b9;
            -webkit-box-shadow: inset 3px 3px #b9b9b9;
        }

        .form-group {
            margin-bottom: 40px;
            outline: 0px;
        }

        .form-control:focus {
            border-color: inherit;
            -webkit-box-shadow: none;
            box-shadow: none;
            border-bottom: 2px solid #0DB8DE;
            outline: 0;
            background-color: #f1f1f1;
            color: #142335;
        }

        input:focus {
            outline: none;
            box-shadow: 0 0 0;
        }

        label {
            margin-bottom: 0px;
        }

        .form-control-label {
            font-size: 14px;
            color: #6C6C6C;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .btn-outline-primary {
            border-color: #0DB8DE;
            color: #0DB8DE;
            border-radius: 0px;
            font-weight: bold;
            letter-spacing: 1px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        }

        .btn-outline-primary:hover {
            background-color: #0DB8DE;
            right: 0px;
        }

        .login-btm {
            /* float: left;
            width: 70%; */
            /* background-color: #ffce49; */
            color: #051b25;
        }

        .login-button {
            /* padding-right: 0px;
            text-align: right; */
            margin-bottom: 15px;
        }

        .login-text {
            text-align: left;
            padding-left: 0px;
            color: #A2A4A4;
        }

        .loginbttm {
            padding: 0px;
        }

        .btn-large {
            padding: 0.3rem 1.4rem;
            /* font-size: 1.3rem; */
            font-size: calc(10% + 1vw + 1vh);
            line-height: 2.1;
            border-radius: 0.7rem;
            letter-spacing: 2px;
            /* width: 50%; */
            font-weight: bold;
            border-bottom: 2px solid #a16e10;
        }

    </style>
</head>

<body>
    <div class="bg">
        <div class="layer">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-1 col-xs-0"></div>
                    <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12 login-box mx-2"
                        style="padding-top: 30px;padding-bottom: 60px;">

                        <div class="col-lg-12 login-title">
                            <img src="{{ asset('img/0904 - LP png (18).png') }}" width="340" height="100">
                            {{-- <strong>BURS
                                |</strong> Login --}}
                        </div>

                        <div class="col-lg-12 login-form">
                            <div class="col-lg-12 login-form">


                                <div class="col-lg-12 loginbttm">
                                    <div class="row">
                                        <div class="col-md-12 mx-auto text-center mb-3">
                                            <h2
                                                style="padding-bottom: 0; margin-bottm: 0; color: #e0b12d; font-size: 2.5rem;">
                                                Sistem
                                                pengurusan</h2>
                                            <h3
                                                style="margin-top: -15px; padding-top:0; color: #cfaa44;font-size: 2.0rem;">
                                                rumah sewa
                                                digital</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 login-btm login-text">

                                    </div>
                                    <div class="row" style="padding-top: 25px">
                                        <div class="col-lg-6 col-md-6 col-sm-6 text-center mt-2">
                                            <a type="button"
                                                class="btn btn-burs-y btn-large float-lg-right float-md-right float-sm-right"
                                                href="/login">
                                                {{ __('LOG MASUK') }}
                                            </a>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 text-center mt-2">
                                            <a type="button"
                                                class="btn btn-burs-y btn-large float-lg-left float-md-left float-sm-left"
                                                href="https://bijakurusrumahsewa.com">
                                                {{ __('DAFTAR') }}
                                            </a>
                                        </div>
                                    </div>


                                    {{-- <div class="row" style="padding-top: 25px">
                                        <div
                                            class="col-lg-3 col-md-4 col-sm-5 col-6 offset-lg-3 offset-md-2 offset-sm-1 offset-2 login-btm login-button">
                                            <a type="button" class="btn btn-burs-y btn-large" href="/login">
                                                {{ __('LOG MASUK') }}
                                            </a>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-3 login-btm register-button">
                                            <a type="button" class="btn btn-burs-y btn-large"
                                                href="https://bijakurusrumahsewa.com">
                                                {{ __('DAFTAR') }}
                                            </a>
                                        </div>
                                    </div> --}}

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="row mt-5" style="">
                    <div class="col-md-12 mx-auto text-center">
                        <h1 style="color: #142335; font-size: calc(57% + 2vw + 1vh); font-weight:900;">Penyelesaian
                            kepada perkara
                            berikut:</h1>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-1 col-xs-0"></div>
                    <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12 login-box mx-2" style="margin-top: 0">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <img class="img-fluid" src="{{ asset('img/0904 - LP png (5).png') }}">

                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <img class="img-fluid" src="{{ asset('img/0904 - LP png (6).png') }}">

                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <img class="img-fluid" src="{{ asset('img/0904 - LP png (7).png') }}">

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <img class="img-fluid" src="{{ asset('img/0904 - LP png (8).png') }}">

                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <img class="img-fluid" src="{{ asset('img/0904 - LP png (9).png') }}">

                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <img class="img-fluid" src="{{ asset('img/0904 - LP png (10).png') }}">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 120px;">
                    <div class="col-md-12 mx-auto text-center">
                        <h1 style="color: #142335; font-size: 2.9rem; font-weight:900;">Bagaimana <img
                                src="{{ asset('img/0904 - LP png (18).png') }}" height="70px" width="150px" alt="">
                            dapat membantu:</h1>
                    </div>

                </div>
                <div class="row" style="margin-bottom: 70px">
                    <div class="col-lg-2 col-md-2"></div>
                    <div class="col-lg-8 col-md-8 login-box" style="margin-top: 0">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <img class="img-fluid" src="{{ asset('img/0904 - LP png (11).png') }}">

                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <img class="img-fluid" src="{{ asset('img/0904 - LP png (12).png') }}">

                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <img class="img-fluid" src="{{ asset('img/0904 - LP png (13).png') }}">

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <img class="img-fluid" src="{{ asset('img/0904 - LP png (14).png') }}">

                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <img class="img-fluid" src="{{ asset('img/0904 - LP png (15).png') }}">

                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <img class="img-fluid" src="{{ asset('img/0904 - LP png (16).png') }}">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <p class="text-center" style="color: #e7e7e7">Copyright <i class="far fa-copyright"></i><span style="font-weight: bold; font-size:1.1rem;"> Hartaplus Capital Sdn Bhd</span></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div>
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                        <p class="text-center" style="color: #e7e7e7"><a style="font-weight: bold; font-size:1.1rem;cursor: pointer; text-decoration: underline;" data-toggle="modal" data-target="#modal_dasar_privasi"> Dasar Privasi</a></p>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                        <p class="text-center" style="color: #e7e7e7"><a style="font-weight: bold; font-size:1.1rem;cursor: pointer; text-decoration: underline;" data-toggle="modal" data-target="#modal_terma_syarat">Terma dan Syarat</a></p>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                        <p class="text-center" style="color: #e7e7e7"><a style="font-weight: bold; font-size:1.1rem;cursor: pointer; text-decoration: underline;" data-toggle="modal" data-target="#modal_hubungi_kami"> Hubungi Kami</a></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modal_dasar_privasi" data-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true" style="z-index: 1060">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="staticBackdropLabel">Dasar Privasi</h3>

                    </div>
                    <div class="modal-body">
                        <div class="ml-2">
                            Accessible from <a target="_blank" href="www.burs-t.com">www.burs-t.com</a>, one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by www.burs-t.com and how we use it.
                            If you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us through email at <span style="color: blue;">aduan.hartaplus.capital@gmail.com</span></br></br><h5>Log Files</h5><p><a target="_blank" href="www.burs-t.com">www.burs-t.com</a> follows a standard procedure of using log files. These files log visitors when they visit websites. All hosting companies do this and a part of hosting services’ analytics. The information collected by log files include internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, referring/exit pages, and possibly the number of clicks. These are not linked to any information that is personally identifiable. The purpose of the information is for analyzing trends, administering the site, tracking users’ movement on the website, and gathering demographic information.</p></br></br><h5>Cookies and Web Beacons</h5><p>Like any other website,<a target="_blank" href="www.burs-t.com">www.burs-t.com</a> uses ‘cookies’. These cookies are used to store information including visitors’ preferences, and the pages on the website that the visitor accessed or visited. The information is used to optimize the users’ experience by customizing our web page content based on visitors’ browser type and/or other information.</p></br></br><h5>Privacy Policies</h5><p>
                            Third-party ad servers or ad networks uses technologies like cookies, JavaScript, or Web Beacons that are used in their respective advertisements and links that appear on <a target="_blank" href="www.burs-t.com">www.burs-t.com</a>, which are sent directly to users’ browser. They automatically receive your IP address when this occurs. These technologies are used to measure the effectiveness of their advertising campaigns and/or to personalize the advertising content that you see on websites that you visit.
                            Note that <a target="_blank" href="www.burs-t.com">www.burs-t.com</a> has no access to or control over these cookies that are used by third-party advertisers.</p>
                            </br></br><h5>Third Party Privacy Policies</h5><p>
                            <a target="_blank" href="www.burs-t.com">www.burs-t.com</a>’s Privacy Policy does not apply to other advertisers or websites. Thus, we are advising you to consult the respective Privacy Policies of these third-party ad servers for more detailed information. It may include their practices and instructions about how to opt-out of certain options. You may find a complete list of these Privacy Policies and their links here: Privacy Policy Links.
                            You can choose to disable cookies through your individual browser options. To know more detailed information about cookie management with specific web browsers, it can be found at the browsers’ respective websites. What Are Cookies?</p>
                            </br></br><h5>Children's Information</h5><p>
                            Another part of our priority is adding protection for children while using the internet. We encourage parents and guardians to observe, participate in, and/or monitor and guide their online activity.
                            <a target="_blank" href="www.burs-t.com">www.burs-t.com</a> does not knowingly collect any Personal Identifiable Information from children under the age of 13. If you think that your child provided this kind of information on our website, we strongly encourage you to contact us immediately and we will do our best efforts to promptly remove such information from our records.</p>
                            </br></br><h5>Online Privacy Policy Only</h5><p>
                            This Privacy Policy applies only to our online activities and is valid for visitors to our website with regards to the information that they shared and/or collect in <a target="_blank" href="www.burs-t.com">www.burs-t.com</a>. This policy is not applicable to any information collected offline or via channels other than this website.</p></br></br><h5>Consent</h5><p style="display: block;">By using our website, you hereby consent to our Privacy Policy and agree to its Terms and Conditions</p>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <div class="float-right">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        {{-- End --}}


        <!-- Modal -->
        <div class="modal fade" id="modal_terma_syarat" data-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true" style="z-index: 1060">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="staticBackdropLabel">Terma dan Syarat</h3>
                    </div>
                    <div class="modal-body">
                        <div class="ml-2">
                            <h5>Hakcipta</h5><p>
                                Semua kandungan editorial, grafik, video dan petikan suara di laman ini dilindungi oleh undang-undang hakcipta Malaysia dan triti antarabangsa dan tidak boleh ditiru atau digunakan semula tanpa kebenaran nyata daripada <span style="font-weight: bold"> Hartaplus Capital Sdn Bhd (No. Syarikat: 1269590-D) </span>(selepas ini dirujuk sebagai “Syarikat”), yang merizab semua hak. Penggunaan semula sebarang kandungan tersebut di dalam talian bagi sebarang tujuan dilarang keras. Kebenaran untuk menggunakan kandungan keempunyaan Syarikat boleh diberikan bergantung kepada keadaan. Sila tujukan pertanyaan anda kepada <span style="font-weight: bold">aduan.hartaplus.capital@gmail.com</span>.Bahan daripada laman web ini tersedia untuk kegunaan luar talian bagi tujuan maklumat dan bukan perdagangan sahaja, dengan syarat bahawa: kandungan dan/atau grafik tidak dimodifikasi, dipinda atau diubah dalam apa cara pun jua; semua notis hakcipta dan notis lain atas apa-apa salinan dikekalkan; dan kebenaran bertulis telah diberikan oleh Syarikat. Anda dilarang sama sekali dari memaparkan kandungan atau bahan yang terkandung dalam portal <a target="_blank" href="www.burs-t.com">www.burs-t.com</a> dalam sesuatu laman web sama ada bagi tujuan perdagangan atau peribadi tanpa mendapati dan memperolehi kebenaran bertulis yang nyata daripada Syarikat terlebih dahulu.
                                Anda tidak boleh meniru atau menyesuaikan kod HTML yang diwujudkan oleh Syarikat untuk memaparkan halaman. Kod HTML turut dirangkum dalam hakcipta Syarikat. “Rupa” dan “gaya” <a target="_blank" href="www.burs-t.com">www.burs-t.com</a> dan laman-laman kecilnya juga cap dagang Syarikat, dan ini termasuk skim warna, bentuk butang, susun atur dan semua unsur-unsur grafik lain dalam <a target="_blank" href="www.burs-t.com">www.burs-t.com</a>.
                                Bahan agensi berita pihak ketiga yang terkandung dalam <a target="_blank" href="www.burs-t.com">www.burs-t.com</a> dilindungi oleh hakcipta dan tidak boleh diterbitkan, disiarkan, ditulis semula untuk disiarkan atau diterbitkan atau diedarkan semula secara langsung atau tidak langsung dalam apa jua perantara. Bahan ini atau mana-mana bahagian daripadanya tidak boleh disimpan dalam komputer kecuali bagi kegunaan peribadi dan bukan perdagangan.
                                Agensi/agensi-agensi berita tidak akan dipertanggungjawabkan atas sebarang kelewatan, ketidaktepatan, kesilapan atau ketinggalan terhadapnya atau terhadap penghantaran atau penyerahan semua atau mana-mana bahagian daripada atau bagi sebarang gantirugi yang berbangkit daripada apa-apa perkara yang disebut sebelum ini.
                                <h5>Cap Dagang</h5>
                                Cap dagang dan cap perkhidmatan yang dimiliki oleh Syarikat antara lainnya termasuk tetapi tidak terhad kepada <a target="_blank" href="www.burs-t.com">www.burs-t.com</a> serta setiap logo di semua laman. Semua cap dagang dan nama dagang lain dimiliki oleh pemiliknya masing-masing.
                            </br></br><h5>Peraturan Am</h5>
                                Syarikat mempunyai komuniti pengguna yang berkembang pesat dan menggalakkan komen dibuat terhadap artikel, cerita dan post blog. Kami memberi tumpuan kepada komuniti ini dan sentiasa berusaha untuk memastikan perbualan yang saling menghormati, menarik dan informatif. Bagi tujuan itu, kami menetapkan garis panduan umum untuk mengulas. Garis panduan ini dikuatkuasakan 24/7 melalui sistem pengantara yang merangkumi pasukan kakitangan dan alat pengantara.
                                Jika menurut pendapat mutlak kami, komen anda secara konsisten atau sengaja membuat komuniti ini tempat yang kurang sivil dan menyeronokkan anda dan komen anda akan dikecualikan daripadanya.Syarikat menggalakkan suasana yang terbuka, telus dan sopan untuk komen dan pengguna. Perbincangan dan penghujahan yang kritis, mendalam dan bijak amat digalakkan.
                            </br></br><h6 style="text-decoration: underline;">A. Perkara Yang Dilarang.</h6>Semua orang adalah dialu-alukan dan digalakkan untuk menyuarakan pendapat mereka tanpa mengira identiti , politik , ideologi , agama atau perjanjian dengan ahli-ahli masyarakat yang lain , pengarang pos atau kakitangan ahli selagi pendapat diberi secara hormat dan membina menambah perbualan. Walau bagaimanapun, komuniti ini tidak akan mentoleransi serangan langsung atau tidak langsung, kata-mengata atau kata-kata kesat, dan juga tidak mentoleransi percubaan yang disengajakan untuk melencongkan, merampas, ‘troll’ atau mengumpan orang lain agar memberikan balasan penuh emosi. Kami merizab budi bicara mutlak untuk memadamkan komen sebegini daripada komuniti jika wajar. Individu yang dengan konsisten atau sengaja membuat komen sebegini boleh diberikan amaran dalam talian dan, jika perlu, disingkirkan daripada komuniti dan/atau dilaporkan kepada pihak berkuasa relevan. Kami telah merumuskan Peraturan Am berikut agar semua dapat meraih manfaat maksimum daripada Www.burs-t.com. Sila ambil maklum bahawa peraturan ini juga dikenakan kepada serahan media beraneka seperti imej, klip video dan audio, serta kandungan berkaitan dengan anda seperti imej avatar. Contoh komen yang tidak dibenarkan di bawah Peraturan Am kami termasuk tetapi tidak terhad kepada:</br><br/>

                                <ul>
                                    <li>Yang bersifat kasar/menyakitkan hati/lucah;</li>
                                    <li>Memfraud, menipu atau memperdaya;</li>
                                    <li>Terkeluar dari topik;</li>
                                    <li>Spam (seperti ulasan yang sama yang berkali-kali dibuat) atau memasukkan pautan tertentu ke laman lain;</li>
                                    <li>Dengan tersirat atau nyata menyerang dan/atau memfitnah mana-mana pihak ketiga;</li>
                                    <li>Komen menyakitkan hati tentang sebarang jantina, asal-usul etnik, agama, bangsa atau budaya;</li>
                                    <li>Menggalakkan sebarang aktiviti haram;</li>
                                    <li>Menerangkan atau menggalakkan aktiviti yang boleh membahayakan keselamatan atau kebajikan orang lain;</li>
                                    <li>Mempromosi perkhidmatan, produk atau pertubuhan politik tertentu;</li>
                                    <li>Nampaknya menyamar diri sebagai orang lain;</li>
                                    <li>Mengandungi pendedahan maklumat peribadi termasuk nama, nombor hubungan, alamat, e-mel dan lain-lain;</li>
                                    <li>Melanggar hak keempunyaan, hakcipta atau cap dagang mana-mana pihak;</li>
                                    <li>Menyalahi undang-undang dan/atau kemungkiran sebarang peraturan atau undang-undang yang kini berkuat kuasa;</li>
                                    <li>Ditulis dalam bahasa lain kecuali Bahasa Inggeris, Bahasa Malaysia kecuali dinyatakan dengan jelas;</li>
                                    <li>Sebarang komen lain yang dianggap tidak sesuai oleh Pasukan;</li>
                                    <li>Mengiklankan atau mempromosi produk atau laman web tidak dibenarkan di mana-mana jua di www.burs-t.com. Ini termasuk pautan kepada:</li>
                                    <li>Laman web peribadi atau forum;</li>
                                    <li>Tinjauan dan soal selidik;</li>
                                    <li>Laman web perdagangan atau laman lelongan yang wujud terutamanya untuk menjual produk.</li>
                                    <li>Butir-butir majlis amal atau pungutan derma</li>
                                    <li>Misalnya, sekiranya ia berkaitan kepada perbincangan, pautan boleh dibuat kepada laman web yang menjual album atau buku jika ini membantu pengguna lain atau mengesyorkan sesuatu yang mungkin menarik minat mereka. Walau bagaimanapun, meletakkan pautan kepada album kumpulan muzik anda sendiri atau cuba menggalakkan pembeli melawat laman lelongan e-bay atau pungutan derma anda sendiri mungkin boleh menyebabkan post anda dipadamkan.</li>
                                </ul>
                            </br><h5>Risiko melanggar undang-undang hakcipta</h5>
Undang-undang hakcipta wujud untuk menghalang seseorang daripada menjiplak karya orang lain. Undang-undang ini diguna pakai terhadap internet dalam cara yang sama seperti TV, buku dan media. Pelanggaran undang-undang hakcipta boleh menyebabkan tindakan dibawa di mahkamah.
Sila jangan masukkan petikan teks yang panjang lebar yang disalin daripada sumber lain, kerana ini mungkin suatu pelanggaran hakcipta. Petikan pendek untuk menyerlahkan sesuatu perkara mungkin dibenarkan, walau bagaimanapun ini adalah menurut budi bicara kami.
Jika anda ingin merujuk kepada sumber maklumat luar, lebih wajar jika anda memasukkan pautan kepada laman web luar yang berkenaan.
Di samping itu, post dengan bahasa teks yang berat atau bahasa yang tidak dapat difahami seperti kod, juga tidak dibenarkan kerana ini boleh mengganggu aliran semulajadi perbualan.
Menyumbang bahan kepada komuniti www.burs-t.com dengan niat untuk melakukan jenayah, melanggar undang-undang, atau menyokong atau menggalakkan aktiviti yang menyalahi undang-undang benar-benar dilarang.
Di samping itu, kami boleh memadamkam post yang kami anggap boleh membahayakan pengguna lain – yang termasuk tetapi tidak terhad kepada, menawarkan nasihat perubatan dan kesihatan, atau menggalakkan penyalahgunaan dadah atau alkohol atau mencederakan diri sendiri.<br/>
<h5>Mengandungi kenyataan yang berpotensi memfitnah</h5>
Undang-undang fitnah wujud untuk melindungi individu dan/atau organisasi daripada serangan tidak wajar, salah atau tidak benar terhadap reputasi mereka.
Memasukkan kenyataan memfitnah di blog adalah sama seperti menerbitkannya di dalam akhbar atau majalah dan boleh menyebabkan prosiding undang-undang dimulakan.
Untuk mengelakkan prosiding undang-undang dimulakan, sila pastikan bahawa anda menentusahkan maklumat dalam posting anda sebagai benar dan tepat, terutamanya sewaktu mengutarakan kenyataan negatif sebagai fakta. Di samping itu, elakkan daripada membuat kesimpulan dengan tergesa-gesa, membesar-besarkan cerita atau membuat implikasi secara halus. Sila diingati bahawa dengan menambah perkataan ‘dikatakan’ dalam sesuatu kenyataan tidak bererti kenyataan tersebut tidak memfitnah.
Anda dan www.burs-t.com kedua-duanya boleh dipertanggungjawabkan jika anda membuat kenyataan memfitnah di laman web www.burs-t.com. Kami akan memadamkam komen jika kami tidak mempunyai keterangan yang cukup untuk membela penerbitan kenyataan anda. Ini bermaksud pengantara www.burs-t.com boleh mengambil sikap amat berhati-hati apabila mempertimbangkan sesetengah komen.<br/><br/>
<h5>Memaki atau mengganggu</h5>
Kelakuan memaki atau mengganggu tidak dibenarkan di www.burs-t.com. Ini termasuk:<br/><br/>
<ul>
<li>Menggunakan kata-kata menyumpah (termasuk singkatan atau ejaan alternatif) atau bahasa lain yang kemungkinan besar akan menyinggung perasaan.</li>
<li>Mengganggu, mengugut atau menyebabkan penderitaan atau kesulitan kepada mana-mana orang atau orang-orang.</li>
<li>‘Flaming’: Ini bermaksud meletakkan post yang marah-marah dan tidak bertimbang rasa.</li>
<li>‘Trolling’: Ini bermaksud sengaja menyatakan perkara yang provokatif sekadar untuk menimbulkan kekacauan.</li>
<li>Melanggar hak, menyekat atau menghalang orang lain daripada menggunakan dan memperolehi manfaat daripada www.burs-t.com.</li>
<li>Cuba menyamar diri sebagai orang lain.</li>
<li>Menggunakan pelbagai akaun untuk mengganggu papan mesej, menyakitkan hati pengguna, atau untuk mengelakkan pra-pengantaraan.</li>
<li>Menaikkan benang (‘bumping’) atau mewujudkan benang pendua, memasukkan post dalam sedemikian cara hingga menyebabkan masalah teknikal, atau sebarang percubaan lain untuk mengganggu aliran perbualan yang bersahaja.</li>
<li>Akaun pengguna yang dengan serius atau dengan berulang kali memaparkan kelakuan sedemikian mungkin dikenakan pra-pengantaraan atau disekat buat selama-lamanya dan tidak dibenarkan kembali.</li>
<li>Menyakitkan hati</li>
<li>Ulasan yang mengandungi kandungan yang menjelikkan tidak dibenarkan di www.burs-t.com. Bahan perkauman, seksis, homophobic , melumpuhkan, lucah, kesat atau kasar akan dipadamkan dan jika keterlaluan akan menyebabkan akaun anda disekat dengan serta-merta dan selama-lamanya.</li>
</ul><br/>

<h5>Terkeluar dari topik</h5>
Komen yang tidak berkaitan dengan subjek catatan artikel yang disumbang oleh anda – dianggap ‘terkeluar dari topik’.
Sila jangan sumbangkan bahan yang terkeluar dari topik dalam artikel yang mempunyai subjek khusus, kecuali jika artikel dinyatakan sebagai post terbuka. Jika komen anda dipadamkan kerana terkeluar dari topik, anda mungkin boleh memasukkan semula komen anda di bahagian topik yang lebih sesuai.
<br/><br/><h5>Mengandungi butir-butir peribadi</h5>
Memasukkan butir-butir hubungan atau pengenalan dalam komen seperti nombor telefon, alamat pos atau e-mel tidak dibenarkan di sebahagian besar perkhidmatan. Sila jangan dedahkan sebarang maklumat peribadi tentang diri anda atau orang lain kerana ini mungkin menyebabkan anda atau orang lain menanggung risiko.
<br/><br/><h5>Risiko penghinaan mahkamah</h5>
Apabila suspek ditangkap kerana kesalahan, atau kesalahan-kesalahan, sekatan undang-undang akan dikenakan. Sila berhati-hati apabila membincangkan laporan tentang tangkapan atau prosiding mahkamah. Pautan kepada cerita berita, catatan blog, dan komen yang telah diarkib juga mungkin menyalahi undang-undang kerana undang-undang penghinaan Malaysia biasanya melarang sebarang rujukan kepada sabitan bersalah sebelum itu bagi seseorang yang menghadapi prosiding mahkamah baru.
<br/><br/><h5>Mengandungi spam</h5>
‘Spamming’ atau ‘flooding’ tidak dibenarkan di www.burs-t.com. ‘Spamming’ bermaksud kerap kali menghantar sumbangan yang sama atau hampir serupa di pelbagai blog atau catatan. ‘Flooding’ bermaksud berkali-kali menghantar semula sumbangan anda ke laman yang sama.
Sila jangan gunakan tandatangan di bawah komen anda untuk mempromosi laman web, perkhidmatan, produk, atau kempen. Ini akan menyebabkan post anda dipadamkan kerana dianggap sebagai spam.
<br/><br/><h5>Mengandungi URL yang tidak sesuai</h5>
Misalnya, anda tidak boleh membuat pautan kepada:<br/><br/>

<ul>
    <li>Kandungan yang menyalahi undang-undang, tidak sesuai atau lucah.</li>
    <li>Laman web yang memerlukan pembayaran untuk mendapatkan akses.</li>
    <li>Kandungan bahasa asing.</li>
    <li>Laman web yang memulakan muat turun fail atau menghendaki perisian tambahan untuk melihatnya. Ini termasuk fail .pdf dan .mp3.</li>
    <li>Laman web yang mengiklankan atau mempromosi produk</li>
    <li>Dalam sesetengah keadaan, pengantara akan menyunting pautan dan meninggalkan komen lain yang dapat dilihat di papan mesej. Jika begitu pautan akan digantikan oleh kenyataan [Unsuitable/ broken URL removed by moderator]</li>

</ul>
<br/>
Syarikat mengalu-alukan maklum balas, yang positif dan juga negatif, tentang program dan perkhidmatan kami tetapi sila pastikan bahawa komen anda mematuhi Peraturan Am di atas.
Berulang kali meletakkan post yang mengandungi komen peribadi atau menyakitkan hati terhadap individu atau mereka yang bekerja dengan Syarikat dan kumpulan syarikatnya boleh dianggap kacau ganggu. Kami merizab hak untuk memadamkan mesej sedemikian dan mengambil tindakan terhadap mereka yang bertanggungjawab.
<br/><br/><h6 style=" text-decoration: underline;">B. Proses Pengantara.</h6>
Untuk mengekalkan suasana yang sopan, pasukan pengantara kami mungkin membaca komen sebelum komen tersebut dipaparkan kepada pengguna lain. Jika begitu, anda boleh melihat bahawa komen anda sedang menunggu kelulusan. Masa kelulusan bergantung kepada jumlah komen di seluruh laman, jadi anda diharap bersabar; kami akan menangani semua komen secepat mungkin.
<br/><br/><h6 style=" text-decoration: underline;">C. Perkara Yang Digalakkan.</h6>
Adililah diri anda sendiri, bukannya orang lain. Pendapat setiap insan adalah bernilai dan unik. Jika anda berpura-pura menjadi orang lain, ciri-ciri unik anda atau orang lain akan hilang. Jangan memberikan gambaran yang salah tentang diri anda atau orang lain, menyebarkan maklumat yang salah, mewujudkan pelbagai akaun atau “astroturf” (Apabila pengguna berpura-pura menjadi pengulas yang objektif, tetapi mempunyai kepentingan diri dalam subjek tersebut). Jika anda berbuat demikian, komuniti akan menjadi tempat yang kurang menyeronokkan dan berharga dan komen anda akan dipadamkan apabila kami melihatnya. Komuniti ini adalah ruang yang selamat. Kami benar-benar percaya bahawa www.burs-t.com seharusnya menjadi suatu ruang yang selamat untuk individu, kumpulan dan idea mereka. Oleh itu, bahasa yang ganas dan bermusuhan atau seruan agar melakukan keganasan dan permusuhan tidak dialu-alukan di sini. Jika anda secara langsung atau tidak langsung mengancam kesejahteraan fizikal atau mental seorang ahli komuniti ini, atau individu atau kumpulan yang menjadi subjek sesuatu artikel, anda akan disingkirkan dengan serta-merta. Jika ancaman yang boleh dipercayai dibuat terhadap sesuatu individu atau kumpulan, ancaman tersebut bukan sahaja akan dipadamkan tetapi kemungkinan besar akan dilaporkan kepada agensi penguatkuasaan undang-undang dan kami akan bekerjasama dengan mereka setakat yang diminta. Maklumat yang boleh dikenal pasti secara peribadi tidak boleh dimasukkan dalam bahagian komen www.burs-t.com. Langkah ini memudaratkan. Jika anda melihat sebarang ancaman, gangguan atau ‘trolling’ tentang maklumat peribadi, sila laporkannya dengan segera.Jika anda mempunyai sebarang komen, kami sentiasa di sini dan menyediakan kakitangan yang akan membaca dan membalasnya. Jika anda mempunyai aduan, soalan, kebimbangan atau maklum balas – positif atau kritis – sila hubungi kami di aduan.hartaplus.capital@gmail.com
<br/><br/><h5>Penafian dan Amaran</h5><br/>
<h6 style=" text-decoration: underline;">Pilihan Penafian.</h6>
Syarikat berusaha untuk memastikan bahawa maklumat yang terkandung dalam halaman ini adalah tepat. Walau bagaimanapun, Syarikat tidak membuat sebarang representasi tentang ketepatan, kebenaran, kesempurnaan, kesesuaian, kesahan sebarang maklumat di halaman ini dan tidak akan bertanggungjawab atas sebarang kesilapan, ketinggalan, kelewatan pada maklumat yang terkandung dalam halaman ini atau sebarang maklumat lain yang diakses melalui laman ini, termasuk tanpa had, sebarang maklumat yang diperolehi melalui pautan di laman ini kepada laman luar, atau sebarang kerugian, kecederaan atau kerosakan yang berbangkit daripada paparan atau penggunaannya. Semua pengguna benar-benar digalakkan mendapatkan nasihat profesional sebelum bergantung kepada sebarang maklumat yang diberikan di dalam ini.
<br/><br/><h6 style=" text-decoration: underline;">Pilihan Amaran.</h6>
Untuk mengelakkan kekecewaan, kami menggalakkan anda membaca Terma dan Syarat dan Peraturan Am kami sebelum membuat komen. Sila ingat bahawa komen anda tertakluk kepada peraturan ini serta Terma & Syarat kami dan boleh dipadamkan tanpa memberi notis terdahulu sekiranya ia melanggar mana-mana Terma dan Syarat dan Peraturan Am yang disebut sebelum ini.
<br/><br/><h5>PRIVASI Maklumat Peribadi</h5><br/>
Sila rujuk kepada dasar p   rivasi untuk membaca terma-terma tentang penggunaan maklumat anda.
<br/><br/><h5>KEBENARAN</h5><br/>
Syarikat ingin menggunakan maklumat peribadi anda hanya bagi tujuan kepentingan sah dan dengan kebenaran anda. Untuk pelanggan, penerimaan terhadap pengumpulan, pengumpulsemakan, penggunaan dan/atau pendedahan semua maklumat peribadi oleh Syarikat membentuk salah satu syarat bagi tujuan melanggan pakej. Dengan melanggan, anda menandakan persetujuan anda.
Untuk individu lain, Syarikat mungkin mengumpul maklumat anda semasa pendaftaran ahli dan aktiviti perniagaan. Maklumat hanya akan digunakan untuk kepentingan sah.
Kami hanya menyimpan Maklumat Peribadi selama mana yang perlu untuk memenuhi Tujuan yang dinyatakan bagi pengumpulannya. Kami menyimpan Maklumat Peribadi mengikut garis panduan, prosedur dan prinsip kami dan selaras dengan undang-undang yang berkenaan.
Kami mungkin mendedahkan Maklumat Peribadi anda kepada anak-anak syarikat lain dalam kumpulan Syarikat atau kepada Vendor (sering kali dirujuk sebagai pemproses data). “Vendor” berhubung dengan Maklumat Peribadi bermaksud mana-mana orang atau entiti (selain daripada pekerja Syarikat) yang memproses Maklumat Peribadi bagi pihak Syarikat. “Pemprosesan”, berhubung dengan Maklumat Peribadi bermaksud contohnya mendapatkan, merekodkan, memegang atau menggunakan Maklumat Peribadi semasa melaksanakan apa-apa operasi atau himpunan operasi terhadap Data Peribadi termasuk mengatur, menyusun, mendapatkan kembali mendedahkan Maklumat Peribadi bagi Tujuan penentusahan. Anak-anak syarikat ini akan merahsiakan Maklumat Peribadi anda, selaras dengan semua perundangan Perlindungan Data yang berkenaan dan akan memproses mana-mana Maklumat Peribadi sedemikian hanya untuk Tujuan tersebut dan menurut terma-terma yang dinyatakan di dalam ini.
Kami boleh mendedahkan Maklumat Peribadi anda jika kami dikehendaki berbuat demikian oleh undang-undang atau keperluan pihak berkuasa yang kompeten.
Di samping perkara di atas, kami boleh dari semasa ke semasa melaksanakan inisiatif khusus dengan syarikat /organisasi pihak ketiga yang dipilih dengan teliti (di luar Syarikat) untuk berkongsi peluang dengan anda. Jika kami berbuat demikian, kami akan memaklumkan anda pada masa inisiatif itu dilaksanakan bahawa, jika anda membuat keputusan untuk memberikan sebarang Maklumat Peribadi, Maklumat Peribadi tersebut akan dikongsi dengan syarikat/organisasi terpilih tersebut dan kami hanya akan berbuat demikian sekiranya mendapat kebenaran terdahulu daripada anda.
Anda akan sentiasa diberi peluang untuk membenarkan (pilihan penyertaan) maklumat anda dikongsi selaras dengan perkara di atas, dan syarikat/organisasi terpilih akan dikenal pasti dengan cukup bagi membolehkan anda membuat keputusan termaklum. Jika anda membenarkan (pilihan penyertaan) dan seterusnya melawat laman web syarikat/organisasi tersebut, kami tidak dapat mengawal cara bagaimana mereka menggunakan atau sebaliknya memproses mana-mana Maklumat Peribadi yang diberikan oleh anda secara terus kepada mereka. Kami sentiasa menggalakkan anda agar menyemak terma dan syarat dan dasar privasi laman mereka sebelum anda memberikan apa-apa Maklumat Peribadi.
Jika anda memberi kebenaran (pilihan penyertaan) untuk menerima komunikasi ini, anda boleh berhenti melanggan pada bila-bila masa di masa hadapan dengan menghubungi kami.
Pilihan Penyertaan:Kami tidak akan menggunakan Maklumat Peribadi anda bagi tujuan yang tidak dinyatakan terlebih dahulu, melainkan kami sebelum ini telah mendapat kebenaran anda atau melainkan jika tujuan tersebut dikehendaki oleh undang-undang.Kebenaran untuk memberikan Maklumat Peribadi tidak menjadi syarat bagi kami menjual produk kepada anda, melainkan jika maklumat yang diminta diperlukan untuk memenuhi tujuan yang dinyatakan secara jelas dan sah.
Khususnya, kami secara amnya akan mendapatkan kebenaran terdahulu yang nyata daripada anda (pilihan penyertaan) sebelum menghantar komunikasi pemasaran kepada anda.
Membatalkan Langganan: Anda boleh menarik balik kebenaran anda terhadap pengumpulan, penggunaan atau pendedahan (secara amnya Pemprosesan) Maklumat Peribadi anda oleh kami pada bila-bila masa, dengan menulis kepada kami dalam cara yang ditetapkan (sama ada melalui e-mel, surat atau faks), seperti yang dinyatakan dalam komunikasi kami kepada anda, atau dalam borang-borang relevan yang mungkin anda tandatangani (misalnya untuk skim kesetiaan pelanggan kami). Jika anda mempunyai apa-apa kebimbangan, tentang kefungsian pembatalan langganan yang kami sediakan kepada anda, selaras dengan seksyen ini, sila hubungi kami di alamat atau perantara yang ditunjukkan dalam seksyen 10 Terma dan Syarat ini. Jika sebelum ini anda memilih untuk menerima komunikasi perdagangan daripada kami, di samping menjadi ahli skim kesetiaan kami, sekiranya keahlian anda dalam skim tersebut tamat atas apa jua jenis sebab, kami tidak akan menganggapnya secara tersirat sebagai permintaan automatik untuk berhenti melanggan, dan kami akan mengandaikan bahawa kami terus mempunyai kebenaran anda, kecuali jika anda mengambil keputusan khusus untuk berhenti melanggan.
Produk atau Perkhidmatan Serupa (Pilihan penyertaan tersirat): Dalam bidang kuasa tertentu, komunikasi perdagangan boleh dihantar oleh e-mel meskipun jika tiada kebenaran terdahulu yang nyata (pilihan penyertaan) jika butir-butir penerima telah dikumpul berhubung dengan penjualan atau rundingan bagi penjualan produk atau perkhidmatan, tidak kira sama ada kontrak selesai dicapai, dengan syarat sentiasa bahawa identiti penghantar dinyatakan dengan jelas dan pilihan untuk berhenti melanggan diberikan. Ini biasanya dirujuk sebagai “pengecualian Produk atau Perkhidmatan Serupa”, atau sebagai “peraturan Pilihan Penyertaan Tersirat “. Jika peraturan ini diguna pakai, kami boleh bergantung kepadanya untuk menghantar komunikasi pemasaran kepada anda yang kami anggap mungkin menarik minat anda, tetapi kami akan memastikan bahawa perkara ini dijelaskan dan anda diberi peluang untuk memilih untuk tidak menerima komunikasi sedemikian daripada kami, dan anda juga akan sentiasa diberi peluang untuk berhenti melanggan selepas itu.
<br/><br/><h5>KETEPATAN maklumat</h5><br/>
Syarikat memastikan Maklumat Sulit disimpan dengan seberapa tepat, lengkap dan dikemaskinikan sebagaimana yang perlu, dengan mengambil kira penggunaannya dan kepentingan pelanggan kami.
Anda bertanggungjawab untuk memaklumkan kepada kami tentang perubahan pada Maklumat Peribadi anda dan untuk memastikan bahawa maklumat tersebut adalah tepat dan terkini.
<br/><br/><h5>Kepatuhan dengan Undang-undang</h5><br/>
Syarikat telah mewujudkan prosedur untuk menerima dan membalas pertanyaan tentang dasar dan amalan kami berkaitan dengan pengendalian Maklumat Peribadi. Sebarang aduan atau pertanyaan harus dibuat secara bertulis dan dialamatkan seperti yang dinyatakan dalam seksyen 10 di bawah.
Syarikat menyiasat semua aduan. Permintaan akan dimajukan kepada kakitangan yang berkenaan. Jika aduan didapati wajar, Syarikat akan mengambil langkah yang sesuai untuk menyelesaikan perkara ini termasuk, jika perlu, meminda dasar dan amalannya.
<br/><br/><h5>Penafian</h5><br/>
BAHAN YANG TERKANDUNG DI DALAM INI DISEDIAKAN “SEADANYA” DAN TANPA SEBARANG JAMINAN TIDAK KIRA JENISNYA SAMA ADA NYATA ATAU TERSIRAT SETAKAT MAKSIMUM YANG DIBENARKAN SELARAS DENGAN UNDANG-UNDANG YANG BERKENAAN. ANDA BERSETUJU UNTUK MENANGGUNG RUGI, MEMBELA DAN TIDAK MEMPERTANGGUNGJAWABKAN LAMAN WEB WWW.BURS-T.COM SDN BHD DAN SEMUA RAKAN NIAGA GABUNGAN TERHADAP APA-APA TUNTUTAN (TERMASUK, TETAPI TIDAK TERHAD KEPADA, TUNTUTAN UNTUK FITNAH, MEMPERKECIL-KECILKAN PERDAGANGAN (‘TRADE DISPARAGEMENT’), PELANGGARAN PRIVASI DAN HARTA INTELEK) DAN GANTIRUGI TERMASUK FI PEGUAM BERBANGKIT DARIPADA SEBARANG PENYERAHAN OLEH ANDA ATAU MELALUI AKAUN ANDA.



                                </p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="float-right">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
                        </div>

                    </div>


                    </div>
                </div>
            </div>
        </div>
        {{-- End --}}

        <!-- Modal -->
        <div class="modal fade" id="modal_hubungi_kami" data-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true" style="z-index: 1060">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Hubungi Kami</h5>

                    </div>
                    <div class="modal-body">
                        <div class="ml-2">

<p> Jika terdapat sebarang soalan atau kebimbangan tentang Terma dan Syarat ini atau amalan kebenaran yang dibentangkan di dalam ini, sila hubungi kami seperti berikut:
Melalui Emel:<br/>
<span style="color: blue;">hartaplus.capital@gmail.com</span><br/><br/>
Talian Perkhidmatan Pelanggan:<br/>
<span style="font-weight: bold">+6011 11454 388</span><br/><br/>
<span style="font-weight: bold">Isnin – Jumaat</span><br/>
<span style="font-weight: bold">9.00 pagi hingga 6.00 petang, tidak termasuk cuti umum.</span><br/><br/>
Dengan persetujuan kepada terma-terma dan syarat-syarat yang terkandung di sini, anda dengan ini membenarkan Syarikat untuk mengumpul Maklumat Peribadi anda yang akan dikawal dan diuruskan oleh Syarikat. Anda juga dengan ini bersetuju untuk menerima maklumat terkini mengenai produk, berita dan acara kemas kini, ganjaran dan promosi, hak istimewa dan inisiatif dari Syarikat, rakan kongsi dan pengiklan.
</p>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <div class="float-right">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>

                        </div>

                    </div>

                </div>
            </div>
        </div>
        {{-- End --}}

</body>

</html>
