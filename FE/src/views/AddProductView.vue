<script setup lang="ts">
import { computed, onMounted, ref, watch } from "vue";
import { categorysData } from '../data';
import _ from "lodash";
import axios from 'axios';

let menus: any = ref([]);
let menuSelect: any = ref();
let subMenuSelect: any = ref();
let product: any = ref({
    id: 0,
    name: "",
    image: null,
    memo: "",
    category_id: '',
    sub_category_id: '',
    status: null,
    price: 0,
    isnew: 1,
    views: 0,
    quantity_sold: 0,
    created_at: null,
    updated_at: null,
});
let productDetail: any = ref({
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
    battery: '1000',
    description: null,
    created_at: null,
    updated_at: null,
});

let colors: any = ref([
    {
        code_color: '',
        product_id: '',
        image: '',
        price: '',
        quantity: 1
    }
])

onMounted(() => {
    getDataCategory();
});

const getDataCategory = () => {
    axios.get('http://127.0.0.1:8000/api/categories')
        .then((response: any) => {
            menus.value = response.data;
            menuSelect.value = menus.value[0];
            subMenuSelect.value = menuSelect.value.sub_categories[0];
        })
        .catch((error: any) => {
            console.error(error);
        });
};

const selectMenu = (menu: any) => {
    menuSelect.value = menu;
}

const selectSubMenu = (sub: any) => {
    subMenuSelect.value = sub;
}

watch(menuSelect, () => {
    subMenuSelect.value = menuSelect.value.sub_categories[0];
    product.value.category_id = menuSelect.value.id;

});

watch(subMenuSelect, () => {
    product.value.sub_category_id = subMenuSelect.value.id;
});

const addColor = () => {
    let dataColors = colors.value;
    dataColors.push({
        code_color: '',
        product_id: '',
        image: '',
        price: '',
        quantity: 1
    })
    colors.value = dataColors;
}

const addNewProduct = () => {
    axios.post('http://127.0.0.1:8000/api/products', product.value)
        .then((response: any) => {
            let newPorductId: number = response.data.product.id;
            productDetail.value.product_id = newPorductId;
            axios.post('http://127.0.0.1:8000/api/product-detail', productDetail.value)
                .then(() => {
                    for (let i = 0; i < colors.value.length; i++) {
                        colors.value[i].product_id = newPorductId;
                        if (i == colors.value.length - 1) {
                            axios.post('http://127.0.0.1:8000/api/color-products', colors.value[i]).then(() => alert('Đăng ký thành công!'))
                        } else {
                            axios.post('http://127.0.0.1:8000/api/color-products', colors.value[i]);
                        }
                    }
                })
        })
        .catch((error: any) => {
        });
}

const handleFileUploadProduct = (event: any) => {
    const file = event.target.files[0];
    const img = new FormData();
    img.append("image", file);
    axios
        .post("http://127.0.0.1:8000/api/image-upload", img)
        .then((response: any) => {
            product.value.image = response.data.image;
            console.log(product.value.image);

        })
        .catch((error) => {
            // Xử lý lỗi
        });
}

const handleFileUploadColor = (event: any, color: any) => {
    const file = event.target.files[0];
    const img = new FormData();
    img.append("image", file);
    axios
        .post("http://127.0.0.1:8000/api/image-upload", img)
        .then((response: any) => {
            color.image = response.data.image;
        })
        .catch((error) => {
            // Xử lý lỗi
        });
}

</script>

<template>
    <main>
        <div class="content">
            <h2>Thêm mới sản phẩm</h2>
            <div class="sub-content">
                <div class="left-content">
                    <div class="info">
                        <h5 class="mb-3">Tên sản phẩm</h5>
                        <div class="input-group mb-3 input_from1">
                            <input type="text" class="form-control" placeholder="Tên sản phẩm"
                                aria-describedby="button-addon2" v-model="product.name">
                        </div>
                        <h5 class="mb-3">Đơn giá</h5>
                        <div class="input-group" style="width: 300px;">
                            <input type="number" class="form-control" v-model="product.price">
                            <span class="input-group-text">đ</span>
                        </div>
                        <h5 class="mb-3 mt-3">Mô tả gắn về sản phẩm</h5>
                        <div class="input-group mb-3 input_from1">
                            <input type="text" class="form-control" placeholder="Memo" aria-describedby="button-addon2"
                                v-model="product.memo">
                        </div>
                        <h5 class="mb-3">Hình ảnh về sản phẩm</h5>
                        <div class="input-group mb-3 input_from1">
                            <input type="file" class="form-control" id="inputGroupFile01" @change="handleFileUploadProduct">
                        </div>
                        <h5 class="mb-3">Loại sản phẩm</h5>
                        <div class="info-1 mb-3">
                            <div style="width: 200px; max-width: 200px;">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ menuSelect ? menuSelect.name : '' }}
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li v-for="menu in menus" @click="selectMenu(menu)"><a class="dropdown-item">{{
                                            menu.name }}</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div v-if="menuSelect" style="width: 200px; max-width: 200px;">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ subMenuSelect ? subMenuSelect.name : '' }}
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                        <li v-for="sub in menuSelect.sub_categories" @click="selectSubMenu(sub)"><a
                                                class="dropdown-item">{{ sub.name }}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <h5 class="mb-3">Màu sắc</h5>
                        <div v-for="color in colors" style="display: flex; flex-direction: row;">
                            <div style="max-width: 150px; width: 150px;">
                                <div>Tên màu</div>
                                <input type="text" class="form-control" placeholder="Tên màu"
                                    aria-describedby="button-addon2" v-model="color.name">
                            </div>
                            <div style="width: 100px; padding-left: 20px;">
                                <div>Mã màu</div>
                                <input type="color" style="width: 50px; height: 38px;" class="form-control"
                                    placeholder="Tên màu" aria-describedby="button-addon2" v-model="color.code_color">
                            </div>
                            <div style="max-width: 150px; width: 150px;">
                                <div>Đơn giá</div>
                                <div class="input-group">
                                    <input type="number" class="form-control" v-model="color.price">
                                    <span class="input-group-text">đ</span>
                                </div>
                            </div>
                            <div style="max-width: 240px; width: 240px; margin-left: 20px;">
                                <div>Hình ảnh</div>
                                <input type="file" class="form-control" @change="handleFileUploadColor($event, color)">
                            </div>
                            <div style="margin-left: 10px;"><img style="padding-top: 35px;"
                                    src="../assets/icon/ic_trash.svg" alt="Delete"></div>
                        </div>
                        <button @click="addColor()" style="width: 200px;" type="button" class="btn btn-primary mt-3">Thêm
                            màu</button>
                        <div class="pay">
                            <button @click="addNewProduct()" data-bs-toggle="modal" data-bs-target="#quickOrder">
                                <strong class="fs-4">Thêm mới sản phẩm</strong>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="right-content">
                    <div class="info">
                        <h4 class="mb-3">Thông số kỹ thuật</h4>
                        <h5 class="mb-3">Bộ xử lý CPU</h5>
                        <div class="input-group mb-3 input_from1">
                            <input type="text" class="form-control" placeholder="Bộ xử lý CPU"
                                aria-describedby="button-addon2" v-model="productDetail.cpu">
                        </div>
                        <h5 class="mb-3">Bộ nhớ RAM</h5>
                        <div class="input-group input_from1" style="max-width: 150px; width: 150px;">
                            <input type="number" class="form-control" v-model="productDetail.ram">
                            <span class="input-group-text">GB</span>
                        </div>
                        <h5 class="mb-3 mt-3">Ổ cứng</h5>
                        <div class="input-group input_from1" style="max-width: 150px; width: 150px;">
                            <input type="number" class="form-control" v-model="productDetail.capacity_rom">
                            <span class="input-group-text">GB</span>
                        </div>
                        <h5 class="mb-3 mt-3">Thông số màn hình</h5>
                        <div class="input-group mb-3 input_from1">
                            <input type="text" class="form-control" placeholder="Thông số màn hình"
                                aria-describedby="button-addon2" v-model="productDetail.display_memo">
                        </div>
                        <h5 class="mb-3">Kích thước</h5>
                        <div class="input-group mb-3 input_from1">
                            <input type="text" class="form-control" placeholder="Kích thước"
                                aria-label="Recipient's username" aria-describedby="button-addon2"
                                v-model="productDetail.weight">
                        </div>
                        <h5 class="mb-3">Camera</h5>
                        <div class="input-group mb-3 input_from1">
                            <input type="text" class="form-control" placeholder="Camera" aria-describedby="button-addon2"
                                v-model="productDetail.camera">
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

.content {
    line-height: 1.5;
    max-width: 1320px;
    width: 1320px;
    margin: auto;
    padding: 30px 0px 20px 0px;
    display: flex;
    flex-direction: column;
}

.sub-content {
    display: flex;
    flex-direction: row;
    background: white;
    border: 1px solid #DEE2E6;
}

.left-content {
    flex: 1.1;
    display: flex;
    flex-direction: column;
}

.right-content {
    flex: 0.9;
    display: flex;
    flex-direction: column;
}

.info {
    margin-top: 15px;
    padding: 15px;
    border-radius: 10px;
    position: relative;
    display: flex;
    flex-direction: column;
}

.info-1 {
    position: relative;
    display: flex;
    flex-direction: row;
}

.input_from1 {
    width: 500px;
}

.title-link {
    width: 100%;
    padding-top: 30px;
    display: flex;
    flex-direction: row;
}

.title-link p {
    color: black;
    font-size: 18px;
    padding: 3px 5px;
}

.title-link a {
    color: black;
    text-decoration: none;
    font-size: 18px;
}

.title-link a:hover {
    background: #E9E9E9;
    color: hsla(160, 100%, 37%, 1);
}

.pay {
    width: 50%;
    padding-right: 10px;
    margin-top: 20px;
}

.pay button {
    width: 100%;
    border: none;
    background: #7CB643;
    color: white;
    padding: 15px 0px;
    border-radius: 10px;
}

.pay button:hover {
    opacity: 0.9;
}

.pay button:active {
    opacity: 1.2;
}
</style>
