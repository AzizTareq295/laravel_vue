import productLst from './components/product/list';
import producCreate from './components/product/create';
import checkout from './components/product/checkout';
import product_list from './components/product/product_list';
import edit_product from './components/product/edit_product';

export const routes = [
    {path: '/',component:productLst},
    {path: '/create',component:producCreate},
    {path: '/checkout',component:checkout},
    {path: '/product_list',component:product_list},
    {path: '/edit_product/:id',component:edit_product},
]
