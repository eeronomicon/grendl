// Back End Code


// Front End Code
$(document).ready(function(){

  $('.planet-description').click(function() {
    var coordinates = $(this).attr('id').split('_');
    var planet_name = $(this).children(".planet_name").text();
    console.log(coordinates);
    console.log(planet_name);
  });

});
