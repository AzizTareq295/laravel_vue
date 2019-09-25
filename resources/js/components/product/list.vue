<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="d-inline">Product list  </h1>

                    <div class="carts">
                        <div class="cart-pop">
                            
                            <div class="shoppingcart"><span><i class="fas fa-shopping-cart"></i></span>{{getquantity}}</div>
                            <div class="cart-list">
                                <div class="cart-list-product">

                                    <div v-for="(cart, index) in getAllCart" class="cart-product mb-3 mt-3">
                                        <div class="cart-product-image">
                                            <img :src="'images/'+cart.product_image" alt="image" class="img-fluid">
                                        </div>
                                        <div class="cart-product-details">
                                            <h5>{{cart.product_name}}</h5>
                                            <span class="product-amount">{{cart.product_price}}</span>
                                        </div>
                                        <div class="cart-product-remove">
                                            <button type="button" @click="remove_cart(index)"><i class="fas fa-trash-alt"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="cart-footer">
                                    <div class="subtotal">
                                        <p>Sub Total : <span id="total_sum">
                                            {{getTotalAmount}}</span></p>
                                    </div>
                                    <div class="cart-button">
                                        <router-link to="/checkout" class="cart-checkout">Check Out</router-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            
            
            <div class="row">
                <div class="col-lg-3 mt-3" v-for='product in getallProducts'>
                    <div class="product-body">
                        <div class="product-image">
                            <img :src="'images/'+product.product_image" alt="image" class="img-fluid">
                            <div class="product-add-to-cart">
                                <button  @click="addtoCart(product.id)" class="btn"><i class="fas fa-cart-plus"></i></button>
                            </div>
                        </div>
                        <div class="product-description">
                            <h5>{{product.product_name}}</h5>
                            <span><i class="fas fa-dollar-sign"></i>{{product.product_price}}</span>
                        </div>
                    </div>
                </div>
            </div>


            
        </div>
    </div>
</template>
<script>
 import axios from 'axios'
    export default {
        data(){
            return{
                
            }
        },
        mounted() {
            this.$store.dispatch("allProducts")
            this.$store.dispatch("allCarts")
            
        },
       computed:{
           getallProducts()
           {
               return this.$store.getters.allproducts;
           },
           getAllCart()
           {
                return this.$store.getters.allcarts;
           },
           getTotalAmount()
           {
                return this.$store.getters.total_amount;
           },
           getquantity()
           {
               return this.$store.getters.quantity;
           }
       },
        methods:{
            addtoCart(id)
            {
                axios.get('/addtocart/'+id)
                    .then((response)=>{
                        console.log(response.data.carts,response.data.total_amount,response.data.quantity)
                         this.$store.commit('carts',response.data.carts)
                         this.$store.commit('total_amount',response.data.total_amount)
                         this.$store.commit('quantity',response.data.quantity)

                        });
            },

            remove_cart(id)
            {
                axios.get('/remove_cart/'+id)
                    .then((response) => {
                        console.log(response);

                        this.$store.commit('carts',response.data.carts);
                        this.$store.commit('total_amount',response.data.total_amount);
                        this.$store.commit('quantity',response.data.quantity);
                    })
            }
            
        }
    }
   
</script>