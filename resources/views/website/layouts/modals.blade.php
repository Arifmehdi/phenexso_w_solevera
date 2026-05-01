<!-- QUICK VIEW MODAL -->
<!-- <div class="modal fade" id="quickViewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Product Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="quickViewContent" class="text-center py-5">
                    <p>Loading...</p>
                </div>
            </div>
        </div>
    </div>
</div> -->

<!-- MODAL AREA START (Quick View Modal) -->
<div class="ltn__modal-area ltn__quick-view-modal-area">
    <div class="modal fade" id="quickViewModal" tabindex="-1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                     <div class="ltn__quick-view-modal-inner">
                         <div class="modal-product-item" id="quickViewContent">
                            <p>Loading...</p>
                         </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MODAL AREA END -->

<!-- MODAL AREA START (Add To Cart Modal) -->
<div class="ltn__modal-area ltn__add-to-cart-modal-area">
    <div class="modal fade" id="add_to_cart_modal" tabindex="-1">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                     <div class="ltn__quick-view-modal-inner">
                         <div class="modal-product-item">
                            <div class="row">
                                <div class="col-12">
                                    <input type="hidden" id="cart_product_id">
                                    <div class="modal-product-img">
                                        <img id="cart_modal_img" src="" alt="Product">
                                    </div>
                                     <div class="modal-product-info">
                                         <h5 id="cart_modal_name"></h5>
                                         <p class="added-cart">
                                             <i class="fa fa-check-circle"></i> <span id="cart_modal_message"></span>
                                         </p>         
                                        <div class="btn-wrapper">
                                            <a href="{{ route('new.checkout') }}" class="theme-btn-1 btn btn-effect-1">View Cart</a>
                                        </div>
                                     </div>
                                     <div class="additional-info">
                                        <p>We want to give you <b>10% discount</b> for your first order, <br>  Use (LoveBroccoli) discount code at checkout</p>
                                        <div class="payment-method">
                                            <img src="{{asset('frontend/img/icons/payment.png') }}" alt="#">
                                        </div>
                                     </div>
                                </div>
                            </div>
                         </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MODAL AREA END -->

<!-- MODAL AREA START (Wishlist Modal) -->
<div class="ltn__modal-area ltn__add-to-cart-modal-area">
    <div class="modal fade" id="liton_wishlist_modal" tabindex="-1">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                     <div class="ltn__quick-view-modal-inner">
                         <div class="modal-product-item">
                            <div class="row">
                                <div class="col-12">
                                    <div class="modal-product-img">
                                        <img src="{{ asset('frontend/img/product/7.png') }}" alt="#">
                                    </div>
                                     <div class="modal-product-info">
                                        <h5><a href="#">Product Details</a></h5>
                                        <p class="added-cart"><i class="fa fa-check-circle"></i>  Successfully added to your Wishlist</p>
                                        <div class="btn-wrapper">
                                            <a href="{{ route('wishlist.index')}}" class="theme-btn-1 btn btn-effect-1">View Wishlist</a>
                                        </div>
                                     </div>
                                     <div class="additional-info d-none">
                                        <p>We want to give you <b>10% discount</b> for your first order, <br>  Use discount code at checkout</p>
                                        <div class="payment-method">
                                            <img src="{{ asset('frontend/img/icons/payment.png') }}" alt="#">
                                        </div>
                                     </div>
                                </div>
                            </div>
                         </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MODAL AREA END -->
