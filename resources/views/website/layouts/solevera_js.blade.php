<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function openWishlist() {
    document.getElementById("Wishlist").style.display = "block";
}
function closeWishlist() {
    document.getElementById("Wishlist").style.display = "none";
}
function openCart() {
    document.getElementById("Cart").style.display = "block";
}
function closeCart() {
    document.getElementById("Cart").style.display = "none";
}
function openSearch() {
    document.getElementById("Search").style.display = "block";
}
function closeSearch() {
    document.getElementById("Search").style.display = "none";
}

$(document).on('click', '.add-to-cart-btn', function(e) {
    e.preventDefault();
    var btn = $(this);
    var id = btn.data('id');
    var quantity = $('.quantity').val() || 1;

    $.ajax({
        url: "{{ route('cart.quick.add') }}",
        type: "GET",
        data: {
            id: id,
            quantity: quantity
        },
        success: function(res) {
            if(res.success) {
                // Update all cart counters on the page
                $('.dn-counter').filter(function() {
                    return $(this).siblings('.lni-shopping-basket').length > 0;
                }).text(res.cartCount);
                
                // Update cart sidebar content
                if (res.soleveraCartHtml) {
                    $('#Cart .right-ch-sideBar').html(res.soleveraCartHtml);
                }

                // Show success message
                Snackbar.show({
                    text: res.message,
                    pos: 'top-right',
                    showAction: false,
                    duration: 3000,
                    backgroundColor:'#151515'
                });

                // Open cart sidebar
                openCart();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: res.message || 'Something went wrong!',
                });
            }
        },
        error: function(xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Could not add item to cart. Please try again.',
            });
        }
    });
});

$(document).on('click', '.cart-remove-btn', function(e) {
    e.preventDefault();
    var btn = $(this);
    var id = btn.data('id');
    var url = "{{ route('cart.remove', ':id') }}";
    url = url.replace(':id', id);

    $.ajax({
        url: url,
        type: "GET",
        success: function(res) {
            if(res.success) {
                // Update all cart counters on the page
                $('.dn-counter').filter(function() {
                    return $(this).siblings('.lni-shopping-basket').length > 0;
                }).text(res.cartCount);
                
                // Update cart sidebar content
                if (res.soleveraCartHtml) {
                    $('#Cart .right-ch-sideBar').html(res.soleveraCartHtml);
                }

                Snackbar.show({
                    text: res.message,
                    pos: 'top-right',
                    showAction: false,
                    duration: 3000,
                    backgroundColor:'#151515'
                });
            }
        }
    });
});

$(document).on('click', '.add-to-wishlist', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        url: "{{ route('wishlist.add') }}",
        type: "POST",
        data: {
            product_id: id,
            _token: "{{ csrf_token() }}"
        },
        success: function(res) {
            if(res.status == 'success') {
                $('.dn-counter').filter(function() {
                    return $(this).siblings('.lni-heart').length > 0;
                }).text(res.wishlistCount);
                
                Snackbar.show({
                    text: res.message,
                    pos: 'top-right',
                    showAction: false,
                    duration: 3000,
                    backgroundColor:'#151515'
                });
            }
        }
    });
});
</script>
