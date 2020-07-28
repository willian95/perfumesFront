<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="{{ url('/assets/img/iso.png') }}" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!--  <link rel="icon" type="image/jpg" href="assets/img/logo-blanco.png" style="width: 30px; height: 30px;">-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;700;800&display=swap"
        rel="stylesheet">

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel='stylesheet'>
    <link href="{{ asset('assets/css/slick.css') }}" rel='stylesheet'>
    <link href="{{ asset('assets/css/slick-theme.css') }}" rel='stylesheet'>
    <link href="{{ asset('assets/css/font-awesome.css') }}" rel='stylesheet'>
    <link href="{{ asset('assets/css/animate.css') }}" rel='stylesheet'>
    <link href="{{ asset('assets/css/main.css') }}" rel='stylesheet'>
    <link href="{{ asset('assets/css/login.css') }}" rel='stylesheet'>
    <link href="{{ asset('assets/css/responsive.css') }}" rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css') }}">
    <title>Aromantica</title>
</head>

<body>

    <!---   <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>--->
    @if(strpos(url()->current() ,url('/checkout/response')) < -1) <nav @if(url()->current() == url('/front-test'))
        class='navbar navbar-expand-md navbar-fixed-js container-fluid m-0 p-0 '
        @else class='navbar navbar-expand-md navbar-fixed-js pepe container-fluid' @endif id="navbarSupportedContent">
        <div class='container-fluid nav-grid'>
            <a class='navbar-brand d-flex align-items-center' href="{{ url('/') }}">
                <img alt='' src="{{ asset('assets/img/logo.png') }}">

            </a>

            <div class="search">
                <div id="search">
                    <form>
                        <input v-model="searchText" class="form-control" type="text" placeholder="Buscar..."
                            autocomplete="off" @keyup="search()">
                    </form>

                    <div class="list_search">
                        <!--por nomnbre-->
                        <ul class="name_list">

                            <li v-for="producttitle in productTitles">
                                <a href="#" @click="setText(producttitle.name)">
                                    <p>
                                        <img style="width: 90px;"
                                            :src="'{{ env('CMS_URL') }}'+'/images/brands/'+producttitle.brand.image">
                                    </p>
                                    @{{ producttitle.name }}
                                    <p>
                                        <img style="width: 90px;"
                                            :src="'{{ env('CMS_URL') }}'+'/images/products/'+producttitle.image">
                                    </p>
                                </a>
                            </li>

                            <li v-for="brandtitle in brandTitles"><a href="#"
                                    @click="setText(brandtitle.name)">@{{ brandtitle.name }}
                                    <p>
                                        <img style="width: 90px;"
                                            :src="'{{ env('CMS_URL') }}'+'/images/brands/'+brandtitle.image">
                                    </p>
                                </a>
                            </li>

                        </ul>

                        <!--presentaciones-->
                        <div class="bg-search">
                            <span>Presentaciones</span>
                            <ul class="name_list name_list2">

                                @foreach(App\Type::all() as $type)

                                <li @click="selectType('{{ $type }}')">
                                    {{ $type->name }}
                                    <label class="control control--radio">
                                        <input type="radio" name="type" />
                                        <div class="control__indicator"></div>
                                    </label>
                                </li>

                                @endforeach

                            </ul>



                            <!--caracteristicas--->
                            <div class="bg-search">
                                <span>Tamaños</span>
                                <ul class="name_list name_list2">

                                    @foreach(App\Size::all() as $size)

                                    <li @click="selectSize('{{ $size }}')">
                                        {{ $size->name }}oz / {{ $size->ml }}ml
                                        <label class="control control--radio">
                                            <input type="radio" name="size" />
                                            <div class="control__indicator"></div>
                                        </label>
                                    </li>

                                    @endforeach

                                </ul>

                            </div>

                            <div class="text-center">
                                <a href="#" type="button" class="btn-custom btn-custom-1" @click="lookFor()">Buscar</a>
                            </div>
                        </div>
                        <!--caracteristicas-->

                    </div>
                </div>
            </div>

            <button class='navbar-toggler p-2 border-0 hamburger hamburger--elastic d-none-lg' data-toggle='offcanvas'
                type='button'>
                <span class='hamburger-box'>
                    <span class='hamburger-inner'></span>
                </span>
            </button>
            <div class='offcanvas-collapse fil ml-auto' id='navbarNav'>
                <ul class='navbar-nav'>
                    <!-- <li class='nav-item active'>
                        <a class='nav-link active nav-link-black ' href='{{ url('/front-test') }}'>Inicio</a>
                    </li> -->
                    <li class='nav-item'>
                        <a class='nav-link nav-link-black ' href='{{ url('/tienda') }}'>Tienda</a>
                    </li>
                    @foreach(App\Category::all() as $category)

                    <li class='nav-item dropdown dowms down-md'>
                        <a href="{{ url('/category/'.$category->slug) }}" aria-expanded='false' aria-haspopup='true'
                            class='nav-link dropdown-toggle nav-link ' data-toggle='dropdown'>
                            {{ $category->name }}
                        </a>

                    </li>

                    @endforeach

                    <!--menu tablet--->
                    <li class='nav-item dropdown down-md-v'>
                        <a href='#' aria-expanded='false' aria-haspopup='true' class='nav-link dropdown-toggle  '
                            data-toggle='dropdown'>
                            Categorias
                        </a>
                        <div aria-labelledby='dropdownMenuButton' class='dropdown-menu'>
                            <div class='content-drop'>
                                <a class='dropdown-item' href='#'>
                                    <p> Damas</p>
                                </a>
                                <a class='dropdown-item' href='#'>
                                    <p> Caballeros</p>
                                </a>
                                <a class='dropdown-item' href='#'>
                                    <p> Ninos</p>
                                </a>
                            </div>
                        </div>

                    </li>

                    <!--menu tablet--->
                    @if(\Auth::guest())
                    <li class="nav-item">
                        <a id="openRegisterModal" style="border: 1px solid white;
                          border-radius: 10px;" class="nav-link p-0 " href="#" data-toggle="modal"
                            data-target="#registerModal">Registrate</a>
                    </li>


                    <!--- <li class="nav-item">
                          <a class="nav-link" href="#" data-toggle="modal" data-target="#loginModal">Login</a>
                      </li>--->
                    @else



                    @endif

                    <!--- <li class="nav-item position-relative mr-3">
                        <span class="add_btn" id="cart-notification"></span>
                        <a class="nav-link" href="{{ url('/cart/index') }}"><i class="flaticon-shopping-cart"></i></a>
                    </li>--->


                    <div class="dropdown" id="cartPreview">
                        <button class="btn btn-default dropdown-toggle d-flex p-0 " type="button" data-toggle="dropdown"
                            data-hover="dropdown">
                            <span class="add_btn" id="cart-notification"></span>
                            <a class="nav-link" href="{{ url('/cart/index') }}"><i
                                    class="flaticon-shopping-cart"></i></a>
                        </button>
                        <ul class="dropdown-menu carrito-nav">

                            <li v-for="product in products">
                                <div>
                                    <img :src="'{{ env('CMS_URL') }}'+'/images/products/'+product.product_type_size.product.image" alt="">
                                </div>

                                <div>
                                    <p>@{{ product.product_type_size.product.name }}</p>
                                    <p>@{{ product.amount }} x $@{{ parseInt(product.product_type_size.price).toString().replace(/\B(?=(\d{3})+\b)/g, ".") }}</p>
                                </div>
                            </li>
                            <li v-for="product in guestProducts">
                                <div>
                                <img :src="'{{ env('CMS_URL') }}'+'/images/products/'+product.product.product.image" alt="">
                                </div>

                                <div>
                                    <p>@{{ product.product.product.name }}</p>
                                    <p>@{{ product.amount }} x $@{{ parseInt(product.product.price).toString().replace(/\B(?=(\d{3})+\b)/g, ".") }}</p>
                                </div>
                            </li>
                            <div class="sub">
                                <span>Subtotal: $@{{ parseInt(total).toString().replace(/\B(?=(\d{3})+\b)/g, ".") }}</span>
                                <ul>
                                    <li><a class="btn-custom sub-h" href="{{ url('/cart/index') }}">Ver carrito</a></li>
                                    <li><a class="btn-custom sub-h btn-w" href="{{ url('/checkout') }}">Finalizar compra</a></li>
                                </ul>
                            </div>
                        </ul>


                    </div>


                    @if(\Auth::guest())

                    <li class="nav-item">
                        <a id="openLoginModal" class="nav-link p-0 mr-5" href="#" data-toggle="modal"
                            data-target="#loginModal"><i class="flaticon-user"></i></a>
                    </li>
                    @else <li class='nav-item dropdown dowms succss'>
                        <a href='#' aria-expanded='false' aria-haspopup='true'
                            class='nav-link dropdown-toggle border-blue ' data-toggle='dropdown'>
                            <i class="flaticon-user"></i>
                            {{ \Auth::user()->name }}
                        </a>

                        <div aria-labelledby='dropdownMenuButton' class='dropdown-menu'>
                            <div class='content-drop'>
                                <a class='dropdown-item nav-link-black' href='#'>
                                    <a class="nav-link nav-link-black" href="{{ url('/profile') }}">Perfil</a>
                                    <a class="nav-link nav-link-black" href="{{ url('/shopping/index') }}">Compras</a>

                                    <a class="nav-link nav-link-black" href="{{ url('/logout') }}">Cerrar sesión</a>
                                </a>
                            </div>
                        </div>
                    </li>

                    <!-- <li class="nav-item">
                      <a class="nav-link" href="#">{{ \Auth::user()->name }}</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ url('/shopping/index') }}">Compras</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ url('/logout') }}">Cerrar sesión</a>
                  </li>--->

                    @endif

                    <!-- <li class='nav-item'>
                        <a class='nav-link' data-toggle="modal" data-target="#login"><i class="flaticon-user"></i></a>
                      </li>-->
                </ul>
            </div>
        </div>
        </nav>
        @endif

        </nav>

        @yield("content")


        <!-- Modal -->
        <div id="authModal">
            <div class="modal fade" id="registerModal" id="registro" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg modal_w">
                    <div class="modal-content login">
                        <div class="modal-body">
                            <button id="registerModalClose" type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                            <div class="main-login main-registro">
                                <div class="main-login__item">
                                    <div class="card">
                                        <div class="title__general title__general2 fadeInUp wow animated">
                                            <p class="m-0 ml-3">Registro</p>
                                        </div>
                                        <div class="card-body">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name">Nombre y apellido</label>
                                                        <input type="text" class="form-control" v-model="name" id="name"
                                                            placeholder="Pedro perez" autocomplete="off">
                                                        <i class="fa fa-user icon_form"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email">Correo electrónico</label>
                                                        <input type="text" class="form-control" v-model="email"
                                                            id="email" placeholder="pedroperez@gmail.com"
                                                            autocomplete="off">
                                                        <i class="fa fa-envelope icon_form"></i>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <label for="identification">Cédula</label>

                                                        <input type="text" class="form-control" v-model="identification"
                                                            id="identification" @keypress="isNumber($event)"
                                                            style="padding-left: 35px;">
                                                        <i class="fa fa-id-card icon_form"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <label for="phone">Teléfono</label>
                                                        <input type="text" class="form-control" v-model="phone"
                                                            id="phone" @keypress="isNumber($event)">
                                                        <i class="fa fa-phone icon_form"></i>
                                                    </div>

                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="address">Dirección</label>
                                                        <textarea class="form-control" rows="1"
                                                            v-model="address"></textarea>
                                                        <i class="fa fa-globe icon_form"></i>
                                                    </div>

                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="password">Contraseña</label>

                                                        <input placeholder="Contraseña" type="password"
                                                            class="form-control  " id="password" v-model="password">
                                                        <i class="fa fa-lock icon_form"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <label for="password_confirmation">Confirmar Contraseña</label>
                                                        <input type="password" class="form-control"
                                                            v-model="password_confirmation" placeholder="Contraseña">

                                                        <i class="fa fa-lock icon_form"></i>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class=" form-group mt-4 text-center">
                                                <button class="btn btn-primary btn-custom "
                                                    @click="register()">Registrarse
                                                </button>

                                            </div>

                                            <div class="text-center">
                                                <p class="inicia">ó registrate facil </p>
                                                <a class="btn-login btn-login2 mr-2"
                                                    href="{{ url('/facebook/redirect') }}">
                                                    <i class="fa fa-facebook"></i> Facebook</a>
                                                <a class="btn-login goo" href="{{ url('/google/redirect') }}"> <i
                                                        class="fa fa-google"></i> Google</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" main-login__item bg-login">


                                    <div class="text-center">
                                        <p>¿Ya tienes cuenta?</p>
                                        <a class="txt facil" href="#" @click="openLoginModal()">Inicia sesión</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>



            <!-- modal login -->
            <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content login">
                        <div class="modal-body">
                            <button id="loginModalClose" type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                            <div class="main-login">
                                <div class="main-login__item">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="title__general title__general2 fadeInUp wow animated">
                                                <p class="m-0">Inicio de sesión</p>
                                            </div>

                                            <div class="form-group">
                                                <label for="emailLogin">Correo electrónico</label>
                                                <input type="text" class="form-control" v-model="emailLogin"
                                                    id="emailLogin" autocomplete="off"
                                                    placeholder="pedroperez@gmail.com">

                                                <i class="fa fa-envelope icon_form"></i>
                                            </div>
                                            <div class="form-group">
                                                <label for="passwordLogin">Contraseña</label>
                                                <input type="password" class="form-control" v-model="passwordLogin"
                                                    placeholder="Contraseña">

                                                <i class="fa fa-lock icon_form"></i>
                                            </div>
                                            <div class="form-group  text-lg-right">
                                                <a href="{{ url('/forgot-password') }}" class="texto">¿Haz olvidado tu
                                                    contraseña?</a>
                                            </div>
                                            <div class=" form-group mt-4 text-center">
                                                <button class="btn btn-primary btn-custom "
                                                    @click="login()">Ingresar</button>

                                            </div>
                                            <div class="text-center">
                                                <p class="inicia">ó inicia sesión con:</p>
                                                <a class="btn-login btn-login2 mr-2"
                                                    href="{{ url('/facebook/redirect') }}">
                                                    <i class="fa fa-facebook"></i> Facebook</a>
                                                <a class="btn-login goo" href="{{ url('/google/redirect') }}"> <i
                                                        class="fa fa-google"></i> Google</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" main-login__item bg-login">
                                    <!-- <div class="mb-5 text-center">
                                    <p>¡Registrate facíl!</p>

                                </div>-->

                                    <div class="text-center">
                                        <a class="txt facil" href="#" @click="openRegisterModal()">¡Registrate
                                            facíl!</a>
                                        <p class="mt-3">¿Aún no tienes cuenta?</p>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <footer class="container-fluid">
            <div class="main-footer">
                <div class="main-footer__item">
                    <a href="{{ url('/') }}">
                        <img class="logo_footer" src="{{ asset('assets/img/logo.png') }}" alt="">
                    </a>
                </div>
                <div class="main-footer__item">
                    <p class="ml-4 mb-2">Categorias</p>
                    <ul class='grid_footer'>
                        <li class='nav-item active'>
                            <a class='' href='#inicio'> Damas</a>
                        </li>
                        <li class='nav-item active'>
                            <a class='' href='#inicio'>Caballeros</a>
                        </li>
                        <li class='nav-item'>
                            <a class='' href='#tienda'>Niños</a>
                        </li>
                        <li class='nav-item'>
                            <a class='' href='#tienda'>Cremas</a>
                        </li>
                        <li class='nav-item' style='color: #000 !important'>
                            <a style='color: #000 !important' href="{{ url('/cart/index') }}">Carrito</a>
                        </li>
                    </ul>
                            </div>
                            <div class="main-footer__item">
                                <p class="ml-4 mb-2">Empresa</p>
                                <ul class='grid_foote'>
                                    <li class='nav-item active'>
                                        <a class='' href='#inicio'> Aviso legal</a>
                                    </li>
                                    <li class='nav-item active'>
                                        <a class='' href='#inicio'>Pago seguro</a>
                                    </li>
                                    <li class='nav-item'>
                                        <a class='terminos' data-toggle="modal" data-target="#terminos">Terminos y
                                            condiciones</a>
                                    </li>

                                </ul>
                            </div>
                        </div>

                        <div>
                            <p class="copy">2020 Copyright. <a class='terminos' data-toggle="modal"
                                    data-target="#terminos">Todos
                                    los
                                    derechos reservados</a>.</p>
                        </div>
                    </footer>

                    <!-- modal terminos-->
                    <div class="modal fade" id="terminos" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>

                                    <div class="content_modal">
                                        Terminos y condiciones FVI

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Optional JavaScript -->
                    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
                    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
                        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
                        crossorigin="anonymous">
                    </script>
                    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
                        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
                        crossorigin="anonymous">
                    </script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
                        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
                        crossorigin="anonymous">
                    </script>
                    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
                    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
                    <script src="{{ asset('assets/js/slick.min.js') }}"></script>
                    <script src="{{ asset('assets/js/setting-slick.js') }}"></script>
                    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
                    <script src="{{ asset('assets/js/wow-settings.js') }}"></script>
                    <script src="{{ asset('assets/js/main.js') }}"></script>
                    <script src="{{ asset('/js/app.js') }}"></script>
                    <script src="https://cdn.jsdelivr.net/jquery.mixitup/latest/jquery.mixitup.min.js?v=2.1.2"></script>

                    <script>

                    const cartPreview = new Vue({
                        el: "#cartPreview",
                        data(){
                            return{
                                authCheck: "{{ Auth::check() }}",
                                products:[],
                                guestProducts:[],
                                total:0
                            }
                        },
                        methods: {
                            cartFetch() {

                                axios.get("{{ url('/cart/fetch') }}")
                                .then(res => {

                                    if (res.data.success == true) {


                                        this.products = res.data.products

                                        this.products.forEach((data, index) => {

                                            this.total = this.total + (data.amount * data.product_type_size.price)

                                        })

                                    }

                                })

                            },
                            guestFetch() {

                                let cart = []
                                if (window.localStorage.getItem('cartAromantica') != null) {
                                    cart = JSON.parse(window.localStorage.getItem('cartAromantica'))
                                }

                                axios.post("{{ url('/cart/guest/fetch') }}", {
                                    cart: cart
                                }).then(res => {

                                    if (res.data.success == true) {
                                        this.guestProducts = res.data.guestProducts

                                        this.guestProducts.forEach((data, index) => {

                                            this.total = this.total + (parseFloat(data.product.price) * parseInt(
                                                data.amount))

                                        })

                                    } else {
                                        alert(res.data.msg)
                                    }

                                })

                            }
                        },
                        mounted(){

                            if (this.authCheck == "1") {
                                this.cartFetch()
                            }

                            this.guestFetch()

                            window.setInterval(() => {

                                if(window.localStorage.getItem("executeCartPreview") == "1"){
                                    if (this.authCheck == "1") {
                                        this.cartFetch()
                                    }

                                    this.guestFetch()

                                    window.localStorage.removeItem("executeCartPreview")
                                }

                            }, 1000)

                        }

                    })


                    const navbar = new Vue({
                        el: '#authModal',
                        data() {
                            return {
                                name: "",
                                email: "",
                                password: "",
                                password_confirmation: "",
                                phone: "",
                                identification: "",
                                address: "",
                                emailLogin: "",
                                passwordLogin: "",
                                products: [],
                                guesProducts: [],
                                authCheck: "{{ Auth::check() }}",
                                total: 0
                            }
                        },
                        methods: {

                            isNumber: function(evt) {
                                evt = (evt) ? evt : window.event;
                                var charCode = (evt.which) ? evt.which : evt.keyCode;
                                if ((charCode > 31 && (charCode < 48 || charCode > 57))) {
                                    evt.preventDefault();;
                                } else {
                                    return true;
                                }
                            },
                            register() {

                                axios.post("{{ url('/register') }}", {
                                        name: this.name,
                                        email: this.email,
                                        password: this.password,
                                        password_confirmation: this.password_confirmation,
                                        phone: this.phone,
                                        identification: this.identification,
                                        address: this.address
                                    }).then(res => {

                                        if (res.data.success == true) {
                                            alert(res.data.msg)
                                            this.name = ""
                                            this.email = ""
                                            this.password = ""
                                            this.password_confirmation = ""
                                            this.phone = ""
                                            this.identification = ""
                                            this.address = ""
                                        } else {
                                            alert(res.data.msg)
                                        }

                                    })
                                    .catch(err => {
                                        $.each(err.response.data.errors, function(key, value) {
                                            alert(value)
                                            //alertify.error(value);
                                            //alertify.alert('Basic: true').set('basic', true); 
                                        });
                                    })

                            },
                            openRegisterModal() {

                                $("#loginModalClose").click();
                                $('body').removeClass('modal-open');
                                $('body').css('padding-right', '0px');
                                $('.modal-backdrop').remove();

                                $("#openRegisterModal").click()

                            },
                            openLoginModal() {

                                $("#registerModalClose").click();
                                $('body').removeClass('modal-open');
                                $('body').css('padding-right', '0px');
                                $('.modal-backdrop').remove();

                                $("#openLoginModal").click()

                            },
                            login() {

                                axios.post("{{ url('/login') }}", {
                                        email: this.emailLogin,
                                        password: this.passwordLogin
                                    })
                                    .then(res => {

                                        if (res.data.success == true) {

                                            alert(res.data.msg)
                                            this.cartInfo()
                                            window.location.href = "{{ url('/') }}"

                                        } else {
                                            alert(res.data.msg)
                                        }
                                    })


                            },
                            cartInfo() {
                                var totalGuest = 0;
                                var totalCheck = 0;

                                let cart = []
                                if (window.localStorage.getItem('cartAromantica') != null) {
                                    cart = JSON.parse(window.localStorage.getItem('cartAromantica'))
                                }

                                cart.forEach((data, index) => {

                                    totalGuest = data.amount + totalGuest

                                })

                                let cartTotal = totalGuest + totalCheck
                                $("#cart-notification").html(cartTotal + "")

                                if (this.authCheck == "1") {

                                    axios.get("{{ url('/cart/fetch') }}")
                                        .then(res => {

                                            if (res.data.success == true) {

                                                this.products = res.data.products

                                                this.products.forEach((data, index) => {

                                                    totalCheck = totalCheck + data.amount

                                                })

                                                let cartTotalCheck = totalGuest + totalCheck
                                                console.log("test-cartTotal", totalGuest, totalCheck,
                                                    cartTotalCheck)
                                                $("#cart-notification").html(cartTotalCheck + "")

                                            }

                                        })

                                }


                            },

                        },
                        mounted() {

                            this.cartInfo()

                        }

                    })

                    const search = new Vue({
                        el: '#search',
                        data() {
                            return {
                                type: "",
                                size: "",
                                searchText: "",
                                brandTitles: [],
                                productTitles: [],
                            }
                        },
                        methods: {

                            selectType(type) {

                                this.type = JSON.parse(type)
                            },
                            selectSize(size) {
                                this.size = JSON.parse(size)
                            },
                            setText(string) {

                                this.searchText = string
                                this.search()
                                this.lookFor()

                            },
                            lookFor() {
                                if (this.searchText != "" || this.type != "" || this.size != "") {
                                    localStorage.setItem("searchAromantica", this.searchText)
                                    //if (this.type != "") {
                                    if (this.type != "") {
                                        localStorage.setItem("typeAromantica", this.type.id)
                                    } else {
                                        localStorage.setItem("typeAromantica", "")
                                    }

                                    //}
                                    if (this.size != "") {
                                        localStorage.setItem("sizeAromantica", this.size.id)
                                    } else {
                                        localStorage.setItem("sizeAromantica", "")
                                    }
                                    window.location.href = "{{ url('/search') }}"
                                }
                            },
                            search() {

                                if (this.searchText != "") {
                                    axios.post("{{ url('/words') }}", {
                                        search: this.searchText
                                    }).then(res => {

                                        if (res.data.success == true) {

                                            this.brandTitles = res.data.brandTitles
                                            this.productTitles = res.data.productTitles

                                        }

                                    })
                                }

                            }

                        },
                        mounted() {

                            if ("{{ url()->current() }}" == "{{ url('/search') }}")
                                this.searchText = localStorage.getItem("searchAromantica")

                        }

                    })
                    </script>

                    @stack("scripts")

</body>

</html>