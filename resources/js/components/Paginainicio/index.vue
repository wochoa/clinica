<template>
  <div>
    <div class="content p-0">
<div class="container-fluid p-0">
      <el-carousel :interval="6000" arrow="always" height="500px">
        <el-carousel-item v-for="item in datos" :key="item.id">
          <div class="carousel-container">
            <img :src="urlini+'/'+item.img" class="carousel-img" alt="Slider">
            
            <div :class="['carousel-overlay', item.posicion === 'left' ? 'overlay-left' : 'overlay-right']">
              <div class="container d-flex h-100 align-items-center" 
                   :class="item.posicion === 'left' ? 'justify-content-start' : 'justify-content-end'">
                
                <div class="carousel-content animate__animated animate__fadeIn" 
                     :class="item.posicion === 'right' ? 'text-right' : 'text-left'">
                  <h1 class="display-4 font-weight-bold">{{ item.titulo }}</h1>
                  <p class="lead">{{ item.frase }}</p>
                  <el-button type="primary" size="large" round>
                     Agendar Cita <i class="el-icon-calendar el-icon--right"></i>
                  </el-button>
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
            <el-card :body-style="{ padding: '0px' }" shadow="always" class="border-0 rounded-lg overflow-hidden">
              <img :src="urlini+'/odonto/image-6.jpg'" class="img-fluid w-100 hover-effect" alt="Clínica">
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
              El <strong>CENTRO ODONTOLÓGICO SD</strong> es un consultorio especializado en la prevención, diagnóstico y tratamiento de enfermedades bucodentales. Nos enfocamos en el bienestar integral de nuestros pacientes, actuando con profesionalismo y calidez humana en cada intervención.
            </p>

            <div class="doctor-profile mt-4 p-4 bg-light rounded d-flex align-items-center shadow-sm border-left border-primary">
              <div class="ml-3">
                <h5 class="mb-0 font-weight-bold">C.D. Deysi Janeth SALVATIERRA MALAVER</h5>
                <small class="text-primary text-uppercase font-weight-bold">Especialista Responsable</small>
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
.carousel-container {
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
  background: linear-gradient(to right, rgba(0,0,0,0.7) 30%, rgba(0,0,0,0.1) 100%);
  display: flex;
  align-items: center;
  color: white;
}

.carousel-content {
  max-width: 600px;
  h1 { text-shadow: 2px 2px 4px rgba(0,0,0,0.5); }
}

.hover-effect {
  transition: transform 0.5s ease;
  &:hover {
    transform: scale(1.03);
  }
}

.border-primary {
  border-left-width: 5px !important;
}

/* Ajuste para móviles */
@media (max-width: 768px) {
  .carousel-content {
    text-align: center;
    h1 { font-size: 2rem; }
  }
  .carousel-overlay {
    background: rgba(0,0,0,0.5);
    justify-content: center;
  }
}
</style>
