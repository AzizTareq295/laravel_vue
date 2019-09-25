<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
               <form @submit.prevent="form_submit()" enctype="multipart/form-data">
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
export default {
    mounted(){
        console.log("mounted");
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

        form_submit(){

            const config = {
                headers: {'content-type':'multipart/form-data'}
            }


            axios.post('/products', {
                product_name : this.product.product_name,
                product_price:this.product.product_price,
                product_qty: this.product.product_qty,
                image: this.product.product_image
            })
            .then((res) => {
                this.product.product_name = '',
                this.product.product_price = '',
                this.product.product_qty = '',
                this.product.product_image = '',

                swal({
                    title: "Product Uploaded",
                    text: "I will disappear.",
                    timer: 1000,
                    showConfirmButton: true
                });
            })
            .catch((err) => {
                console.log(err);
            })
            
            


        }
    }
}
</script>