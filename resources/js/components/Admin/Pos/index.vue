<template>
    <div>
        <div class="d-sm-flex align-items-center justify-content-between">
            <h1 class="h3 mb-0 text-gray-800">Point of Sale</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <router-link :to="{ name: 'Home' }">Home</router-link>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    POS
                </li>
            </ol>
        </div>

        <div class="row mb-3">
            <!-- Area Chart -->
            <div class="col-xl-5 col-lg-5">
                <div class="card mb-4">
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                    >
                        <h6 class="m-0 font-weight-bold text-primary">
                            Monthly Recap Report
                        </h6>
                    </div>
                    <div class="card-body"></div>
                </div>
            </div>
            <!-- Pie Chart -->
            <div class="col-xl-7 col-lg-7">
                <div class="card mb-4">
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                    >
                        <h3 class="m-0 font-weight-bold text-primary">
                            Products List
                        </h3>
                        <form>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Search...."
                                v-model="searchItem"
                            />
                        </form>
                    </div>

                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a
                                class="nav-item nav-link active"
                                id="nav-products-tab"
                                data-toggle="tab"
                                href="#nav-products"
                                role="tab"
                                aria-controls="nav-products"
                                aria-selected="true"
                                >All Product</a
                            >
                            <a
                                class="nav-item nav-link"
                                id="nav-category-tab"
                                data-toggle="tab"
                                href="#nav-category"
                                role="tab"
                                aria-controls="nav-category"
                                aria-selected="false"
                                >Category</a
                            >
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div
                            class="tab-pane fade show active"
                            id="nav-products"
                            role="tabpanel"
                            aria-labelledby="nav-products-tab"
                        >
                            <div class="card-body">
                                <div class="row">
                                    <div
                                        class="col-lg-3 col-md-3 col-sm6 col-6"
                                        v-for="product in filterSearch"
                                        :key="product.id"
                                    >
                                        <div class="card text-center">
                                            <img
                                                :src="photo(product.photo)"
                                                class="card-img-top"
                                                alt="..."
                                            />
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    {{ product.name }}
                                                </h5>
                                                <h6>
                                                    Price:
                                                    {{ product.selling_price }}
                                                    BDT
                                                    <span
                                                        class="badge badge-success py-1"
                                                        v-if="
                                                            product.quantity > 0
                                                        "
                                                        >{{
                                                            product.quantity
                                                        }}
                                                        units Available</span
                                                    >
                                                </h6>
                                                <a
                                                    href="#"
                                                    class="btn btn-primary"
                                                    v-if="product.quantity > 0"
                                                    >Add to Cart</a
                                                >
                                                <button
                                                    v-else
                                                    class="btn btn-danger"
                                                >
                                                    Out of Stock
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="tab-pane fade"
                            id="nav-category"
                            role="tabpanel"
                            aria-labelledby="nav-category-tab"
                        >
                            <div class="card-body">
                                <div class="row">
                                    <div
                                        class="col-lg-3 col-md-3 col-sm6 col-6"
                                        v-for="product in filterSearch"
                                        :key="product.id"
                                    >
                                        <div class="card text-center">
                                            <img
                                                :src="photo(product.photo)"
                                                class="card-img-top"
                                                alt="..."
                                            />
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    {{ product.name }}
                                                </h5>
                                                <h6>
                                                    Price:
                                                    {{ product.selling_price }}
                                                    BDT
                                                    <span
                                                        class="badge badge-success py-1"
                                                        v-if="
                                                            product.quantity > 0
                                                        "
                                                        >{{
                                                            product.quantity
                                                        }}
                                                        units Available</span
                                                    >
                                                </h6>
                                                <a
                                                    href="#"
                                                    class="btn btn-primary"
                                                    v-if="product.quantity > 0"
                                                    >Add to Cart</a
                                                >
                                                <button
                                                    v-else
                                                    class="btn btn-danger"
                                                >
                                                    Out of Stock
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Row-->
    </div>
</template>

<script>
export default {
    data() {
        return {
            searchItem: "",
            form: {
                quantity: "",
                product_id: ""
            },
            errors: []
        };
    },
    components: {},
    mounted() {
        this.$store.dispatch("getAllProducts");
    },
    created() {},
    computed: {
        allProducts() {
            return this.$store.getters.getAllProducts;
        },
        filterSearch() {
            if (this.searchItem != "") {
                return this.allProducts.filter(item => {
                    return item.name.match(this.searchItem);
                });
            } else {
                return this.allProducts;
            }
        }
    },
    methods: {
        photo(img) {
            return "/assets/img/product/" + img;
        },
        deleteData(id) {
            Swal.fire({
                title: "Are you sure?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Delete It!"
            }).then(result => {
                if (result.isConfirmed) {
                    axios
                        .delete("/api/product/" + id)
                        .then(res => {
                            this.$store.dispatch("getAllProducts");
                            Toast.fire({
                                icon: "success",
                                title: "Product Data Deleted Successfully"
                            });
                        })
                        .catch(error => {
                            Toast.fire({
                                icon: "error",
                                title: "Data cann't be Deleted"
                            });
                        });
                } else {
                    Toast.fire({
                        icon: "info",
                        title: "Product Data Remains Unchanged"
                    });
                }
            });
        },
        editStock(id) {
            axios
                .get("/api/product/" + id)
                .then(res => {
                    this.form.quantity = res.data.product.quantity;
                    this.form.product_id = res.data.product.id;
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                });
        },
        updateStock() {
            let id = this.form.product_id;
            axios
                .put("/api/product/stock/" + id, {
                    quantity: this.form.quantity
                })
                .then(res => {
                    $("#exampleModalCenter").modal("hide");
                    this.$store.dispatch("getAllProducts");
                    Toast.fire({
                        icon: "success",
                        title: "Product Stock Updated Successfully"
                    });
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                    Toast.fire({
                        icon: "error",
                        title: "Product Stock can't be Updated"
                    });
                });
        }
    }
};
</script>

<style></style>
