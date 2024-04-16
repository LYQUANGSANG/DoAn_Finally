<script setup lang="ts">
import { onMounted, ref, type PropType } from 'vue';
import ItemProductVue from './ItemProduct.vue';
import { macbookproData, macbookairData, imacData, macminiData, macDestopData, colorProduct } from '@/data';
import axios from 'axios';
import _ from 'lodash';
import router from '@/router';


const props = defineProps({
    object: {
        type: Object,
        required: true,
    }
});

let groupProducts: any = ref([]);
let products: any = ref([]);

onMounted(() => {
    // getData();

    if (props.object.name === 'iMac') {
        groupProducts.value = _.chunk(imacData, 4);
        products.value = groupProducts.value.length > 0 ? groupProducts.value[0] : [];
    } else if (props.object.name === 'Mac Mini') {
        groupProducts.value = _.chunk(macminiData, 4);
        products.value = groupProducts.value.length > 0 ? groupProducts.value[0] : [];
    }
    else if (props.object.name === 'Mac Desktop') {
        groupProducts.value = _.chunk(macDestopData, 4);
        products.value = groupProducts.value.length > 0 ? groupProducts.value[0] : [];
    } else {
        groupProducts.value = _.chunk(macbookproData, 4);
        products.value = groupProducts.value.length > 0 ? groupProducts.value[0] : [];
    }
});

// const getData = () => {
//     axios.get('http://127.0.0.1:8000/api/categories/' + props.object.id)
//         .then((response: any) => {
//             groupProducts.value = _.chunk(response.data, 4);
//         })
//         .catch((error: any) => {
//             console.error(error);
//         });
// };

const viewAll = (param: string, subId?: number) => {
    if (subId) {
        router.push('/product/' + param.replace(' ', '') + '/' + subId);
        return;
    }
    router.push('/product/' + param.replace(' ', '') + '/' + 0);
}

</script>

<template>
    <div class="group-product text-center">
        <h2 class="title fs-3 mb-1 mb-lg-2 d-flex align-items-center justify-content-center bold_title">
            <strong class="bi bi-apple bold_title">{{ props.object.name }}</strong>
        </h2>
        <div class="slick-sub-cat">
            <div class="slick-sub-cat-item" v-for="sub in object.sub_categories"
                @click="viewAll(props.object.name, sub.id)">
                <span>{{ sub.name
                }}</span>
            </div>
        </div>
        <div class="col">
            <div class="group-item">
                <RouterLink class="item" :to="'/product-detail/' + item.id" v-for="item in products">
                    <!-- <ItemProduct :name="item.name" :img="'http://127.0.0.1:8000/' + item.image" :info="item.memo" :price="item.price">
                        </ItemProduct> -->
                    <ItemProductVue :name="item.name" :img="item.image" :info="item.memo" :price="item.price">
                    </ItemProductVue>
                </RouterLink>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3 more">
            <span @click="viewAll(props.object.name, 0)">Xem tất cả {{ props.object.name }} >></span>
        </div>
    </div>
</template>

<style scoped>
.group-product {
    width: auto;
    height: auto;
    padding-top: 20px;
}

.group-product .slick-sub-cat {
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    justify-content: center;
    text-wrap: nowrap;
}

.group-product .slick-sub-cat .slick-sub-cat-item {
    padding: 5px;
}

.group-product .slick-sub-cat .slick-sub-cat-item span {
    display: block;
    background: #FFFFFF;
    padding: 6px 15px;
    border-radius: 1rem;
    color: var(--mo-grey-btn);
    transition: all 0.25s;
    cursor: pointer;
}

.group-product .slick-sub-cat .slick-sub-cat-item span:hover {
    background: hsla(160, 100%, 37%, 1);
    color: white;
}

.group-product .group-item {
    display: flex;
    padding-top: 15px;
}

.group-product .group-item .item {
    padding: 5px;
}

.group-product .group-item .item:not(:last-child) {
    margin-right: 20px;
}

.group-product .more {
    color: #2689FF;
    cursor: pointer;
}

.group-product .more:hover {
    color: hsla(160, 100%, 37%, 1);
}

a {
    text-decoration: none;
}
</style>
