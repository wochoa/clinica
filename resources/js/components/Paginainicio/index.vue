<template>
    <div>
        <div class="content p-0">
            <div class="container-fluid p-0">
                <el-carousel :interval="6000" arrow="always" height="500px">
                    <el-carousel-item v-for="item in datos" :key="item.id">
                        <div class="slide-wrapper">
                            <img :src="urlini + '/' + item.img" class="carousel-img" alt="Slider">

                            <div
                                :class="['carousel-overlay', item.posicion === 'left' ? 'overlay-left' : 'overlay-right']">

                                <div class="container h-100">
                                    <div
                                        :class="['row h-100 align-items-center', item.posicion === 'right' ? 'justify-content-end' : 'justify-content-start']">

                                        <div class="col-md-6"
                                            :class="item.posicion === 'right' ? 'text-right' : 'text-left'">
                                            <div class="carousel-content animate__animated animate__fadeIn">
                                                <h1 class="display-4 font-weight-bold">{{ item.titulo }}</h1>
                                                <p class="lead mb-4">{{ item.frase }}</p>
                                                <el-button type="primary" size="large" round elevation="2">
                                                    Agendar Cita <i class="el-icon-right"></i>
                                                </el-button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </el-carousel-item>
                </el-carousel>
            </div>

            <div class="container mt-5 mb-5">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-4">
                        <el-card :body-style="{ padding: '0px' }" shadow="always"
                            class="border-0 rounded-lg overflow-hidden">
                            <img :src="urlini + '/odonto/image-6.jpg'" class="img-fluid w-100 hover-effect" alt="Clínica">
                        </el-card>
                    </div>

                    <div class="col-lg-6 pl-lg-5">
                        <div class="header-title mb-4">
                            <span class="badge badge-primary mb-2 px-3 py-2">BIENVENIDOS</span>
                            <h2 class="font-weight-bold">
                                <i class="fa-solid fa-heart-pulse text-danger"></i>
                                Sobre el CENTRO ODONTOLÓGICO SD
                            </h2>
                        </div>

                        <el-divider content-position="left"><i class="el-icon-caret-right"></i></el-divider>

                        <p class="text-secondary text-justify" style="font-size: 1.1rem; line-height: 1.8;">
                            El <strong>CENTRO ODONTOLÓGICO SD</strong> es un consultorio especializado en la prevención,
                            diagnóstico y tratamiento de enfermedades bucodentales. Nos enfocamos en el bienestar
                            integral de nuestros pacientes, actuando con profesionalismo y calidez humana en cada
                            intervención.
                        </p>

                        <div
                            class="doctor-profile mt-4 p-4 bg-light rounded d-flex align-items-center shadow-sm border-left border-primary">
                            <div class="ml-3">
                                <h5 class="mb-0 font-weight-bold">C.D. Deysi Janeth SALVATIERRA MALAVER</h5>
                                <small class="text-primary text-uppercase font-weight-bold">Especialista
                                    Responsable</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                img: 'odonto/3-1.jpg',
                titulo: 'Excelencia y Calidez',
                frase: 'Tu sonrisa en manos expertas: Calidez en cada tratamiento.',
                posicion: 'right' // Texto a la derecha
            },
            {
                id: 2,
                img: 'odonto/3-2.jpg',
                titulo: 'Tecnología Avanzada',
                frase: 'Innovación para tu salud bucal con resultados precisos y sin dolor.',
                posicion: 'right' // Texto a la derecha
            },
            {
                id: 3,
                img: 'odonto/slide-1-3.jpg',
                titulo: 'Estética Dental',
                frase: 'Refleja tu mejor versión: Diseñamos la sonrisa que siempre deseaste.',
                posicion: 'left' // Texto a la izquierda
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
.slide-wrapper {
  position: relative;
  height: 100%;
  width: 100%;
}

.carousel-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.carousel-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  transition: all 0.6s ease-in-out;
}

/* Oscurece el lado IZQUIERDO cuando el texto está ahí */
.overlay-left {
  background: linear-gradient(to right, 
    rgba(0, 0, 0, 0.85) 0%, 
    rgba(0, 0, 0, 0.4) 40%, 
    rgba(0, 0, 0, 0) 100%);
}

/* Oscurece el lado DERECHO cuando el texto está ahí */
.overlay-right {
  background: linear-gradient(to left, 
    rgba(0, 0, 0, 0.85) 0%, 
    rgba(0, 0, 0, 0.4) 40%, 
    rgba(0, 0, 0, 0) 100%);
}

.carousel-content {
  color: white;
  // Sombra suave adicional para asegurar lectura
  text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
  
  h1 {
    line-height: 1.1;
    margin-bottom: 20px;
  }
}

/* Responsive: En móviles centramos todo y oscurecemos parejo */
@media (max-width: 768px) {
  .carousel-overlay {
    background: rgba(0, 0, 0, 0.6) !important;
  }
  .text-right, .text-left {
    text-align: center !important;
  }
}
</style>
