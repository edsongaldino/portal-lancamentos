$(function(){
  'use strict';
  
	// Left Sidebar
	$('#menu-left').sideNav({
		menuWidth: 240, // Default is 240
		edge: 'left',
		closeOnClick: true // Closes side-nav on <a> clicks
	});
	// Right Sidebar
	$('#menu-right').sideNav({
		menuWidth: 240, // Default is 240
		edge: 'right',
		closeOnClick: false // Closes side-nav on <a> clicks
	});

	// Featured slider
	$('.featured-slider').slick({
		dots: true,
		arrows: false,
		autoplay: true,
	});
	
	// Pictures & Video widget slider
	if ($(window).width() > 767) {
		$('.widget-item-slider').slick({
			slidesToShow: 4,
			slidesToScroll: 1,
			prevArrow: '<span class="prev-arr"><i class="fa fa-chevron-left"></i></span>',
			nextArrow: '<span class="next-arr"><i class="fa fa-chevron-right"></i></span>',
		});
	} else {
		$('.widget-item-slider').slick({
			slidesToShow: 2,
			slidesToScroll: 1,
			prevArrow: '<span class="prev-arr"><i class="fa fa-chevron-left"></i></span>',
			nextArrow: '<span class="next-arr"><i class="fa fa-chevron-right"></i></span>',
		});
	}
	
	// Gallery slider
	$('.featured-gallery-slider').slick({
		dots: true,
		autoplay: true,
		prevArrow: '<span class="prev-arr"><i class="fa fa-chevron-left"></i></span>',
		nextArrow: '<span class="next-arr"><i class="fa fa-chevron-right"></i></span>',
	});
	
	// Swipebox gallery
	$( '.swipebox' ).swipebox();
	
	// Right sidebar tabs
	$('ul.tabs').tabs();

	// Scroll to top
	var winScroll = $(window).scrollTop();
	if (winScroll > 1) {
		$('#to-top').css({bottom:"10px"});
	} else {
		$('#to-top').css({bottom:"-100px"});
	}
	$(window).on("scroll",function(){
		winScroll = $(window).scrollTop();

		if (winScroll > 1) {
			$('#to-top').css({opacity:1,bottom:"30px"});
		} else {
			$('#to-top').css({opacity:0,bottom:"-100px"});
		}
	});
	$('#to-top').click(function(){
		$('html, body').animate({scrollTop: '0px'}, 800);
		return false;
	});



	// Atribui evento e função para limpeza dos campos
    $('#busca').on('input', limpaCampos);

    // Dispara o Autocomplete a partir do segundo caracter
    $( "#busca" ).autocomplete({
	    minLength: 2,
	    source: function( request, response ) {
	        $.ajax({
	            url: "consulta_json.php",
	            dataType: "json",
	            data: {
	            	acao: 'autocomplete',
	                parametro: $('#busca').val()
	            },
	            success: function(data) {
	               response(data);
	            }
	        });
	    },
	    focus: function( event, ui ) {
	        $("#busca").val( ui.item.titulo );
	        return false;
	    },
	    select: function( event, ui ) {
	        $("#busca").val( ui.item.titulo );
	        return false;
	    }
    })
    .autocomplete( "instance" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<a><b>Empreendimento: </b>" + item.nome + "<br><b>Construtora: </b>" + item.modalidade + " - <b> Endereço: </b>" + item.id_empreendimento + "</a><br>" )
        .appendTo( ul );
    };

	// Função para limpar os campos caso a busca esteja vazia
    function limpaCampos(){
       var busca = $('#busca').val();
    }


});