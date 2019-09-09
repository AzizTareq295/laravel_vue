import productLst from './components/product/list';
import producCreate from './components/product/create';
import checkout from './components/product/checkout';

export const routes = [
    {path: '/',component:productLst},
    {path: '/create',component:producCreate},
    {path: '/checkout',component:checkout},
]
