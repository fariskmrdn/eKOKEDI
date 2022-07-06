<template>
    <div class=" form--borang bd-example">
        <div class="border  form--border p-2 mb-2">
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Jenis borang</label>
                <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example">
                        <option value="1">Borang Kebenaran Balik Bermalam</option>
                        <!-- <option value="2">Borang Kebenaran Outing</option> -->
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Id Pelajar :</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="staticEmail2">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Nama Pelajar :</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="staticEmail2">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Nom IC Pelajar :</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="staticEmail2">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Kos Pengajian :</label>
                <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Jenis kos</option>
                        <option value="1">Web</option>
                            <option value="2">Kulinari</option>
                            <option value="2">Perakaunan</option>
                            <option value="2">Animasi</option>
                            <option value="2">Pemasaran</option>
                            <option value="2">Perabot</option>
                            <option value="2">Bakeri</option>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Nama Dorm :</label>
                <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Nama Dorm</option>
                        <option value="1">Ali 1 </option>
                        <option value="1">Ali 2 </option>
                        <option value="1">Ali 3 </option>
                        <option value="1">Ali 4 </option>
                        <option value="1">Ali 5 </option>
                        <option value="1">Ali 6 </option>
                        <option value="1">Ali 7 </option>
                        <option value="1">Ali 8 </option>
                        <option value="1">Uthman 1 </option>
                        <option value="1">Uthman 2 </option>
                        <option value="1">Uthman 3 </option>
                        <option value="1">Uthman 4 </option>
                        <option value="1">Uthman 5 </option>
                        <option value="1">Uthman 6 </option>
                        <option value="1">Uthman 7 </option>
                        <option value="1">Uthman 8 </option>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Tarikh pergi :</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control datepicker" placeholder="Select Date"/>
                </div>
            </div>
            <div class="mb-3 row">
                <label or="inputPassword" class="col-sm-2 col-form-label">Pergi bersama :</label>
                <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example">
                        <option value="1">Ibu bapa / penjaga</option>
                        <!-- <option value="2">Member</option> -->
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Tarikh balik :</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control datepicker" placeholder="Select Date"/>
                </div>
            </div>
        </div>
    </div>

    <!--^ Submit button -->
    <!--todo, make button active and fuctional -->
    <div class="btn--hantar">
        <button type="submit" class="btn btn-primary btn--hantar">Hantar</button>
    </div>
</template>