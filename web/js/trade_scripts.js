

$(document).ready(function() {
    // alert('hi');

    var resource_names = new Array('Ore', 'Grain', 'Livestock', 'Consumables', 'Heavy_Machinery', 'Consumer_Goods', 'Military_Hardware', 'Robots');
    resource_names.forEach(function(name) {
        $('#' + name + '_buy_input').on('input', function() {
            var max_quantity = parseInt($('#' + name + '_planet_quantity').text());
            $(this).val(checkCargoSpace($(this).val()));
            $(this).val(creditCheck($('#' + name + '_price').text(), $(this).val()));
            if ($(this).val() > max_quantity) {
                $(this).val(max_quantity);
            }
            var value = $(this).val() * $('#' + name + '_price').text();
            $('#' + name + '_buy_price').text(value);
            if (value <= 0) {
                $('#' + name + '_buy_price').parent().addClass('black_text');
                $('#' + name + '_buy_price').parent().removeClass('red_text');
            } else {
                $('#' + name + '_buy_price').parent().removeClass('black_text');
                $('#' + name + '_buy_price').parent().addClass('red_text');
            }
        });

        $('#' + name + '_sell_input').on('input', function() {
            var max_quantity = parseInt($('#' + name + '_ship_quantity').text());
            if ($(this).val() > max_quantity) {
                $(this).val(max_quantity);
            }
            var value = $(this).val() * $('#' + name + '_price').text();
            $('#' + name + '_sale_price').text(value);
            if (value <= 0) {
                $('#' + name + '_sale_price').parent().addClass('black_text');
                $('#' + name + '_sale_price').parent().removeClass('green_text');
            } else {
                $('#' + name + '_sale_price').parent().removeClass('black_text');
                $('#' + name + '_sale_price').parent().addClass('green_text');
            }
        });

        $('#' + name + '_sell_input').click('input', function() {
            var max_quantity = parseInt($('#' + name + '_ship_quantity').text());
            $(this).val(max_quantity);
            var value = $(this).val() * $('#' + name + '_price').text();
            $('#' + name + '_sale_price').text(value);
            if (value <= 0) {
                $('#' + name + '_sale_price').parent().addClass('black_text');
                $('#' + name + '_sale_price').parent().removeClass('green_text');
            } else {
                $('#' + name + '_sale_price').parent().removeClass('black_text');
                $('#' + name + '_sale_price').parent().addClass('green_text');
            }
        });

        $('#' + name + '_buy_input').click('input', function() {
            var max_quantity = parseInt($('#' + name + '_planet_quantity').text());
            $(this).val(max_quantity);
            $(this).val(checkCargoSpace($(this).val()));
            $(this).val(creditCheck($('#' + name + '_price').text(), $(this).val()));
            var value = $(this).val() * $('#' + name + '_price').text();
            $('#' + name + '_buy_price').text(value);
            if (value <= 0) {
                $('#' + name + '_buy_price').parent().addClass('black_text');
                $('#' + name + '_buy_price').parent().removeClass('red_text');
            } else {
                $('#' + name + '_buy_price').parent().removeClass('black_text');
                $('#' + name + '_buy_price').parent().addClass('red_text');
            }
        });
    });

    function checkCargoSpace(quantity) {
        var max_cargo = parseInt($('#cargo_capacity').text());
        var current_cargo = parseInt($('#cargo_load').text());

        var new_ore = parseInt($('#Ore_buy_input').val());
        var new_grain = parseInt($('#Grain_buy_input').val());
        var new_livestock = parseInt($('#Livestock_buy_input').val());
        var new_consumables = parseInt($('#Consumables_buy_input').val());
        var new_consumer_goods = parseInt($('#Consumer_Goods_buy_input').val());
        var new_heavy_machinery = parseInt($('#Heavy_Machinery_buy_input').val());
        var new_military_hardware = parseInt($('#Military_Hardware_buy_input').val());
        var new_robots = parseInt($('#Robots_buy_input').val());

        var new_cargo_total = new_ore + new_grain + new_livestock + new_consumables + new_consumer_goods + new_heavy_machinery + new_military_hardware + new_robots + current_cargo;

        if (new_cargo_total > max_cargo) {
            var subtract_me = new_cargo_total - max_cargo;
            quantity = quantity - subtract_me;
        }
        return quantity;
    };

    function creditCheck(price, quantity) {
        var available_credits = parseInt($('#bank').text());

        var new_ore = parseInt($('#Ore_buy_input').val());
        var new_grain = parseInt($('#Grain_buy_input').val());
        var new_livestock = parseInt($('#Livestock_buy_input').val());
        var new_consumables = parseInt($('#Consumables_buy_input').val());
        var new_consumer_goods = parseInt($('#Consumer_Goods_buy_input').val());
        var new_heavy_machinery = parseInt($('#Heavy_Machinery_buy_input').val());
        var new_military_hardware = parseInt($('#Military_Hardware_buy_input').val());
        var new_robots = parseInt($('#Robots_buy_input').val());

        var ore_price = parseInt($('#Ore_price').text());
        var grain_price = parseInt($('#Grain_price').text());
        var livestock_price = parseInt($('#Livestock_price').text());
        var consumables_price = parseInt($('#Consumables_price').text());
        var consumer_goods_price = parseInt($('#Consumer_Goods_price').text());
        var heavy_machinery_price = parseInt($('#Heavy_Machinery_price').text());
        var military_hardware_price = parseInt($('#Military_Hardware_price').text());
        var robots_price = parseInt($('#Robots_price').text());

        var ore_cost = ore_price * new_ore;
        var grain_cost =  grain_price * new_grain;
        var livestock_cost =  livestock_price * new_livestock;
        var consumables_cost =  consumables_price * new_consumables;
        var consumer_goods_cost =  consumer_goods_price * new_consumer_goods;
        var heavy_machinery_cost =  heavy_machinery_price * new_heavy_machinery;
        var military_hardware_cost =  military_hardware_price * new_military_hardware;
        var robots_cost =  robots_price * new_robots;

        var total_cost = ore_cost + grain_cost + livestock_cost + consumables_cost + consumer_goods_cost + heavy_machinery_cost + military_hardware_cost + robots_cost;

        if (available_credits <= total_cost) {
            return quantity;
        } else {
            var credits_to_cut = total_cost - available_credits;
            var number_to_cut = Math.ceil(credits_to_cut / price);
            return quantity - number_to_cut;
        }
    }

});
