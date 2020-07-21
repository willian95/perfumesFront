 @extends("layouts.index")

 @section("content")
    <div class="container mt-5" id="store-area">
        <div class="row">
            <div class="col-md-3">
                <div class="controls">
                    <div class="">
                        <div class="border p-4 rounded mb-4">
                            <h3 class="mb-3 h6 text-uppercase text-black d-block">
                                Categorias
                            </h3>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-1">
                                    <div class="form-check d-flex filter" data-filter=".category-1">
                                        <input type="checkbox" value="0" class="form-check-input" id="todascategorias" @click="selectAllCategories()">
                                        <label class="form-check-label" for="exampleCheck1"><span>Todas ({{ App\ProductTypeSize::count() }})</span></label>
                                    </div>
                                </li>
                                
                                <li class="mb-1" v-for="category in categories">

                                    <div class="form-check d-flex filter" data-filter=".category-1">
                                        <input type="checkbox" :value="category.id" class="form-check-input" :id="'category-id'+category.id" v-model="selectedCategories">
                                        <label class="form-check-label" :for="'category-id'+category.id"><span>@{{ category.name }} - (@{{ category.productsAmount }})</span></label>

                                    </div>
                                </li>
                                
                            </ul>
                        </div>
                    </div>

                    <!--marcas--->
                    <div class="">
                        <div class="border p-4 rounded mb-4">
                            <h3 class="mb-3 h6 text-uppercase text-black d-block">
                                Marcas
                            </h3>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-1">
                                    <div class="form-check d-flex filter" data-filter="all">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" @click="selectAllBrands()">
                                        <label class="form-check-label" for="exampleCheck1"><span>Todas</span></label>

                                    </div>
                                </li>
                                <li class="mb-1" v-for="brand in brands">
                                    <div class="form-check d-flex filter" data-filter=".category-1">
                                        <input type="checkbox" :value="brand.id" class="form-check-input" :id="'brand-id'+brand.id" v-model="selectedBrands">
                                        <label class="form-check-label" :for="'brand-id'+brand.id"><span>@{{ brand.name }}</span></label>

                                    </div>


                                </li>
                                
                            </ul>
                        </div>
                    </div>

                    <div>
                        <div class="container-range">
                            <div class="box-minmax">
                                <div class="range-slider">
                                    <div class="d-flex price-range">
                                        <p>Precio: 0$ - </p>
                                        <span id="rs-bullet" class="">@{{ range }}</span>
                                        <span>$</span>
                                    </div>
                                    <input id="rs-range-line" class="rs-range" type="range" v-model="range" min="0" :max="maxPrice" step="1000" >
                                </div>
                            </div>
                            <a href="#" class="btn-custom btn-filtro " @click="fetch()">Filtrar</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <br>
                <div id="product-grid" class="product-grid">
                    <div class="main-products__item col-xs-6 " v-for="product in products">
                        <div class="main-products__box">
                            <!--<div class="views">
                                <span data-toggle="modal" data-target="#producto_modal"><i
                                        class="flaticon-view"></i></span>
                                <span href="#"><i class="flaticon-shopping-cart"></i></span>
                            </div>-->
                            <div class="main-products__img">
                                <img :src="'{{ env('CMS_URL') }}'+'/images/products/'+product.product.image" />
                            </div>
                            <a :href="'{{ url('/') }}'+'/tienda/producto/'+product.id">
                                <div class="main-products__text">
                                    <div class="main-products__title_cat">
                                        <p>@{{ product.product.category.name }}</p>
                                    </div>
                                    <div class="main-products__title">
                                        <p>@{{ product.product.name }}</p>
                                    </div>
                                    <div class="main-products__details">
                                        <span>$ @{{ product.price }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item" v-for="index in pages"><a class="page-link" href="#" @click="fetch(index)">@{{ index }}</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>


 @endsection

 @push("scripts")

<script>

        const devArea = new Vue({
            el: '#store-area',
            data(){
                return{
                    selectedBrands:[],
                    selectedCategories:[],
                    categories:[],
                    brands:[],
                    page:1,
                    pages:0,
                    products:[],
                    range:0,
                    maxPrice:0,
                    minPrice:0
                }
            },
            methods:{
                
                
                fetchCategories(){

                    axios.get("{{ url('/tienda/fetch/categories') }}").then(res =>{

                        if(res.data.success == true){

                            this.categories = res.data.categories

                        }

                    })

                },
                fetchBrands(){

                    axios.get("{{ url('/tienda/fetch/brands') }}").then(res =>{

                        if(res.data.success == true){

                            this.brands = res.data.brands

                        }

                    })

                },
                selectAllBrands(){

                    if(this.brands.length == this.selectedBrands.length){

                        this.selectedBrands = []

                    }else{

                        this.selectedBrands = []
                        this.brands.forEach((data, index) => {

                            this.selectedBrands.push(data.id)

                        })

                    }

                },
                fetch(page = 1){
                    
                    this.page = page

                    axios.post("{{ url('/tienda/fetch') }}", {categories: this.selectedCategories, brands: this.selectedBrands, price: this.range, page: this.page}).then(res =>{

                        if(res.data.success == true){

                            this.products = res.data.products
                            this.maxPrice = res.data.maxPrice
                            this.pages = Math.ceil(res.data.productsCount / 20)

                        }

                    })

                },
                selectAllCategories(){

                    if(this.selectedCategories.length == this.categories.length){

                        this.selectedCategories = []

                    }else{

                        this.selectedCategories = []
                        this.categories.forEach((data, index) => {

                            this.selectedCategories.push(data.id)

                        })

                    }

                }

            },
            mounted(){

                this.fetchCategories()
                this.fetchBrands()
                this.fetch()

            }

        })

    </script>

@endpush