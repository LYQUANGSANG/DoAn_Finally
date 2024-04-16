<script setup lang="ts">
import ItemProduct from "@/components/product/ItemProduct.vue";
import { onMounted, ref, watch } from "vue";
import { imacData } from '../data';
import axios from 'axios';
import _ from 'lodash';
import { useRoute } from "vue-router";

let allData: any = ref([]);
let productView: any = ref([]);
let groupProducts: any = ref([]);
let subId: number = useRoute().params.id as unknown as number;

onMounted(() => {
    allData.value = imacData;
    productView.value = imacData;

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
                <RouterLink to="/">IMac</RouterLink>
            </div>
            <div class="d-flex justify-content-center fs-3 m-0 py-3 text-black fw-bolder">
                <img src="../assets/icon/ic_mac.svg" alt="logo">
                <h1 class="ms-1 fs-3 lh-base">IMac</h1>
            </div>
            <div>
                <h2 class="fw-bold fs-6 text-black d-block lh-base mb-2">Danh mục: IMac</h2>
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
                    <p class="p3">iMac là một trong sản phẩm vô cùng độc đáo có thể nói độc nhất mà Apple hiện đang sở hữu
                        trên thị trường. Những sản phẩm khiến nhiều người dùng siêu lòng và mong muốn được sở hữu. Hôm nay
                        hãy cùng MacOne chúng tôi tìm hiệu chiếc máy tính để bản - iMac là gì và chúng có gì ấn tường đến
                        nỗi dù có mức ra rất đắt đỏ nhưng ai cũng muôn sở hữu nhé!</p>
                    <h2 class="d-block fs-5 fw-bold mt-3 mb-2">1. iMac là gì?</h2>
                    <p class="p3">iMac là dòng máy tính để bàn được Apple phát triển với chỉ một màn hình duy nhất không đi
                        kèm cây máy tính và kết nối không dây với các bộ phận khác như chuột bàn phím, …. hoàn toàn khác với
                        mẫu PC thông thường. Tất cả phần cứng bao gồm: Ram, CPU, ổ cứng, …. đều được tích hợp một cách khéo
                        léo trên màn hình máy. Nhưng nổi bật nhất vẫn là khung màn hình siêu chất kèm độ phân giải cực cao
                        5K và khả năng bao phủ màu tuyệt vời.</p>
                    <p class="p3">Dù vậy việc tích hợp các phần cứng vào màn hình không khiến Apple iMac nặng hay cồng kềnh
                        như các bạn nghĩ, chúng thon gọn và mỏng nhẹ đến đáng ngờ so với một chiếc PC thông thường. Quan
                        trọng hơn cả việc không cần kết nối dây với các thiết bị như chuột, màn hình, ….trước kia khiến
                        chúng nhìn trông gọn gàng và hiện đại hơn, ít bụi bẩn và dễ dàng có thể tháo lắp hơn cũng như chiếm
                        ít diện tích trên bàn làm việc.&nbsp;</p>
                    <p class="m-0"><img class="aligncenter wp-image-37957 size-large d-block mx-auto rounded-4 mw-100 my-4"
                            src="https://macone.vn/wp-content/uploads/2022/11/iMac-2-768x1024.jpeg" alt="iMac là gì?&nbsp;"
                            width="768" height="1024"></p>
                    <h2 class="d-block fs-5 fw-bold mt-3 mb-2">2.Ưu và nhược điểm dòng sản phẩm iMac</h2>
                    <p><strong>+ Ưu điểm :</strong></p>
                    <ul style="list-style-type: disc;">
                        <li class="p3"><strong>Thiết kế thon gọn, tiết kiệm không gian:</strong></li>
                    </ul>
                    <p class="p3">Phong cách thiết kế đi đầu xu hướng với khung vỏ nhôm nguyên khối bền đẹp, thiết kế. Viền
                        màn hình siêu mỏng. Những đường nét chi tiết hoàn thiện, mọi thứ đều được dấu hoàn toàn ở phần sau
                        màn hình - sự tinh tế, gọn gàng kế thừa từ thiết kế chiếc iPhone đời đầu.Phía sau màn hình là cổng
                        kết nối để bạn có thể kết nối với các thiết bị ngoài thêm như máy tính, máy in, ….</p>
                    <p class="p3">Điểm đang chú ý là khung màn hình sắc nét, to rộng đủ loại kích thước 21,5 24 và 27 inch
                        mang đến trải nghiệm tuyệt vời mà khó có một chiếc máy tính nào hiện có thể sánh ngang tầm hiện nay.
                    </p>
                    <ul class="ul1" style="list-style-type: disc;">
                        <li class="li3"><strong>Hiệu năng mạnh mẽ xử lý đồ hoạ mượt mà:</strong></li>
                    </ul>
                    <p class="p3">Apple không tập trung vào nhiều thứ như Windows sản phẩm họ đem lại nhắm đến khả năng làm
                        đồ hạo, render video, làm đồ hoạ nặng. Những con chip được trang bị đều tập trung để đem đến khả
                        năng làm việc tốt nhất và tối ưu dành cho công việc này. Trong cùng phần khúc, Apple có thể nói là
                        vô đối và không có đối thủ.</p>
                    <p class="p3">Trong đó là 2 dòng chip Intel và dòng M1, Intel cũng vô cùng mạnh mẽ nhưng M1 là sản phẩm
                        của nhà trông được mang đến sự tốt ưu tuyệt vời nhất về hiệu năng, tôi ưu thời gian sử dụng.</p>
                    <ul class="ul1" style="list-style-type: disc;">
                        <li class="li3"><strong>Camera sắc nét hỗ trợ tính năng trực tuyến: </strong>Hệ thống camera sắc nét
                            làm việc online qua FaceTime, Team, …. hoạt động ổn định hình ảnh sắc nét với khung hình mượt mà
                            trải nghiệm mãn nhãn.</li>
                    </ul>
                    <p><strong>+ Nhược điểm:</strong></p>
                    <ul style="list-style-type: disc;">
                        <li class="p3"><strong>Không dành để chơi game:</strong> Nếu đã nói đến Apple thì bạn không nên nghĩ
                            đến việc chơi game, những sản phẩm của họ được tối ưu không dành cho công việc này. Việc tối ưu
                            duy nhất dành cho đồ hoạ lấy đi khả năng giải trí mà nhiều người dùng cảm thấy khá tiếc nuối
                            nhưng đây là một quyết định đúng đắn: “ Cạnh tranh khả năng xử lý game với WINDOWS không phải là
                            một lựa chọn khôn ngoan Apple“.<span class="Apple-converted-space"> Kết quả, Apple đang là ông
                                trùm trong ngách về thiết kế mà hãng đã chọn lựa.</span></li>
                        <li class="p3"><strong>Giá bán đắt đỏ</strong>: Apple có mức giá bán có thể nói thuộc hàng cao cấp
                            nên khá " <strong>kén</strong> " người sử dụng. Không giống như Windows họ có đa dạng về đủ mức
                            giá và hiệu năng phân bổ rộng rãi đáp ứng mọi nhu cầu.</li>
                        <li class="p3"><strong>Kho phần mềm không nhiều</strong>: Mặc dù hiện nay Apple có một kho phần mềm
                            tương đối lớn nhưng để so sánh với Windows thì họ vẫn còn nhiều thiếu sót nhưng ở khía cạnh đồ
                            hoạ “ Apple thực sự bỏ xa Windows“</li>
                    </ul>
                    <p class="m-0"><img class="aligncenter wp-image-37960  d-block mx-auto rounded-4 mw-100 my-4"
                            src="https://macone.vn/wp-content/uploads/2022/11/iMac-5.jpeg"
                            alt="Ưu và nhược điểm dòng sản phẩm iMac" width="623" height="415"></p>
                    <h2 class="d-block fs-5 fw-bold mt-3 mb-2">3. iMac dành cho đối tượng nào?</h2>
                    <p class="p3">Với độ bao phủ màu sắc đạt 100% sRGB, chiếc iMac trở thành chân ái các tín đồ thiết kế, đồ
                        hoạ. Độ chân thực và chính xác màu sắc đạt gần như tuyệt đối là những tiêu chí hàng đầu mà nhiều
                        người lựa chọn. Để làm chuyên nghiệp thì thật khó lòng mà không chọn iMac làm trợ thủ đăc lực. Bên
                        cạnh đó, chúng cũng là một lựa chọn không kém phần phù hợp với dân coder, developer,…</p>
                    <p class="p3 m-0"><img class="aligncenter wp-image-37959  d-block mx-auto rounded-4 mw-100 my-4"
                            src="https://macone.vn/wp-content/uploads/2022/11/imac-4.jpeg"
                            alt="iMac dành cho đối tượng nào?" width="611" height="815"></p>
                    <h2 class="d-block fs-5 fw-bold mt-3 mb-2">4.Mức giá bán các mẫu iMac là bao nhiêu? Mua iMac ở đâu?</h2>
                    <p class="p3">Theo mức giá bán trên thị trường, những chiếc iMac để bàn đang được bán trong khoảng 20 -
                        48 triệu đồng - Một mức vô cùng đắt đỏ so với dòng máy để bàn PC. Vậy nên, các bạn nên cân nhắc giữa
                        nhu cầu sử dụng có cần thiết hay không và ngân sách bản thân để có thể đưa ra một lựa chọn phù hợp
                        nhất. Với nhu cầu học làm thông thường một chiếc máy tính PC giá vừa rẻ lại ngon lành sẽ là một lựa
                        chọn tuyệt vời hơn cả tuy nhiên nếu bạn làm đồ hoạ cao cấp, phức tạp cần độ chính xác màu sắc cao ở
                        mức chuyên nghiệp thì các bạn nên chọn mẫu iMac để sử dụng.</p>
                    <p class="p3">Để mua mẫu iMac chính hãng, chất lượng với mức giá tốt, các bạn có thể ghé ngay qua
                        <strong>MacOne</strong> - Chuyên kinh doanh sản phẩm chính hãng Apple. Chúng tôi có chính sách bảo
                        hành, giao hàng, … và quy trình tư vấn với đội ngũ nhân viên am hiểu sản phẩm để có thể giúp các bạn
                        đưa ra những lựa chọn chính xác nhất với bản thân.&nbsp;
                    </p>
                    <p class="m-0"><img class="aligncenter wp-image-37958 size-large d-block mx-auto rounded-4 mw-100 my-4"
                            src="https://macone.vn/wp-content/uploads/2022/11/iMac-3-767x1024.jpeg"
                            alt="Mức giá bán các mẫu iMac là bao nhiêu? Mua iMac ở đâu?" width="767" height="1024"></p>
                    <h2 class="d-block fs-5 fw-bold mt-3 mb-2">5. Phân loại các những mẫu máy tính để bàn 2 in 1 Apple&nbsp;
                    </h2>
                    <ul class="ul1" style="list-style-type: disc;">
                        <li class="li3"><strong>Theo con chip:</strong></li>
                    </ul>
                    <p class="p3">+ <strong>iMac Intel</strong>: Kể từ năm 2020 trở về trước, Apple vẫn sử dụng những con
                        chip Intel với sản phẩm iMac của họ. Hiệu năng từ con chip Intel kết hợp card đồ hoạ trang bị từ AMD
                        vô cùng mạnh mẽ mang đến hiệu năng xử lý dành cho nhu cầu đồ hoạ chuyên nghiệp.</p>
                    <p class="p3">+ <a href="#"><strong>iMac M1</strong></a>: Bước sang năm 2021,
                        Apple đổi mới với " con chip nhà làm " Apple M1 - mẫu chip Apple Silicon mang đến hiệu năng không
                        tưởng, sự tối ưu và gọn nhẹ đồng thời thay đổi hoàn toàn thiết kế dòng sản phẩm sau này.<span
                            class="Apple-converted-space"> Hiệu năng thậm chí còn tối ưu và vượt trội gấp nhiều lần tạo nên
                            chiếc iMac tuyệt vời</span></p>
                    <ul class="ul1" style="list-style-type: disc;">
                        <li class="li3"><strong>Theo Ram:</strong></li>
                    </ul>
                    <p class="p3">+ <strong>Dung lượng 8GB</strong>: Nhu cầu làm đa nhiệm render đa luồng với 8Gb đáp ứng
                        tốt nhu cầu tốt làm đồ hoạ.</p>
                    <p class="p3">+ <strong>Dung lượng 16Gb</strong>: Tuy nhiên ở dung lượng 16Gb Ram, ngừoi dùng làm đồ hoạ
                        2D và 3D mạnh mẽ, mượt mà hơn, render video nhiều hiệu ứng.</p>
                    <ul class="ul1" style="list-style-type: disc;">
                        <li class="li3"><strong>Theo ổ cứng:</strong></li>
                    </ul>
                    <p class="p3">+ <strong>iMac 256GB</strong> : 256Gb hiện là dung lượng lưu trữ tối thiểu hiện nay, sau
                        khi khấu trừ các phần mềm cần thiết và hệ điểu hành ngừoi dùng vẫn còn dư sài khoảng 170GB sử dụng.
                    </p>
                    <p class="p3">+ <strong>iMac 512GB</strong>: Hiện 512GB là dung lượng được đa phần người dùng sử dụng,
                        đáp ứng tốt nhu cầu từ 2 -4 năm ngừoi dùng sử dụng thông thường lưu trữ thông tin, dữ liệu hình ảnh,
                        ….</p>
                    <p class="p3">+ <strong>iMac 1TB:</strong> Đối với người dùng làm đồ hoạ cao cấp, render video thì 1Tb
                        là dung lượng tối thiểu mà các bạn nên cân nhắc sử dụng đặc biệt là số lượng source video lớn.</p>
                    <p class="p3">+ <strong>iMac 2TB</strong>: Dung lượng đáp ứng tốt nhu cầu làm đồ hoạ, coder, thiết kế, …
                        lâu dài không cần cân nhắc đến việc trang bị phần ổ cứng ngoài.</p>
                    <p class="m-0"><img class="aligncenter wp-image-37956 size-full d-block mx-auto rounded-4 mw-100 my-4"
                            src="https://macone.vn/wp-content/uploads/2022/11/iMac-1.png" alt="Phân loại các mẫu iMac"
                            width="966" height="966"></p>
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
