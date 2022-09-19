<?php
function cart_total_product(){
    return App\Models\Cart::Where('cookie_id', Cookie::get('cookie_id'))->count();

}
function wish_list_count(){
    return App\Models\Wishlist::Where('user_id', auth()->id())->count();
}
function cart_product_view(){
    return App\Models\Cart::with(['Product:id,title,slug,thumbnail_img','Product.Attribute',])->Where('cookie_id', Cookie::get('cookie_id'))->get();

}
function wish_list_products(){
    return App\Models\Wishlist::with(['Product.Attribute',])
    ->Where('user_id', auth()->id())->get();
}   

?>