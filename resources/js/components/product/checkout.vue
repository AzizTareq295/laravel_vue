<template>
    <div v-if="getAllCart != '' " class="checkout">
        <div class="container">
            <div class="row my-5 justify-content-center">
                <div class="col-lg-7">
                    <div class="checkout-header">
                        <div class="invoice">
                            <div class="invoice-number">
                                <h5>Invoice : AB1354</h5>
                            </div>
                            <div class="invoice-date">
                                <h5>Date    : 2019-09-09</h5>
                            </div>
                            <div class="invoice-details">
                                <p>Billed To : Jhon Doe</p>
                                <p class="invoice-address">Address : Rasulbag R/A, Road No : 01 , House No : 05, Bakolia, Chittagong</p>
                                <p class="invoice-contact">Contact : +8801544322333</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 text-right">
                    <div class="checkout-logo">
                        <img src="images/invoice-icon-13.jpg" alt="logo" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(cart, index) in getAllCart" class="text-right">
                                <th scope="row">{{index}}</th>
                                <td class="text-left">{{cart.product_name}}</td>
                                <td>1</td>
                                <td>{{cart.product_price}}</td>
                            </tr>
                            <tr class="text-right">
                                <td colspan="2">Total</td>
                                <td>Quantity : {{getquantity}}</td>
                                <td>Price : {{getTotalAmount}}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="checkout-footer">
                        <h5>Note</h5>
                        <p>Payment Should Be Cash</p>
                        <p>Every Electronic Products have 1 Year Warrenty.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-else>
        <div class="container">
            <div class="row">
                <div class="col-lg-10">
                    <h5>You Don't Select any cart yet..</h5>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import axios from 'axios'

export default {
    mounted(){
        this.$store.dispatch("allCarts");
    },
    computed:{
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
    }

}
</script>