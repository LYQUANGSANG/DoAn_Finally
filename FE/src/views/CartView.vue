<script setup lang="ts">
import { computed, onMounted, ref, type Ref } from 'vue';
import _ from 'lodash';
import { formatPrice } from '../common/number';
import { main } from '@popperjs/core';

const products: Ref<any[]> = ref([]);
const paymentsMomo = ref(false);
const userId = '1';

const name = ref('');
const phoneNumber = ref();
const mail = ref('');
const address = ref('');
const note = ref('');

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
            <h4>Giỏ hàng</h4>
            <div class="table-responsive mb-4 rounded-4">
                <table class="table table-cart align-middle fs-13px rounded-4 bg-white overflow-hidden mb-0">
                    <thead class="text-start text-muted fs-7 text-uppercase gs-0 mb-0">
                        <tr>
                            <th class="text-center fw-bold" style="min-width:40px;"></th>
                            <th class="text-start fw-bold" style="min-width: 400px;">Sản Phẩm</th>
                            <th class="text-center fw-bold" style="min-width: 130px;">Số Lượng</th>
                            <th class="text-end fw-bold" style="min-width: 130px;">Đơn Giá</th>
                            <th class="text-center fw-bold" style="min-width: 250px;">Màu Sắc</th>
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
                                                <input data-update="goibaohanh" data-key="42657357bf9210cc30ac587ca0e13700"
                                                    data-value="20491" type="checkbox"
                                                    class="typecover form-check-input goibh"
                                                    name="goibh42657357bf9210cc30ac587ca0e13700"
                                                    id="goibh42657357bf9210cc30ac587ca0e13700" value="1"
                                                    aria-invalid="false">
                                                <label class="form-check-label product_extra" data-number="390000"
                                                    for="goibh42657357bf9210cc30ac587ca0e13700">
                                                    Gói bảo hành MinApple Care + <span class="priceFormat"
                                                        data-number="390000">390.000 ₫</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="input-group d-flex flex-row align-items-center">
                                    <input data-update="qty" data-key="42657357bf9210cc30ac587ca0e13700" type="number"
                                        id="qty_42657357bf9210cc30ac587ca0e13700"
                                        name="qty[42657357bf9210cc30ac587ca0e13700]" min="1" max="100" aria-valuemax="100"
                                        aria-valuemin="1" class="quantity_number form-control border-0 bg-light shadow-none"
                                        :value="product.quantity" aria-invalid="false">
                                </div>
                            </td>
                            <td class="text-end">
                                <div class="priceFormat unit_price">{{ formatPrice(product.price) }} đ</div>
                            </td>
                            <td class="text-center">
                                <select data-update="color" data-key="42657357bf9210cc30ac587ca0e13700"
                                    name="color_options[42657357bf9210cc30ac587ca0e13700]"
                                    id="color_options_42657357bf9210cc30ac587ca0e13700"
                                    class="form-select color_options fs-14px" aria-invalid="false">
                                    <option v-for="color in product.color_info" :value="color.id"
                                        :selected="color.isSelect"> {{
                                            color.name }} + {{ color.price }} ₫</option>
                                </select>
                            </td>
                            <td class="text-end">
                                <div class="priceFormat total_price fw-bold">{{ formatPrice(product.price *
                                    product.quantity)
                                }} đ</div>
                            </td>
                            <td class="text-center">
                                <img @click="remoteProduct(product)" src="../assets/icon/ic_trash.svg" alt="Delete">
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">
                                <div class="d-flex align-items-center fw-bold"><span>Tổng đơn hàng (tạm tính)</span></div>
                            </td>
                            <td colspan="2" class="text-end"><strong id="order_total"
                                    class="priceFormat fs-5 text-mo-green fw-bold">{{ totalPrice }}
                                    ₫</strong></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="py-3 px-3 px-lg-4 rounded-4 bg-white">
                <div>
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <p><span class="wpcf7-form-control-wrap"><input size="40"
                                        class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control form-control-lg"
                                        placeholder="Họ và tên" value="" type="text" v-model="name"></span>
                            </p>
                        </div>
                        <div class="col-12 col-lg-4">
                            <p><span class="wpcf7-form-control-wrap"><input size="40"
                                        class="wpcf7-form-control wpcf7-tel wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-tel form-control form-control-lg"
                                        placeholder="Số điện thoại" value="" type="tel" v-model="phoneNumber"></span>
                            </p>
                        </div>
                        <div class="col-12 col-lg-4">
                            <p><span class="wpcf7-form-control-wrap"><input size="40"
                                        class="wpcf7-form-control wpcf7-email wpcf7-text wpcf7-validates-as-email form-control form-control-lg"
                                        aria-invalid="false" placeholder="Địa chỉ Email" value="" type="email"
                                        v-model="mail"></span>
                            </p>
                        </div>
                        <div class="col-12 col-lg-4">
                            <p><span class="wpcf7-form-control-wrap"><textarea cols="40" rows="2"
                                        class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required form-control form-control-lg"
                                        placeholder="Địa chỉ" style="display: inline-block;"
                                        v-model="address"></textarea></span>
                            </p>
                        </div>
                        <div class="col-12 col-lg-4">
                            <p><span class="wpcf7-form-control-wrap"><textarea cols="40" rows="2"
                                        class="wpcf7-form-control wpcf7-textarea form-control form-control-lg"
                                        placeholder="Ghi chú" style="display: inline-block;"
                                        v-model="note"></textarea></span>
                            </p>
                        </div>
                        <div class="col-12 col-lg-4">
                            <button data-bs-toggle="modal" data-bs-target="#payment" class="btn_ship">
                                <strong class="fs-4">Gửi đơn hàng</strong>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="payment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Thông tin đơn hàng</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <div class="info-7 cf6">
                                        <table class="table table-striped">
                                            <tr>
                                                <td>Họ tên</td>
                                                <td>{{ name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Số điện thoại</td>
                                                <td>{{ phoneNumber }}</td>
                                            </tr>
                                            <tr>
                                                <td>Địa chỉ gmail</td>
                                                <td>{{ mail }}</td>
                                            </tr>
                                            <tr>
                                                <td>Địa chỉ</td>
                                                <td>{{ address }}</td>
                                            </tr>
                                            <tr>
                                                <td>Ghi chú</td>
                                                <td>{{ note === '' ? 'Không có ghi chú' : note }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="fs-5">
                                        <span class="fw-bold">Tổng tiền: </span>
                                        <span class="fw-bold">{{ totalPrice }} ₫ </span>
                                    </div>
                                    <hr>
                                    <div class="fs-6">
                                        <p class="fw-bold">Hình thức thanh toán:</p>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="payments1" :checked="true">
                                            <label class="form-check-label" for="payments1">
                                                Thanh toán khi nhận hàng.
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="payments2">
                                            <label class="form-check-label" for="payments2">
                                                Thanh toán qua VnPay.
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div v-if="paymentsMomo">
                                    <img src="../assets/qrcode.png" width="200" height="200">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Xác nhận</button>
                        </div>
                    </div>
                </div>
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
