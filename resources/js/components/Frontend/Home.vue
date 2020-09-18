<template>
    <span>
        <!-- Masthead-->
        <header class="masthead">
            <div class="h-100">
                <div
                    class="row h-100 align-items-center justify-content-center text-center"
                >
                    <div class="col-lg-10 align-self-end">
                        <h1 class="text-uppercase text-white font-weight-bold">
                            Inventory Management System with POS
                        </h1>
                        <hr class="divider my-4" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white-75 font-weight-light mb-5">
                            Inventory with Point of Sale - POS in Laravel 7,
                            Vuejs, RESTful API & Laravel Sanctum
                        </p>
                        <router-link
                            class="btn btn-primary btn-xl js-scroll-trigger"
                            to="/login"
                            >Getting Started</router-link
                        >
                    </div>
                </div>
            </div>
        </header>
    </span>
</template>

<script>
export default {};
</script>

<style>
header.masthead {
    padding-top: 10rem;
    padding-bottom: calc(10rem - 4.5rem);
    background: linear-gradient(
            to bottom,
            rgba(92, 77, 66, 0.8) 0%,
            rgba(92, 77, 66, 0.8) 100%
        ),
        url("/../assets/img/bg-masthead.jpg");
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: scroll;
    background-size: cover;
}
header.masthead h1 {
    font-size: 2.25rem;
}
@media (min-width: 992px) {
    header.masthead {
        height: 100vh;
        min-height: 40rem;
        padding-top: 4.5rem;
        padding-bottom: 0;
    }
    header.masthead p {
        font-size: 1.15rem;
    }
    header.masthead h1 {
        font-size: 3rem;
    }
}
@media (min-width: 1200px) {
    header.masthead h1 {
        font-size: 3.5rem;
    }
}
</style>
