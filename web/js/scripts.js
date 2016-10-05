// Back End Code


// Front End Code
$(document).ready(function(){

  $('.planet-description').click(function() {
    var coordinates = $(this).attr('id').split('_');
    var planet_name = $(this).children(".planet_name").text();
    if (!planet_name) {
        planet_name = "Unpopulated Space";
    }
    $('#destination_name').text(planet_name);
    $('#destination_coordinates').text('(' + coordinates[0] + ", " + coordinates[1] + ')');
  });

});
