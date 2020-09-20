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
                                class="table align-items-center table-flush table-bordered"
                            >
                                <thead class="thead-light">
                                    <tr>
                                        <th>Serial</th>
                                        <th>Product Name</th>
                                        <th>Product Code</th>
                                        <th>Photo</th>
                                        <th>Category</th>
                                        <th>Supplier</th>
                                        <th>Buying Price</th>
                                        <th>Selling Price</th>
                                        <th>Quantity</th>
                                        <th>Root</th>
                                        <th>Buying Date</th>
                                        <th width="10%">Actions</th>
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
                                        <td>{{ product.quantity }}</td>
                                        <td>{{ product.root }}</td>
                                        <td>{{ product.buying_date }}</td>
                                        <td>
                                            <router-link
                                                :to="{
                                                    name: 'EditEmployee',
                                                    params: { id: product.id }
                                                }"
                                                class="btn btn-sm btn-info"
                                                >Edit</router-link
                                            >
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
            <!--Row-->
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            searchItem: ""
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
        }
    }
};
</script>

<style></style>
