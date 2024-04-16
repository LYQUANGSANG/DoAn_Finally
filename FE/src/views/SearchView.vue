
<script setup lang="ts">
import ItemProduct from "@/components/product/ItemProduct.vue";
import { onMounted, ref, watch } from "vue";
import { macDestopData, macbookproData, macbookairData, imacData, macminiData, } from '../data';
import axios from 'axios';
import _ from 'lodash';
import { useRoute } from "vue-router";

let productView: any = ref([]);

let textSearh = ref(useRoute().params.text);

let groupProducts: any = ref([]);
let allData: any = ref([]);

onMounted(() => {
    textSearh.value = textSearh.value.replace('%20', ' ');
    let a: any[] = [];
    let data1 = _.filter(macDestopData, (f: any) => { return f.name === textSearh.value });
    let data2 = _.filter(macbookproData, (f: any) => { return f.name === textSearh.value });
    let data3 = _.filter(macbookairData, (f: any) => { return f.name === textSearh.value });
    let data4 = _.filter(imacData, (f: any) => { return f.name === textSearh.value });
    let data5 = _.filter(macminiData, (f: any) => { return f.name === textSearh.value });

    if (data1.length > 0) {
        data1.forEach((f: any) => {
            a.push(f);
        })
    }
    if (data2.length > 0) {
        data2.forEach((f: any) => {
            a.push(f);
        })
    }
    if (data3.length > 0) {
        data3.forEach((f: any) => {
            a.push(f);
        })
    }
    if (data4.length > 0) {
        data4.forEach((f: any) => {
            a.push(f);
        })
    }
    if (data5.length > 0) {
        data5.forEach((f: any) => {
            a.push(f);
        })
    }

    allData.value = a;
    productView.value = a;
    groupProducts.value = _.chunk(productView.value, 4);
});

// watch(allData, (subId: any) => {
//     if (subId == 0) {
//         reloadData();
//     }
// });

const reloadData = () => {
    productView.value = allData.value;
    groupProducts.value = _.chunk(productView.value, 4);
}

const sort1 = () => {
    productView.value = _.filter(allData.value, ((f: any) => { return f.price >= 10000001 && f.price <= 20000000 }));
    groupProducts.value = _.chunk(productView.value, 4);
}

const sort2 = () => {
    productView.value = _.filter(allData.value, ((f: any) => { return f.price >= 20000001 && f.price <= 30000000 }));
    groupProducts.value = _.chunk(productView.value, 4);
}

const sort3 = () => {
    productView.value = _.filter(allData.value, ((f: any) => { return f.price >= 30000001 && f.price <= 40000000 }));
    groupProducts.value = _.chunk(productView.value, 4);
}

const sort4 = () => {
    productView.value = _.filter(allData.value, ((f: any) => { return f.price >= 40000001 }));
    groupProducts.value = _.chunk(productView.value, 4);
}

const sortIncrease = () => {
    productView.value = _.sortBy(productView.value, 'price', 'DESC');
    groupProducts.value = _.chunk(productView.value, 4);
}

const sortReduce = () => {
    productView.value = _.sortBy(productView.value, item => -item.price);
    groupProducts.value = _.chunk(productView.value, 4);
}

</script>

<template>
    <main>
        <div class="product_view">
            <div class="title-link col">
                <RouterLink to="/">Trang chủ</RouterLink>
                <p> > </p>
                <RouterLink to="/">Bạn đang tìm: {{ textSearh }}</RouterLink>
            </div>
            <div>
                <h2 class="fw-bold fs-6 text-black d-block lh-base mb-2">Kết quả tìm kiếm: {{ textSearh }}</h2>
                <div class="d-flex flex-column flex-md-row justify-content-between">
                    <div class="">
                        <div id="sort-wrapper">
                            <div id="sort-wrap">
                                <div class="btn-sort-wrap d-flex flex-row flex-wrap fs-14px">
                                    <button class="me-2 my-1 btn-find-price" @click="reloadData()">
                                        <span class="d-flex flex-row align-items-center">
                                            <i class="bi bi-laptop me-1"></i>
                                            <span>Mặc định</span>
                                        </span>
                                    </button>
                                    <button class="me-2 my-1 btn-find-price" @click="sort1()">
                                        <span class="d-flex flex-row align-items-center">
                                            <i class="bi bi-laptop me-1"></i>
                                            <span>10 - 20 triệu</span>
                                        </span>
                                    </button>
                                    <button class="me-2 my-1 btn-find-price" @click="sort2()">
                                        <span class="d-flex flex-row align-items-center">
                                            <i class="bi bi-laptop me-1"></i>
                                            <span>20 - 30 triệu</span>
                                        </span>
                                    </button>
                                    <button class="me-2 my-1 btn-find-price" @click="sort3()">
                                        <span class="d-flex flex-row align-items-center">
                                            <i class="bi bi-laptop me-1"></i>
                                            <span>30 - 40 triệu</span>
                                        </span>
                                    </button>
                                    <button class="me-2 my-1 btn-find-price" @click="sort4()">
                                        <span class="d-flex flex-row align-items-center">
                                            <i class="bi bi-laptop me-1"></i>
                                            <span>Trên 40 triệu</span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-shrink-0 mb-2 mb-md-0">
                        <div
                            class="btn-filter-wrap d-flex flex-row flex-wrap justify-content-between justify-content-md-start">
                            <div class="me-0 me-md-2">
                                <div class="dropdown btn-sort-wrap-new">
                                    <a class="my-1 btn btn-white btn-filter border-0 fs-14px dropdown-toggle d-flex align-items-center flex-row btn-find-price"
                                        href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Sắp xếp theo </a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-item" @click="sortIncrease()">
                                            <span>Giá Thấp - Cao</span>
                                        </li>
                                        <li class="dropdown-item" @click="sortReduce()">
                                            <span>Giá Thấp - Cao</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" row">
                <div class="group-item" v-for="groupItem in groupProducts">
                    <RouterLink class="item" :to="'/product-detail/' + item.id" v-for="item in groupItem">
                        <!-- <ItemProduct :name="item.name" :img="'http://127.0.0.1:8000/' + item.image" :info="item.memo" :price="item.price">
                        </ItemProduct> -->
                        <ItemProduct :name="item.name" :img="item.image" :info="item.memo" :price="item.price">
                        </ItemProduct>
                    </RouterLink>
                </div>
            </div>
        </div>
    </main>
</template>

<style>
main {
    width: 100%;
    height: auto;
    position: relative;
    background: #E9E9E9;
}

.product_view {
    line-height: 1.5;
    max-width: 1320px;
    width: 1320px;
    margin: auto;
    padding: 30px 0px 20px 0px;
    min-height: 600px;
}

a {
    text-decoration: none;
}

.product_view .title-link {
    width: 100%;
    padding-top: 10px;
    display: flex;
    flex-direction: row;
}

.product_view .title-link p {
    color: black;
    font-size: 18px;
    padding: 3px 5px;
}

.product_view .title-link a {
    color: black;
    text-decoration: none;
    font-size: 18px;
}

.product_view .title-link a:hover {
    background: #E9E9E9;
    color: hsla(160, 100%, 37%, 1);
}

.group-item {
    display: flex;
    padding-top: 15px;
}

.group-item .item {
    padding: 5px;
}

.group-item .item:not(:last-child) {
    margin-right: 20px;
}

.btn-find-price {
    background: white;
    border: 1px solid white;
    border-radius: 10px;
}

.btn-find-price:hover {
    background: hsla(160, 100%, 37%, 1);
    color: white;
}
</style>
