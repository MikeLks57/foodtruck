function deleteProductEvent(){
    $('.delete').click(function(e){
        e.preventDefault();
        var $this = $(this);
        $.ajax({
            url : $('#url_delete').val(),
            method : 'post',
            data: {
                form: $this.parent('form').serialize(),
                nbProduct: $this.attr('data-id'),
            }
        }).done(function(r){
            // Si ajout, affichage les produits dans la commande
            $('#command').html(r);
            deleteProductEvent();
        }).always(function(r){
            $('#command').html(r);
            deleteProductEvent();
        });
    });
}

function addProductEvent(){
    $('.order').click(function(e){
        e.preventDefault();
        var $this = $(this);

        $.ajax({
            url : $('#url_order').val(),
            method : 'post',
            data: $this.parent('form').serialize(),

        }).done(function(r){
            // Si ajout, affichage les produits dans la commande
            $('#command').html(r);
        }).always(function(r){
            $('#command').html(r);
            deleteProductEvent();
        });
    });       
}

function priceSupplement(){
    $('select.supplement').on('change', function(e){
        var optionPrice = 0;
        $('select.supplement').each(function(){
            if( $(this).find('option:selected').data('price') !== undefined) {
                optionPrice += $(this).find('option:selected').data('price');
            }

        })
        console.log(optionPrice);
        $('#supplement-price').val( optionPrice )
    });    
}

function searchProduct(){
    $('.search').on('input', function(){
        var $this = $(this);
        var searchProduct = $('#search').val();

        if (searchProduct == "") {
           document.location.href="/foodtruck/w/public/menu";
       } else {
            $.ajax({
                url : $('#url_search').val(),
                method : 'post',
                data: {
                    form: $this.parent('form').serialize(),
                    searchpro: searchProduct,
                }
            }).done(function(response){
                $('#menu').replaceWith(response);
            });
       }  
    });
}

/*Fonction pour cacher les marqueurs de GoogleMap et afficher uniquement celui du jour sélectionner. A ne pas effacer malgré le doublon dans le fichier map.php*/
$('#selectDay').change(function(){
    markers.forEach( function(element, index) {
        element.setMap(null);
    });
})

function map()
{
    /*Fonction pour cacher les marqueurs de GoogleMap et afficher uniquement celui du jour sélectionner. A ne pas effacer malgré le doublon dans le fichier map.php*/
    $('#selectDay').change(function(){
        markers.forEach( function(element, index) {
            element.setMap(null);
        });

        markers[document.getElementById('selectDay').value].setMap(map);
    });

}
/*Fin de la fonction pour la map*/



/*------------------- Menu-admin -------------------*/


/************Les catégories************/

/*Fonction rafraichissement des catégories*/
function refreshCategories()
{
	var url = $('#get_categories').val();
    $.ajax({
        method: "GET",
        url: url,
        dataType: 'json',
    }).done(function(response){
        var allCategories = "";
        response.categories.forEach(function(element, key){
        	allCategories += '<li id="category_' + element.id + '" class="center-block categoryContainer"><div class="panel-heading"><button type="button" data-toggle="modal" data-backdrop="false" data-target="#deleteCat" data-id="' + element.id + '" class="close trash category"><span class="glyphicon glyphicon-trash"></span></button><button type="button" data-toggle="modal" data-backdrop="false" data-target="#updateCat" data-id="' + element.id + '" data-name="' + element.name + '" class="close pencil category"><span class="glyphicon glyphicon-pencil"></span></button><div><a href="' + element.id + '" data-toggle="collapse"><span class="glyphicon glyphicon-menu-down seeMoreProducts"></span></a>&nbsp;&nbsp;&nbsp;' + element.name + '</div></div></li><div id="' + element.id + '" class="panel-collapse collapse"><div class="panel-body"><span data-toggle="modal" data-backdrop="false" data-target="#addProd" data-id="' + element.id + '" class="glyphicon glyphicon-plus addProductBdd">&nbsp;Ajouter un produit</span><ul id="list-productsCat_'+ element.id +'" class="row list-products"></ul></div></div>';        
        });
        $('ul#list-categories').html(allCategories);

        var nonClasses = 	'<li id="category_5000" class="center-block categoryContainer">\
        						<div class="panel-heading">\
									<div>\
										<a href="5000" data-toggle="collapse">\
											<span class="glyphicon glyphicon-menu-down seeMoreProducts"></span>\
										</a>&nbsp;&nbsp;&nbsp;Non classés\
									</div>\
        						</div>\
        					</li>\
        					<div id="5000" class="panel-collapse collapse">\
        						<div class="panel-body">\
        							<ul id="list-productsCat_5000" class="row list-products"></ul>\
        						</div>\
        					</div>';
        $('ul#list-nonClasses').html(nonClasses);

        var noVisible = 	'<li id="category_noVisible" class="center-block categoryContainer">\
        						<div class="panel-heading">\
									<div>\
										<a href="noVisible" data-toggle="collapse">\
											<span class="glyphicon glyphicon-menu-down seeMoreProducts"></span>\
										</a>&nbsp;&nbsp;&nbsp;Produits désactivés\
									</div>\
        						</div>\
        					</li>\
        					<div id="noVisible" class="panel-collapse collapse">\
        						<div class="panel-body">\
        							<ul id="list-productsCat_noVisible" class="row list-products"></ul>\
        						</div>\
        					</div>';
        $('ul#list-noVisible').html(noVisible);
    })
}
/*Fin de la fonction rafraichissement des catégories*/

/*Fonction réorganisation des catégories*/
function reorganiseCategories() {
	$("#list-categories").sortable({ // initialisation de Sortable sur #list-categories
		items: 'li:not(.productContainer)',
		/*placeholder: 'highlight',*/ // classe à ajouter à l'élément fantome
		update: function() {  // callback quand l'ordre de la liste est changé
			var order = $('#list-categories').sortable('serialize'); // récupération des données à envoyer
			$.ajax({
				method: "POST",
				url: $('#reorganise_categories_route').val(),
				data: order,
			}).done(function(response){
				console.log(response);
			});
				/*refreshCategories();*/
		}
  	});
  	$("#list-categories").disableSelection(); // on désactive la possibilité au navigateur de faire des sélections
}
/*Fin de la fonction réorganisation des catégories*/


/*Fonction d'ajout de catégorie en bdd*/
function addCategoryBdd(){
	$("form").submit(function(e) {
		e.preventDefault();
		var form = $(this);
		var url = form.attr("action");
		var newCategory = $('#newCategory').val();
		$.ajax({
			method: "POST",
			url: url,
			data: { 
				newCategory: newCategory 
			},
		}).done(function(response){
			$("#formulaire").modal("hide");
			refreshCategories();
			effacer("form");
		})
	});
};
/*Fin de la fonction d'ajout de catégorie en bdd*/


/*Fonction suppression de catégorie*/
function deleteCategorie(){
	$("ul#list-categories").on('click', 'button[class="close trash category"]', function(e) {
		e.preventDefault();
		var idCategory = $(this).data('id');
		var url = $('#delete_category').val();
		$('#deleteCatButton').on('click', function(e){
			e.preventDefault();
			$.ajax({
				method: "POST",
				url: url,
				data: {
					idCategory: idCategory
				},
			}).done(function(response){
				refreshCategories();
			});
		})
	}) 
}
/*Fin de la fonction suppression de catégorie*/


/*Fonction modification de catégorie*/
function updateCategorie(){
	$("ul#list-categories").on('click', 'button[class="close pencil category"]', function(e){
		e.preventDefault();
		var idCategory = $(this).data('id');
		var oldCategory = $(this).data('name');
		$("form#updateCat").submit(function(e) {
			e.preventDefault();
			var form = $(this);
			var url = form.attr("action");
			var updateCategory = $('#updateCategory').val();
			$.ajax({
				method: "POST",
				url: url,
				data: { 
					updateCategory: updateCategory,
					idCategory: idCategory,
				},
			}).done(function(response){
				$("#updateCat").modal("hide");
				console.log(response);
				refreshCategories();
			})
		});
	});
}
/*Fin de la fonction suppression de catégorie*/

/************Fin catégories************/


/************Les produits************/

/*Fonction affichage des produits de la catégorie au clic*/
function seeMoreProductClick(){
	$("ul#list-categories").on('click', 'a[data-toggle=collapse]', function(e){
		e.preventDefault();
		var target_element= $(this).attr("href");
		if($('div#' + target_element).is('.in')){
			refreshProducts(target_element);
			$('div#' + target_element).removeClass('in');
		} else {
			refreshProducts(target_element);
			$('div#' + target_element).addClass('in');
		}
	});

	$("ul#list-nonClasses").on('click', 'a[data-toggle=collapse]', function(e){
		e.preventDefault();
		var target_element= $(this).attr("href");
		if($('div#' + target_element).is('.in')){
			$('div#' + target_element).removeClass('in');
		} else {
			$('div#' + target_element).addClass('in');
			refreshProductsNonClasses();
		}
	});

	$("ul#list-noVisible").on('click', 'a[data-toggle=collapse]', function(e){
		e.preventDefault();
		var target_element= $(this).attr("href");
		if($('div#' + target_element).is('.in')){
			$('div#' + target_element).removeClass('in');
		} else {
			$('div#' + target_element).addClass('in');
			refreshNoVisibleProducts();
		}
	});
}
/*Fin de la fonction affichage des produits de la catégorie au clic*/


/*Fonction de rafraichissement des produits par idCategory*/
function refreshProducts($idCat){
	var url = $('#get_products_by_idCat_ajax').val();
	var idCategory = $idCat;
	$.ajax({
		method: "GET",
		url: url,
		data: {
			idCategory: idCategory,
		}
	}).done(function(response){
		var products = "";
		var url = $('#get_img_route').val();
		response.products.forEach(function(element, key){
			products += '<li class="ui-state-default productItem" id="product_' + element.productId + '"><div class="productContainer"><div class="boutonsSuppModif"><button type="button" data-id="' + element.productId + '" class="close highlight products"><span class="glyphicon glyphicon-star-empty"></span></button><button type="button" data-toggle="modal" data-backdrop="false" data-target="#sleepProd" data-id="' + element.productId + '" data-cat="' + element.categoryId + '" class="close sleep products"><span class="glyphicon glyphicon-pause"></span></button><button type="button" data-toggle="modal" data-backdrop="false" data-target="#deleteProd" data-id="' + element.productId + '" data-cat="' + element.categoryId + '" class="close trash products"><span class="glyphicon glyphicon-trash"></span></button><button type="button" data-toggle="modal" data-backdrop="false" data-target="#updateProd" data-id="' + element.productId + '" data-name="' + element.productName + '" class="close pencil products"><span class="glyphicon glyphicon-pencil"></span></button></div><div class="title"><h4>' + element.productName + '</h4></div><div class="image"><img src="' + url + element.productPicture + '" alt="' + element.productName + '" width="150" height="150"></div></div></li>';
		})
		$('ul#list-productsCat_' + idCategory).html(products);
		$('ul#list-productsCat_' + idCategory).sortable({
			update: function() {  
				var order = $('ul#list-productsCat_' + idCategory).sortable('serialize'); 
				var url = $('#reorganise_products_route').val();
				$.ajax({
					method: "POST",
					url: $('#reorganise_products_route').val(),
					data: order,
				}).done(function(response){
					console.log(response);
				});
			}
		})
		$('ul#list-productsCat_' + idCategory).disableSelection();
	});
}
/*Fin de la fonction de rafraichissement des produits par idCategory*/


/*Fonction de rafraichissement des produits désactivés*/
function refreshNoVisibleProducts()
{
	var url = $('#get_products_by_visibility_ajax').val();
	$.ajax({
		method: "GET",
		url: url,
	}).done(function(response){
		var products = "";
		var url = $('#get_img_route').val();
		response.productsNoVisible.forEach(function(element, key){
			products += '<li class="ui-state-default productItem" id="product_' + element.productId + '"><div class="productContainer"><div class="boutonsSuppModif"><button type="button" data-toggle="modal" data-backdrop="false" data-target="#activateProd" data-id="' + element.productId + '" data-cat="' + element.categoryId + '" class="close display products"><span class="glyphicon glyphicon-play"></span></button><button type="button" data-toggle="modal" data-backdrop="false" data-target="#deleteProd" data-id="' + element.productId + '" data-cat="' + element.categoryId + '" class="close trash products"><span class="glyphicon glyphicon-trash"></span></button><button type="button" data-toggle="modal" data-backdrop="false" data-target="#updateProd" data-id="' + element.productId + '" data-name="' + element.productName + '" class="close pencil products"><span class="glyphicon glyphicon-pencil"></span></button></div><div class="title"><h4>' + element.productName + '</h4></div><div class="image"><img src="' + url + element.productPicture + '" alt="' + element.productName + '" width="150" height="150"></div></div></li>';
		})
		$('ul#list-productsCat_noVisible').html(products);
		$('ul#list-productsCat_noVisible').sortable({
			update: function() {  
				var order = $('ul#list-productsCat_noVisible').sortable('serialize'); 
				var url = $('#reorganise_products_route').val();
				$.ajax({
					method: "POST",
					url: $('#reorganise_products_route').val(),
					data: order,
				}).done(function(response){
					console.log(response);
				});
			}
		})
		$('ul#list-productsCat_noVisible').disableSelection();
	});
}
/*Fin de la fonction de rafraichissement des produits désactivés*/


/*Fonction de rafraichissement des produits non classés*/
function refreshProductsNonClasses()
{
	var url = $('#get_products_non_classes_ajax').val();
	$.ajax({
		method: "GET",
		url: url,
	}).done(function(response){
		var products = "";
		var url = $('#get_img_route').val();
		response.productsNonClasses.forEach(function(element, key){
			products += '<li class="ui-state-default productItem" id="product_' + element.productId + '"><div class="productContainer"><div class="boutonsSuppModif"><button type="button" data-toggle="modal" data-backdrop="false" data-target="#deleteProd" data-id="' + element.productId + '" data-cat="' + element.categoryId + '" class="close trash products"><span class="glyphicon glyphicon-trash"></span></button><button type="button" data-toggle="modal" data-backdrop="false" data-target="#updateProd" data-id="' + element.productId + '" data-name="' + element.productName + '" class="close pencil products"><span class="glyphicon glyphicon-pencil"></span></button></div><div class="title"><h4>' + element.productName + '</h4></div><div class="image"><img src="' + url + element.productPicture + '" alt="' + element.productName + '" width="150" height="150"></div></div></li>';
		})
		$('ul#list-productsCat_5000').html(products);
		$('ul#list-productsCat_5000').sortable({
			update: function() {  
				var order = $('ul#list-productsCat_5000').sortable('serialize'); 
				var url = $('#reorganise_products_route').val();
				$.ajax({
					method: "POST",
					url: $('#reorganise_products_route').val(),
					data: order,
				}).done(function(response){
					console.log(response);
				});
			}
		})
		$('ul#list-productsCat_5000').disableSelection();
	});
}
/*Fin de la fonction de rafraichissement des produits non classés*/


/*Fonction affichage du formulaire d'ajout de produit*/
function addProductPlus(){
	$("ul#list-categories").on('click', 'span[class="glyphicon glyphicon-plus addProductBdd"]', function(){

		//On récupère l'id category des produits lorsque on clique sur ajouter produit
		var idCategory = $(this).data('id');
		console.log(idCategory);
		
		//Récupération des ingrédients en bdd pour l'autocomplétion
		var url = $('#get_ingredients_ajax').val();
		$.ajax({
			method: "GET",
			url: url,
			dataType: 'json',
		}).done(function(response){
		//On place les ingrédients récupérés dans un tableau
			var ingredients = [];
			response.ingredients.forEach(function(element, key){
				ingredients.push(element.name);
			});
		//On initialise le tokenfield avec le tableau ingredients en autocompletion
			initialiseToken('input#productIngredients', ingredients);
		});

		//Fonction d'affichage d'un aperçu de l'image uploadée
		seeUploadPic('form#addProdForm');

		//On place l'id category dans un input hidden afin de le réutiliser
		$('input#idCategoryHidden').val(idCategory);
	});
}
/*Fin de la fonction affichage du formulaire d'ajout de produit*/


/*Fonction d'ajout du produit en bdd*/
function addProductBdd(){
	$("form#addProdForm").on('click', 'button[id="sendProductForm"]', function() {

  		//On génère une liste à virgules de l'ensemble des tokens ingrédients
		var productIngredients = $('#productIngredients').tokenfield('getTokensList');
		//On place cette liste dans l'attribut value dans un input caché, afin de faire un serialize du formulaire complet
		$('input#tokenfieldValues').val(productIngredients);

		var $form = $("form#addProdForm");
    	var formdata = (window.FormData) ? new FormData($form[0]) : null;
    	var data = (formdata !== null) ? formdata : $form.serialize();
    	var idCategory = $('#idCategoryHidden').val();

        $.ajax({
        	url: $form.attr('action'),
        	type: $form.attr('method'),
        	contentType: false,
        	processData: false,
           	dataType: 'json',
            data: data,
        }).done(function(r) {
        	console.log(r);
            $('.error').addClass('hide');
            var errorsTable = r.errors;
            
            if(errorsTable !== undefined) { // Si erreurs
                if(errorsTable.productNameEmpty !== undefined ) {
                    $('.error.productNameLength').removeClass('hide');
                }

                if(errorsTable.productNameLength !== undefined) {
                    $('.error.productNameLength').removeClass('hide');
                }
                if(errorsTable.productDescriptionLength !== undefined) {
                    $('.error.productDescriptionLength').removeClass('hide');
                }
                if(errorsTable.productPriceType !== undefined) {
                    $('.error.productPriceType').removeClass('hide');
                }
                if(errorsTable.idCategoryMissing !== undefined) {
                    $('.error.idCategoryMissing').removeClass('hide');
                }
                if(errorsTable.idCategoryType !== undefined) {
                    $('.error.idCategoryType').removeClass('hide');
                }
                if(errorsTable.ingredientsListEmpty !== undefined) {
                    $('.error.ingredientsListEmpty').removeClass('hide');
                }
                if(errorsTable.ingredientType !== undefined) {
                    $('.error.ingredientType').removeClass('hide');
                }
                if(errorsTable.fileWeightMax !== undefined) {
                    $('.error.fileWeightMax').removeClass('hide');
                }
                if(errorsTable.fileEmpty !== undefined) {
                    $('.error.fileEmpty').removeClass('hide');
                }
                if(errorsTable.fileType !== undefined) {
                    $('.error.fileType').removeClass('hide');
                }
                if(errorsTable.fileSizeMin !== undefined) {
                    $('.error.fileSizeMin').removeClass('hide');
                }
                if(errorsTable.fileSizeMax !== undefined) {
                    $('.error.fileSizeMax').removeClass('hide');
                }
                if(errorsTable.fileLoad !== undefined) {
                    $('.error.fileLoad').removeClass('hide');
                }
            }
    		$("#addProd").modal("hide");
    		refreshProducts(idCategory);
    		effacer('form#addProdForm');
    		$('#image_preview').find('.thumbnail').addClass('hidden');
    		$('#productIngredients').tokenfield('setTokens', ['']);
    	});
    });
}


/*Fonction suppression de produit dans les produits visibles*/
function deleteProduct(){
	$("ul#list-categories").on('click', 'button[class="close trash products"]', function(e) {
		e.preventDefault();
		var idCategory = $(this).data('cat'); 
		var idProduct = $(this).data('id');
		var url = $('#delete_product').val();
		$('#deleteProdButton').on('click', function(e){
			e.preventDefault();
			$.ajax({
				method: "POST",
				url: url,
				data: {
					idProduct: idProduct
				},
			}).done(function(response){
				refreshProducts(idCategory);
			});
		});
	});
}
/*Fin de la fonction suppression de produit dans les produits visibles*/


/*Fonction suppression de produit dans les produits non classés*/
function deleteProductNonClasse(){
	$("ul#list-nonClasses").on('click', 'button[class="close trash products"]', function(e) {
		e.preventDefault();
		var idProduct = $(this).data('id');
		var url = $('#delete_products_non_classe').val();
		console.log(idProduct);
		console.log(url);
		$('#deleteProdButton').on('click', function(e){
			e.preventDefault();
			console.log('youhou');
			$.ajax({
				method: "POST",
				url: url,
				data: {
					idProduct: idProduct
				},
			}).done(function(response){
				console.log(response);
				refreshProductsNonClasses()
			});
		});
	});
}
/*Fin de la fonction suppression de produit dans les produits non classés*/


/*Fonction suppression de produit dans les produits non visibles*/
function deleteProductNoVisible(){
	$("ul#list-noVisible").on('click', 'button[class="close trash products"]', function(e) {
		e.preventDefault();
		var idProduct = $(this).data('id');
		var url = $('#delete_products_no_visible').val();
		$('#deleteProdButton').on('click', function(e){
			e.preventDefault();
			$.ajax({
				method: "POST",
				url: url,
				data: {
					idProduct: idProduct
				},
			}).done(function(response){
				console.log(response);
				refreshNoVisibleProducts();
			});
		});
	});
}
/*Fin de la fonction suppression de produit dans les produits non classés*/


/*Fonction de mise en non visibilité d'un produit*/
function noVisibilityProduct(){
	$("ul#list-categories").on('click', 'button[class="close sleep products"]', function(e) {
		e.preventDefault();
		var idProd = $(this).attr('data-id');
		var idCategory = $(this).attr('data-cat');
		var url = $('#sleep_product').val();
		console.log(idCategory);
		$('#sleepProductButton').on('click', function(e){
			e.preventDefault();
			$.ajax({
				method: "POST",
				url: url,
				data: {
					idProduct: idProd
				},
			}).done(function(response) {
				refreshProducts(idCategory);
			});
		});
	});	
}
/*Fin de la fonction de mise en non visibilité d'un produit*/


/*Fonction de remise en visibilité d'un produit*/
function visibilityProduct(){
	$("ul#list-noVisible").on('click', 'button[class="close display products"]', function(e) {
		e.preventDefault();
		var idProd = $(this).attr('data-id');
		var url = $('#visibility_product').val();
		console.log(idProd);
		console.log(url);
		$('#activateProductButton').on('click', function(e){
			e.preventDefault();
			$.ajax({
				method: "POST",
				url: url,
				data: {
					idProduct: idProd
				},
			}).done(function(response) {
				refreshNoVisibleProducts();
			});
		});
	});	
}
/*Fin de la fonction de remise en visibilité d'un produit*/


/*Fonction de mise à la une d'un produit*/
/*function highlightProduct(){
	$("ul#list-categories").on('click', 'button[class="close highlight products"]', function(e) {
		$idProduct = $(this).attr('data-id');
		if($(this).html("span.class='glyphicon glyphicon-star'")){
			alert('étoile pleine');
			$(this).html("<span class='glyphicon glyphicon-star-empty'></span>");
		} else if ($(this).html("span.class='glyphicon glyphicon-star-empty'")){
			alert('étoile vide');
			$(this).html("<span class='glyphicon glyphicon-star'></span>");
		} 
	});
}*/
/*Fin de la fonction de mise à la une d'un produit*/


/*Fonction de récupération des images produits HighLight en bdd*/
/*function getHighlightProducts(){
	url = $("#getHighlightProducts").val();
	$.ajax({
		method: "GET",
		url: url,
	}).done(function(r){
		response.productsHighlight.forEach(function(element, key){

		})

	});
}*/
/*Fin de la fonction de récupération des images produits HighLight en bdd*/


/*Fonction d'affichage des produits highlight en page d'accueil*/
/*function displayHighlightProducts(){

}*/
/*Fin de la fonction d'affichage des produits highlight en page d'accueil*/


/*Fonction agrandissement image mouseover*/
function showBiggerImg(){
	$('div.thumbnails .img-responsive').mouseover(function(e){
		console.log($(this).attr('src'));
        var fullpic = $('div.fullpic .fullpic');
        $('div.fullpic .fullpic').attr('src', $(this).attr('src'));
        if(fullpic.attr('src') === "/foodtruck/w/public/assets/img/highlight4.jpg") {
        	$("figcaption.figure-caption.highlightFullpic h3").html('Un peu de poulet?');
        	$("figcaption.figure-caption.highlightFullpic p").html('De délicieux morceaux de poulet rôti agrémentés d\'emmental...');
        } else if(fullpic.attr('src') === "/foodtruck/w/public/assets/img/highlight3.jpg") {
        	$("figcaption.figure-caption.highlightFullpic h3").html('Eternelle Pizza Roma');
        	$("figcaption.figure-caption.highlightFullpic p").html('Un grand classique revisité pour l\'occasion. Le tout parsemé de basilic frais');
        } else if(fullpic.attr('src') === "/foodtruck/w/public/assets/img/highlight2.jpg") {
        	$("figcaption.figure-caption.highlightFullpic h3").html('La Vésuvia');
        	$("figcaption.figure-caption.highlightFullpic p").html('Laissez-vous charmer par son goût unique délicatement relevé. Un bonheur pour les papilles...');
        } else if(fullpic.attr('src') === "/foodtruck/w/public/assets/img/highlight1.jpg") {
        	$("figcaption.figure-caption.highlightFullpic h3").html('Peperonni mon ami');
        	$("figcaption.figure-caption.highlightFullpic p").html('De fines tranches de poivrons et de généreux morceaux de cheddar. A manger d\'urgence!');
        }
	});
}

/*Fin de la fonction agrandissement image mouseover*/



/*Fonction de rafraîchissement des infos produit*/
function refreshInfosProduct($idProduct){
	var url = $('#get_infos_by_idProd_ajax').val();
	var idProd = $idProduct;
	/*console.log(url);
	console.log(idProd);*/
	$.ajax({
		method: "GET",
		url: url,
		data: {
			idProd: idProd,
		}
	}).done(function(response){
		/*console.log(response);*/
		var infos = "";
		var ingredients = "";
		response.ingredients.forEach(function(element, key){
			ingredients += '<span class="ingredientName" data-idIngredient="' + element.ingredientId + '">' + element.ingredientName + '</span> ';
		});
		var url = $('#get_img_route').val();
		response.infosProduct.forEach(function(element, key){
			infos += '<div class="globalContentInfos"><div class="productName">' + element.productName + '<button type="button" class="close pencil productsUpdate" data-name="' + element.productName + '"><span class="glyphicon glyphicon-pencil"></span></button></div><div class="productPicture"><img src="' + url + element.productPicture + '" alt="' + element.productName + '" width="200" height="200"><button type="button" class="close folder productsUpdate"><span class="glyphicon glyphicon-folder-open"></span></button></div><div class="productDescription">' + element.productDescription + '<button type="button" class="close pencil productsUpdate" data-description="' + element.productDescription + '"><span class="glyphicon glyphicon-pencil"></span></button></div><div class="productIngredients">' + ingredients + '<button type="button" class="close pencil productsUpdate"><span class="glyphicon glyphicon-pencil"></span></button></div><div class="productPrice">Prix : ' + element.productPrice + ' €<button type="button" class="close pencil productsUpdate" data-price="' + element.productPrice + '"><span class="glyphicon glyphicon-pencil"></span></button></div><div class="productCategory">Catégorie : ' + element.categoryName + '<button type="button" class="close pencil productsUpdate" data-category="' + element.categoryId + '"><span class="glyphicon glyphicon-pencil"></span></button></div></div>';
		});
		$('div.prodInfos').html(infos);
	});
}
/*Fin de la fonction de rafraîchissement des infos produit*/


/*Fonction d'affichage des caractéristiques des produits pour modifications*/
function updateProduct(){
	$("ul#list-categories").on('click', 'button[class="close pencil products"]', function(e){
		e.preventDefault();
		var idProduct = $(this).data('id');
		refreshInfosProduct(idProduct);
		/*$("form#updateProd").submit(function(e) {
			console.log(idProduct);
			var newName = $('input#updateProductName').val();
			console.log(newName);*/
			/*refreshInfosProduct(idProduct)*/;

			/*e.preventDefault();
			var form = $(this);
			var url = form.attr("action");
			var updateCategory = $('#updateCategory').val();
			$.ajax({
				method: "POST",
				url: url,
				data: { 
					updateCategory: updateCategory,
					idCategory: idCategory,
				},
			}).done(function(response){
				$("#updateCat").modal("hide");
				console.log(response);
				refreshCategories();
			})
		});*/
	});

}

/*Fin de la fonction d'affichage des caractéristiques des produits pour modifications*/


/*Fonction d'initialisation des tokenfields*/
function initialiseToken(field, source){
	$(field).tokenfield({
		autocomplete: {
			source: source,
			minLength: 2,
			delay: 100
		},
		showAutocompleteOnFocus: true
	});

	$(field).on('tokenfield:createtoken', function (event) {
		var existingTokens = $(this).tokenfield('getTokens');
		$.each(existingTokens, function(index, token) {
			if (token.value === event.attrs.value)
				event.preventDefault();
		});
	});
};
/*Fin de la fonction d'initialisation des tokenfields*/


/*Fonction effacement de champs de formulaire*/
function effacer(formulaire) {
	$(':input', + formulaire)
	.val('')
	.removeAttr('checked')
	.removeAttr('selected');
}
/*Fin de la fonction effacement de champs de formulaire*/


/*Fonction d'aperçu de l'image uploadée*/
function seeUploadPic(idForm){
	// A chaque sélection de fichier
	$(idForm/*'form#addProd'*/).find('input[name="productPicture"]').on('change', function (e) {
		var files = $(this)[0].files;

		if (files.length > 0) {
            // On part du principe qu'il n'y qu'un seul fichier
            // étant donné que l'on a pas renseigné l'attribut "multiple"
            var file = files[0],
            $image_preview = $('#image_preview');

            // Ici on injecte les informations recoltées sur le fichier pour l'utilisateur
            $image_preview.find('.thumbnail').removeClass('hidden');
            $image_preview.find('img').attr('src', window.URL.createObjectURL(file));
            $image_preview.find('h4').html(file.name);
            $image_preview.find('.caption p:first').html(file.size/1000 +' Ko');
        }

    });

    // Bouton "Annuler"
    $('#image_preview').find('button[type="button"]').on('click', function (e) {
    	e.preventDefault();

    	$('#my_form').find('input[name="image"]').val('');
    	$('#image_preview').find('.thumbnail').addClass('hidden');
    });
}
/*Fin de la fonction d'aperçu de l'image uploadée*/


/************Fin produits************/



$(function(){

	deleteProductEvent();
    priceSupplement();
    addProductEvent();
    searchProduct();
    map();

	refreshCategories();
	reorganiseCategories();
	addCategoryBdd();
	deleteCategorie();
	updateCategorie();
	
	addProductPlus();
	addProductBdd();
	seeMoreProductClick();
	seeUploadPic();	
	deleteProduct();
	deleteProductNonClasse();
	deleteProductNoVisible();
	noVisibilityProduct();
	visibilityProduct();


	showBiggerImg();
	    
});


/*------------------- Fin Menu-admin -------------------*/

