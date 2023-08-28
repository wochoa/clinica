<template>
<div class="container">

    <div class="text-center">
        <!-- <input type="radio" id="radio1" name="accion" value="fractura" checked="checked" /><label for="radio1">Fractura</label>
        <input type="radio" id="radio2" name="accion" value="restauracion" /><label for="radio2">Restauracion</label>
        <input type="radio" id="radio3" name="accion" value="borrar" /><label for="radio3">Borrar</label>
        <input type="radio" id="radio4" name="accion" value="extraccion" /><label for="radio4">Extraccion</label>
        <input type="radio" id="radio5" name="accion" value="puente" /><label for="radio5">Puente</label> -->

        <el-radio-group v-model="tiporadio" @change="seleccionforma" size="small" v-if="can('tratamientos_create')">
            <el-radio-button label="Fractura"></el-radio-button>
            <el-radio-button label="Restauracion"></el-radio-button>
            <el-radio-button label="Borrar"></el-radio-button>
            <el-radio-button label="Extraccion"></el-radio-button>
            <el-radio-button label="Puente"></el-radio-button>
        </el-radio-group>

    </div>
    <br>
    <div id="canvasesdiv" style="position:relative; width:810px; height:205px;">
        <canvas id="myCanvas" width="810" height="205" style="z-index: 1; position:absolute; left:0px; top:0px;"></canvas>
        <canvas id="myCanvas2" width="810" height="205" style="z-index: 2; position:absolute; left:0px; top:0px;"></canvas>
        <canvas id="myCanvas3" width="810" height="205" style="z-index: 3; position:absolute; left:0px; top:0px;"></canvas>
        <canvas id="myCanvas4" width="810" height="205" style="z-index: 4; position:absolute; left:0px; top:0px;"></canvas>
    </div>

    <br />
    <div v-show="btnborrar" class="text-center">
        <!-- <input type="radio" id="radio_1" name="seccion" value="seccion" checked="checked" /><label for="radio_1">Seccion</label>
        <input type="radio" id="radio_2" name="seccion" value="diente" /><label for="radio_2">Diente</label> -->
        <el-radio-group v-model="tipoborrado" size="small">
            <el-radio-button label="seccion"></el-radio-button>
            <el-radio-button label="diente"></el-radio-button>

        </el-radio-group>
    </div>

</div>
</template>

<script>
import axios from 'axios';

window.$ = window.jQuery = require('jquery')
export default {
    name: 'Odontograma',
    props: {
        ruta: '',
        usuario: '',
        formulariotrata: '',
        idtratamiento: null
    },

    data() {
        return {
            color_line: 'black',
            medida: 40,
            separacion_x: 10,
            separacion_y: 10,
            iniciar_x: 0,
            iniciar_y: 20,
            //Dientes para el puente
            diente1: 0,
            diente2: 0,
            ////////////////////////////
            canvas: null,
            context: null,
            layer2: null,
            ctx2: null,
            layer3: null,
            ctx3: null,
            layer4: null,
            ctx4: null,

            posx: null,
            posy: null,
            ////////////////////////

            datospintados: [],
            datospintados2: [],

            ////////////////////////////
            tiporadio: 'Fractura',
            tipoborrado: 'seccion',
            btnborrar: false

        };
    },
    created() {
        if(this.idtratamiento){
            this.odontogral(this.idtratamiento);
        }
        

    },

    mounted() {
        this.inicializa();

        // if(this.datospintados2.length>0)//datospintados2 podemos cambiar por datospintados para pintar
        // {
        //     //alert('podemos pintar xq se tiene datos')
        //     for(var i=0;i<this.datospintados2.length;i++)
        //     {
        //         switch(this.datospintados2[i].funcion)
        //         {
        //             case 'dibuja_seccion': this.dibuja_seccion(this.context,this.datospintados2[i].diente1,this.datospintados2[i].seccion,this.datospintados2[i].color);break;
        //             case 'marcar_extraccion': this.marcar_extraccion(this.context,this.datospintados2[i].diente1,this.datospintados2[i].color);break;
        //             case 'marcar_puente': this.marcar_puente(this.context,this.datospintados2[i].diente1,this.datospintados2[i].diente2,this.datospintados2[i].color);break;
        //         }
        //     }
        // }
        // this.layer4.addEventListener("mousemove", this.Marcar, false);
    },

    methods: {
        odontogral(value) {
            var url = '/listatratamiento/' + value
            axios.get(url).then(res => {
                // this.tratamiento=res.data.tratamiento[0];
                // this.historial=res.data.historial;
                this.datospintados2 = res.data.odontogeneral
                // alert(this.datospintados2.length)

                if(this.datospintados2.length>0)//datospintados2 podemos cambiar por datospintados para pintar
                {
                    //alert('podemos pintar xq se tiene datos')
                    for(var i=0;i<this.datospintados2.length;i++)
                    {
                        switch(this.datospintados2[i].funcion)
                        {
                            case 'dibuja_seccion': this.dibuja_seccion(this.context,this.datospintados2[i].diente1,this.datospintados2[i].seccion,this.datospintados2[i].color);break;
                            case 'marcar_extraccion': this.marcar_extraccion(this.context,this.datospintados2[i].diente1,this.datospintados2[i].color);break;
                            case 'marcar_puente': this.marcar_puente(this.context,this.datospintados2[i].diente1,this.datospintados2[i].diente2,this.datospintados2[i].color);break;
                        }
                    }
                }

            })
        },
        inicializa() {
            // Valores iniciales
            this.canvas = document.getElementById('myCanvas');
            this.context = this.canvas.getContext('2d');
            //
            this.layer2 = document.getElementById("myCanvas2");
            this.ctx2 = this.layer2.getContext("2d");
            //
            this.layer3 = document.getElementById("myCanvas3");
            this.ctx3 = this.layer3.getContext("2d");
            //
            this.layer4 = document.getElementById("myCanvas4");
            this.ctx4 = this.layer4.getContext("2d");
            //
            // var color_line = 'black';
            // var medida = 40;
            // var separacion_x = 10;
            // var separacion_y = 10;
            // var iniciar_x = 0;
            // var iniciar_y = 20;
            //Dientes para el puente
            // var diente1 = 0;
            // var diente2 = 0;
            // 1 - 16 dientes
            for (var x = 0; x < 16; x++) {
                this.iniciar_x = (x * this.medida) + (this.separacion_x * x) + this.separacion_x;
                this.dibuja_contorno(this.context, this.iniciar_x, this.iniciar_y, this.medida, this.separacion_x, 10);
                /* Numero de diente */
                this.context.font = '10pt Calibri';
                this.context.textAlign = 'center';
                this.context.fillStyle = 'blue';
                var numfil11 = 18
                var numfil12 = 13
                if (x < 8) {
                    this.context.fillText(numfil11 - x, this.iniciar_x + (this.medida / 2), (this.iniciar_y / 2) + 5);

                } else {
                    this.context.fillText(numfil12 + x, this.iniciar_x + (this.medida / 2), (this.iniciar_y / 2) + 5);
                }
                // this.context.fillText(x + 1, this.iniciar_x + (this.medida / 2), (this.iniciar_y / 2) + 5);
            }
            // 17 - 32 dientes
            this.iniciar_x = 0;
            this.iniciar_y = this.medida + 100;
            for (var x = 0; x < 16; x++) {
                this.iniciar_x = (x * this.medida) + (this.separacion_x * x) + this.separacion_x;
                this.dibuja_contorno(this.context, this.iniciar_x, this.iniciar_y, this.medida, this.separacion_x, 10);
                /* Numero de diente */
                this.context.font = '10pt Calibri';
                this.context.textAlign = 'center';
                this.context.fillStyle = 'blue';
                var numfil21 = 48
                var numfil222 = 23
                if (x < 8) {
                    this.context.fillText(numfil21 - x, this.iniciar_x + (this.medida / 2), (this.iniciar_y - 10) + 5);

                } else {
                    this.context.fillText(numfil222 + x, this.iniciar_x + (this.medida / 2), (this.iniciar_y - 10) + 5);
                }
                // this.context.fillText(x + 17, this.iniciar_x + (this.medida / 2), (this.iniciar_y - 10) + 5);
            }
            // DIBUJAR LA LINEA VERTICAL QUE DIVICA CADA 8 DIENTES
            this.ctx4.moveTo(405, 0);
            this.ctx4.lineTo(405, 205);
            this.ctx4.strokeStyle = "#f00";
            this.ctx4.stroke();
            //  FIN DE LINEA VERTICAL
            // this.dibuja_seccion(this.context, 2, 3, 'red');s
            //dibuja_seccion(context, 18, 5, 'green');
            //dibuja_seccion(context, 24, 4, 'blue');
            // window.onload = function () {
            // localStorage.clear();
            // this.eventoclick();
            // }
            window.addEventListener("load", () => {
                localStorage.clear();
                this.eventoclick();
            });
        },
        // Funcion para dibujar las lineas de cada diente
        dibuja_contorno(context, inicio_x, inicio_y, med, separacion_x, separacion_y) {
            var ctx = context;
            // Definiendo puntos de dibujo
            var cua = med / 4;
            var ter = cua * 3;
            /* 1ra zona */
            if (ctx) {
                ctx.strokeStyle = this.color_line;
                ctx.beginPath();
                ctx.moveTo(inicio_x, inicio_y);
                ctx.lineTo(med + inicio_x, inicio_y);
                ctx.lineTo(ter + inicio_x, cua + inicio_y);
                ctx.lineTo(cua + inicio_x, cua + inicio_y);
                ctx.closePath();
                ctx.stroke();
            }
            /* 2da zona */
            if (ctx) {
                ctx.strokeStyle = this.color_line;
                ctx.beginPath();
                ctx.moveTo(ter + inicio_x, cua + inicio_y);
                ctx.lineTo(med + inicio_x, inicio_y);
                ctx.lineTo(med + inicio_x, med + inicio_y);
                ctx.lineTo(ter + inicio_x, ter + inicio_y);
                ctx.closePath();
                ctx.stroke();
            }
            /* 3ra zona */
            if (ctx) {
                ctx.strokeStyle = this.color_line;
                ctx.beginPath();
                ctx.moveTo(cua + inicio_x, ter + inicio_y);
                ctx.lineTo(ter + inicio_x, ter + inicio_y);
                ctx.lineTo(med + inicio_x, med + inicio_y);
                ctx.lineTo(inicio_x, med + inicio_y);
                ctx.closePath();
                ctx.stroke();
            }
            /* 4ta zona */
            if (ctx) {
                ctx.strokeStyle = this.color_line;
                ctx.beginPath();
                ctx.moveTo(inicio_x, inicio_y);
                ctx.lineTo(cua + inicio_x, cua + inicio_y);
                ctx.lineTo(cua + inicio_x, ter + inicio_y);
                ctx.lineTo(inicio_x, med + inicio_y);
                ctx.closePath();
                ctx.stroke();
            }
        },
        // Funcion para pintar una region del diente
        dibuja_seccion(contexto, num_diente, seccion, color_pas) {
            var ctx = contexto;
            // Definiendo puntos de dibujo
            var med = this.medida;
            var cua = med / 4;
            var ter = cua * 3;
            var num_diente = num_diente - 1;
            this.color_line = color_pas;
            if (num_diente < 16) {
                var inicio_y = 20;
            } else {
                num_diente = num_diente - 16;
                inicio_y = med + 100;
                //if(num_diente==1){num_diente=0;}
            }
            //alert(num_diente);
            var inicio_x = (num_diente * med) + (this.separacion_x * num_diente) + this.separacion_x;
            /* 1ra zona */
            if (seccion == 1) {
                if (ctx) {
                    ctx.fillStyle = this.color_line;
                    ctx.beginPath();
                    ctx.moveTo(inicio_x, inicio_y);
                    ctx.lineTo(med + inicio_x, inicio_y);
                    ctx.lineTo(ter + inicio_x, cua + inicio_y);
                    ctx.lineTo(cua + inicio_x, cua + inicio_y);
                    ctx.closePath();
                    ctx.fill();
                    ctx.strokeStyle = 'black';
                    ctx.stroke();
                }
            }
            /* 2da zona */
            if (seccion == 2) {
                if (ctx) {
                    ctx.fillStyle = this.color_line;
                    ctx.beginPath();
                    ctx.moveTo(ter + inicio_x, cua + inicio_y);
                    ctx.lineTo(med + inicio_x, inicio_y);
                    ctx.lineTo(med + inicio_x, med + inicio_y);
                    ctx.lineTo(ter + inicio_x, ter + inicio_y);
                    ctx.closePath();
                    ctx.fill();
                    ctx.strokeStyle = 'black';
                    ctx.stroke();
                }
            }
            /* 3ra zona */
            if (seccion == 3) {
                if (ctx) {
                    ctx.fillStyle = this.color_line;
                    ctx.beginPath();
                    ctx.moveTo(cua + inicio_x, ter + inicio_y);
                    ctx.lineTo(ter + inicio_x, ter + inicio_y);
                    ctx.lineTo(med + inicio_x, med + inicio_y);
                    ctx.lineTo(inicio_x, med + inicio_y);
                    ctx.closePath();
                    ctx.fill();
                    ctx.strokeStyle = 'black';
                    ctx.stroke();
                }
            }
            /* 4ta zona */
            if (seccion == 4) {
                if (ctx) {
                    ctx.fillStyle = this.color_line;
                    ctx.beginPath();
                    ctx.moveTo(inicio_x, inicio_y);
                    ctx.lineTo(cua + inicio_x, cua + inicio_y);
                    ctx.lineTo(cua + inicio_x, ter + inicio_y);
                    ctx.lineTo(inicio_x, med + inicio_y);
                    ctx.closePath();
                    ctx.fill();
                    ctx.strokeStyle = 'black';
                    ctx.stroke();
                }
            }
            /* 5ta zona(medio) */
            if (seccion == 5) {
                if (ctx) {
                    ctx.fillStyle = this.color_line;
                    ctx.beginPath();
                    ctx.moveTo(cua + inicio_x, cua + inicio_y);
                    ctx.lineTo(ter + inicio_x, cua + inicio_y);
                    ctx.lineTo(ter + inicio_x, ter + inicio_y);
                    ctx.lineTo(cua + inicio_x, ter + inicio_y);
                    ctx.closePath();
                    ctx.fill();
                    ctx.strokeStyle = 'black';
                    ctx.stroke();
                }
            }
        },
        //
        // Funcion para sombrear
        marcar_seccion(contexto, num_diente, seccion, color_pas) {
            var ctx = contexto;
            // Definiendo puntos de dibujo
            var med = this.medida;
            var cua = med / 4;
            var ter = cua * 3;
            var num_diente = num_diente - 1;
            this.color_line = color_pas;
            if (num_diente < 16) {
                var inicio_y = 20;
            } else {
                num_diente = num_diente - 16;
                var inicio_y = med + 100;
                //if(num_diente==1){num_diente=0;}
            }
            //alert(num_diente);
            var inicio_x = (num_diente * med) + (this.separacion_x * num_diente) + this.separacion_x;
            /* 1ra zona */
            if (seccion == 1) {
                if (ctx) {
                    ctx.fillStyle = this.color_line;
                    ctx.beginPath();
                    ctx.moveTo(inicio_x, inicio_y);
                    ctx.lineTo(med + inicio_x, inicio_y);
                    ctx.lineTo(ter + inicio_x, cua + inicio_y);
                    ctx.lineTo(cua + inicio_x, cua + inicio_y);
                    ctx.closePath();
                    //ctx.fill();
                    ctx.strokeStyle = 'yellow';
                    ctx.stroke();
                }
            }
            /* 2da zona */
            if (seccion == 2) {
                if (ctx) {
                    ctx.fillStyle = this.color_line;
                    ctx.beginPath();
                    ctx.moveTo(ter + inicio_x, cua + inicio_y);
                    ctx.lineTo(med + inicio_x, inicio_y);
                    ctx.lineTo(med + inicio_x, med + inicio_y);
                    ctx.lineTo(ter + inicio_x, ter + inicio_y);
                    ctx.closePath();
                    //ctx.fill();
                    ctx.strokeStyle = 'yellow';
                    ctx.stroke();
                }
            }
            /* 3ra zona */
            if (seccion == 3) {
                if (ctx) {
                    ctx.fillStyle = this.color_line;
                    ctx.beginPath();
                    ctx.moveTo(cua + inicio_x, ter + inicio_y);
                    ctx.lineTo(ter + inicio_x, ter + inicio_y);
                    ctx.lineTo(med + inicio_x, med + inicio_y);
                    ctx.lineTo(inicio_x, med + inicio_y);
                    ctx.closePath();
                    //ctx.fill();
                    ctx.strokeStyle = 'yellow';
                    ctx.stroke();
                }
            }
            /* 4ta zona */
            if (seccion == 4) {
                if (ctx) {
                    ctx.fillStyle = this.color_line;
                    ctx.beginPath();
                    ctx.moveTo(inicio_x, inicio_y);
                    ctx.lineTo(cua + inicio_x, cua + inicio_y);
                    ctx.lineTo(cua + inicio_x, ter + inicio_y);
                    ctx.lineTo(inicio_x, med + inicio_y);
                    ctx.closePath();
                    //ctx.fill();
                    ctx.strokeStyle = 'yellow';
                    ctx.stroke();
                }
            }
            /* 5ta zona(medio) */
            if (seccion == 5) {
                if (ctx) {
                    ctx.fillStyle = this.color_line;
                    ctx.beginPath();
                    ctx.moveTo(cua + inicio_x, cua + inicio_y);
                    ctx.lineTo(ter + inicio_x, cua + inicio_y);
                    ctx.lineTo(ter + inicio_x, ter + inicio_y);
                    ctx.lineTo(cua + inicio_x, ter + inicio_y);
                    ctx.closePath();
                    //ctx.fill();
                    ctx.strokeStyle = 'yellow';
                    ctx.stroke();
                }
            }
        },
        // Funcion para sombrear diente completo
        marcar_diente(contexto, num_diente, color_pas) {
            var ctx = contexto;
            // Definiendo puntos de dibujo
            var med = this.medida;
            num_diente = num_diente - 1;
            this.color_line = color_pas;
            if (num_diente < 16) {
                var inicio_y = 20;
            } else {
                num_diente = num_diente - 16;
                var inicio_y = med + 100;
            }
            //alert(num_diente);
            var inicio_x = (num_diente * med) + (this.separacion_x * num_diente) + this.separacion_x;

            ctx.fillStyle = this.color_line;
            ctx.beginPath();
            ctx.moveTo(inicio_x, inicio_y);
            ctx.lineTo(inicio_x + 40, inicio_y);
            ctx.lineTo(inicio_x + 40, inicio_y + 40);
            ctx.lineTo(inicio_x, inicio_y + 40);
            ctx.closePath();
            ctx.strokeStyle = this.color_line;
            ctx.stroke();
        },
        // Funcion para sombrear diente completo
        marcar_extraccion(contexto, num_diente, color_pas) {
            var ctx = contexto;
            // Definiendo puntos de dibujo
            var med = this.medida;
            num_diente = num_diente - 1;
            this.color_line = color_pas;
            if (num_diente < 16) {
                var inicio_y = 20;
            } else {
                num_diente = num_diente - 16;
                var inicio_y = med + 100;
            }
            //alert(num_diente);
            var inicio_x = (num_diente * med) + (this.separacion_x * num_diente) + this.separacion_x;

            ctx.fillStyle = this.color_line;
            ctx.beginPath();
            ctx.lineWidth = 3;
            ctx.moveTo(inicio_x, inicio_y);
            ctx.lineTo(inicio_x + 40, inicio_y + 40);
            ctx.moveTo(inicio_x + 40, inicio_y);
            ctx.lineTo(inicio_x, inicio_y + 40);
            ctx.stroke();
            ctx.lineWidth = 1;
        },
        // Funcion para marcar puente
        marcar_puente(contexto, dient_1, dient_2, color_pas) {
            var ctx = contexto;
            // Definiendo puntos de dibujo
            var med = this.medida;
            var num_diente1 = dient_1 - 1;
            var num_diente2 = dient_2 - 1;
            // this.color_line = color_pas;
            if (num_diente1 < 16) {
                var inicio_y = 80;
            } else {
                num_diente1 = num_diente1 - 16;
                num_diente2 = num_diente2 - 16;
                var inicio_y = med + 160;
            }
            //alert(num_diente);
            // console.log(num_diente)
            var inicio_x = (num_diente1 * med) + (this.separacion_x * num_diente1) + this.separacion_x + (med / 2);
            var fin_x = (num_diente2 * med) + (this.separacion_x * num_diente2) + this.separacion_x + (med / 2);
            // ctx.fillStyle = this.color_line;
            ctx.fillStyle = color_pas;
            ctx.beginPath();
            ctx.lineWidth = 4;
            ctx.moveTo(inicio_x, inicio_y);
            ctx.lineTo(fin_x, inicio_y);
            //ctx.moveTo(inicio_x+40,inicio_y);
            //ctx.lineTo(inicio_x,inicio_y+40);
            ctx.stroke();
            ctx.lineWidth = 1;
        },
        // Funcion para marcar puente
        borrar_diente(contexto, num_diente) {
            var ctx = contexto;
            // Definiendo puntos de dibujo
            var med = this.medida;
            num_diente = num_diente - 1;
            if (num_diente < 16) {
                var inicio_y = 20;
            } else {
                num_diente = num_diente - 16;
                var inicio_y = med + 100;
            }
            //alert(num_diente);
            var inicio_x = (num_diente * med) + (this.separacion_x * num_diente) + this.separacion_x;
            ctx.clearRect(inicio_x, inicio_y, med, med);
        },

        eventoclick() {
            //Añadimos un addEventListener al canvas para reconocer el click
            this.layer4.addEventListener("click",

                //Una vez se haya clickado se activará la siguiente función
                this.getPosition, false);
            this.layer4.addEventListener("mousemove", this.Marcar, false);
        },
        //canvas.addEventListener("mousedown", getPosition, false);

        getPosition(event) {
            var x = event.x - 257; //-268;
            var y = event.y - 131; //-187;
            // console.log(x+','+y)
            //alert(y);
            //alert(x);
            var canvas = document.getElementById("myCanvas");
            var div_can = document.getElementById("canvasesdiv");
            x -= div_can.offsetLeft;
            y -= div_can.offsetTop;
            //alert(div_can.offsetTop);
            // console.log('Click Posicion:'+x+','+y)
            var div = 0;
            var color = '';
            var accion = '';
            var seleccion = this.tiporadio //$("input[name='accion']:checked").val();
            if (seleccion == 'Fractura') {
                color = 'red';
                accion = 'seccion';
            } else if (seleccion == 'Restauracion') {
                color = 'blue';
                accion = 'seccion';
            } else if (seleccion == 'Extraccion') {
                color = 'black';
                accion = 'marcar';
            } else if (seleccion == 'Puente') {
                accion = 'Puente';
            } else if (seleccion == 'Borrar') {
                accion = 'Borrar';
            }
            //alert(y);
            var diente = 0;
            var seccion = 0;
            if (y >= 20 && y <= 60) {
                //alert(x);
                if (x >= 10 && x <= 50) {
                    diente = 1;
                } else if (x >= 60 && x <= 800) {
                    div = parseInt(x / 50, 10);
                    var ini = (div * 40) + (10 * div) + 10;
                    var fin = ini + 40;
                    if (x >= ini && x <= fin) {
                        diente = div + 1;
                    }
                }
            } else if (y >= 140 && y <= 180) {
                if (x >= 10 && x <= 50) {
                    diente = 17;
                } else if (x >= 60 && x <= 800) {
                    div = parseInt(x / 50, 10);
                    var ini = (div * 40) + (10 * div) + 10;
                    var fin = ini + 40;
                    if (x >= ini && x <= fin) {
                        diente = div + 17;
                    }
                }
            }
            if (diente) {
                //alert(diente);
                if (accion == 'seccion') { // fractura o restauracion
                    x = x - ((div * 40) + (10 * div) + 10);
                    y = y - 20;
                    if (diente > 16) {
                        y = y - 120;
                    }
                    //alert(y);
                    if (y > 0 && y < 10 && x > y && y < 40 - x) {
                        seccion = 1;
                    } else if (x > 30 && x < 40 && y < x && 40 - x < y) {
                        seccion = 2;
                    } else if (y > 30 && y < 40 && x < y && x > 40 - y) {
                        seccion = 3;
                    } else if (x > 0 && x < 10 && y > x && x < 40 - y) {
                        seccion = 4;
                    } else if (x > 10 && x < 30 && y > 10 && y < 30) {
                        seccion = 5;
                    }
                } else if (accion == 'marcar') { // extraccion
                    var cod = diente + '-0-' + '3';
                    if (cod && !localStorage.getItem(cod)) {
                        var new_array = [diente, 0, 3, Date.now(), 0];
                        var guardar = new_array.toLocaleString();
                        localStorage.setItem(cod, guardar);
                        const arraydatos = {
                            funcion: 'marcar_extraccion',
                            ctx: this.ctx2,
                            diente1: diente,
                            diente2: null,
                            seccion: null,
                            color: 'black'
                        };

                        this.datospintados.push(arraydatos);
                        this.marcar_extraccion(this.ctx2, diente, 'black')
                    } else {
                        alert("Ya fue marcado");
                    }
                } else if (accion == 'Puente') { // puente

                    if (this.diente1 == 0) {
                        this.marcar_diente(this.ctx4, diente, 'red');
                        this.diente1 = diente;
                    } else if (this.diente2 == 0) {
                        this.diente2 = diente;
                        var menor = 0;
                        var mayor = 0;
                        if (this.diente1 > this.diente2) {
                            mayor = this.diente1;
                            menor = this.diente2;
                        } else {
                            mayor = this.diente2;
                            menor = this.diente1
                        }
                        this.diente1 = menor;
                        this.diente2 = mayor;
                        if ((this.diente1 < 17 && this.diente2 < 17 && this.diente1 != this.diente2) || (this.diente1 > 17 && this.diente2 > 17 && this.diente1 != this.diente2)) {
                            this.marcar_diente(this.ctx4, diente, 'red');
                            this.ctx4.clearRect(0, 0, 810, 70);
                            this.ctx4.clearRect(0, 135, 810, 70);
                            var cod = this.diente1 + '-0-4-' + this.diente2;
                            if (cod && !localStorage.getItem(cod)) {
                                var new_array = [this.diente1, 0, 4, Date.now(), this.diente2];
                                var guardar = new_array.toLocaleString();
                                localStorage.setItem(cod, guardar);
                            } else {
                                alert("Ya fue marcado");
                            }
                            const arraydatos = {
                                funcion: 'marcar_puente',
                                ctx: this.ctx4,
                                diente1: this.diente1,
                                diente2: this.diente2,
                                seccion: null,
                                color: 'red'
                            };

                            this.datospintados.push(arraydatos);
                            // console.log(arraydatos)
                            this.marcar_puente(this.ctx4, this.diente1, this.diente2, 'red');

                        } else {
                            this.ctx4.clearRect(0, 0, 810, 70);
                            this.ctx4.clearRect(0, 135, 810, 70);
                        }

                        this.diente1 = 0;
                        this.diente2 = 0;
                    }
                } else if (accion == 'Borrar') { //borrar
                    this.borrar_diente(this.ctx2, diente);
                    //cargar el ultimo pintado
                    var seccion_chk = this.tipoborrado //$("input[name='seccion']:checked").val();

                    if (seccion_chk == 'seccion') { //borrar por seccion
                        x = x - ((div * 40) + (10 * div) + 10);
                        y = y - 20;
                        if (diente > 16) {
                            y = y - 120;
                        }
                        var seccion_b = this.ubica_seccion(x, y);
                        if (seccion_b) {
                            var ultimo = '';
                            var key_cod = '';
                            for (var i = 0; i < localStorage.length; i++) {
                                var key_name = localStorage.key(i);
                                var item = localStorage.getItem(key_name);
                                item = item.split(',');
                                var diente_comp = parseInt(item[0], 10);
                                var seccion_comp = parseInt(item[1], 10);
                                var accion_comp = parseInt(item[2], 10);
                                if (diente_comp == diente && seccion_b == seccion_comp && (accion_comp == 1 || accion_comp == 2)) {
                                    if (ultimo == '') {
                                        ultimo = item;
                                        key_cod = key_name;
                                    } else {
                                        var fecha_ult = parseInt(item[3], 10);
                                        if (ultimo[3] < fecha_ult) {
                                            ultimo = item;
                                            key_cod = key_name;
                                        }
                                    }
                                }
                            }
                            if (key_cod != '') {
                                //console.log(key_cod);
                                localStorage.removeItem(key_cod);
                                this.datospintados.splice(key_cod, 1);
                            }
                        }

                    } else if (seccion_chk == 'diente') { // borrar por diente
                        var ultimo = '';
                        var key_cod = '';
                        for (var i = 0; i < localStorage.length; i++) {
                            var key_name = localStorage.key(i);
                            var item = localStorage.getItem(key_name);
                            var item = item.split(',');
                            var diente_comp = parseInt(item[0], 10);
                            var accion_comp = parseInt(item[2], 10);
                            if (diente_comp == diente && accion_comp == 3) {
                                if (ultimo == '') {
                                    ultimo = item;
                                    key_cod = key_name;
                                } else {
                                    var fecha_ult = parseInt(item[3], 10);
                                    if (ultimo[3] < fecha_ult) {
                                        ultimo = item;
                                        key_cod = key_name;
                                    }
                                }
                            }
                        }
                        if (key_cod != '') {
                            //console.log(key_cod);
                            localStorage.removeItem(key_cod);
                            this.datospintados.splice(key_cod, 1);
                        }
                    }
                    //alert('a');
                    this.pinta_datos(diente);
                }
            }
            //alert(diente);
            if (seccion && color != '') {
                //alert(color);

                //alert(seccion);
                //[numero_diente, seccion, accion, fecha, diente2]
                if (color == 'red') {
                    var cod = diente + '-' + seccion + '-' + '1';
                    accion_g = 1;
                } else if (color == 'blue') {
                    var cod = diente + '-' + seccion + '-' + '2';
                    var accion_g = 2;
                };
                if (cod && !localStorage.getItem(cod)) {
                    new_array = [diente, seccion, accion_g, Date.now(), 0];
                    guardar = new_array.toLocaleString();
                    localStorage.setItem(cod, guardar);

                    const arraydatos = {
                        funcion: 'dibuja_seccion',
                        ctx: this.ctx2,
                        diente1: diente,
                        diente2: null,
                        seccion: seccion,
                        color: color
                    };

                    this.datospintados.push(arraydatos);

                    this.dibuja_seccion(this.ctx2, diente, seccion, color);
                } else {
                    alert("ya fue marcado");
                }

            }
            if ('Borrar' == this.tiporadio) {
                //alert("x-> "+x+" y-> "+y);
                //ctx4.clearRect(0, 0, 810, 205);

                if (x >= 30 && x <= 780 && ((y > 78 && y < 82) || (y > 198 && y < 202))) {
                    //alert(x);
                    div = parseInt(x / 50, 10);
                    //alert(div);
                    var ultimo = '';
                    var key_cod = '';
                    var fin_x = '';
                    for (var i = 0; i < localStorage.length; i++) {
                        var key_name = localStorage.key(i);
                        item = localStorage.getItem(key_name);
                        item = item.split(',');
                        var diente1_comp = parseInt(item[0], 10);
                        var diente2_comp = parseInt(item[4], 10);
                        var accion_comp = parseInt(item[2], 10);
                        if (accion_comp == 4) {
                            if (diente1_comp > 16) {
                                diente1_comp = diente1_comp - 17;
                                diente2_comp = diente2_comp - 17;
                            } else {
                                diente1_comp = diente1_comp - 1;
                                diente2_comp = diente2_comp - 1;
                            }
                            var inicio_x = (diente1_comp * 40) + (10 * diente1_comp) + 10 + 20;
                            var fin_x = (diente2_comp * 40) + (10 * diente2_comp) + 10 + 20;
                            if (x >= inicio_x && x <= fin_x) {
                                if (ultimo == '') {
                                    ultimo = item;
                                    key_cod = key_name;
                                } else {
                                    fecha_ult = parseInt(item[3], 10);
                                    if (ultimo[3] < fecha_ult) {
                                        ultimo = item;
                                        key_cod = key_name;
                                    }
                                }
                            }

                        }
                    }
                    if (key_cod != '') {
                        // console.log(key_cod);
                        if (parseInt(ultimo[0], 10) < 16) {
                            var seccion_p = 1;
                            this.ctx4.clearRect(0, 0, 810, 130);
                        } else {
                            this.ctx4.clearRect(0, 130, 810, 150);
                            var seccion_p = 2;
                        }
                        localStorage.removeItem(key_cod);
                        this.datospintados.splice(key_cod, 1);
                        this.pinta_puentes(seccion_p);
                    }
                }

            }

        },

        //dibuja_seccion(x, y, 5, 5);
        //dibuja_seccion(context, num_diente, seccion, color)

        Marcar(event) {
            var x = event.x - 257; //-268;
            var y = event.y - 131; //-187;
            var canvas2 = document.getElementById("myCanvas2");
            var div_can = document.getElementById("canvasesdiv");
            x -= div_can.offsetLeft;
            y -= div_can.offsetTop;
            // console.log('Posicion:'+x+','+y)
            //alert(x);
            var diente = 0;
            var seccion = 0;
            var div = 0;
            var ini = 0;
            var fin = 0;

            if (y >= 20 && y <= 60) {
                //alert(x);
                if (x >= 10 && x <= 50) {
                    diente = 1;
                    //alert("1");
                } else if (x >= 60 && x <= 800) {
                    div = parseInt(x / 50, 10);
                    ini = (div * 40) + (10 * div) + 10;
                    fin = ini + 40;
                    if (x >= ini && x <= fin) {
                        diente = div + 1;
                    }
                }
            } else if (y >= 140 && y <= 180) {
                if (x >= 10 && x <= 50) {
                    diente = 17;
                } else if (x >= 60 && x <= 800) {
                    div = parseInt(x / 50, 10);
                    ini = (div * 40) + (10 * div) + 10;
                    fin = ini + 40;
                    if (x >= ini && x <= fin) {
                        diente = div + 17;
                    }
                }
            }
            //alert(diente);
            if (diente) {
                var accion = this.tiporadio //$("input[name='accion']:checked").val();
                var seleccion = '';
                if (accion == 'Fractura') {
                    seleccion = 'seccion';
                } else if (accion == 'Restauracion') {
                    seleccion = 'seccion';
                } else if (accion == 'Extraccion') {
                    seleccion = 'diente';
                } else if (accion == 'Puente') {
                    seleccion = 'diente';
                } else if (accion == 'Borrar') {
                    var seccion_chk = this.tipoborrado //$("input[name='seccion']:checked").val();
                    if (seccion_chk == 'diente') {
                        seleccion = 'diente';
                    } else {
                        seleccion = 'seccion';
                    }
                }
                if (seleccion == 'seccion') {
                    x = x - ((div * 40) + (10 * div) + 10);
                    y = y - 20;
                    if (diente > 16) {
                        y = y - 120;
                    }
                    //alert(y);
                    /*if (y>=x && y<=39){}*/
                    // Ubicar la seccion clickeada
                    if (y > 0 && y < 10 && x > y && y < 40 - x) {
                        seccion = 1;
                    } else if (x > 30 && x < 40 && y < x && 40 - x < y) {
                        seccion = 2;
                    } else if (y > 30 && y < 40 && x < y && x > 40 - y) {
                        seccion = 3;
                    } else if (x > 0 && x < 10 && y > x && x < 40 - y) {
                        seccion = 4;
                    } else if (x > 10 && x < 30 && y > 10 && y < 30) {
                        seccion = 5;
                    }
                    //Comprobacion de si eta en una seccion
                    if (seccion) {
                        //alert(seccion);
                        var color = 'yellow';
                        this.ctx3.clearRect(0, 0, 810, 205);
                        this.marcar_seccion(this.ctx3, diente, seccion, color);
                        //alert(seccion);
                    } else {
                        //ctx2.fillStyle = "white";
                        //ctx2.fillRect(0, 0, 810, 205);
                        this.ctx3.clearRect(0, 0, 810, 205);
                    }
                } else if (seleccion == 'diente') {
                    this.ctx3.clearRect(0, 0, 810, 205);
                    this.marcar_diente(this.ctx3, diente, 'yellow');
                }
            } else {
                this.ctx3.clearRect(0, 0, 810, 205);
            }

            //dibuja_contorno(canvas, inicio_x, inicio_y, med, separacion_x, separacion_y)
        },
        pinta_datos(diente) {
            var item = '';
            var acc = '';
            var color = '';
            var array_local = [];
            for (var i = 0; i < localStorage.length; i++) {
                var key_name = localStorage.key(i);
                array_local[i] = localStorage.getItem(key_name).split(',');
            }
            //console.log(array_local);
            array_local.sort(function (a, b) {
                return a[3] > b[3]; // orden ascendente por las fechas;
            });
            //console.log(array_local);
            for (var i = 0; i < array_local.length; i++) {
                item = array_local[i];
                if (parseInt(item[0], 10) == diente) {
                    acc = parseInt(item[2], 10);
                    //console.log(acc);
                    if (acc == 1) {
                        color = 'red';
                        this.dibuja_seccion(this.ctx2, item[0], item[1], color);
                    } else if (acc == 2) {
                        color = 'blue';
                        this.dibuja_seccion(this.ctx2, item[0], item[1], color);
                    } else if (acc == 3) {
                        this.marcar_extraccion(this.ctx2, item[0], 'black');
                    }
                }
            }
        },
        pinta_puentes(seccion_p) {
            var array_local = [];
            var item = [];
            var color_pas = '';
            var acc = '';
            var key_name = '';
            for (var i = 0; i < localStorage.length; i++) {
                key_name = localStorage.key(i);
                array_local[i] = localStorage.getItem(key_name).split(',');
            }
            //console.log(array_local);
            array_local.sort(function (a, b) {
                return a[3] > b[3]; // orden ascendente por las fechas;
            });
            //console.log(array_local);
            for (var i = 0; i < array_local.length; i++) {
                item = array_local[i];
                acc = parseInt(item[2], 10);
                //console.log(acc);
                if (acc == 4) {
                    color_pas = 'red';
                    if (seccion_p == 1) {
                        if (parseInt(item[0], 10) < 17) {
                            this.marcar_puente(this.ctx4, item[0], item[4], color_pas);
                        }
                    } else {
                        if (parseInt(item[0], 10) > 16) {
                            this.marcar_puente(this.ctx4, item[0], item[4], color_pas);
                        }
                    }
                    //dibuja_seccion(ctx2, item[0], item[1], color);
                }

            }
        },
        ubica_seccion(X, Y) {
            var y = Y;
            var x = X;
            var devolver_seccion = 0;
            if (y > 0 && y < 10 && x > y && y < 40 - x) {
                devolver_seccion = 1;
            } else if (x > 30 && x < 40 && y < x && 40 - x < y) {
                devolver_seccion = 2;
            } else if (y > 30 && y < 40 && x < y && x > 40 - y) {
                devolver_seccion = 3;
            } else if (x > 0 && x < 10 && y > x && x < 40 - y) {
                devolver_seccion = 4;
            } else if (x > 10 && x < 30 && y > 10 && y < 30) {
                devolver_seccion = 5;
            }
            return devolver_seccion;
        },
        seleccionforma() {
            if (this.tiporadio == 'Borrar') {
                this.btnborrar = true
            } else {
                this.btnborrar = false
            }
        },

        Guardardatos(forumlarios) {
            // alert(datos)
            // this.$emit('guardartratamiento',this.datospintados);
            const datos = {
                'formularios': forumlarios,
                'odontograma': this.datospintados
            }
            var url = '/tratamiento-nuevo';
            axios.post(url, datos).then(res => {
                // console.log(res.data)
            })
            // console.log(datos)

        },
        actualizadatos(formularioupd){
            // alert('actualizamos los datos')
            const antesdatos=this.datospintados
            this.datospintados=this.datospintados2.concat(this.datospintados);
            // console.log(this.datospintados)
            const datos = {
                'formulariosupd': formularioupd,
                'odontograma_gral': this.datospintados,
                'odontograma_his': antesdatos
            }
            var url = '/addhistorial';
            axios.post(url, datos).then(res => {
                // console.log(res.data)
                this.odontogral(this.idtratamiento);
            })
        }

    },
};
</script>

<style scoped>
/* body,
a,
a:hover {
    cursor: url(cur438.cur), progress;
} */

#myCanvas {
    border: 1px solid #9C9898;
}

#myCanvas2 {
    border: 1px solid #9C9898;
}

#myCanvas3 {
    border: 1px solid #9C9898;
}

#myCanvas4 {
    border: 1px solid #9C9898;
}
</style>
