<template>
    <div class="row justify-content-center">
        <div class="col-12">
            <div>
                <router-link
                    :to="{ name: 'Employee' }"
                    class="btn btn-success float-right mr-5"
                    >ALL EMPLOYEES</router-link
                >
            </div>
            <div class="card shadow-sm my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mt-4">
                                    Add New Employee
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
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="exampleInputFirstName"
                                                placeholder="Enter Your Full Name"
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
                                                type="date"
                                                class="form-control"
                                                placeholder="Enter Joining Date"
                                                v-model="form.joining_date"
                                            />
                                            <small
                                                class="text-danger"
                                                v-if="errors.joining_date"
                                                >{{
                                                    errors.joining_date[0]
                                                }}</small
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
                                                    name="form.photo"
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
                                                src="form.photo"
                                                alt="Employee Photo"
                                                height="70px"
                                                width="70px"
                                                class="rounded"
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
                                            <input
                                                type="number"
                                                class="form-control"
                                                placeholder="Enter Your Salary"
                                                v-model="form.salary"
                                            />
                                            <small
                                                class="text-danger"
                                                v-if="errors.salary"
                                                >{{ errors.salary[0] }}</small
                                            >
                                        </div>
                                        <div class="form-group">
                                            <input
                                                type="number"
                                                class="form-control"
                                                placeholder="Enter Your NID Card Number"
                                                v-model="form.nid"
                                            />
                                            <small
                                                class="text-danger"
                                                v-if="errors.nid"
                                                >{{ errors.nid[0] }}</small
                                            >
                                        </div>
                                        <div class="form-group">
                                            <textarea
                                                name="address"
                                                v-model="form.address"
                                                id="address"
                                                rows="5"
                                                class="form-control"
                                                placeholder="Enter Your Address"
                                            ></textarea>
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
                email: "",
                address: "",
                phone: "",
                salary: "",
                joining_date: "",
                photo: "",
                nid: ""
            },
            errors: []
        };
    },
    components: {},
    mounted() {},
    created() {},
    computed: {},
    methods: {
        saveForm() {}
    }
};
</script>

<style></style>
