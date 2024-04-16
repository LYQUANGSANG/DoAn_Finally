<script setup lang="ts">
import ItemProduct from "@/components/product/ItemProduct.vue";
import { onMounted, ref, watch } from "vue";
import { macminiData } from '../data';
import axios from 'axios';
import _ from 'lodash';
import { useRoute } from "vue-router";

let allData: any = ref([]);
let productView: any = ref([]);
let groupProducts: any = ref([]);
let subId: number = useRoute().params.id as unknown as number;

onMounted(() => {
    allData.value = macminiData;
    productView.value = macminiData;

    if (subId > 0) {
        productView.value = _.filter(productView.value, ((f: any) => { return f.sub_category_id === subId.toString() }));
    }

    groupProducts.value = _.chunk(productView.value, 4);
});

watch(allData, (subId: any) => {
    if (subId == 0) {
        reloadData();
    }
});

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
                <RouterLink to="/">MacMini</RouterLink>
            </div>
            <div class="d-flex justify-content-center fs-3 m-0 py-3 text-black fw-bolder">
                <img src="../assets/icon/ic_mac.svg" alt="logo">
                <h1 class="ms-1 fs-3 lh-base">MacMini</h1>
            </div>
            <div>
                <h2 class="fw-bold fs-6 text-black d-block lh-base mb-2">Danh mục: MacMini</h2>
                <div class="d-flex flex-column flex-md-row justify-content-between">
                    <div class="">
                        <div id="sort-wrapper">
                            <div id="sort-wrap">
                                <div class="btn-sort-wrap d-flex flex-row flex-wrap fs-14px">
                                    <button class="me-2 my-1 btn-find-price" @click="reloadData()">
                                        <span class="d-flex flex-row align-items-center">
                                            <i class="bi bi-apple me-1"></i>
                                            <span>Mặc Định</span>
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
            <div class="row">
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
        <div id="product-article" class="full bg-white py-3 expanded">
            <div class="container lh-base fs-6">
                <div class="the_content">
                    <p class="p1"><i>Apple Mac mini được giới công nghệ biết đến là chiếc máy tính để bàn do Apple phát
                            triển được ra mắt đầu tiên vào năm 2005. Phong cách thiết kế độc đáo đi trước thời đại khiến
                            nhiều người dùng phải trầm trồ thán phục</i></p>
                    <h2 class="d-block fs-5 fw-bold mt-3 mb-2">1. Mac mini là gì?</h2>
                    <p class="p1">Mac mini là dòng cây máy tính có hiệu năng phân khúc thấp mà Apple cung cấp cho người dùng
                        so với Mac Studio hay Mac Pro. Máy không đi kèm với màn hình, chuột và bàn phím, khi mua các bạn cần
                        trang bị thêm để có thể sử dụng. Nhỏ gọn nhưng không hề kém , chúng sở hữu hiệu suất xử lý tương
                        đương những mẫu PC để bàn thông thường.</p>
                    <p class="m-0"><img class="aligncenter wp-image-38259 size-large d-block mx-auto rounded-4 mw-100 my-4"
                            src="https://macone.vn/wp-content/uploads/2022/12/Mac-mini-2014-8-1024x576.jpeg"
                            alt="Mac mini là gì?&nbsp;" width="1024" height="576"></p>
                    <h2 class="d-block fs-5 fw-bold mt-3 mb-2">2. Mac mini dành cho đối tượng nào?</h2>
                    <p class="p1">Ngay từ khi sản xuất, Apple định hươngs Mac mini đến với nhóm người dùng văn phòng tương
                        tự như mẫu Macbook Air hay Macbook Pro.&nbsp;</p>
                    <p class="m-0"><img class="aligncenter wp-image-38199 size-large d-block mx-auto rounded-4 mw-100 my-4"
                            src="https://macone.vn/wp-content/uploads/2022/12/Mac-mini-2018-3-1024x683.jpeg"
                            alt="Mac mini dành cho đối tượng nào?" width="1024" height="683"></p>
                    <h2 class="d-block fs-5 fw-bold mt-3 mb-2">3. Một vài ưu điểm nổi trội</h2>
                    <ul class="ul1" style="list-style-type: disc;">
                        <li class="li1"><strong>Thiết kế nhỏ gọn:</strong></li>
                    </ul>
                    <p class="p1">Thiết kế máy nhỏ gọn đến không tưởng chỉ cỡ hai bàn tay. Lớp hoàn thiện tinh tế với chất
                        liệu nhôm nguyên khối cao cấp. Thiết kế hình hộp với góc bo tinh tế trên thân máy kèm logo quả táo
                        nổi bật mặt A máy. Các bạn có thể thấy điểm độc đáo, tối giản trong cách thiết kế Mac Mini.&nbsp;
                    </p>
                    <p class="p1">Điều nổi bật đó là trọng lượng máy vô cùng ấn tượng chỉ 1,1 - 1,2 kg vô cùng nhẹ nhàng nếu
                        bạn cần chuyển văn phòng, chuyển nhà, …. Tính di dộng cao. Không chỉ vậy, mini laptop này nhỏ gọn
                        nên tiết kiệm rất nhiều không gian sử dụng cũng như để bàn so với cây máy tính PC thông thường.</p>
                    <p class="m-0"><img class="aligncenter wp-image-37134 size-full d-block mx-auto rounded-4 mw-100 my-4"
                            src="https://macone.vn/wp-content/uploads/2022/10/Mac-mini-1.jpeg" alt="Thiết kế Mac Mini "
                            width="800" height="452"></p>
                    <ul class="ul1" style="list-style-type: disc;">
                        <li class="li1"><strong>Cổng kết nối:</strong></li>
                    </ul>
                    <p class="p1">So sánh với mẫu MacBook mỏng nhẹ thì Mac mini có nhiều cổng kết nối. Một điểm cần thiết
                        khi mà máy cần kết nối với nhiều thiết bị ngoại vi như màn hình, chuột, bàn phím, máy in, …..</p>
                    <ul class="ul1" style="list-style-type: disc;">
                        <li class="li1"><strong>Hỗ trợ xuất màn hình</strong></li>
                    </ul>
                    <p class="p1">Những mẫu Mac mini hỗ trợ xuất màn hình đa dạng không chỉ với tủn cầu hình mà còn tuỳ tưng
                        độ phân giải:</p>
                    <p class="p1">Danh mục mẫu Mac Mini:</p>
                    <ul class="ul1" style="list-style-type: disc;">
                        <li class="li1"><a href="https://macone.vn/mac-mini-2014/"><strong>Mac mini 2014</strong></a></li>
                        <li class="li1"><a href="https://macone.vn/mac-mini-2018/"><strong>Mac mini 2018</strong></a></li>
                        <li class="li1"><a href="https://macone.vn/mac-mini-2020/"><strong>Mac mini 2020</strong></a></li>
                        <li class="li1"><a href="https://macone.vn/mac-mini-2023/"><strong>Mac mini 2023</strong></a></li>
                    </ul>
                    <ul style="list-style-type: disc;">
                        <li class="p1"><b>Dễ dàng kết nối WiFi và Bluetooth:</b></li>
                    </ul>
                    <p class="p1">Phần cứng được tích hợp đầy đủ khả năng kết nối Wifi và Bluetooth<b> </b>giúp việc kết nối
                        với thiết bị ngoại vi: chuột, bàn phím, …. và truy cập Internet ổn định.</p>
                    <p class="m-0"><img class="aligncenter wp-image-416 size-full d-block mx-auto rounded-4 mw-100 my-4"
                            src="https://macone.vn/wp-content/uploads/2016/11/mac-mini.jpg"
                            alt="Dễ dàng kết nối WiFi và Bluetooth:&nbsp;" width="960" height="720"></p>
                    <ul class="ul1" style="list-style-type: disc;">
                        <li class="li1"><strong>Hiệu năng văn phòng thoải mái:</strong></li>
                    </ul>
                    <p class="p1">Mac mini cũng như nhiều dòng máy tính khác Apple đã có cuộc cải cách với con chip M-series
                        tạo ra hai thế hệ:</p>
                    <ul class="ul1" style="list-style-type: disc;">
                        <li class="li1"><strong>Mac mini Intel</strong>: Hiệu năng văn phòng vừa đủ word, Excel, ….</li>
                        <li class="li1"><strong>Mac mini M -series</strong>: Hiệu năng mạnh mẽ không chỉ văn phòng mà còn cả
                            những tác vụ đồ hoạ nhẹ nhàng với Photoshop, AI, Camtasia 9, ….</li>
                    </ul>
                    <p class="p1">Chúng tôi tìn rằng trong khoảng thời gian tới, Apple sẽ còn tiếp tục cung cấp những phiên
                        bản mới ngày càng mạnh mẽ và có nhiều cải tiến hơn nữa. Đây sẽ là một lựa chọn vô cùng tuyệt vời mà
                        bạn không nên bỏ lỡ.&nbsp;</p>
                    <p class="p1">Ngoài ra, nếu bạn đang còn bất cứ thắc mắc cần giải đáp hãy liên hệ đến <strong><a
                                href="https://www.facebook.com/macone.vn/">Fanpage MacOne</a></strong> để được nhân viên
                        chúng tôi hỗ trợ. Mua Mac mini new hay Mac mini cũ - hãy ghé MacOne để trải nghiệm sản phẩm chính
                        hãng, giá rẻ.</p>
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
