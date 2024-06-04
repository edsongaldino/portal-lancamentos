var OfertaWizard = function (oferta) {
  this.oferta = oferta;
};

OfertaWizard.prototype.iniciar = function () {

  var $this = this;

  var $w10finish = $('#w10').find('ul.pager li.finish'),
    $w10validator = $("#w10 form").validate({
    highlight: function(element) {
      $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
      $(element).closest('.form-group').removeClass('has-error');
      $(element).remove();
    },
    errorPlacement: function( error, element ) {
      element.parent().append( error );
    }
  });

  $('#w10').bootstrapWizard({
    tabClass: 'wizard-steps',
    nextSelector: 'ul.pager li.next',
    previousSelector: 'ul.pager li.previous',
    firstSelector: null,
    lastSelector: null,
    onNext: function( tab, navigation, index, newindex ) {
      if (index == 1) {
        return $this.oferta.validacoes_aba_unidade();
      }

      if (index == 2) {          
        return $this.oferta.validacoes_aba_valor();
      }

      if (index == 3) {          
        return $this.oferta.validacoes_aba_negociacao();
      }

      return true;
    },
    onTabClick: function( tab, navigation, index, newindex ) {
      if ( newindex == index + 1 ) {
        return this.onNext( tab, navigation, index, newindex);
      } else if ( newindex > index + 1 ) {
        return false;
      } else {
        return true;
      }
    },
    onTabChange: function( tab, navigation, index, newindex ) {
      var $total = navigation.find('li').length - 1;
      $w10finish[ newindex != $total ? 'addClass' : 'removeClass' ]( 'hidden' );
      $('#w10').find(this.nextSelector)[ newindex == $total ? 'addClass' : 'removeClass' ]( 'hidden' );
    },
    onTabShow: function( tab, navigation, index ) {
      var $total = navigation.find('li').length - 1;
      var $current = index;
      var $percent = Math.floor(( $current / $total ) * 100);
      $('#w10').find('.progress-indicator').css({ 'width': $percent + '%' });
      tab.prevAll().addClass('completed');
      tab.nextAll().removeClass('completed');
    }
  });
}