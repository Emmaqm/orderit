<div class="row">
    <div class="col-12">
            
        <div class="also-like --white-container">
            <h3 class="mb-4 pb-2 text-center text--darkest-grey">Otros productos que te pueden interesar</h3>
            <div class="d-flex justify-content-center">
                
                @foreach ($alsoLike as $product)

                  <div class="col-xl-2 col-lg-3 col-sm-4 col-6 mb-3">

                    <div class="card">

                        <a href="{{ route('home.show', $product->id . '-' .$product->nombre) }}">
                            <img class="card-img-top" src="{{ asset('img/products/'. $product->imagen_url) }}" alt="{{ $product->descripcion }}">
                          </a>
                          
                          <div class="card-body --border-top text-center">
                            <h5 class="card-title">{{ $product->nombre }}</h5>
                            <p class="card-title text--dark-grey">{{ $product->presentPrice() }}<span> c/u</span></p>
                            <div class="text-center">
                              <a href="{{ route('home.show', $product->id . '-' .$product->nombre) }}" class="text-center --link">Ver más</a>
                            </div>
                          </div>

                    </div>
                      
                  </div>
                      
                @endforeach
              


            </div>
        </div>
    </div>
</div>