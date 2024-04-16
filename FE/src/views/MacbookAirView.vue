<script setup lang="ts">
import ItemProduct from "@/components/product/ItemProduct.vue";

import { onMounted, ref, watch } from "vue";
import { macbookairData } from '../data';
import axios from 'axios';
import _ from 'lodash';
import { useRoute } from "vue-router";

let allData: any = ref([]);
let productView: any = ref([]);
let groupProducts: any = ref([]);
let subId: number = useRoute().params.id as unknown as number;

onMounted(() => {
    allData.value = macbookairData;
    productView.value = macbookairData;

    if (subId > 0) {
        productView.value = _.filter(productView.value, ((f: any) => { return f.sub_category_id === subId.toString() }));
    }

    groupProducts.value = _.chunk(productView.value, 4);
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
                <RouterLink to="/">MacBook Air</RouterLink>
            </div>
            <div class="d-flex justify-content-center fs-3 m-0 py-3 text-black fw-bolder">
                <img src="../assets/icon/ic_mac.svg" alt="logo">
                <h1 class="ms-1 fs-3 lh-base">MacBook Air</h1>
            </div>
            <div>
                <h2 class="fw-bold fs-6 text-black d-block lh-base mb-2">Danh mục: MacBook Air</h2>
                <div class="d-flex flex-column flex-md-row justify-content-between">
                    <div class="">
                        <div id="sort-wrapper">
                            <div id="sort-wrap">
                                <div class="btn-sort-wrap d-flex flex-row flex-wrap fs-14px">
                                    <button @click="reloadData()" class="me-2 my-1 btn-find-price">
                                        <span class="d-flex flex-row align-items-center">
                                            <i class="bi bi-apple me-1"></i>
                                            <span>Mặc Định</span>
                                        </span>
                                    </button>
                                    <button class="me-2 my-1 btn-find-price " @click="sort1()">
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
                                    <button class="me-2 my-1 btn-find-price" @click="sort3">
                                        <span class="d-flex flex-row align-items-center">
                                            <i class="bi bi-laptop me-1"></i>
                                            <span>30 - 40 triệu</span>
                                        </span>
                                    </button>
                                    <button class="me-2 my-1 btn-find-price" @click="sort4">
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
                    <p><strong>Ra mắt phiên bản đầu tiên vào năm 2008 và cho đến đời mới nhất Macbook Air&nbsp;những chiếc Macbook Air
                            cũ và mới của thương hiệu Apple vẫn giữ được đẳng cấp nhất định trong lòng các tín đồ công
                            nghệ.</strong></p>
                    <h2 class="d-block fs-5 fw-bold mt-3 mb-2">Đánh giá về Macbook Air</h2>
                    <h3 class="d-block fs-6 fw-bold mt-3 mb-2"><strong>Cấu hình ổn</strong></h3>
                    <p>Sở hữu card đồ họa Intel UHD Graphics 617, <strong>Macbook Air</strong> mang lại cho người dùng những
                        trải nghiệm “mượt mà” khi sử dụng . Cùng với bộ vi xử lý Intel Core i5 hoặc Core i7 thế hệ thứ 8,
                        chiếc laptop này còn sở hữu một cấu hình cực ổn và giúp bạn trải nghiệm trơn tru hầu hết các ứng
                        dụng.</p>
                    <h3 class="d-block fs-6 fw-bold mt-3 mb-2"><strong>Thiết kế tinh tế</strong></h3>
                    <p class="m-0"><img class="aligncenter wp-image-11325 size-full d-block mx-auto rounded-4 mw-100 my-4"
                            src="https://macone.vn/wp-content/uploads/2018/10/macbook_air_new_2018.jpg" alt="macbook air"
                            width="1018" height="568"></p>
                    <p>Với ưu điểm về vóc dáng siêu mỏng và cân nặng khá nhẹ, đây là sự lựa chọn thông minh cho những ai có
                        lịch trình công việc phải di chuyển nhiều. Máy được gia công từ hợp kim nhôm nguyên khối unibody –
                        được đánh giá là một bước đột phá trong cách thiết kế của Apple để tạo nên những sản phẩm siêu mỏng
                        và siêu nhẹ. Với đời Macbook Air 2018 thì thiết kế còn trở nên càng mỏng nhẹ hơn nữa chỉ nặng 1.25
                        kg</p>
                    <h3 class="d-block fs-6 fw-bold mt-3 mb-2"><strong>Tuổi thọ pin ấn tượng</strong></h3>
                    <p>Yếu tố thứ ba để người dùng lựa chọn sử dụng <strong>Macbook Air&nbsp;</strong>đó là khả năng tiết
                        kiệm pin đáng kinh ngạc của chip Intel.&nbsp;Theo một số trang thử nghiệm, phiên bản 2017 trở về
                        trước có thể chơi video liên tục 18 tiếng, vượt xa các đối thủ. Trên thực tế, nếu chỉ dùng cho các
                        tác vụ thông thường (lướt web, tin học văn phòng), Macbook Air có thể chạy liên tục trong 8 tiếng,
                        mà vẫn còn dư vài chục phần trăm pin. Macbook Air 2018 đời mới nhất được trang bị vi xử l ý mới tiết
                        kiệm điện thì pin còn tốt hơn cả các phiên bản Macbook Air cũ</p>
                    <h3 class="d-block fs-6 fw-bold mt-3 mb-2"><strong>Hỗ trợ cổng USB phổ biến</strong></h3>
                    <p>Chỉ trừ phiên bản Macbook Air mới nhất rút gọn lại còn cổng USB Type-C, thì Macbook Air đời 2017 trở
                        về trước vẫn đầy đủ các cổng kết nối USB, HDMI... Vì vậy, thay vì phải mua thêm một bộ chuyển đổi
                        hoặc thiết bị ngoại vi mới, <strong>MacBook Air</strong> vẫn có thể giúp bạn kết nối với 2 cổng USB
                        3.0 của nó.</p>
                    <h3 class="d-block fs-6 fw-bold mt-3 mb-2"><strong>Bàn phím cảm ứng đa chạm</strong></h3>
                    <p>Không thể chối cãi, bàn phím của máy đem lại trải nghiệm mượt mà và thao tác nhanh chóng. Đặc biệt,
                        công nghệ cảm ứng đa chạm cho phép bạn thoải mái trong việc sử dụng touchpad hiệu quả. Các thao tác
                        như kéo, thả, phóng to hay thu nhỏ cũng không cần phải dùng đến chuột. Đối với người thường xuyên gõ
                        văn bản, đây quả thật là một điểm cộng hoàn hảo cho chiếc laptop này. Với đời Macbook Air 2018 mới
                        track pad to hơn và cũng trải nghiệm sướng hơn.</p>
                    <h3 class="d-block fs-6 fw-bold mt-3 mb-2"><strong>Hỗ trợ khe cắm thẻ nhớ SD</strong></h3>
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
