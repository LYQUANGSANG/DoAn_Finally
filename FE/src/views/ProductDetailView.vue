<script setup lang="ts">
import SlideShowVue from "@/components/SlideShow.vue";
import ItemProductVue from './../components/product/ItemProduct.vue';

import { computed, onMounted, ref, watch } from "vue";
import { macbookproData, macbookairData, imacData, macminiData, macDestopData, colorProduct, macbookproDataDetail, cardProduct } from '../data';
import axios from 'axios';
import _ from 'lodash';
import { useRoute } from "vue-router";
import { formatPrice } from '../common/number';
import { v4 } from "uuid";

const paymentsMomo = ref(false);
const name = ref('');
const phoneNumber = ref();
const mail = ref('');
const address = ref('');
const note = ref('');

let model: any = ref({
    id: 0,
    name: "",
    image: "",
    memo: "",
    category_id: "",
    sub_category_id: "",
    status: 1,
    price: 0,
    isnew: true,
    views: 0,
    quantity_sold: 0,
    created_at: null,
    updated_at: null,
});
let modelDetail: any = ref({
    id: 0,
    product_id: 0,
    cpu: '',
    ram: 0,
    display_size: 0,
    display_memo: '',
    capacity_rom: 0,
    type_rom: null,
    camera: '',
    weight: '',
    battery: '',
    description: null,
    created_at: null,
    updated_at: null,
});
let colors: any = ref([]);
let productId = ref(useRoute().params.id);
let colorSelect: any = ref();
let relatedProducts: any = ref([]);

const totalPrice = computed(() => {
    if (colorSelect.value) {
        const color = _.find(colors.value, ((f: any) => { return f.id == colorSelect.value }));
        return model.value.price + color.price;
    }
    return model.value.price;
});

onMounted(() => {
    getAddData();
});

const getAddData = () => {
    if (parseInt(productId.value) <= 12) {
        model.value = _.find(macbookproData, ((f: any) => { return f.id == productId.value }));
    } else if (parseInt(productId.value) <= 24) {
        model.value = _.find(macbookairData, ((f: any) => { return f.id == productId.value }));
    }
    else if (parseInt(productId.value) <= 36) {
        model.value = _.find(imacData, ((f: any) => { return f.id == productId.value }));
    }
    else if (parseInt(productId.value) <= 48) {
        model.value = _.find(macminiData, ((f: any) => { return f.id == productId.value }));
    } else {
        model.value = _.find(macDestopData, ((f: any) => { return f.id == productId.value }));
    }



    modelDetail.value = _.find(macbookproDataDetail, ((f: any) => { return f.product_id == productId.value }));
    colors.value = _.filter(colorProduct, ((f: any) => { return f.product_id == 1 }));
    colorSelect.value = colors.value.id;
    // getDataProduct();
    relatedProducts.value = _.filter(macbookproData, ((f: any) => { return f.id != productId.value }));
    relatedProducts.value = _.chunk(relatedProducts.value, 2)[0];
}

watch(productId, () => {
    getAddData();
});

// const getData = () => {
//     axios.get('/api')
//         .then((response: any) => {
//             groupProducts.value = _.chunk(macbookproData, 4);
//             // groupProducts.value = _.chunk(response, 4);
//         })
//         .catch((error: any) => {
//             console.error(error);
//         });
// };

// const getDataProduct = () => {
//     axios.get('/api', { productId: productId.value })
//         .then((response: any) => {
//             model.value = response.data;
//         })
//         .then(() => {
//             axios.get('/api', { productId: productId.value })
//                 .then((colorProduct: any) => {
//                     modelDetail.value = colorProduct.data;
//                 })
//                 .then(() => {
//                     axios.get('/api', { productId: productId.value })
//                         .then((colorData: any) => {
//                             colors.value = colorData.data;
//                         })
//                 })
//                 .catch((error: any) => {
//                     console.error(error);
//                 });
//         })
//         .catch((error: any) => {
//             console.error(error);
//         });
// };

const handleColorClick = (colorId: string) => {
    colorSelect.value = colorId;
}

const addCard = () => {
    let userId = '1';
    const color: any[] = _.map(colors.value, ((m: any) => {
        return {
            id: m.id.toString(),
            name: m.name,
            price: m.price,
            isSelect: m.id == colorSelect.value ? true : false
        }
    }));

    const product = {
        id: model.value.id,
        subId: v4(),
        name: model.value.name,
        image: model.value.image,
        price: model.value.price,
        quantity: 1,
        color_info: color
    }
    cardProduct.push(product);

    let dataInStorage: any = localStorage.getItem(userId);

    if (dataInStorage) {
        dataInStorage = JSON.parse(dataInStorage);
        if (dataInStorage.length > 0) {
            dataInStorage.push(product);
            localStorage.setItem(userId, JSON.stringify(dataInStorage));
            return;
        }
    }

    const data = [product];
    localStorage.setItem(userId, JSON.stringify(data));
}

const reloadScreen = () => {
    setTimeout(() => {
        window.location.reload();
    }, 500);
}

const openMesseger = () => {
    window.open("https://www.messenger.com/e2ee/t/6477529642351847", "_blank");
}
</script>

<template>
    <main>
        <div class="product-detail">
            <div class="content">
                <div class="left-ct">
                    <div class="image">
                        <SlideShowVue :height="450" :product="true"></SlideShowVue>
                        <div class="info-2 fs-6">
                            MinApple là đại lý bán lẻ ủy quyền các nhà phân phối chính hãng Apple Việt Nam
                        </div>
                        <div class="info-3 fs-6">
                            <div>
                                Sản phẩm chính hãng Apple mới 100% nguyên seal.
                            </div>
                            <div>
                                Phụ kiện chính hãng gồm: hộp trùng imei, sạc, cable, sách hướng dẫn
                            </div>
                        </div>
                        <div style="margin-top: 15px;">
                            <strong data-bold="2" class="bold_title">Sản phẩm liên quan</strong>
                        </div>
                        <div class="relate-to">
                            <RouterLink class="item" :to="'/product-detail/' + item.id" v-for="item in relatedProducts">
                                <ItemProductVue :name="item.name" :img="'http://127.0.0.1:8000/' + item.image"
                                    :info="item.memo" :price="item.price" @click="reloadScreen()">
                                </ItemProductVue>
                            </RouterLink>
                        </div>
                    </div>
                </div>
                <div class="right-ct">
                    <h4>{{ model.name + ' ' + model.memo }}</h4>
                    <div>
                        <strong class="fs-5 price">{{ formatPrice(totalPrice) }}₫</strong>
                    </div>
                    <div class="info-1">
                        <div class="color">
                            <strong data-bold="2" class="bold_title">Màu sắc:</strong>
                            <div class="color-info">
                                <div v-for="color in colors" :style="{ background: color.code_color }"
                                    @click="handleColorClick(color.id)">
                                </div>
                            </div>
                        </div>
                        <div class="chat">
                            <span>Chat để được tư vấn</span>
                            <img src="@/assets/ic_zalo.webp" height="22px">
                            <img @click="openMesseger()" src="@/assets/ic_messenger.webp" height="22px">
                        </div>
                    </div>
                    <div class="info-4 cfs-6 bg-light">
                        <div>
                            <img src="@/assets/product/Apple_Care.png" height="70px">
                        </div>
                        <div class="care">
                            <div>
                                <strong>Gói bảo hành MinApple Care</strong>
                                <img src="@/assets/icon/ic-infomation.svg">
                            </div>
                            <div>Bảo hành 1 đổi 1 nguyên seal 30 ngày</div>
                            <div>
                                <strong class="price">390.000₫</strong>
                            </div>
                        </div>
                        <div class="action">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                            </div>
                        </div>
                    </div>
                    <div class="info-5 cf-6 bg-light">
                        <div>
                            <img src="@/assets/icon/ic-check.svg">
                            <span>Sản phẩm chính hãng Apple mới 100% nguyên seal.</span>
                        </div>
                        <div>
                            <img src="@/assets/icon/ic-check.svg">
                            <span>Giá đã bao gồm VAT.</span>
                        </div>
                        <div>
                            <img src="@/assets/icon/ic-check.svg">
                            <span>Bảo hành 12 tháng.</span>
                        </div>
                        <div>
                            <img src="@/assets/icon/ic-check.svg">
                            <span>Hỗ trợ phần mềm chọn đời.</span>
                        </div>
                    </div>
                    <div class="pay">
                        <div class="pay-left">
                            <button data-bs-toggle="modal" data-bs-target="#quickOrder">
                                <strong class="fs-4">MUA NGAY</strong>
                                <div>Giao hàng tận nhà hoặc nhận tại cửa hàng</div>
                            </button>
                        </div>
                        <div class="pay-right">
                            <button @click="addCard()">
                                <strong class="fs-4">THÊM VÀO GIỎ</strong>
                                <div>Chọn thêm món đồ khác</div>
                            </button>
                        </div>
                    </div>
                    <div class="info-6 cf-6 bg-light">
                        <div>
                            <img src="@/assets/icon/ic-rocket.svg">
                            <span>Giao hàng tận nhà toàn quốc</span>
                        </div>
                        <div>
                            <img src="@/assets/icon/ic_like_20px.svg">
                            <span>Thanh toán khi nhận hàng (nội thành).</span>
                        </div>
                        <div>
                            <img src="@/assets/icon/ic_calling_20px.svg">
                            <span>Gọi 0987 654 321 để được tư vấn mua hàng (Miễn phí).</span>
                        </div>
                    </div>
                    <div class="info-7 cf6 bg-light">
                        <strong>Thông số kỹ thuật</strong>
                        <table class="table">
                            <tr>
                                <td>Bộ xử lý CPU</td>
                                <td>{{ modelDetail.cpu }}</td>
                            </tr>
                            <tr>
                                <td>Bộ nhớ RAM</td>
                                <td>{{ modelDetail.ram }}GB</td>
                            </tr>
                            <tr>
                                <td>Màn hình</td>
                                <td>{{ modelDetail.display_size + ' ' + modelDetail.display_memo }}</td>
                            </tr>
                            <tr>
                                <td>Card màn hình</td>
                                <td>GPU 10 lõi</td>
                            </tr>
                            <tr>
                                <td>Ổ cứng</td>
                                <td>{{ modelDetail.capacity_rom }}GB SSD</td>
                            </tr>
                            <tr>
                                <td>Kích thước</td>
                                <td>{{ modelDetail.weight }}</td>
                            </tr>
                            <tr>
                                <td>Camera</td>
                                <td>{{ modelDetail.camera }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="title-link">
                <RouterLink to="/">Trang chủ</RouterLink>
                <p> > </p>
                <RouterLink to="/">MacBook Pro</RouterLink>
                <p> > </p>
                <RouterLink to="/">MacBook Pro 2023</RouterLink>
            </div>

            <div class="modal fade" id="quickOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">ĐẶT HÀNG NHANH</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <p><span class="wpcf7-form-control-wrap" data-name="hoten"><input size="40"
                                                class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control form-control-lg"
                                                id="hoten" aria-required="true" aria-invalid="false" placeholder="Họ và tên"
                                                type="text" name="hoten" v-model="name"></span>
                                    </p>
                                </div>
                                <div class="col-12">
                                    <p><span class="wpcf7-form-control-wrap" data-name="dienthoai"><input size="40"
                                                class="wpcf7-form-control wpcf7-tel wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-tel form-control form-control-lg"
                                                id="dienthoai" aria-required="true" aria-invalid="false"
                                                placeholder="Số điện thoại" type="tel" name="dienthoai"
                                                v-model="phoneNumber"></span>
                                    </p>
                                </div>
                                <div class="col-12">
                                    <p><span class="wpcf7-form-control-wrap" data-name="email"><input size="40"
                                                class="wpcf7-form-control wpcf7-email wpcf7-text wpcf7-validates-as-email form-control form-control-lg"
                                                id="email" aria-invalid="false" placeholder="Địa chỉ Email" type="email"
                                                v-model="mail" name="email"></span>
                                    </p>
                                </div>
                                <div class="col-12">
                                    <p><span class="wpcf7-form-control-wrap" data-name="diachi"><input size="40"
                                                class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control form-control-lg"
                                                id="diachi" aria-required="true" aria-invalid="false" placeholder="Địa chỉ"
                                                v-model="address" type="text" name="diachi"></span>
                                    </p>
                                </div>
                                <div class="col-12">
                                    <p><span class="wpcf7-form-control-wrap" data-name="ghichu"><textarea cols="40" rows="2"
                                                class="wpcf7-form-control wpcf7-textarea form-control form-control-lg"
                                                id="ghichu" aria-invalid="false" placeholder="Ghi chú" name="ghichu"
                                                v-model="note" style="display: inline-block;"></textarea></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#payment">Gửi đơn hàng</button>
                        </div>
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
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="payments1"
                                            :checked="true">
                                        <label class="form-check-label" for="payments1">
                                            Thanh toán khi nhận hàng.
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="payments2">
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
    </main>
</template>

<style scoped>
main {
    width: 100%;
    height: auto;
    position: relative;
    background: #E9E9E9;
}

.relate-to {
    width: 100%;
    position: relative;
    display: flex;
    flex-direction: row;
    padding: auto;
    margin-top: 15px;
}

.relate-to a:last-child {
    margin-left: 27px;
}

.info-7 table {
    margin-top: 15px;
    width: 100%;
    border-collapse: collapse;
}

.info-7 table tbody tr {
    margin-top: 20px;
}

.info-7 {
    margin-top: 15px;
    padding: 15px;
    border: 1px solid #DEE2E6;
    border-radius: 10px;
    position: relative;
    display: flex;
    flex-direction: column;
}

.info-6 {
    margin-top: 15px;
    position: relative;
    display: flex;
    flex-direction: column;
    border: 1px solid #DEE2E6;
    border-radius: 10px;
    padding: 15px 10px;
}

.info-6 span {
    padding-left: 5px;
}

.pay .pay-left {
    width: 50%;
    padding-right: 10px;
}

.pay .pay-left button {
    width: 100%;
    border: none;
    background: #7CB643;
    color: white;
    padding: 15px 0px;
    border-radius: 10px;
}

.pay .pay-left button:hover {
    opacity: 0.9;
}

.pay .pay-left button:active {
    opacity: 1.2;
}

.pay .pay-right {
    width: 50%;
    padding-left: 5px;
}

.pay .pay-right button {
    width: 100%;
    border: 1px solid #7CB643;
    background: (rgb(122, 182, 67) 100%);
    color: #7CB643;
    padding: 15px 0px;
    border-radius: 10px;
}

.pay .pay-right button:hover {
    background: white;
}

.pay {
    margin-top: 15px;
    position: relative;
    display: flex;
    flex-direction: row;
    width: 100%;
    min-width: 100%;
}

.info-5 span {
    padding-left: 5px;
}

.info-5 {
    margin-top: 10px;
    padding: 10px;
    border-radius: 10px;
    position: relative;
    display: flex;
    flex-direction: column;
}

.info-4 img {
    margin-right: 10px;
}

.info-4 .care img {
    margin-left: 5px;
}

.info-4 .action {
    height: 100%;
    margin-left: 214px;
    vertical-align: middle;
    padding-top: 20px;
}

.info-4 .action input {
    width: 45px;
    height: 25px;
}

.info-4 {
    margin-top: 15px;
    padding: 15px;
    border: 1px solid #DEE2E6;
    border-radius: 10px;
    position: relative;
    display: flex;
}

.info-3 {
    margin-top: 15px;
    text-align: center;
    padding: 15px 0px;
    border: 1px solid #DEE2E6;
    border-radius: 10px;
    background: white;

}

.info-2 {
    padding-top: 15px;
    text-align: center;
}

.color-info {
    position: relative;
    display: flex;
    flex-direction: row;
}

.color-info div {
    margin-left: 8px;
    width: 20px;
    height: 20px;
    border-radius: 10px;
    border: 1px solid #E8E8E8;
}

.color-info div::selection {
    border-color: #c2992e;
    box-shadow: 0 0 5px #c2992e;
}

.info-1 {
    position: relative;
    display: flex;
    flex-direction: row;
    box-sizing: border-box;
    float: left;
    margin-top: 10px;
}

.info-1 .color {
    position: relative;
    display: flex;
    flex-direction: row;
    box-sizing: border-box;
    width: 50%;
}

.info-1 .chat img {
    margin-left: 10px;
}

.info-1 .chat {
    margin-right: 0px;
    padding-right: 0px;
    box-sizing: border-box;
    float: right;
    padding-left: 112px;
    width: 50%;
}

.product-detail {
    width: 1320px;
    max-width: 1320px;
    display: flex;
    position: relative;
    flex-direction: column-reverse;
    margin: auto;
}

.product-detail .title-link {
    width: 100%;
    padding-top: 30px;
    display: flex;
    flex-direction: row;
}

.product-detail .title-link p {
    color: black;
    font-size: 18px;
    padding: 3px 5px;
}

.product-detail .title-link a {
    color: black;
    text-decoration: none;
    font-size: 18px;
}

.product-detail .title-link a:hover {
    background: #E9E9E9;
    color: hsla(160, 100%, 37%, 1);
}

.product-detail .content {
    width: 1320px;
    max-width: 1320px;
    display: flex;
    position: relative;
    flex-direction: row;
}

.product-detail .content .left-ct {
    width: 50%;
    position: relative;
    display: flex;
    flex-direction: column;
    padding: 10px 0px 10px 0px;

}

.product-detail .content .left-ct .image img {
    border-radius: 10px;
}

.product-detail .content .right-ct {
    width: 50%;
    position: relative;
    display: flex;
    flex-direction: column;
    padding: 10px 0px 10px 20px;
}

.price {
    color: red;
}

.modal-footer {
    justify-content: center !important;
}

.table tr td {
    padding: 10px 0px;
    color: #989898;
    border-bottom: 1px solid #E6E9EC;
}

.table tr td:last-child {
    padding-left: 5px;
}

.table tr:nth-child(odd) {
    background-color: #F1F1F1;
}
</style>
