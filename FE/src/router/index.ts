import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: HomeView,
    },
    {
      path: "/product-detail/:id",
      name: "product-detail",
      component: () => import("../views/ProductDetailView.vue"),
    },
    {
      path: "/cart",
      name: "cart",
      component: () => import("../views/CartView.vue"),
    },
    {
      path: "/product",
      name: "product",
      component: () => import("../views/ProductView.vue"),
    },
    {
      path: "/signup",
      name: "signup",
      component: () => import("../views/SignUpView.vue"),
    },
    {
      path: "/product/MacbookPro/:id",
      name: "MacbookPro",
      component: () => import("../views/MacbookProView.vue"),
    },
    {
      path: "/product/MacbookAir/:id",
      name: "MacbookAir",
      component: () => import("../views/MacbookAirView.vue"),
    },
    {
      path: "/product/iMac/:id",
      name: "iMac",
      component: () => import("../views/IMacView.vue"),
    },
    {
      path: "/product/MacMini/:id",
      name: "MacMini",
      component: () => import("../views/MacMiniView.vue"),
    },
    {
      path: "/product/MacDesktop/:id",
      name: "MacDesktop",
      component: () => import("../views/MacDesktopView.vue"),
    },
    {
      path: "/product/admin/addOrEdit",
      name: "AddOrEdit",
      component: () => import("../views/AddProductView.vue"),
    },
    {
      path: "/order/product",
      name: "OrderProduct",
      component: () => import("../views/OrderView.vue"),
    },
    {
      path: "/search/:text",
      name: "Search",
      component: () => import("../views/SearchView.vue"),
    },
  ],
});

export default router;
