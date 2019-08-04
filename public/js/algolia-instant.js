(function() {

    const search = instantsearch({
        appId: '4RQ9DF48ON',
        apiKey: 'c7a764916b5f63c05314b8955a9d2b2b',
        indexName: 'product_types',
        routing: true
      });
      
      search.start();

      search.addWidget(
        instantsearch.widgets.searchBox({
          container: '#search-box',
          placeholder: 'Search for products'
        })
      );

  

      search.addWidget(
        instantsearch.widgets.hits({
          container: '#hits',
          templates: {
            empty: 'No se encontraron Productos.',
            item: function(item){
                return `
                        <div class="card flex-row flex-sm-column d-block">
                        <div class="text-center align-items-center d-sm-block card-img-container">
                            <a href="${window.location.origin + '/home/' + item.nombre}">
                                <img class="card-img-top" src="${window.location.origin}/img/products/${item.imagen_url}" alt="{{ $product->descripcion }}">
                            </a>
                        </div>
                
                        
                        <div class="card-body --border-top">
                            <h3 class="mb-3">$${(item.precio / 100).toFixed(2)}</h3>
                            <div class="product-nombre mb-1">
                                <h5>${item._highlightResult.nombre.value}</h5>
                            </div>
                            <p class="text--dark-grey card-text">${item._highlightResult.descripcion.value}<span> ${item.capacidad}</span></p>
                            <div class="text-sm-center">
                            <a href="${window.location.origin + '/home/' + item.nombre}" class="text-center btn bt-primary">Agregar al pedido</a>
                            </div>
                        </div>
                    </div>
                `;
            }
            
            //'<em>Hit {{objectID}}</em>: {{{_highlightResult.nombre.value}}}'
          }
        })
      );


      search.addWidget(
        instantsearch.widgets.pagination({
          container: '#pagination',
          maxPages: 20,
          // default is to scroll to 'body', here we disable this behavior
          scrollTo: false
        })
      );


      search.addWidget(
        instantsearch.widgets.refinementList({
          container: '#refinement-list',
          attributeName: 'categories'
        })
      );
})();