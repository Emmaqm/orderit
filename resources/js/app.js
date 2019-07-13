
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/* const app = new Vue({
    el: '#app'
});
 */

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $('#content').toggleClass('mini');
    });

});

$(document).ready(function () {

    var categories = document.getElementsByClassName("category");

    for (i=0 ; i < categories.length ; i++) {
        categories[i].addEventListener("click", function(e){
            e.stopPropagation();
            e.preventDefault();
        });

        categories[i].addEventListener("mouseover", function(e){
            e.stopPropagation();
            e.preventDefault();

            for (i=0 ; i < categories.length ; i++) {
                $(categories[i]).removeClass("activeCat");
            }

            $(this).toggleClass("activeCat");

            var subcategories = document.getElementsByClassName("subcategories");
            for (i=0 ; i < subcategories.length ; i++) {
                $(subcategories[i]).hide();
            }

            var currentCatId = document.querySelector(".activeCat").id;

            document.getElementById(currentCatId + "-items").style.display = "flex";

        });
    }

});

$(document).ready(function () {

    var categories = document.getElementsByClassName("category-responsive");
    var category = document.getElementsByClassName("categories-responsive")[0];

    for (i=0 ; i < categories.length ; i++) {
        categories[i].addEventListener("click", function(e){
            e.stopPropagation();
            e.preventDefault();

            $(category).fadeOut();

            for (i=0 ; i < categories.length ; i++) {
                $(categories[i]).removeClass("activeCatR");
            }

            $(this).toggleClass("activeCatR");

            clearSubcategories();

            var currentCatId = document.querySelector(".activeCatR").id;
            var subcategory_title = $(this).text(); 

            currentCatId = currentCatId + "-itemsR";

            
            $('#categories-modal-title').hide();
            $('#back-subcategories').fadeIn();
            $('#' + currentCatId).fadeIn(); 
            $('#subcategories-span').text(subcategory_title);



            var goback = document.getElementById('back-subcategories');

            goback.addEventListener("click", function(){
                 clearSubcategories();
                 $('#back-subcategories').hide();
                 $('#categories-modal-title').fadeIn();
                 $(category).fadeIn();
                 
            });

            
        });

    }

    function clearSubcategories(){
        var subcategories = document.getElementsByClassName("subcategories-responsive");
        for (i=0 ; i < subcategories.length ; i++) {
            $(subcategories[i]).fadeOut();
        }
    }

});






