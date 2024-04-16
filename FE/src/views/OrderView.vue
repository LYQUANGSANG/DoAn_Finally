<script setup lang="ts">
import { computed, onMounted, ref, type Ref } from 'vue';
import _ from 'lodash';
import { formatPrice } from '../common/number';
import { main } from '@popperjs/core';

const products: any = ref([{
    
}]);
const userId = '1';

onMounted(() => {
    let dataInStorage: any = localStorage.getItem(userId);
    products.value = JSON.parse(dataInStorage);
});

const remoteProduct = (product: any) => {
    products.value = _.filter(products.value, ((f: any) => {
        return f.subId !== product.subId;
    }));
    localStorage.setItem(userId, JSON.stringify(products.value));
}

const totalPrice = computed(() => {
    let result = 0;
    _.forEach(products.value, ((p: any) => result = result + (p.price * p.quantity)));
    return formatPrice(result);
});

</script>

<template>
    <main>
        <div class="cart">
            <h4>Đơn hàng đã mua.</h4>
            <div class="table-responsive mb-4 rounded-4">
                <table class="table table-cart align-middle fs-13px rounded-4 bg-white overflow-hidden mb-0">
                    <thead class="text-start text-muted fs-7 text-uppercase gs-0 mb-0">
                        <tr>
                            <th class="text-center fw-bold" style="min-width:40px;"></th>
                            <th class="text-start fw-bold" style="min-width: 400px;">Sản Phẩm</th>
                            <th class="text-center fw-bold" style="min-width: 130px;">Thời gian mua hàng</th>
                            <th class="text-end fw-bold" style="min-width: 130px;"></th>
                            <th class="text-center fw-bold" style="min-width: 250px;"></th>
                            <th class="text-end fw-bold" style="min-width: 130px;">Thành Tiền</th>
                            <th class="text-center fw-bold" style="min-width:50px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="product_cart_item" v-for="product in products"
                            data-key="42657357bf9210cc30ac587ca0e13700">
                            <td class="text-center">
                                <div class="cart_index">{{ products.indexOf(product) + 1 }}</div>
                            </td>
                            <td class="text-start">
                                <div class="d-flex flex-row align-items-center">
                                    <div class="d-none d-xl-block me-2">
                                        <div class="d-flex flex-column justify-content-center">
                                            <a class="product_link"
                                                href="https://macone.vn/macbook-air-2020-13-inch-apple-m1-8gb-ram-256gb-ssd-new/"
                                                target="_blank">
                                                <img class="mx-auto product_image" style="width: 70px;"
                                                    :src="product.image">
                                            </a>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-truncate- fw-bold product_title">{{ product.name }}</div>
                                        <div class="mt-1 rounded-2 bg-light px-2 pt-1">
                                            <div class="form-check m-0">
                                                <label class="form-check-label product_extra" data-number="390000"
                                                    for="goibh42657357bf9210cc30ac587ca0e13700">
                                                    x1
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">

                            </td>
                            <td class="text-end">
                            </td>
                            <td class="text-center">
                            </td>
                            <td class="text-end">
                                <div class="priceFormat total_price fw-bold">{{ formatPrice(product.price *
                                    product.quantity)
                                }} đ</div>
                            </td>
                            <td class="text-center">

                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">
                                <div class="d-flex align-items-center fw-bold"><span>Tổng giá trị đơn hàng</span></div>
                            </td>
                            <td colspan="2" class="text-end"><strong id="order_total"
                                    class="priceFormat fs-5 text-mo-green fw-bold">{{ totalPrice }}
                                    ₫</strong></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </main>
</template>

<style scoped>
main {
    width: 100%;
    height: auto;
    position: relative;
    background: #E9E9E9;
}

.cart {
    line-height: 1.5;
    max-width: 1320px;
    width: 1320px;
    margin: auto;
    padding: 50px 0px 20px 0px;
    min-height: 500px;
}

.cart .cart_detail {
    background: white;
    border: 1px solid white;
    border-radius: 5px;
    display: flex;
    flex-direction: row;
    width: 100%;
}

.fs-13px {
    font-size: 13px;
}

.btn_ship {
    width: 100%;
    border: none;
    background: #7CB643;
    color: white;
    padding: 15px 0px;
    border-radius: 10px;
}

.btn_ship:hover {
    opacity: 0.9;
}
</style>
