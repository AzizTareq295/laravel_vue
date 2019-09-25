<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="product-table-heading">
                    <h3>Product List</h3>
                    <span>Edit all products</span>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product Image</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody v-for="(product,index) in product_list">
                        <tr>
                            <th scope="row">{{index}}</th>
                            <td class="text-center"><img :src="'images/'+product.product_image" class="img-fluid" width="50" height="50"></td>
                            <td>{{product.product_name}}</td>
                            <td>{{product.product_qty}}</td>
                            <td>{{product.product_price}}</td>
                            <td>
                                <router-link :to="'/edit_product/'+product.id" class="btn btn-sm btn-success">Edit</router-link>
                                <button @click="delete_product(product.id)" class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>

import axios from 'axios'

export default {
    mounted(){
        this.$store.dispatch("allProducts")
    },
    methods:{
        delete_product(id){

            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this product!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    axios.delete('/products/'+id)
                        .then((res) =>{
                            this.$store.commit('products',res.data.products);
                            swal("Poof! Your product has been deleted!", {
                                icon: "success",
                            });
                        });
                    
                } else {
                    swal("Your product is safe!");
                }
            });
                
            

            
        }
    },
    computed:{
        product_list(){
           return this.$store.getters.allproducts;
        },
    }

}
</script>