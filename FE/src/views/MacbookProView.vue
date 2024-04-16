<script setup lang="ts">
import ItemProduct from "@/components/product/ItemProduct.vue";
import { onMounted, ref, watch } from "vue";
import { macbookproData } from '../data';
import axios from 'axios';
import _ from 'lodash';
import { useRoute } from "vue-router";

let allData: any = ref([]);
let productView: any = ref([]);
let groupProducts: any = ref([]);
let subId: number = useRoute().params.id as unknown as number;

onMounted(() => {
    allData.value = macbookproData;
    productView.value = macbookproData;

    if (subId > 0) {
        productView.value = _.filter(allData.value, ((f: any) => { return f.sub_category_id === subId.toString() }));
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
                <RouterLink to="/">MacBook Pro</RouterLink>
            </div>
            <div class="d-flex justify-content-center fs-3 m-0 py-3 text-black fw-bolder">
                <img src="../assets/icon/ic_mac.svg" alt="logo">
                <h1 class="ms-1 fs-3 lh-base">MacBook Pro</h1>
            </div>
            <div>
                <h2 class="fw-bold fs-6 text-black d-block lh-base mb-2">Danh mục: MacBook Pro</h2>
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
                                            <span>Giá Cao - Thấp</span>
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
        <div id="product-article" class="full bg-white py-3">
            <div class="container lh-base fs-6">
                <div class="the_content">
                    <h2 class="d-block fs-5 fw-bold mt-3 mb-2"><strong>Macbook</strong> là thương hiệu máy tính xách tay
                        được sản
                        xuất bởi <a href="https://www.apple.com/mac/" rel="nofollow">Apple</a>. Bao gồm các dòng:
                        <strong>Macbook
                            Pro</strong>, <strong>Macbook Air</strong>
                    </h2>
                    <p><strong>Nổi tiếng với thiết kế thời trang, hiệu năng và tính ổn định tương ứng, những chiếc MacBook
                            của Apple
                            luôn là lựa chọn hàng đầu của một bộ phận người sử dụng.</strong></p>
                    <h3 class="d-block fs-6 fw-bold mt-3 mb-2"><br>
                        <strong>Hiệu năng ổn định trên cả macbook cũ và mới</strong>
                    </h3>
                    <p class="m-0"><img class="aligncenter size-full wp-image-11346 d-block mx-auto rounded-4 mw-100 my-4"
                            src="#" alt="" width="770" height="433"></p>
                    <p><em>MacBook chạy ổn định hơn nhiều dòng máy laptop khác</em><br>
                        So với các laptop chạy HĐH Windows, Macbook được cho là chạy mượt và ít khi bị treo hơn. Một nghiên
                        cứu cho
                        thấy kể từ năm 2013, hầu hết các sản phầm của Apple, dù là MacBook Pro hay MacBook Air, máy đã qua
                        sử dụng hay
                        máy mới 100% đều sở hữu một cấu hình khá tốt giúp máy tính của bạn có thể khởi động rất nhanh trong
                        khoảng 15
                        giây kể từ lúc bấm nút nguồn.</p>
                    <h3 class="d-block fs-6 fw-bold mt-3 mb-2"><strong>Thiết kế macbook tuyệt đẹp</strong></h3>
                    <p>Nếu những chiếc laptop khiến bạn e ngại vì trọng lượng lớn và không được đẹp mắt cho lắm thì với
                        Macbook, kể
                        cả là Macbook cũ qua sử dụng cách đây vài năm cũng sẽ khiến bạn yêu ngay từ nhìn đầu tiên. Với ưu
                        điểm về kích
                        thước nhỏ nhắn và siêu nhẹ, đây là sự lựa chọn hoàn hảo cho những ai hay di chuyển, đi lại nhiều
                        nơi. Bạn sẽ
                        dễ dàng mang theo một chiếc <em>MacBook Air</em> bên trong túi xách cùng với toàn bộ dây nối, đồ sạc
                        gọn nhẹ.
                    </p>
                    <p class="m-0"><img class="aligncenter size-full wp-image-21158 d-block mx-auto rounded-4 mw-100 my-4"
                            src="https://macone.vn/wp-content/uploads/2020/06/MacBook-3.jpg" alt="" width="564"
                            height="564"></p>
                    <p><em>Vẻ ngoài của MacBook gây ấn tượng vì được chăm chút đến từng chi tiết nhỏ</em></p>
                    <h3 class="d-block fs-6 fw-bold mt-3 mb-2"><strong>Tính bảo mật cao</strong></h3>
                    <p>Có một điều không thể chối cãi, đó là Windows dù là hệ điều hành phổ biến nhất nhưng độ bảo mật không
                        cao như
                        Mac OS. Một máy tính Mac không cài đặt phần mềm bảo mật nào nhưng ít có nguy cơ bị virus hay malware
                        tấn công
                        so với máy tính Windows. Apple cho biết họ luôn cập nhật các loại mã hóa và bảo mật mới trong các
                        phiên bản
                        Mac OS mới để đảm bảo an toàn. Đây cũng được coi là ưu điểm nổi trội của Macbook so với những dòng
                        máy tính
                        xách tay khác.</p>
                    <h3 class="d-block fs-6 fw-bold mt-3 mb-2"><strong>Thời lượng pin “khủng”</strong></h3>
                    <p><em>MacBook có thời lượng pin đáng kinh ngạc</em><br>
                        Thông thường các dòng Macbook luôn sở hữu thời gian sử dụng pin rất trâu. Đặc biệt là các dòng
                        MacBook Air,
                        thời lượng pin sử dụng có thể lên đến 10 giờ sử dụng. Thậm chí nếu được sử dụng đúng cách thì tuổi
                        thọ pin của
                        các dòng Macbook cũ cách đây vài năm cũng&nbsp;&nbsp;không bị hao mòn nhiều</p>
                    <h3 class="d-block fs-6 fw-bold mt-3 mb-2"><strong>Giá thành hơi cao nhưng vẫn hợp lý</strong></h3>
                    <p>Khi nhắc đến <strong>MacBook</strong>, người dùng thường băn khoăn về giá thành của nó.&nbsp; Một
                        chiếc
                        MacBook mới thường dao động trong quãng giá từ 30 đến 50 triệu. Với thu nhập trung bình của người
                        Việt hiện
                        tại, quyết định sở hữu một chiếc Mac không phải điều dễ dàng. Nhưng để có 1 chiếc máy tính với vô số
                        ưu điểm
                        như vậy thì cũng là mức giá xứng đáng.<br>
                        Bên cạnh đó, với những người tài chính có hạn hơn thì việc mua máy macbook cũ qua sử dụng cũng là 1
                        phương án
                        lựa chọn hợp lý. Bởi cấu hình, chất lượng thì vẫn thế mà giá thành lại hấp dẫn hơn cả.</p>
                    <h3 class="d-block fs-6 fw-bold mt-3 mb-2"><strong>Các dòng Macbook cũ &amp; mới hiện nay:</strong></h3>
                    <h4 class="d-block fs-14px fw-bold mt-3 mb-2"><strong>- Macbook Pro</strong></h4>
                    <p><br>
                        Là dòng Macbook xách tay có cấu hình mạnh mẽ, đa chức năng, phù hợp những công việc đòi hỏi hiệu
                        năng cao.<br>
                        Xem thêm tại <em><a href="#">Macbook Pro</a></em></p>
                    <h4 class="d-block fs-14px fw-bold mt-3 mb-2"><strong>- Macbook Air</strong></h4>
                    <p>Dòng Macbook Air có thiết kế mỏng nhẹ, giá thành rẻ và thời lượng pin khủng, phù hợp cho các công
                        việc văn
                        phòng.<br>
                        <a href="#">Tìm hiểu thêm về&nbsp;Macbook Air</a>
                    </p>
                    <h4 class="d-block fs-14px fw-bold mt-3 mb-2"><strong>- iMac, Mac Mini, Mac Pro</strong></h4>
                    <p>Là các dòng máy tính để bàn của Apple, có cấu hình rất cao, hiệu năng mạnh.<br>
                        Tham khảo: <a href="#">iMac &amp; Mac mini</a></p>
                    <h4 class="d-block fs-14px fw-bold mt-3 mb-2"><strong>Xem thêm video tổng quan về các dòng Macbook cũ và
                            mới:</strong></h4>

                    <p>Máy tính MacBook được xem là một lựa chọn thông minh bởi cấu hình mạnh mẽ, thiết kế tinh tế cùng hệ
                        điều hành
                        ổn định, mượt mà. Hơn cả, việc sở hữu một chiếc <strong>MacBook </strong>sẽ giúp người dùng dễ dàng
                        đồng bộ
                        với hệ sinh thái hiện đã phổ biến mạnh mẽ của <strong>Apple</strong> như <strong>iPhone, iPad,
                            Macbook, Apple
                            Watch</strong>...&nbsp;</p>
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
