<template>
<div>

    <!-- Content Header (Page header) -->
    <!-- <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> Top Navigation <small>Example 3.0</small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Layout</a></li>
                        <li class="breadcrumb-item active">Top Navigation</li>
                    </ol>
                </div>
            </div>
        </div>
    </div> -->
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="row">

                <div class="col-12">
                    <template>
                        <el-carousel :interval="5000" arrow="always">
                            <el-carousel-item v-for="item in datos" :key="item.id">
                                <img :src="urlini+'/'+item.img" alt="" height="300">
                                <h3>Lo mejor en
odontología moderna.</h3>
                            </el-carousel-item>
                        </el-carousel>
                    </template>
                </div>

            </div>
            <div class="row mt-3">
                <div class="col-6">
                    <el-card shadow="always">
                        <img :src="urlini+'/'+'odonto/image-6.jpg'" alt="" class="img-fluid">
                    </el-card>
                </div>
                <div class="col-6 pt-5 pl-4 pr-5">
                    <h5> <i class="fa-solid fa-heart-pulse fa-2x"></i> Sobre el CENTRO ODONTOLOGICO SD</h5>
                    <el-divider></el-divider>
                    <p style="font-size: 18px;">
                        El CENTRO ODONTOLOGICO SD, es consultorio odontológico cuya actividad es la prevención, diagnóstico y tratamiento de enfermedades bucodentales que afecten los dientes, encías, periodonto, articulación temporomandibular y el conjunto del sistema muscular y nervioso de la zona bucal, actuando con profesionalismo al servicio de los pacientes.                       
                    </p>
                    <h4 class="text-center pt-5">C.D. Deysi Janeth SALVATIERRA MALAVER</h4>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

</div>
</template>

<script>
export default {
    name: 'index',
    props: ['urlini'],

    data() {
        return {
            datos: [{
                    id: 1,
                    img: 'odonto/3-1.jpg'
                },
                {
                    id: 2,
                    img: 'odonto/3-2.jpg'
                },
                {
                    id: 3,
                    img: 'odonto/slide-1-3.jpg'
                }
            ]
        };
    },

    mounted() {

    },

    methods: {

    },
};
</script>

<style lang="scss" scoped>
.el-carousel__item h3 {
    color: #475669;
    font-size: 18px;
    opacity: 0.75;
    line-height: 300px;
    margin: 0;
}

.el-carousel__item:nth-child(2n) {
    background-color: #99a9bf;
}

.el-carousel__item:nth-child(2n+1) {
    background-color: #d3dce6;
}
</style>
