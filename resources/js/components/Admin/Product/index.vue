<template>
    <div>
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
            <div
                class="d-sm-flex align-items-center justify-content-between mb-4"
            >
                <router-link
                    :to="{ name: 'CreateProduct' }"
                    class="btn btn-info text-white mb-0 text-gray-800"
                    >Add New Product</router-link
                >
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <router-link :to="{ name: 'Dashboard' }"
                            >Dashboard</router-link
                        >
                    </li>
                    <li class="breadcrumb-item">Product</li>
                    <li class="breadcrumb-item active" aria-current="page">
                        All Products
                    </li>
                </ol>
            </div>

            <div class="row">
                <div class="col-lg-12 mb-4">
                    <!-- Simple Tables -->
                    <div class="card">
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                        >
                            <h4 class="m-0 font-weight-bold">
                                ALL PRODUCT LISTS
                            </h4>
                            <h6>
                                <form>
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Search...."
                                        v-model="searchItem"
                                    />
                                </form>
                            </h6>
                        </div>
                        <div class="table-responsive">
                            <table
                                class="table align-items-center table-flush table-bordered text-center"
                            >
                                <thead class="thead-light">
                                    <tr>
                                        <th>S.L</th>
                                        <th>Product Name</th>
                                        <th>Product Code</th>
                                        <th>Photo</th>
                                        <th>Category</th>
                                        <th>Supplier</th>
                                        <th>Buying Price</th>
                                        <th>Selling Price</th>
                                        <th>Status</th>
                                        <th>Quantity</th>
                                        <th width="13%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(product, index) in filterSearch"
                                        :key="product.id"
                                    >
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ product.name }}</td>
                                        <td>{{ product.code }}</td>
                                        <td>
                                            <img
                                                v-if="product.photo"
                                                :src="photo(product.photo)"
                                                :alt="product.name"
                                                width="50px"
                                                height="40px"
                                            />
                                            <span
                                                v-else
                                                class="badge badge-warning"
                                                >No Image</span
                                            >
                                        </td>
                                        <td>{{ product.category.name }}</td>
                                        <td>{{ product.supplier.name }}</td>
                                        <td>{{ product.buying_price }}</td>

                                        <td>{{ product.selling_price }}</td>
                                        <td>
                                            <span
                                                v-if="product.quantity > 0"
                                                class="badge badge-success"
                                                >Available</span
                                            >
                                            <span
                                                v-else
                                                class="badge badge-danger"
                                                >Stock Out</span
                                            >
                                        </td>
                                        <td>{{ product.quantity }}</td>

                                        <td>
                                            <router-link
                                                :to="{
                                                    name: 'EditProduct',
                                                    params: { id: product.id }
                                                }"
                                                class="btn btn-sm btn-info"
                                                >Edit</router-link
                                            >

                                            <button
                                                type="button"
                                                class="btn btn-sm btn-primary"
                                                data-toggle="modal"
                                                data-target="#exampleModalCenter"
                                                id="#modalCenter"
                                                @click.prevent="
                                                    editStock(product.id)
                                                "
                                            >
                                                Stock
                                            </button>
                                            <button
                                                @click="deleteData(product.id)"
                                                class="btn btn-sm btn-danger"
                                            >
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <h3
                                v-show="filterSearch == ''"
                                class="text-center text-danger my-5"
                            >
                                No Search Result Found
                            </h3>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>
            </div>

            <!-- Modal Center -->
            <div
                class="modal fade"
                id="exampleModalCenter"
                tabindex="-1"
                role="dialog"
                aria-labelledby="exampleModalCenterTitle"
                aria-hidden="true"
            >
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5
                                class="modal-title"
                                id="exampleModalCenterTitle"
                            >
                                Update Product Stock
                            </h5>
                            <button
                                type="button"
                                class="close"
                                data-dismiss="modal"
                                aria-label="Close"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
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
                            <input type="hidden" v-model="form.product_id" />
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-outline-secondary"
                                data-dismiss="modal"
                            >
                                Close
                            </button>
                            <button
                                type="button"
                                @click.prevent="updateStock"
                                class="btn btn-primary"
                            >
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!--Row-->
        </div>
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
                    return item.name
                        .toLowerCase()
                        .match(this.searchItem.toLowerCase());
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
