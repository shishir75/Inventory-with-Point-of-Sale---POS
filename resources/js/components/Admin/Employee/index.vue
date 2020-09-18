<template>
    <div class="row justify-content-center">
        <div class="col-12">
            <div>
                <router-link
                    :to="{ name: 'CreateEmployee' }"
                    class="btn btn-success float-right mr-5"
                    >ADD NEW EMPLOYEE</router-link
                >
            </div>
            <div class="card shadow-sm my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mt-4">
                                    ALL EMPLOYEES
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {};
</script>

<style></style>
