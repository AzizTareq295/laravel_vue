<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
               <form @submit.prevent="edit_product()" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" class="form-control" v-model="product.product_name">
                    </div>
                    <div class="form-group">
                        <label>Product Price</label>
                        <input type="text" class="form-control" v-model="product.product_price">
                    </div>
                    <div class="form-group">
                        <label>Product Quantity</label>
                        <input type="text" class="form-control" v-model="product.product_qty">
                    </div>
                    <div class="form-group">
                        <label>Product Image</label>
                        <input type="file" class="form-control" @change="image_upload">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form> 
            </div>
        </div>
    </div>
</template>
<script>

import axios from 'axios';

export default {
    mounted(){
        this.$store.dispatch("singleProduct",this.$route.params.id);

        console.log(this.$route.params.id);
        
    },
    data(){
        return{
            product:{
                product_name: '',
                product_price: '',
                product_qty : '',
                product_image: '',
            }
            
        };
    },
    methods:{
        image_upload(e){
            let fileReader = new FileReader();
            fileReader.readAsDataURL(e.target.files[0]);
            

            fileReader.onload = (e) =>{
                this.product.product_image = e.target.result
            }


        },

        edit_product(){

            const config = {
                headers: {'content-type':'multipart/form-data'}
            }


            axios.put('/products/'+this.$route.params.id, {
                product_name : this.product.product_name,
                product_price:this.product.product_price,
          ভুভু      product_qty: this.product.product_qty,
                product_image: this.product.product_image
            })
            .then((res) => {
                swal({
                    title: "Product Updated",
                    text: "I will disappear.",
                    timer: 1000,
                    showConfirmButton: false
                });
            })
            .catch((err) => {
                console.log(err);
            })
        }
    },
    computed:{
        single_product(){
            return this.$store.getters.singleProduct
        }
    },
    watch:{
        single_product(val){
            this.product.product_name  = val[0].product_name,
            this.product.product_price = val[0].product_price,
            this.product.product_qty   = val[0].product_qty,
            this.product.product_image = val[0].product_image
        }
    }
}
</script>