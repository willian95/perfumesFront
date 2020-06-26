@extends("layouts.index")

@section("content")

   <!--- <div class="container" id="dev-area">
        <div class="row">
            <div class="col-lg-4">
                <h3 class="text-center">@{{ title }}</h3>
                <h4 class="text-center">@{{ brand }}</h4>

                <button class="btn btn-primary" v-for="type in types" @click="selectType(type)" style="margin-right: 5px;">@{{ type.name }}</button>

                <button class="btn btn-success" v-for="size in sizes" @click="selectSize(size)"  style="margin-right: 5px; margin-top: 5px;">@{{ size.name }} Oz - @{{ size.ml }} ml</button>

            </div>
            <div class="col-lg-4">
                Precio: @{{ price }}
                Cantidad: @{{ amount }}
                <button class="btn btn-success" @click="addAmount()">+</button>
                <button class="btn btn-success" @click="substractAmount()">-</button>

                <p class="text-center" style="margin-top: 10px;" v-if="this.type != '' && this.size != ''">
                    <button class="btn btn-success" @click="addToCart()">Agregar al carrito</button>
                </p>

            </div>  
        </div>
    </div>--->
    <section class="container mt-5" id="dev-area">
        <div class="main main-details__product">
          <div class="grid__detail row">
            <div class="col-md-6">
              <div class="video">
        
              </div>
              <div class="row">
                <div class="col-md-3">
    
                </div>
                <div class="col-md-8">
    
                </div>
              </div>
    
           
            <div class="slider slider-for__details">
              <div>
                <img src="assets/img/productos/perfume1.png" alt="">
              </div>
              <div>
                <img src="assets/img/productos/perfume1.png" alt="">
              </div>
            </div>
            <!---mini---->
            <div class="slider slider-nav__details">
              <div>
                <img src="assets/img/productos/perfume1.png" alt="">
              </div>
              <div>
                <img src="assets/img/productos/perfume1.png" alt="">
              </div>
            </div>
         
            </div>
            <div class="col-md-6">
    
              <div class="slider_details--text">
                <div class="">
                  <div class="main-top__item">
                    <div class="main-top__text">
                      <div class="main-top__title">
                        <p>@{{ title }}</p>
                      </div>
                      <div class="main-top__price">
                        <p> @{{ amount }}</p>
                      </div>
                      <div class="barra mb-3">
                        <p class="details__txt">Tamaño : 1.7 oz / 50ml</p>
                       <div>
                        <p>Cantidades disponibles: <span>28</span></p>
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="10"></div>
                        </div>
                       </div>
                      </div>
                      
                      
    
                      <div class="main-top__description">
                        <p>CH Men Privé es una fragancia refinada y un tributo a la masculinidad extremadamente
                          cautivador. Una firma sensual, al mismo tiempo rica, con textura y misteriosa. CH Men Privé es
                          cálida y lujosa, con notas de whisky y de cuero, provocativa, moderna y rica.</p>
                      </div>
                      
                      <p>Presentaciones</p>
                      <div class="presentaciones">
                    <div>
                        <button class="btn btn-primary optiones" v-for="type in types" @click="selectType(type)" style="margin-right: 5px;">@{{ type.name }}</button>
                    </div>
                      
                       
                    <div>
                       
                        <button class="btn btn-success" v-for="size in sizes" @click="selectSize(size)"  style="margin-right: 5px; margin-top: 5px;">@{{ size.name }} Oz - @{{ size.ml }} ml</button> 
                    </div>

     

                      <!---  <div class="tabset">
                      
                          <input type="radio" name="tabset" id="tab1" checked>
                          <label for="tab1">Parfum</label>
                      
                          <input type="radio" name="tabset" id="tab2">
                          <label for="tab2">Eau de toilete</label>
                        
                          <input type="radio" name="tabset" id="tab3">
                          <label for="tab3">Eau deperfum</label>
    
                          <div class="tab-panels">
                    
                            <div class="tab-panel">
    
                              <input class="" type="radio">
                              <label class="mr-4" for="">1.7 OZ</label>
    
                              <input class="" type="radio">
                              <label class="mr-4" for="">3.4 OZ</label>
    
                              <input class="" type="radio">
                              <label class="mr-4" for="">4.2 OZ</label>
    
                              <input class="" type="radio">
                              <label class="mr-4" for="">1.7 OZ</label>
                            </div>
                         
    
                            <div class="tab-panel">
    
                              <input class="" type="radio">
                              <label class="mr-4" for="">3.4 OZ</label>
    
    
                              <input class="" type="radio">
                              <label class="mr-4" for="">4.2 OZ</label>
    
    
                              <input class="" type="radio">
                              <label class="mr-4" for="">1.7 OZ</label>
                            </div>
                            <section class="tab-panel">
    
                              <input class="" type="radio">
                              <label class="mr-4" for="">1.7 OZ</label>
                            </section>
                          </div>
    
                        </div>--->
    
                      </div>
    
                      <div class="float-left main-top__btn ">
                        <a style="color:#fff" class="btn-custom mr-4" @click="addToCart()">
                          Añadir >
                        </a>
                      </div>
                    </div>
                  </div>
    
                </div>
              </div>
            </div>
    
          </div>
    
    
        </div>
      </section>
    

@endsection

@push("scripts")

    <script>
    
        const devArea = new Vue({
            el: '#dev-area',
            data(){
                return{
                    authCheck:"{{ Auth::check() }}",
                    title:"{{ $product->name }}",
                    category:"{{ $product->category->name }}",
                    brand:"{{ $product->brand->name }}",
                    productTypeSizes:JSON.parse('{!! json_encode($product->productTypeSizes) !!}'),
                    types:[],
                    sizes:[],
                    type:"",
                    size:"",
                    productTypeSize:"",
                    amount:0,
                    stock:0,
                    price:0
                }
            },
            methods:{
                
                selectType(type){
                    this.type = type

                    this.sizes = []
                    this.productTypeSizes.forEach((data, index) => {

                        if(data.type == type){
                            this.sizes.push(data.size)
                        }

                    })

                },
                selectSize(size){   

                    this.amount = 0;
                    this.size = size

                    if(this.type != "" && this.size != ""){

                        this.productTypeSizes.forEach((data, index) => {

                            if(data.type == this.type && data.size == this.size){
                                
                                this.productTypeSize = data
                                this.price = data.price
                                this.stock = data.stock

                            }   

                        })

                    }

                },
                addAmount(){

                    if(this.amount + 1 <= this.stock){
                        this.amount++
                    }

                },
                substractAmount(){

                    if(this.amount - 1 > 0){
                        this.amount--
                    }

                },
                addToCart(){

                    if(this.amount > 0){

                        if(this.authCheck == true){
                            
                            axios.post("{{ url('/cart/store') }}", {productTypeSizeId: this.productTypeSize.id, amount: this.amount})
                            .then(res => {

                                if(res.data.success == true){
                                    alert(res.data.msg)
                                    this.amount = 0;
                                    this.type = ""
                                    this.size = ""
                                    this.productTypeSize = ""
                                }else{
                                    alert(res.data.msg)
                                }

                            })

                        }

                    }else{

                        alert("Debe seleccionar una cantidad")

                    }

                }


            },
            mounted(){

                this.productTypeSizes.forEach((data, index) => {

                    this.types.push(data.type)
                    

                })


            }

        })

    </script>

@endpush