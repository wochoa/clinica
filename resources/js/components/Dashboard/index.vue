<template>
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $route.name }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <!-- <li class="breadcrumb-item">
                            <router-link :to="'/home'">Dashboard</router-link>
                        </li> -->
                            <li class="breadcrumb-item active">{{ $route.name }}</li>

                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <!-- <div class="row">
                <div class="col-lg-6 col-10">
                    <router-link to="" class="btn btn-info btn-sm"><i class="fa-regular fa-circle-left"></i> ir a documentos en proceso</router-link>
                </div>

            </div> -->

                <div class="row mt-2">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>150</h3>

                                <p>Registro de citas</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-truck-medical"></i>
                            </div>
                            <router-link :to="'/citas'" class="small-box-footer">Registrar citas <i class="fas fa-arrow-circle-right"></i></router-link>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>150</h3>

                                <p>Registro de pacientes</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-bed-pulse"></i>
                            </div>
                            <router-link :to="'/pacientes'" class="small-box-footer">Registrar pacientes <i class="fas fa-arrow-circle-right"></i></router-link>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>150</h3>

                                <p>Registro de tratamientos</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-suitcase-medical"></i>
                            </div>
                            <router-link :to="'/tratamientos'" class="small-box-footer">Registrar tratamientos <i class="fas fa-arrow-circle-right"></i></router-link>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>150</h3>

                                <p>Registro de dentistas</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-user-doctor"></i>
                            </div>
                            <router-link :to="'/cirujano'" class="small-box-footer">Registrar dentistas <i class="fas fa-arrow-circle-right"></i></router-link>
                        </div>
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->

    </div>
</template>

<script>
export default {
    name: 'ClinicaIndex',

    data() {
        return {

        };
    },

    mounted() {

    },

    methods: {

    },
};
</script>

<style lang="scss" scoped></style>
