<script setup lang="ts">
import { formatPrice } from '../../common/number';

const props = defineProps({
    name: {
        type: String,
        default: () => 'Error Data'
    },
    img: {
        type: String,
        default: () => 'https://cuocsongdungnghia.com/wp-content/uploads/2018/05/loi-hinh-anh.jpg'
    },
    info: {
        type: String,
        default: () => 'Error Data'
    },
    price: {
        type: String,
        default: () => '0'
    }
});

</script>

<template>
    <div class="item-product text-center product-count-1">
        <div class="image-box">
            <img :src="props.img" width="300" height="250" alt="">
        </div>
        <div class="product-name">
            <h3 class="fs-6">
                <strong style="color: black;" data-bold="2" class="bold_title">{{ props.name }}</strong>
                <span style="color: black;" class="normal_title append_status">{{ props.info }}</span>
            </h3>
        </div>
        <div class="price-box">
            <strong class="fs-5 price_set_23827">{{ formatPrice(props.price) }} ₫</strong>
        </div>
    </div>
</template>

<style scoped>
.item-product {
    width: 315px;
    background: #FFFFFF;
    padding: 15px;
    border-radius: 10px;
    position: relative;
    height: 100%;
    cursor: pointer;
}

.item-product:hover {
    border-radius: 10px;
}

.normal_title {
    font-weight: 300;
    margin-top: 3px;
    font-size: 14px;
    max-height: 25px;
    height: 25px;
}

.product-name {
    cursor: pointer;
    margin-top: 10px;
}

.bold_title,
.normal_title {
    display: block;
}

.price-box {
    padding: 10px 0px;
    cursor: pointer;
    margin-bottom: 0px;
}

.price-box strong {
    color: red;
}
</style>
