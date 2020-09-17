<template>
    <footer
        class="sticky-footer bg-white"
        id="footer"
        v-show="
            $route.path === '/' ||
            $route.path === '/register' ||
            $route.path === '/forget'
                ? false
                : true
        "
    >
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span
                    >copyright &copy; 2020 - developed by
                    <b
                        ><a
                            href="https://indrijunanda.gitlab.io/"
                            target="_blank"
                            >indrijunanda</a
                        ></b
                    >
                </span>
            </div>
        </div>
    </footer>
</template>

<script>
export default {};
</script>

<style></style>
