@extends('layouts.app')

@section('content')
    <div id="wrapper">
        <!-- Sidebar -->
            <sidebar-component></sidebar-component>
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <!-- TopBar -->
                <topbar-component></topbar-component>
            <!-- Topbar -->

            <!-- Container Fluid-->
            <div class="container-fluid" id="container-wrapper">
                <router-view></router-view>
            </div>
            <!---Container Fluid-->
        </div>
        <!-- Footer -->
            <footer-component></footer-component>
        <!-- Footer -->
        </div>
    </div>
@endsection

<script>
    window.auth_user = {!! json_encode($auth_user); !!};
</script>
