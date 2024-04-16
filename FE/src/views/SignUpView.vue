<script setup lang="ts">
import { ref } from "vue";

const text = ref("vn");
</script>

<template>
    <main>
        <div class="sign-up">
            <h4>Sign Up</h4>
            <div class="py-3 px-3 px-lg-4 rounded-4 bg-white">
                <div>
                    <div class="col">
                        <div class="col-12 col-lg-4">
                            <p><span class="wpcf7-form-control-wrap"><input size="40"
                                        class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control form-control-lg"
                                        placeholder="Họ và tên" value="" type="text"></span>
                            </p>
                        </div>
                        <div class="col-12 col-lg-4">
                            <p><span class="wpcf7-form-control-wrap"><input size="40"
                                        class="wpcf7-form-control wpcf7-tel wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-tel form-control form-control-lg"
                                        placeholder="User name" value="" type="user"></span>
                            </p>
                        </div>
                        <div class="col-12 col-lg-4">
                            <p><span class="wpcf7-form-control-wrap"><input size="40"
                                        class="wpcf7-form-control wpcf7-email wpcf7-text wpcf7-validates-as-email form-control form-control-lg"
                                        aria-invalid="false" placeholder="Địa chỉ Email" value="" type="email"></span>
                            </p>
                        </div>
                        <div class="col-12 col-lg-4">
                            <p><span class="wpcf7-form-control-wrap"><input size="40"
                                        class="wpcf7-form-control wpcf7-password wpcf7-text wpcf7-validates-as-password form-control form-control-lg"
                                        placeholder="Password" value="" type="password"></span>
                            </p>
                        </div>
                        <div class="col-12 col-lg-4">
                            <button class="btn_ship">
                                <strong class="fs-4">Sign Up</strong>
                            </button>
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

.sign-up {
    line-height: 1.5;
    max-width: 1320px;
    width: 1320px;
    margin: auto;
    padding: 50px 0px 20px 0px;
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
