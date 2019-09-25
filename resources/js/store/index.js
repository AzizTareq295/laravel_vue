import axios from 'axios';

export default{
    state: {
        products :[],
        carts: [],
        total_amount : '',
        quantity: '',
        single_product : ''

    },
    getters:{
        allproducts(state){
            return state.products;
        },
        allcarts(state){
            return state.carts;
        },
        total_amount(state){
            return state.total_amount;
        },
        quantity(state){
            return state.quantity;
        },
        singleProduct(state){
            return state.single_product;
        }
    },
    actions:{
        allProducts(context){
            axios.get('/products')
                .then((response) => {
                    context.commit('products',response.data.products)
                })
        },
        allCarts(context){
            axios.get('/carts')
                .then((response) =>{
                    context.commit('carts',response.data.carts);
                    context.commit('total_amount',response.data.total_amount);
                    context.commit('quantity',response.data.quantity);
                })
        },
        singleProduct(context,id){
            axios.get('/products/'+id)
                .then((res) => {
                    context.commit('single_product',res.data.product)
                })
                .catch((err) => {
                    console.log(err);
                })
        }
    },
    mutations:{
        products(state,data){
            return state.products = data 
        },
        single_product(state,data){
            return state.single_product = data
        },
        carts(state,data){
            return state.carts = data
        },
        total_amount(state,data){
            return state.total_amount = data;
        },
        quantity(state,data){
            return state.quantity = data;
        }
    }
}