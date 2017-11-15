(function($){
  $(function(){

    $('.button-collapse').sideNav();

    $('.dropdown-button').dropdown({
      belowOrigin: true,
      alignment: 'left', 
      inDuration: 500,
      outDuration: 300,
      constrain_width: true,
      hover: false, 
      gutter: 1
    });

  }); // end of document ready
})(jQuery); // end of jQuery name space