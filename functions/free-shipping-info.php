/**
 * Plugin Name: Stromk - Free Shipping Info
 * Description: Dynamicznie pokazuje klientowi, ile brakuje do darmowej dostawy w WooCommerce (AJAX + jQuery).
 * Author: Kajetan (Stromk)
 * Version: 1.0
 */


// AJAX: pobieranie sumy koszyka
function stromk_get_cart_total_ajax() {
    if (WC()->cart) {
        echo WC()->cart->get_cart_contents_total();
    }
    wp_die();
}
add_action('wp_ajax_get_cart_total', 'stromk_get_cart_total_ajax');
add_action('wp_ajax_nopriv_get_cart_total', 'stromk_get_cart_total_ajax');

// Dodaje JS do frontendu
function stromk_enqueue_free_shipping_script() {
    if (is_admin()) return;

    wp_register_script('stromk-free-shipping', '', [], '', true);
    wp_enqueue_script('stromk-free-shipping');

    $inline_script = "
    jQuery(function($) {
        function updateFreeShippingInfo() {
            var threshold = 150; // Próg darmowej dostawy

            // Ustawiam komunikat na 'Loading...' przed wykonaniem AJAX
            $('#free-shipping-info').text('Loading...');

            $.ajax({
                url: wc_cart_fragments_params.ajax_url,
                type: 'POST',
                data: { action: 'get_cart_total' },
                success: function(response) {
                    var cartTotal = parseFloat(response);
                    var remaining = threshold - cartTotal;

                    // Usuwam stary komunikat przed dodaniem nowego
                    $('#free-shipping-info').stop(true, true).fadeOut(200, function() {
                        if (remaining > 0) {
                            $(this).html('You miss <strong> $ ' + remaining.toFixed(2) +' </strong> for free delivery!');
                        } else {
                            $(this).html('<strong>You have free delivery!</strong>');
                        }
                        $(this).fadeIn(200);
                    });
                },
                error: function() {
                    $('#free-shipping-info').text('Data could not be downloaded.');
                }
            });
        }

        // Automatyczna aktualizacja na najważniejsze zdarzenia koszyka
        $(document.body).on('added_to_cart updated_cart_totals wc_fragments_refreshed', function() {
            updateFreeShippingInfo();
        });
        
        // Dodatkowa aktualizacja przy załadowaniu strony
        $(window).on('load', updateFreeShippingInfo);
    });
    ";
    wp_add_inline_script('stromk-free-shipping', $inline_script);
}
add_action('wp_enqueue_scripts', 'stromk_enqueue_free_shipping_script');
