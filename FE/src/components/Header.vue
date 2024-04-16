<script setup lang="ts">
import router from '@/router';
import { onMounted, ref } from 'vue';
import { categorysData } from '../data';
import axios from 'axios';
import { off } from 'process';

const singUP = (() => {
    router.push('/signup');
});

const openOrder = (() => {
    router.push('/order/product');
});

const islogin: any = ref(false);

let menus: any = ref([]);

const gmail: any = ref();
const password: any = ref();
const search: any = ref('');

onMounted(() => {
    menus.value = categorysData;
});

const login = () => {
    axios.post('http://127.0.0.1:8000/api/custom-login', { email: gmail.value, password: password.value })
        .then((response: any) => {
            islogin.value = true;
            alert('Đăng nhập thành công');
        })
        .catch((error: any) => {
            alert('Đăng nhập không thành công');
            islogin.value = false;
        });
}

const setPath = (name: string) => {
    return '/product/' + name.replace(' ', '') + '/0';
};

const setPathSearch = (name: string) => {
    return name.replace(' ', '_');
};

const signout = () => {
    islogin.value = false;
    router.push('/');
}

const searchProduct = () => {
    if (search.value !== '') {
        router.push('/search/' + search.value);
    }
    setTimeout(() => {
        window.location.reload();
    }, 500);
}

</script>

<template>
    <div class="bg-header">
        <header>
            <RouterLink to="/">
                <img class=" logo" src="@/assets/logo2.png" width="50" height="50" />
            </RouterLink>
            <div class="wrapper">
                <nav>
                    <RouterLink v-for="menu in menus" :to="setPath(menu.name)">{{ menu.name }}
                    </RouterLink>
                </nav>
            </div>

            <div class="search_group">
                <div class="input-group mb-2 mt-2">
                    <input type="text" class="form-control" placeholder="Search" aria-describedby="basic-addon2"
                        v-model="search">
                    <div class="input-group-append">
                        <button class="btn btn-success" type="button" @click="searchProduct()">Search</button>
                    </div>
                    <RouterLink to="/cart">
                        <img src="../assets/icon/ic_cart.svg">
                    </RouterLink>
                    <div class="dropdown" style="padding-top: 3px;">
                        <div class="dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="../assets/icon/ic_user.svg">
                        </div>
                        <ul class="dropdown-menu">
                            <li><button v-if="islogin" class="dropdown-item" type="button">Thông tin cá nhân</button></li>
                            <li><button @click="openOrder()" v-if="islogin" class="dropdown-item" type="button">Đơn
                                    mua</button></li>
                            <li><button v-if="!islogin" class="dropdown-item" type="button" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">Login</button></li>
                            <li><button @click="signout()" v-if="islogin" class="dropdown-item"
                                    type="button">Logout</button></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Login</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col">
                            <div class="col-12">
                                <p><span class="wpcf7-form-control-wrap"><input size="40"
                                            class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control form-control-lg"
                                            placeholder="Gmail" type="text" v-model="gmail"></span>
                                </p>
                            </div>
                            <div class="col-12">
                                <p><span class="wpcf7-form-control-wrap"><input size="40"
                                            class="wpcf7-form-control wpcf7-password wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-password form-control form-control-lg"
                                            placeholder="Password" type="password" v-model="password"></span>
                                </p>
                            </div>
                            <span>New to MinApp? </span>
                            <span data-bs-dismiss="modal" style="cursor: pointer;" class="text-primary" @click="singUP">Sign
                                up</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" @click="login()" class="btn btn-primary" data-bs-dismiss="modal">Sign
                            in</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
header {
    line-height: 1.5;
    max-width: 1320px;
    width: 1320px;
    float: left;
    display: flex;
    place-items: center;
    margin: auto;
}

.bg-header {
    width: 100%;
    position: absolute;
    background: #000;
    display: flex;
    margin: auto;
}

.logo {
    display: block;
}

nav {
    width: 100%;
    font-size: 12px;
    text-align: center;
    display: flex;
}

nav a.router-link-exact-active:hover {
    background-color: hsla(160, 100%, 37%, 1);
}

nav a {
    display: inline-block;
    padding: 12px 1rem;
    border-left: 1px solid var(--color-border);
    color: white;
    text-decoration: none;
    font-size: 16px;
}

nav a:first-of-type {
    border: 0;
}

header .wrapper {
    display: flex;
    place-items: flex-start;
    flex-wrap: wrap;
    margin: auto;
}

nav {
    text-align: left;
    /* margin-left: -1rem; */
    font-size: 1rem;
}

header .search_group {
    display: flex;
    place-items: flex-start;
    flex-wrap: wrap;
}

header .search_group img {
    padding-left: 10px;
}

.modal-footer {
    justify-content: center !important;
}
</style>
../data