<style>
    body {
  background: url('https://images.unsplash.com/photo-1420496368970-d83b063b5b48?fit=crop&fm=jpg&h=700&q=80&w=1225') no-repeat center center;
  background-size: 1400px 700px;
  background-position: 30%;
  background-attachment: fixed;
}


.text {
  font-family: raleway;
  font-size: 40px;
  position: absolute center;
  text-align: center;
  padding-left: 0%;
  color: #000;
  margin-top: 43px;
}

.text1 {
  font-family: raleway;
  font-size: 21px;
  text-align: center;
  margin-top: -20px;
  color: #000;
}

.image {
  text-align: center;
  width: 200px;
  /* Container's dimensions */

  height: 200px;
  -webkit-border-radius: 75%;
  -moz-border-radius: 75%;
  box-shadow: 0 0 0 1px #eee;
  background: url("https://images.unsplash.com/reserve/ysPfhVSzSP2m629CW0mw_selfPortrait.jpg?fit=crop&fm=jpg&h=700&q=80&w=1225") center center no-repeat;
  background-size: cover;
  margin: auto;
  margin-top: 20px;
  margin-bottom: -30px;
  align-content: center;
}



.trick {
  display: inline-block;
  vertical-align: middle;
  height: 150px;
}

.image:hover {
  box-shadow: 0px 5px 20px .9px #3F3F3F;
}

.image:hover {
  -webkit-transform: scale(1.12);
  transform: scale(1.12);
  -webkit-transition: 1.6s ease-in-out;
  transition: 1.6s ease-in-out;
}



.trick:hover img {
  -webkit-transform: scale(1);
  transform: scale(1);
}

#overlay {
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  padding: 0 0 0 0;
  opacity: 1.0;
  -webkit-transition: opacity 2.25s ease;
  -moz-transition: opacity 10.25s ease;
}

#box:hover #overlay {
  opacity: 1;
}





.panel-group{
  width:350px;
  margin:auto;
  /*margin:50px 400px 50px 400px;*/
  max-width:100%;
}

.panel-heading{
  background-color:transparent !important;
}

.title{
  text-align: center;
  background-color:transparent;
  color:#000;
  font-family:lato;
  font-weight:300;
  font-size:15px;
  max-width:100%;
}




#accordion{
  background-color: transparent;
  max-width:100%;
  margin-bottom:200px;
}







.btn-outline {
  color: inherit;
  transition: all 1.4s;
  background-color: transparent;
}
/* button CSS */

.btn-danger.btn-outline {
  margin-top: 9px;
  background-color: transparent;
  color: #000;
  border-color: #000;
  padding:auto;
  padding:10px 0px 10px 0px;
  margin: 1px 5px 1px 0px;
  width: 100%;
  text-align:center;
  font-family: raleway;
  font-weight: 300;
  max-width:100%;
}


















/*---------    Contact Form    ------------*/

input::-webkit-input-placeholder,
textarea::-webkit-input-placeholder {
  color: #000;
  font-size: 15px;
}
/* on hover placeholder */

input:hover::-webkit-input-placeholder,
textarea:hover::-webkit-input-placeholder {
  color: #fff;
  font-size: 15px;
  font-family: raleway;
}

input:hover:focus::-webkit-input-placeholder,
textarea:hover:focus::-webkit-input-placeholder {
  color: #fff;
  font-family: raleway;
}

input:hover::-moz-placeholder,
textarea:hover::-moz-placeholder {
  color: #fff;
  font-size: 15px;
  font-family: raleway;
}

input:hover:focus::-moz-placeholder,
textarea:hover:focus::-moz-placeholder {
  color: #fff;
  font-family: raleway;
}

input:hover::placeholder,
textarea:hover::placeholder {
  color: #fff;
  font-size: 15px;
  font-family: raleway;
}

input:hover:focus::placeholder,
textarea:hover:focus::placeholder {
  color: #fff;
  font-family: raleway;
}

input:hover::placeholder,
textarea:hover::placeholder {
  color: #fff;
  font-size: 15px;
  font-family: raleway;
}

input:hover:focus::-ms-placeholder,
textarea:hover::focus:-ms-placeholder {
  color: #fff;
  font-family: raleway;
}

#form {
  position: relative;
  width: 100%;
  margin: 0px auto 0px auto;
  font-family: raleway;
}

input {
  font-family: raleway;
  font-size: 15px;
  width: 100%;
  height: 50px;
  padding: 0px 12px 0px 12px;
  background: transparent;
  outline: none;
  color: #726659;
  border: solid 1px #eee;
  border-bottom: none;
  transition: all 0.9s ease-in-out;
  -webkit-transition: all 0.9s ease-in-out;
  -moz-transition: all 0.9s ease-in-out;
  -ms-transition: all 0.9s ease-in-out;
}

input:hover {
  background: #ccc;
  color: #fff;
  font-family: raleway;
}

textarea {
  width: 100%;
  max-width: 100%;
  height: 110px;
  max-height: 110px;
  padding: 15px;
  background: transparent;
  outline: none;
  color: #000;
  font-family: raleway;
  font-size: 25px;
  border: solid 1px #eee;
  transition: all 0.9s ease-in-out;
  -webkit-transition: all 0.9s ease-in-out;
  -moz-transition: all 0.9s ease-in-out;
  -ms-transition: all 0.9s ease-in-out;
}

textarea:hover {
  background: #ccc;
  color: #fff;
  font-family: raleway;
}

#submit {
  width: 100%;
  padding: 0;
  font-family: raleway;
  font-size: 20px;
  color: #000;
  outline: none;
  cursor: pointer;
  border: solid 1px #eee;
  border-top: none;
  margin-bottom: 0px;
}

#submit:hover {
  color: #fff;
  background-color: #ccc;
}
</style>

  <div class="box">
    <div id="overlay">
      <div class="image">
        <div class="trick">

        </div>
      </div>
      <ul class="text">Walter Wright</ul>
      <div class="text1">HTML + CSS</div>




<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading " role="tab" id="headingOne">
      <h4 class="panel-title ">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="" aria-controls="collapseOne">
          <div class="title  btn btn-danger btn-outline btn-lg">Alamat Rumah</div>
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        {{ $house->address1 }}, {{$house->address2}}, {{$house->poskod}}, {{$house->daerah}}, {{$house->negeri}}
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          <div class="title btn btn-danger btn-outline btn-lg">SOCIAL</div>
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
        Walter has been building websites for years. He enjoys making unique websites and web projects. His hobbies include photography, woodworking, leatherworking, fishing, and mid century modern furniture.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          <div class="title btn btn-danger btn-outline btn-lg">CONTACT</div>
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">



                  <form id="form" class="topBefore">

            <input id="name" type="text" placeholder="NAME">
            <input id="email" type="text" placeholder="E-MAIL">
            <textarea id="message" type="text" placeholder="MESSAGE"></textarea>
            <input id="submit" type="submit" value="Submit Now!">

          </form>
      </div>
    </div>
  </div>
</div>
</div>
</div>


