// Back End Code
function getFuelCost(x1, y1, x2, y2) {
  var distance = Math.ceil(Math.sqrt(Math.pow(Math.abs(x1 - x2), 2) + Math.pow(Math.abs(y1 - y2), 2)));
  return distance * 10;
}

// Front End Code
$(document).ready(function(){

  $('.planet-description').click(function() {
    var coordinates = $(this).attr('id').split('_');
    var location_x = $('#current_x').val();
    var location_y = $('#current_y').val();
    var fuel = getFuelCost(coordinates[0], coordinates[1], location_x, location_y);
    var planet_name = $(this).children('.planet_name').text();
    if (!planet_name) {
        planet_name = "Unpopulated Space";
    }
    $('#destination_name').text(planet_name);
    $('#destination_coordinates').text('(' + coordinates[0] + ", " + coordinates[1] + ') Requires ' + fuel + ' Fuel');
    $('#destination_x').val(coordinates[1]);
    $('#destination_y').val(coordinates[0]);
  });

});
