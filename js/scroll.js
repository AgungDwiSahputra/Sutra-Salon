$('.scroll').on('click', function(e){

	var nunjukHref = $(this).attr('href');

	//Tangkap Elemen dari Href tersebut
	var elemenHref = $(nunjukHref);

	$('html, body').animate({
		scrollTop : elemenHref.offset().top - 50
	});

	e.preventDefault();
});