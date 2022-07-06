<template>
    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title text-black" id="offcanvasRightLabel">Navigasi Laman Web</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul>
                <li>
                    <RouterLink to="/">Laman Utama</RouterLink>
                    <hr>
                </li>
                <li>
                    <RouterLink to="/dashboard">Dashboard</RouterLink>
                    <hr>
                </li>
                <li>
                    <RouterLink to="/borang">E-Borang</RouterLink>
                    <hr>
                </li>
                <li>
                    <RouterLink to="/jadual">E-Jadual</RouterLink>
                    <hr>
                </li>
            </ul>
        </div>
    </div>
</template>