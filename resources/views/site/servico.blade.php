@extends('layout.layout')

@section('title', 'Serviço - Le Flower')

@section('conteudo')


  <!-- Bootstrap core CSS -->
  <link href="{{ asset('cards/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

  {{-- CSS DOS PARCEIROS --}}
    {{-- TESTE PARA OS ICONES --}}
    <!-- For favicon png -->
    <link rel="shortcut icon" type="image/icon" href="{{ asset('assets/logo/favicon.png') }}">

    <!--font-awesome.min.css-->
    <link rel="stylesheet" href="{{ asset('icon/css/font-awesome.min.css') }}">

    <!--flat icon css-->
    <link rel="stylesheet" href="{{ asset('icon/css/flaticon.css') }}">

    <!--animate.css-->
    <link rel="stylesheet" href="{{ asset('icon/css/animate.css') }}">

    <!--owl.carousel.css-->
    <link rel="stylesheet" href="{{ asset('icon/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('icon/css/owl.theme.default.min.css') }}">

    <!--bootstrap.min.css-->
    <link rel="stylesheet" href="{{ asset('icon/css/bootstrap.min.css') }}">

    <!-- bootsnav -->
    <link rel="stylesheet" href="{{ asset('icon/css/bootsnav.css') }}">

    <!--style.css-->
    <link rel="stylesheet" href="{{ asset('icon/css/style.css') }}">

    <!--responsive.css-->
    <link rel="stylesheet" href="{{ asset('icon/css/responsive.css') }}">

    {{-- CSS do titulo da sessão de perguntas --}}
    <link rel="stylesheet" href="{{ asset('icon/css/quest.css') }}">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" />

    {{-- ESTILO CARDS --}}
  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('cards/css/templatemo-chain-app-dev.css') }}">
  <link rel="stylesheet" href="{{ asset('cards/css/animated.css')  }}">
  <link rel="stylesheet" href="{{ asset('cards/css/owl.css') }}">



  <style>
    @media (min-width: 1200px) {
    .container {
        width: 1300px!important;
    }
  </style>
    <style>
        .h3-gaby {
            /* font-family: var(--minha-font2); */
            font-weight: bold;
            font-size: 30px;
            letter-spacing: 1px;
        }

        .p-gaby {
            font-size: 20px;
            font-family: var(--minha-font2);
            text-align: justify
        }
    </style>

    <style>
        /* FLOR PULSAR */
        .pulse {
            margin: 10px;
            width: 60px;
            height: 22px;
            border-radius: 50%;
            box-shadow: 0 0 0 rgba(204, 169, 44, 0.4);
            animation: pulse 2s infinite;
        }

        .pulse:hover {
            animation: none;
        }

        @-webkit-keyframes pulse {
            0% {
                -webkit-box-shadow: 0 0 0 0 rgba(204, 169, 44, 0.4);
            }

            70% {
                -webkit-box-shadow: 0 0 0 10px rgba(204, 169, 44, 0);
            }

            100% {
                -webkit-box-shadow: 0 0 0 0 rgba(204, 169, 44, 0);
            }
        }

        @keyframes pulse {
            0% {
                -moz-box-shadow: 0 0 0 0 rgba(204, 169, 44, 0.4);
                box-shadow: 0 0 0 0 rgba(204, 169, 44, 0.4);
            }

            70% {
                -moz-box-shadow: 0 0 0 10px rgba(204, 169, 44, 0);
                box-shadow: 0 0 0 10px rgba(204, 169, 44, 0);
            }

            100% {
                -moz-box-shadow: 0 0 0 0 rgba(204, 169, 44, 0);
                box-shadow: 0 0 0 0 rgba(204, 169, 44, 0);
            }
        }
    </style>

<style>
    .service-section {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;
    }

    .service {
      background-color: transparent;
      margin: 10px;
      padding: 0% 5% 1% 5%;
      width: calc(25% - 40px);
      box-sizing: border-box;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
    }


    .service img {
      width: 100%;
      height: auto;
    }

    .service h2 {
      font-size: 20px;
      margin: 10px 0;
    }

    .service p {
      margin: 10px 0;
      color: #202020;
    }

    .price {
      font-weight: bold;
    }

    .descricoes{
        display: block;
    }

    .service{
        width: 500px;
        display: block;
    }

    .service h4{
        color: #202020;
    }

    .service-description{
        color: #202020;
        text-align: start;
    }

    .test-bg {
        background-position: center;
        background: linear-gradient( 180deg, rgba(89, 132, 142, 0.23), rgba(89, 132, 142, 0.23) ), url({{ asset('assets/AdobeStock_587067399.jpeg') }});

    }

    .servico{
        padding: 0% 13% 0% 13%;
    }

    .card-header{
        padding-left: 6.5%;
    }

    .card-header h3{
        font-size: 28pt;
    }

    .about-thumb-2{
        top: 12%;
    }

    .justify-content-between h4{
        font-weight: 400;
    }

    .card-menu2{
        margin-left:15%;
    }

    .buttonAgendar1{
        margin-right:70%;
    }

    .buttonAgendar2{
        margin-left:63.5%;
    }

    .buttonAgendar3{
        margin-right:70%;
    }
    @media (max-width: 700px) {
      .about-thumb-2 img{
        /* display: none; */
      }

      .about-thumb-num{
        /* display: none; */
      }

      .servico{
        padding: 0% 0% 0% 0%;
      }

      .service p{
        font-size: 8pt
      }

      .service{
        width: 100%;
      }

      .card-menu2{
        margin-left:0%;
      }

     .buttonAgendar1{
        margin-right:0%;
     }

     .buttonAgendar2{
        margin-left:0%;
    }

    .buttonAgendar3{
        margin-right:0%;
    }

    .card-header h3{
        font-size: 20pt;
        text-align: center;
    }


    }

    @media (min-width: 701px) and (max-width:1024px){

    .about-thumb-2 img{
        /* display: none; */
      }

      .about-thumb-num{
        /* display: none; */
      }

      .servico{
        padding: 0% 0% 0% 0%;
      }

      .service p{
        font-size: 17pt
      }

      .service{
        width: 700px;
      }

      .card-menu2{
        margin-left:0%;
      }

     .buttonAgendar1{
        margin-right:0%;
        margin-left: 3.5%;
     }

     .buttonAgendar2{
        margin-left:0%;
        margin-left: 3%;

    }

    .buttonAgendar3{
        margin-right:0%;
        margin-left: 3.5%;

    }

    .container1{
        /* display: none; */
    }
    .container2{
        /* display: none; */
    }
    .container3{
        /* display: none; */
    }
    .col-md-6 {
        width: 100%;
    }

    .card-header h3{
        text-align: center;
    }
    }

    .selecao{
        height: 600px;
        display: flex;
        justify-content: space-around;
        padding: 0% 15%;
    }
    .list-group{
        justify-content: space-between;
        height: 100%;
        text-align: center;
        font-weight: bold;
    }
    .list-group-item{
        width: 400px;
        border-radius: 20px;
    }

    .about-thumb-num {
        position: absolute;
        left: 40px;
        bottom: 0;
        font-size: 17pt;
        font-weight: 700;
        font-family: var(--title-font);
        color: transparent;
        -webkit-text-stroke: 1px var(--white-color);
        line-height: initial;
    }

    </style>

{{-- Cards --}}
<div id="services" class="services section" data-aos="fade-down" style="margin-bottom: 50px"
data-aos-easing="linear"
data-aos-duration="500">
    <div class="container">
      <div class="row" style=" gap: 20px 0;">
        <div class="col-lg-3">
          <div class="service-item first-service">
            <div class="iconn"></div>
            <h4>Cabelo</h4>
            <p>Nossos cortes, cores e tratamentos expressam sua singularidade. Conte a história da sua beleza através dos fios.</p>
            <div class="text-button">
              <a href="/servico/cabelo" style="color: #59848e">Saiba mais <i class="fa fa-arrow-right" style="color: #59848e"></i></a>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="service-item second-service">
            <div class="iconn"></div>
            <h4>Depilação</h4>
            <p>Experimente a suavidade sem pelos indesejados. Nossos tratamentos oferecem conforto, deixando sua pele radiante.</p>
            <div class="text-button">
              <a href="/servico/depilacao" style="color: #59848e">Saiba mais <i class="fa fa-arrow-right" style="color: #59848e"></i></a>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="service-item third-service">
            <div class="iconn icon-gaby" ></div>
            <h4>Maquiagem</h4>
            <p>Transformamos sua aparência com maquiagem personalizada. Descubra a magia dos pincéis e realce sua beleza única.</p>
            <div class="text-button">
              <a href="/servico/maquiagem" style="color: #59848e">Saiba mais <i class="fa fa-arrow-right" style="color: #59848e"></i></a>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="service-item fourth-service">
            <div class="iconn"></div>
            <h4>Unhas</h4>
            <p>Transformamos unhas em verdadeiras obras de arte. Dos tons clássicos aos designs ousados, eleve sua autoestima..</p>
            <div class="text-button">
              <a href="/servico/unhas" style="color: #59848e">Saiba mais <i class="fa fa-arrow-right" style="color: #59848e"></i></a>
            </div>
          </div>
        </div>

        <div class="col-lg-3">
            <div class="service-item five-service">
              <div class="iconn"></div>
              <h4>Rosto</h4>
              <p>Desfrute de tratamentos faciais que renovam e realçam sua beleza única. No nosso espaço, cada sessão é uma experiência personalizada para revitalizar a vitalidade da sua pele.</p>
              <div class="text-button">
                <a href="/servico/rosto" style="color: #59848e">Saiba mais <i class="fa fa-arrow-right" style="color: #59848e"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="service-item six-service">
              <div class="iconn"></div>
              <h4>Massagem</h4>
              <p>Embarque numa jornada de relaxamento profundo com nossas massagens terapêuticas. Nossa equipe dedicada oferece momentos de tranquilidade para revitalizar corpo e mente.</p>
              <div class="text-button">
                <a href="/servico/massagem" style="color: #59848e">Saiba mais <i class="fa fa-arrow-right" style="color: #59848e"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="service-item seven-service">
              <div class="iconn"></div>
              <h4>Barba</h4>
              <p>Descubra o luxo de uma barba impecavelmente aparada. Nossos barbeiros especializados oferecem cortes precisos e tratamentos relaxantes, garantindo uma barba que reflete sua elegância.</p>
              <div class="text-button">
                <a href="/servico/barba" style="color: #59848e">Saiba mais <i class="fa fa-arrow-right" style="color: #59848e"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="service-item seven-service">
              <div class="iconn"></div>
              <h4>Sombrancelhas</h4>
              <p>Destaque seus olhos com sobrancelhas perfeitamente esculpidas. Nossos especialistas criam um arco que complementa sua expressão, proporcionando definição e poder ao seu olhar.</p>
              <div class="text-button">
                <a href="/servico/sombrancelhas" style="color: #59848e">Saiba mais <i class="fa fa-arrow-right" style="color: #59848e"></i></a>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>

<!--profiles start -->
<section id="profiles" class="profiles"  style="background-color: #fff; " >
    {{--data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500"
         --}}
    <div class="profiles-details">
        <div class="section-heading text-center">
            <h2>PARCEIROS</h2>
        </div>
        <div class="container">
            <div class="profiles-content" style="width: 100%">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="single-profile">
                            <div class="profile-txt">
                                <img src="../assets/img-gaby/loreal.svg" alt="">

                                <div class="profile-icon-name">Paris</div>
                            </div>
                            <div class="single-profile-overlay">
                                <div class="profile-txt">
                                    <img src="../assets/img-gaby/loreal.svg" alt="">
                                    <div class="profile-icon-name">Paris</div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="col-sm-3">
                        <div class="single-profile">
                            <div class="profile-txt">
                                <img src="../assets/img-gaby/layer1.svg" alt="">
                                {{-- <a href=""><i class="flaticon-dribbble"></i></a> --}}
                                <div class="profile-icon-name">Creme</div>
                            </div>
                            <div class="single-profile-overlay">
                                <div class="profile-txt">
                                    <img src="../assets/img-gaby/layer1.svg" alt="">
                                    {{-- <a href=""><i class="flaticon-dribbble"></i></a> --}}
                                    <div class="profile-icon-name">Creme</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="single-profile">
                            <div class="profile-txt">
                                <img src="../assets/img-gaby/sep.svg" alt="">
                                {{-- <a href=""><i class="flaticon-behance-logo"></i></a> --}}
                                <div class="profile-icon-name">Beauty</div>
                            </div>
                            <div class="single-profile-overlay">
                                <div class="profile-txt">
                                    <img src="../assets/img-gaby/sep.svg" alt="">
                                    {{-- <a href=""><i class="flaticon-behance-logo"></i></a> --}}
                                    <div class="profile-icon-name">Beauty</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="single-profile profile-no-border">
                            <div class="profile-txt">
                                <img src="../assets/img-gaby/labriza.svg" alt="">
                                {{-- <a href=""><i class="flaticon-github-logo"></i></a> --}}
                                <div class="profile-icon-name">Comestics</div>
                            </div>
                            <div class="single-profile-overlay">
                                <div class="profile-txt">
                                    <img src="../assets/img-gaby/labriza.svg" alt="">
                                    {{-- <a href=""><i class="flaticon-github-logo"></i></a> --}}
                                    <div class="profile-icon-name">Comestics</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile-border"></div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="single-profile">
                            <div class="profile-txt">
                                <img src="../assets/img-gaby/group.svg" alt="">
                                {{-- <a href=""><i class="flaticon-flickr-website-logo-silhouette"></i></a> --}}
                                <div class="profile-icon-name">Group</div>
                            </div>
                            <div class="single-profile-overlay">
                                <div class="profile-txt">
                                    <img src="../assets/img-gaby/group.svg" alt="">
                                    {{-- <a href=""><i class="flaticon-flickr-website-logo-silhouette"></i></a> --}}
                                    <div class="profile-icon-name">Group</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="single-profile">
                            <div class="profile-txt">
                                <img src="../assets/img-gaby/risque.svg" alt="">
                                {{-- <a href=""><i class="flaticon-smug"></i></a> --}}
                                <div class="profile-icon-name">Tá nas suas mãos</div>
                            </div>
                            <div class="single-profile-overlay">
                                <div class="profile-txt">
                                    <img src="../assets/img-gaby/risque.svg" alt="">
                                    {{-- <a href=""><i class="flaticon-smug"></i></a> --}}
                                    <div class="profile-icon-name">Tá nas suas mãos</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="single-profile">
                            <div class="profile-txt">
                                <img src="../assets/img-gaby/barba.svg" alt="">
                                {{-- <a href=""><i class="flaticon-squarespace-logo"></i></a> --}}
                                <div class="profile-icon-name">Men's beard care products</div>
                            </div>
                            <div class="single-profile-overlay">
                                <div class="profile-txt">
                                    <img src="../assets/img-gaby/barba.svg" alt="">
                                    {{-- <a href=""><i class="flaticon-squarespace-logo"></i></a> --}}
                                    <div class="profile-icon-name">Men's beard care products</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="single-profile profile-no-border">
                            <div class="profile-txt">
                                <img src="../assets/img-gaby/tangle.svg" alt="">

                                {{-- <a href=""><i class="flaticon-bitbucket-logotype-camera-lens-in-perspective"></i></a> --}}
                                <div class="profile-icon-name">Você só precisa da escova certa</div>
                            </div>
                            <div class="single-profile-overlay">
                                <div class="profile-txt">
                                    <img src="../assets/img-gaby/tangle.svg" alt="">
                                    {{-- <a href=""><i class="flaticon-bitbucket-logotype-camera-lens-in-perspective"></i></a> --}}
                                    <div class="profile-icon-name">Você só precisa da escova certa…</div>
                                </div>
                                </>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>

    {{-- Teste fonts --}}
    <!--modernizr.min.js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>

    <!--bootstrap.min.js-->
    <script src="{{ asset('icon/js/bootstrap.min.js') }}"></script>

    <!-- bootsnav js -->
    <script src="{{ asset('icon/js/bootsnav.js') }}"></script>

    <!-- jquery.sticky.js -->
    <script src="{{ asset('icon/js/jquery.sticky.js') }}"></script>

    <!-- for progress bar start-->

    <!-- progressbar js -->
    <script src="{{ asset('icon/js/progressbar.js') }}"></script>
    <!-- appear js -->


    {{-- Começo scripts gaby --}}
    <!-- DEPENDENCIA jQuery 3.6.0 COontador JORNADA -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Verifica se o dispositivo é responsivo (por exemplo, largura da tela menor que 768 pixels)
        if (window.innerWidth <= 768) {
            // Remove a classe "aos-animate" que é usada pelo AOS para animações
            document.querySelectorAll('.accordion').forEach(function(element) {
                element.classList.remove('aos-animate');
            });
        }
    </script>

    <script>
        $(function() {
            $('.title').each(function() {
                var $this = $(this),
                    countTo = $this.attr('data-count');

                $({
                    countNum: $this.text()
                }).animate({
                    countNum: countTo
                }, {
                    duration: 8000,
                    easing: 'linear',
                    step: function() {
                        $this.text('+' + Math.floor(this.countNum) + ' unidades');
                    },
                    complete: function() {
                        $this.text('+' + this.countNum + ' unidades');
                        //alert('finished');
                    }
                });
            });
        });
    </script>


    @endsection
