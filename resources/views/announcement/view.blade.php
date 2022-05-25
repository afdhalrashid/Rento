<!------------------------------------------------------------------------>
<!--[ Main Table - Start ]-->
<!------------------------------------------------------------------------>

<table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#08090b" valign="top" align="center" style="
 background-color:rgba(255, 255, 255, 0.952);
 width: 100%;
 max-width: 680px;
 margin-right: auto;
 margin-left: auto;
 padding-top: 32px;
 padding-bottom: 0;
 font-family: Helvetica, Arial, Sans-Serif;
 font-size: 16px;
 line-height: 23px;
 letter-spacing: -0.1px;
 text-align: center;
 color: #260504;
 border-width: 0;
 border-radius: 4px;
 -moz-border-radius: 4px;
 -webkit-border-radius: 4px;
 ">

    <tr>

        <td style="width: 88%; padding-left: 0%; padding-right: 0%;">

            <!-- Inline responsive style for Headline on mobile -->
            <style>
                @media (max-width: 500px) {
                    .headline {
                        font-size: 60px !important;
                        line-height: 48px !important;
                        letter-spacing: -2px !important;
                    }
                }

                ;

            </style>

            {{-- <table width="100%" background="https://wallpaperaccess.com/full/48074.jpg" style="
    background-repeat:repeat;
    background-size: 100% auto;
    filter: brightness(89%);
    "> --}}
    <table width="100%" style="background-color:rgb(3, 3, 3);
    filter: brightness(89%);
    ">

                <tr>
                    <td>

                        <!-- Big Headline -->
                        <div class="headline" mc:edit="section_headline" style="
       width: 100%;
       max-width: 600px;
       margin-right: auto;
       margin-left: auto;
       padding-top: 10px;
       padding-bottom: 100px;
       margin-bottom: 10px;
       font-family: Helvetica, Arial, Sans-Serif;
       font-weight: normal;
       font-size: 40px;
       line-height: 48px;
       /* letter-spacing: -3.5px; */
       color: #FFFFFF;
       ">
                            <div class="row badge badge-primary mb-2" style="font-size: 20px;">
                                {{ $data->announcement_type }}</div>

                            <div class="text-center">
                                <strong style="font-size: 55px;">{{ $data->title }}</strong>
                            </div>

                            <div class="text-center mt-5">
                                <p style="font-size: 35px;">{{ $data->message }}</p>
                            </div>

                        </div>

                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row" style="margin-top: 60px">
                            <div class="col-sm-6 col-md-6 col-lg-6">

                                {{-- <img alt="no image" src="@if (count($data->images) > 0) {{ asset($data->images[0]['image_path']) }} @endif" width="300px" height="300px"
                                    style="padding:1rem;" /> --}}
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6">

                                {{-- <img alt="no image" src="@if (count($data->images) > 1) {{ asset($data->images[1]['image_path']) }} @endif" width="300px" height="300px"
                                    style="padding:1rem;" /> --}}
                            </div>
                        </div>
                    </td>
                </tr>

            </table><br>

            <p><a target="_blank" href="@if (count($data->images) > 0) {{ asset($data->images[0]['image_path']) }} @else # @endif">Fail 1</a></p>
            <p><a target="_blank" href="@if (count($data->images) > 1) {{ asset($data->images[1]['image_path']) }} @else # @endif">Fail 2</a></p>


            <!-- CTA Button -->
            <div mc:edit="section_button" style="
    margin-bottom: 40px;
    ">



                <!-- Terms -->
                <p mc:edit="terms" mc:repeatable style="
     font-family: Merriweather, Georgia, Serif;
     font-size: 16px;
     line-height: 16px;
     letter-spacing: -0.1px;
     color: #b37128;
     font-style: italic;
     ">
                    Tarikh hebahan: {{ $data->announcement_date }}
                </p>

            </div>

        </td>

    </tr>

</table>
