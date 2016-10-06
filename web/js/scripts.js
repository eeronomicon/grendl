// Back End Code
function getFuelCost(x1, y1, x2, y2) {
  var distance = Math.ceil(Math.sqrt(Math.pow(Math.abs(x1 - x2), 2) + Math.pow(Math.abs(y1 - y2), 2)));
  return distance * 10;
}

// Front End Code
$(document).ready(function(){

  $('#to_space').click(function() {
    if ($('#name').val()) {
      var startGameSound = new Audio('/media/GRENDL04.ogg');
      startGameSound.volume = 1.0;
      startGameSound.play();
      setTimeout(function() {
        $('#ship_name').submit();
      }, 2000);
    }
  });

  $('.planet-description').click(function() {
    var coordinates = $(this).attr('id').split('_');
    var location_x = $('#current_x').val();
    var location_y = $('#current_y').val();
    var fuel = getFuelCost(coordinates[1], coordinates[0], location_x, location_y);
    var current_fuel = $('#current_fuel').val();
    var planet_name = $(this).children('.planet_name').text();
    if (!planet_name) {
        planet_name = "Empty Space";
    }
    $('#destination_name').text(planet_name);
    $('#destination_coordinates').text('(' + coordinates[0] + ", " + coordinates[1] + ') Requires ' + fuel + ' Fuel');
    $('#destination_x').val(coordinates[1]);
    $('#destination_y').val(coordinates[0]);
    if (fuel > current_fuel) {
      $('#go_travel').prop('disabled', true);
    } else {
      $('#go_travel').prop('disabled', false);
    }
  });

});
