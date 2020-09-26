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
                            Add Expense
                        </h6>
                        <button
                            type="button"
                            class="btn btn-sm btn-primary"
                            data-toggle="modal"
                            data-target="#exampleModalCenter"
                            id="#modalCenter"
                        >
                            Add Customer
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table
                                class="table align-items-center table-flush"
                                style="font-size:12px"
                            >
                                <thead class="thead-light">
                                    <tr>
                                        <th>Serial</th>
                                        <th>Product Title</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Total Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(cart, index) in allCartProducts"
                                        :key="cart.id"
                                    >
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ cart.product.name }}</td>
                                        <td>
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button
                                                        type="button"
                                                        class="quantity-left-minus btn btn-sm btn-secondary btn-number mt-2"
                                                        @click="
                                                            decreaseItem(
                                                                cart.id
                                                            )
                                                        "
                                                    >
                                                        <i
                                                            class="fas fa-minus"
                                                        ></i>
                                                    </button>
                                                </span>
                                                <input
                                                    type="text"
                                                    class="form-control input-number mt-1 rounded"
                                                    :value="cart.quantity"
                                                    min="1"
                                                    max="100"
                                                    style="height:29px"
                                                />
                                                <span class="input-group-btn">
                                                    <button
                                                        type="button"
                                                        class="quantity-right-plus btn btn-sm btn-success btn-number mt-2"
                                                        @click="
                                                            increaseItem(
                                                                cart.id
                                                            )
                                                        "
                                                    >
                                                        <i
                                                            class="fas fa-plus"
                                                        ></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            {{
                                                cart.product.selling_price.toFixed(
                                                    2
                                                )
                                            }}
                                        </td>
                                        <td>
                                            {{
                                                totalPrice(
                                                    cart.product.selling_price,
                                                    cart.quantity
                                                )
                                            }}
                                        </td>
                                        <td>
                                            <button
                                                class="btn btn-sm btn-danger"
                                                @click="deleteData(cart.id)"
                                            >
                                                <i
                                                    class="fa fa-times"
                                                    aria-hidden="true"
                                                ></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <ul class="list-group">
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center"
                            >
                                Total Quantity :
                                <strong>{{ totalQuantity }}</strong>
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center"
                            >
                                Sub Total :
                                <strong>$ {{ subTotal }}</strong>
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center"
                            >
                                <p>Vat <small>(15%)</small></p>
                                :
                                <strong>$ {{ vat }}</strong>
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center"
                            >
                                Total Amount :
                                <strong>$ {{ priceWithVat }}</strong>
                            </li>
                        </ul>

                        <form action="" class="mt-5">
                            <div class="form-group">
                                <label for="">Select Customer</label>
                                <select
                                    v-model="form.customer_id"
                                    class="form-control"
                                >
                                    <option value="" selected disabled
                                        >Select Customer</option
                                    >
                                    <option
                                        v-for="customer in allCustomers"
                                        :key="customer.id"
                                        :value="customer.id"
                                        >{{ customer.name }} -
                                        {{ customer.phone }}</option
                                    >
                                </select>
                                <small
                                    class="text-danger"
                                    v-if="errors.customer_id"
                                    >{{ errors.category_id[0] }}</small
                                >
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Pay Amount</label>
                                        <input
                                            type="number"
                                            class="form-control"
                                            placeholder="Enter Pay Amount"
                                            v-model="form.pay"
                                        />
                                        <small
                                            class="text-danger"
                                            v-if="errors.pay"
                                            >{{ errors.pay[0] }}</small
                                        >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for=""
                                            >Select Payment Method</label
                                        >
                                        <select
                                            v-model="form.payment_method"
                                            class="form-control"
                                        >
                                            <option value="" selected disabled
                                                >Payment Method</option
                                            >
                                            <option value="HandCash"
                                                >Hand Cash</option
                                            >
                                            <option value="HandCash"
                                                >Cheaque</option
                                            >
                                            <option value="HandCash"
                                                >Gift Card</option
                                            >
                                        </select>
                                        <small
                                            class="text-danger"
                                            v-if="errors.payment_method"
                                            >{{
                                                errors.payment_method[0]
                                            }}</small
                                        >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <p class="text-center">Due Amount</p>
                                        <div class="row justify-content-center">
                                            <h2
                                                class="btn btn-sm"
                                                :class="
                                                    duePrice == '0.00'
                                                        ? 'btn-success'
                                                        : 'btn-danger'
                                                "
                                            >
                                                {{ duePrice }}
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button
                                type="submit"
                                class="btn btn-success float-right my-4"
                                :disabled="disabledButton"
                            >
                                Payment Confirm
                            </button>
                        </form>
                    </div>
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
                                @click="getAllProducts"
                                >All Product</a
                            >
                            <a
                                v-for="category in allCategories"
                                :key="category.id"
                                class="nav-item nav-link"
                                id="nav-category-tab"
                                data-toggle="tab"
                                href="#nav-category"
                                role="tab"
                                aria-controls="nav-category"
                                aria-selected="false"
                                @click="categoryProducts(category.id)"
                                >{{ category.name }}</a
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
                                                    @click.prevent="
                                                        addToCart(product.id)
                                                    "
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
                                        v-for="product in alLProductsByCategory"
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
                                                    @click.prevent="
                                                        addToCart(product.id)
                                                    "
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

        <!-- Modal Center -->
        <div
            class="modal fade"
            id="exampleModalCenter"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true"
        >
            <div
                class="modal-dialog modal-xl modal-dialog-centered"
                role="document"
            >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">
                            Add New Customer
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
                        <form
                            class="user"
                            method="POST"
                            enctype="multipart/form-data"
                        >
                            <div class="row login-form">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="exampleInputFirstName"
                                            placeholder="Enter Customer Full Name"
                                            v-model="form.name"
                                        />
                                        <small
                                            class="text-danger"
                                            v-if="errors.name"
                                            >{{ errors.name[0] }}</small
                                        >
                                    </div>

                                    <div class="form-group">
                                        <input
                                            type="number"
                                            class="form-control"
                                            placeholder="Enter Phone Number"
                                            v-model="form.phone"
                                        />
                                        <small
                                            class="text-danger"
                                            v-if="errors.phone"
                                            >{{ errors.phone[0] }}</small
                                        >
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-file">
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
                                            alt="Employee Photo"
                                            height="70px"
                                            width="70px"
                                            class="rounded"
                                            v-if="form.photo"
                                        />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input
                                            type="email"
                                            class="form-control"
                                            id="exampleInputEmail"
                                            aria-describedby="emailHelp"
                                            placeholder="Enter Email Address"
                                            v-model="form.email"
                                        />
                                        <small
                                            class="text-danger"
                                            v-if="errors.email"
                                            >{{ errors.email[0] }}</small
                                        >
                                    </div>

                                    <div class="form-group">
                                        <textarea
                                            name="address"
                                            v-model="form.address"
                                            id="address"
                                            rows="5"
                                            class="form-control"
                                            placeholder="Enter Customer Address"
                                        ></textarea>
                                        <small
                                            class="text-danger"
                                            v-if="errors.address"
                                            >{{ errors.address[0] }}</small
                                        >
                                    </div>
                                </div>
                            </div>
                        </form>
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
                            class="btn btn-primary"
                            @click="saveForm"
                        >
                            Save Data
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!--Row-->

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
                product_id: "",
                customer_id: "",
                pay: "",
                payment_method: "",
                name: "",
                email: "",
                address: "",
                phone: "",
                photo: ""
            },
            errors: []
        };
    },
    components: {},
    mounted() {
        this.$store.dispatch("getAllProducts");
        this.$store.dispatch("getAllCategories");
        this.$store.dispatch("getAllCustomers");
    },
    created() {
        this.$store.dispatch("getAllCartProducts");
    },
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
        },
        allCategories() {
            return this.$store.getters.getAllCategories;
        },
        alLProductsByCategory() {
            return this.$store.getters.getAlLProductsByCategory;
        },
        allCustomers() {
            return this.$store.getters.getAllCustomers;
        },
        allCartProducts() {
            return this.$store.getters.getAllCartProducts;
        },
        subTotal() {
            let price = 0;
            this.allCartProducts.forEach(cart => {
                price += cart.product.selling_price * cart.quantity;
            });
            return price.toFixed(2);
        },
        vat() {
            return (this.subTotal * 0.15).toFixed(2);
        },
        totalQuantity() {
            let quantity = 0;
            this.allCartProducts.forEach(cart => {
                quantity += cart.quantity;
            });
            return quantity;
        },
        priceWithVat() {
            let price = parseFloat(this.subTotal);
            let vat = parseFloat(price * 0.15);
            return (price + vat).toFixed(2);
        },
        duePrice() {
            let paid = this.form.pay;
            let due = parseFloat(this.priceWithVat) - parseFloat(paid);
            return due.toFixed(2);
        },
        disabledButton() {
            if (this.duePrice < 0) {
                return true;
            } else {
                return false;
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
                        .delete("/api/cart/" + id)
                        .then(res => {
                            this.$store.dispatch("getAllCartProducts");
                            Toast.fire({
                                icon: "success",
                                title: "Product Deleted Successfully from Cart"
                            });
                        })
                        .catch(error => {
                            Toast.fire({
                                icon: "error",
                                title: "Product can't be Deleted from Cart"
                            });
                        });
                } else {
                    Toast.fire({
                        icon: "info",
                        title: "Product Remains Unchanged in Cart"
                    });
                }
            });
        },
        categoryProducts(id) {
            this.$store.dispatch("getAlLProductsByCategory", id);
        },
        getAllProducts() {
            this.$store.dispatch("getAllProducts");
        },
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
                .post("/api/customer", this.form)
                .then(res => {
                    $("#exampleModalCenter").modal("hide");
                    this.$store.dispatch("getAllCustomers");
                    Toast.fire({
                        icon: "success",
                        title: "Customer Created Succesfully"
                    });
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                    Toast.fire({
                        icon: "error",
                        title: "Customer can't be Created"
                    });
                });
        },
        addToCart(id) {
            axios
                .post("/api/cart", { id: id })
                .then(res => {
                    this.$store.dispatch("getAllCartProducts");
                    Toast.fire({
                        icon: "success",
                        title: "Add to Cart Succesfully"
                    });
                })
                .catch(error => {
                    Toast.fire({
                        icon: "error",
                        title: "Can't Add to Cart"
                    });
                });
        },
        totalPrice(unit_price, quantity) {
            return (unit_price * quantity).toFixed(2);
        },
        increaseItem(id) {
            axios
                .put("/api/cart/increase/" + id)
                .then(res => {
                    this.$store.dispatch("getAllCartProducts");
                    Toast.fire({
                        icon: "success",
                        title: "Quantity Increased Succesfully"
                    });
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                    Toast.fire({
                        icon: "error",
                        title: "Quantity can't be Increased"
                    });
                });
        },
        decreaseItem(id) {
            axios
                .put("/api/cart/decrease/" + id)
                .then(res => {
                    this.$store.dispatch("getAllCartProducts");
                    Toast.fire({
                        icon: "success",
                        title: "Quantity Decreased Succesfully"
                    });
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                    Toast.fire({
                        icon: "error",
                        title: "Quantity can't be Decreased"
                    });
                });
        }
    }
};
</script>

<style></style>
