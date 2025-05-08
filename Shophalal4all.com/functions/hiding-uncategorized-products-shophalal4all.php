add_action( 'pre_get_posts', function( $query ) {
    if ( ! is_admin() && $query->is_main_query() && ( is_shop() || is_product_category() || is_product_tag() || is_search() ) ) {
        $tax_query = $query->get( 'tax_query' );
        $tax_query[] = array(
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => 'uncategorized',
            'operator' => 'NOT IN',
        );
        $query->set( 'tax_query', $tax_query );
    }
});