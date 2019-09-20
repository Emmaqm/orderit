(function() {
    var client = algoliasearch('4RQ9DF48ON', 'c7a764916b5f63c05314b8955a9d2b2b');
    var index = client.initIndex('product_types');
    var enterPressed = false;
    //initialize autocomplete on search input (ID selector must match)
    autocomplete('#aa-search-input',
        { hint: false }, {
            source: autocomplete.sources.hits(index, { hitsPerPage: 10 }),
            //value to be displayed in input control after user's suggestion selection
            displayKey: 'name',
            //hash of templates used when rendering dataset
            templates: {
                //'suggestion' templating function used to render a single suggestion
                suggestion: function (suggestion) {
                    const markup = `
                        <div class="algolia-result">
                            <span>
                                <img src="${window.location.origin}/storage/${suggestion.imagen_url}" alt="" class="algolia-thumb">
                                ${suggestion._highlightResult.nombre.value}
                            </span>
                            <span>$${(suggestion.precio / 100).toFixed(2)}</span>
                        </div>
                        <div class="algolia-details">
                            <span>${suggestion._highlightResult.descripcion.value}</span>
                        </div>
                    `;

                    return markup;
                },
                empty: function (result) {
                    return '<p class="errorSearch">Lo sentimos, no encontramos resultados para: "' + result.query + '"</p>';
                }
            }
        }).on('autocomplete:selected', function (event, suggestion, dataset) {
            window.location.href = window.location.origin + '/home/' +  suggestion.nombre;
            enterPressed = true;
        }).on('keyup', function(event) {
            if (event.keyCode == 13 && !enterPressed) {
                window.location.href = window.location.origin + '/search?query=' + document.getElementById('aa-search-input').value;
            }
        });
})();