<?php
// Zmiana tekstu przycisku "Read more" na "Variations"
add_filter( 'woocommerce_product_add_to_cart_text', 'zmien_tekst_przycisku_woocommerce' ); 
function zmien_tekst_przycisku_woocommerce( $tekst ) {
    if ( 'Read more' === $tekst ) {
        return 'Variations';
    }
    return $tekst;
}
