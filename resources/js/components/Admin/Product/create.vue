<template>
    <div class="row justify-content-center">
        <div class="col-12">
            <div
                class="d-sm-flex align-items-center justify-content-between mb-4"
            >
                <router-link
                    :to="{ name: 'Product' }"
                    class="btn btn-info text-white mb-0 text-gray-800"
                    >All Products</router-link
                >
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <router-link :to="{ name: 'Dashboard' }"
                            >Dashboard</router-link
                        >
                    </li>
                    <li class="breadcrumb-item">Product</li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Add New Product
                    </li>
                </ol>
            </div>
            <div class="card shadow-sm my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mt-4">
                                    Add New Product
                                </h1>
                            </div>

                            <form
                                class="user"
                                @submit.prevent="saveForm"
                                method="POST"
                                enctype="multipart/form-data"
                            >
                                <div class="row login-form">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Product Name</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="exampleInputFirstName"
                                                placeholder="Enter Product Name"
                                                v-model="form.name"
                                            />
                                            <small
                                                class="text-danger"
                                                v-if="errors.name"
                                                >{{ errors.name[0] }}</small
                                            >
                                        </div>

                                        <div class="form-group">
                                            <label>Product Code</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                placeholder="Enter Product Code"
                                                v-model="form.code"
                                            />
                                            <small
                                                class="text-danger"
                                                v-if="errors.code"
                                                >{{ errors.code[0] }}</small
                                            >
                                        </div>
                                        <div class="form-group">
                                            <label>Product Quantity</label>
                                            <input
                                                type="number"
                                                class="form-control"
                                                placeholder="Enter Product Quantity"
                                                v-model="form.quantity"
                                            />
                                            <small
                                                class="text-danger"
                                                v-if="errors.quantity"
                                                >{{ errors.quantity[0] }}</small
                                            >
                                        </div>
                                        <div class="form-group">
                                            <label>Product Buying Date</label>
                                            <input
                                                type="date"
                                                class="form-control"
                                                placeholder="Enter Buying Date"
                                                v-model="form.buying_date"
                                            />
                                            <small
                                                class="text-danger"
                                                v-if="errors.buying_date"
                                                >{{
                                                    errors.buying_date[0]
                                                }}</small
                                            >
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-file">
                                                <label>Product Photo</label>
                                                <input
                                                    type="file"
                                                    class="custom-file-input"
                                                    id="customFile"
                                                    @change="onFileSelected"
                                                />
                                                <label
                                                    class="custom-file-label"
                                                    for="customFile"
                                                    >Choose file</label
                                                >
                                            </div>
                                            <small
                                                class="text-danger"
                                                v-if="errors.photo"
                                                >{{ errors.photo[0] }}</small
                                            >
                                        </div>
                                        <div class="form-group">
                                            <img
                                                :src="form.photo"
                                                alt="Product Photo"
                                                height="70px"
                                                width="70px"
                                                class="rounded"
                                                v-if="form.photo"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Product Category</label>
                                            <select
                                                class="form-control mb-3"
                                                v-model="form.category_id"
                                            >
                                                <option
                                                    value=""
                                                    selected
                                                    disabled
                                                    >Select Category</option
                                                >
                                                <option
                                                    v-for="category in allCategories"
                                                    :key="category.id"
                                                    :value="category.id"
                                                    >{{ category.name }}</option
                                                >
                                            </select>
                                            <small
                                                class="text-danger"
                                                v-if="errors.category_id"
                                                >{{
                                                    errors.category_id[0]
                                                }}</small
                                            >
                                        </div>
                                        <div class="form-group">
                                            <label>Product Supplier</label>
                                            <select
                                                class="form-control mb-3"
                                                v-model="form.supplier_id"
                                            >
                                                <option
                                                    value=""
                                                    selected
                                                    disabled
                                                    >Select Supplier</option
                                                >
                                                <option
                                                    v-for="supplier in allSuppliers"
                                                    :key="supplier.id"
                                                    :value="supplier.id"
                                                    >{{ supplier.name }}</option
                                                >
                                            </select>
                                            <small
                                                class="text-danger"
                                                v-if="errors.supplier_id"
                                                >{{
                                                    errors.supplier_id[0]
                                                }}</small
                                            >
                                        </div>
                                        <div class="form-group">
                                            <label>Product Buying Price</label>
                                            <input
                                                type="number"
                                                class="form-control"
                                                placeholder="Enter Buying Price"
                                                v-model="form.buying_price"
                                            />
                                            <small
                                                class="text-danger"
                                                v-if="errors.buying_price"
                                                >{{
                                                    errors.buying_price[0]
                                                }}</small
                                            >
                                        </div>
                                        <div class="form-group">
                                            <label>Product Selling Price</label>
                                            <input
                                                type="number"
                                                class="form-control"
                                                placeholder="Enter Selling Price"
                                                v-model="form.selling_price"
                                            />
                                            <small
                                                class="text-danger"
                                                v-if="errors.selling_price"
                                                >{{
                                                    errors.selling_price[0]
                                                }}</small
                                            >
                                        </div>

                                        <div class="form-group">
                                            <label>Product Root</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                placeholder="Enter Root"
                                                v-model="form.root"
                                            />
                                            <small
                                                class="text-danger"
                                                v-if="errors.root"
                                                >{{ errors.root[0] }}</small
                                            >
                                        </div>
                                    </div>
                                </div>

                                <button
                                    type="submit"
                                    class="btn btn-primary float-right mr-5 mb-3"
                                >
                                    Save Data
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: {
                name: "",
                code: "",
                supplier_id: "",
                category_id: "",
                quantity: "",
                selling_date: "",
                photo: "",
                buying_price: "",
                selling_price: "",
                root: ""
            },
            errors: []
        };
    },
    components: {},
    mounted() {
        this.$store.dispatch("getAllCategories");
        this.$store.dispatch("getAllSuppliers");
    },
    created() {},
    computed: {
        allCategories() {
            return this.$store.getters.getAllCategories;
        },
        allSuppliers() {
            return this.$store.getters.getAllSuppliers;
        }
    },
    methods: {
        onFileSelected(event) {
            let file = event.target.files[0];
            if (file.size > 1048576) {
                Toast.fire({
                    icon: "error",
                    title: "Image size cannt be more than 1MB!"
                });
            } else {
                let reader = new FileReader();
                reader.onload = event => {
                    this.form.photo = event.target.result;
                    console.log(event.target.result);
                };
                reader.readAsDataURL(file);
            }
        },
        saveForm() {
            axios
                .post("/api/product", this.form)
                .then(res => {
                    this.$router.push({ name: "Product" });
                    Toast.fire({
                        icon: "success",
                        title: "Product Created Succesfully"
                    });
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                    Toast.fire({
                        icon: "error",
                        title: "Product can't be Created"
                    });
                });
        }
    }
};
</script>

<style></style>
