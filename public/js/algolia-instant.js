(function() {

    const search = instantsearch({
        appId: '4RQ9DF48ON',
        apiKey: 'c7a764916b5f63c05314b8955a9d2b2b',
        indexName: 'product_types',
        routing: true
      });
      
    
      search.addWidget(
        instantsearch.widgets.hits({
          container: '#hits',
          templates: {
            empty: function(empty){
              return `
                <div class="alert alert-warning" role="alert">
                  No se encontraron Productos
                </div>
              `;
          },
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

          }
        })
      );


      
      search.addWidget(
        instantsearch.widgets.searchBox({
          container: '#search-box',
          placeholder: 'Buscar Productos...'
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
        instantsearch.widgets.menu({
          container: '#refinement-list-subcategory',
          attributeName: 'subcategories',
          sortBy: ['name:asc']
        })
      );

      search.addWidget(
        instantsearch.widgets.refinementList({
          container: '#refinement-list-brand',
          attributeName: 'marca',
          sortBy: ['name:asc']
        })
      );

      
      search.addWidget(
        instantsearch.widgets.refinementList({
          container: '#refinement-list-capacity',
          attributeName: 'capacidad',
          sortBy: ['name:asc']
        })
      );

      search.addWidget(
        instantsearch.widgets.sortBySelector({
          container: '#ordenar',
          autoHideContainer: true,
          indices: [
            {name: 'product_types', label: 'Mas Relevante'},
            {name: 'product_types_asc', label: 'Menor Precio'},
            {name: 'product_types_desc', label: 'Mayor Precio'}
          ]
        })
      );

      search.addWidget(
        instantsearch.widgets.breadcrumb({
          container: '#breadcrumb',
          attributes: ['subcategories'],
          templates: { home: 'Inicio' },
        })
      );
      
      search.start();

      search.helper.on('result', function(res) {
        const filtros = document.getElementById('filtros');
        const filtros_open = document.getElementById('filtros-open');
        if (res && res.hits && res.hits.length > 0) {
          filtros.style.display = 'block';
        } else {
          filtros.style.display = 'none';
          filtros_open.style.display = 'none';
        }
      });

})();

function closeOpenMenu() {
  $('#filtros').toggleClass('filtros-open');
  $('#apply-filters').toggleClass('apply-filters-open');
  $('#bg-filtros').fadeToggle();
}

$(document).ready(function () {
  $('#filtros-open').click(function () {
          closeOpenMenu();
  });

  $('#filtros-close').click(function () {
          closeOpenMenu();
  });
  
  $('#apply-filters').click(function () {
          closeOpenMenu();
  });
});

$(document).mouseup(function (e) {
  if ($('#bg-filtros').is(e.target)) {
          closeOpenMenu();
  }
});



