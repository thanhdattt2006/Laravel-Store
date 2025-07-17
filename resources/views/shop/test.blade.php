@foreach($products as $product)
            
<td>           
                <div class="single-product">
                    <div class="product-details">
                        <div class="prd-bottom">
                            <a href="" class="social-info">
                                <span class="ti-bag"></span>
                                <p class="hover-text">add to bag</p>
                            </a>
                            <a href="" class="social-info">
                                <span class="lnr lnr-heart"></span>
                                <p class="hover-text">Wishlist</p>
                            </a>
                            <a href="{{ url('/shop/productDetails/' . $product->id) }}" class="social-info">
                                <span class="lnr lnr-move"></span>
                                <p class="hover-text">view more</p>
                            </a>
                        </div>
                    </div>
                </div>

            </td>
            
            @endforeach
            <div class="prd-bottom">
									<a href="" class="social-info">
										<span data-id="{{ $product->id }}" class="ti-bag"></span>
										<p class="hover-text">add to bag</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-heart"></span>
										<p class="hover-text">Wishlist</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-sync"></span>
										<p class="hover-text">compare</p>
									</a>
									<a href="{{ url('/shop/productDetails/' . $product->id) }}" class="social-info">

										<span class="lnr lnr-move"></span>
										<p class="hover-text">view more</p>
									</a>
								</div>