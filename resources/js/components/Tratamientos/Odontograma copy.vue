<template>
<div>
    <div id="radio">
        <input type="radio" id="radio1" name="accion" value="fractura" checked="checked" /><label for="radio1">Fractura</label>
        <input type="radio" id="radio2" name="accion" value="restauracion" /><label for="radio2">Restauracion</label>
        <input type="radio" id="radio3" name="accion" value="borrar" /><label for="radio3">Borrar</label>
        <input type="radio" id="radio4" name="accion" value="extraccion" /><label for="radio4">Extraccion</label>
        <input type="radio" id="radio5" name="accion" value="puente" /><label for="radio5">Puente</label>
    </div>
    <div id="canvasesdiv" class="mt-4" style="position:relative; width:810px; height:300px">
        <canvas id="myCanvas" width="810" height="300" style="z-index: 1; position:absolute; left:0px; top:0px;"></canvas>
        <canvas id="myCanvas2" width="810" height="300" style="z-index: 2; position:absolute; left:0px; top:0px;"></canvas>
        <canvas id="myCanvas3" width="810" height="300" style="z-index: 3; position:absolute; left:0px; top:0px;"></canvas>
        <canvas id="myCanvas4" width="810" height="300" style="z-index: 4; position:absolute; left:0px; top:0px;"></canvas>
    </div>
</div>
</template>

<script>
export default {
    name: 'ClinicaOdontograma',

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
            canvas:null,
            context:null,
            layer2:null,
            ctx2:null,
            layer3:null,
            ctx3:null,
            layer4:null,
            ctx4:null,

        };
    },

    mounted() {
        this.inicializa();
    },

    methods: {
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
                this.context.fillText(x + 1, this.iniciar_x + (this.medida / 2), (this.iniciar_y / 2) + 5);
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
                this.context.fillText(x + 17, this.iniciar_x + (this.medida / 2), (this.iniciar_y - 10) + 5);
            }
            // this.dibuja_seccion(this.context, 2, 3, 'red');s
            //dibuja_seccion(context, 18, 5, 'green');
            //dibuja_seccion(context, 24, 4, 'blue');
            // window.onload = function () {
            localStorage.clear();
                this.eventoclick();
            // }
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
                inicio_y = 20;
            } else {
                num_diente = num_diente - 16;
                inicio_y = med + 100;
            }
            //alert(num_diente);
            inicio_x = (num_diente * med) + (this.separacion_x * num_diente) + this.separacion_x;

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
                inicio_y = 20;
            } else {
                num_diente = num_diente - 16;
                inicio_y = med + 100;
            }
            //alert(num_diente);
            inicio_x = (num_diente * med) + (this.separacion_x * num_diente) + this.separacion_x;

            ctx.fillStyle = color_line;
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
            num_diente1 = dient_1 - 1;
            num_diente2 = dient_2 - 1;
            this.color_line = color_pas;
            if (num_diente1 < 16) {
                inicio_y = 80;
            } else {
                num_diente1 = num_diente1 - 16;
                num_diente2 = num_diente2 - 16;
                inicio_y = med + 160;
            }
            //alert(num_diente);
            inicio_x = (num_diente1 * med) + (this.separacion_x * num_diente1) + this.separacion_x + (med / 2);
            fin_x = (num_diente2 * med) + (this.separacion_x * num_diente2) + this.separacion_x + (med / 2);
            ctx.fillStyle = this.color_line;
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
                inicio_y = 20;
            } else {
                num_diente = num_diente - 16;
                inicio_y = med + 100;
            }
            //alert(num_diente);
            inicio_x = (num_diente * med) + (this.separacion_x * num_diente) + this.separacion_x;
            ctx.clearRect(inicio_x, inicio_y, med, med);
        },

        eventoclick() {
            //Añadimos un addEventListener al canvas para reconocer el click
            this.layer4.addEventListener("click",

                //Una vez se haya clickado se activará la siguiente función
                this.getPosition(), false);
            this.layer4.addEventListener("mousemove", this.Marcar(), false);
        },
        //canvas.addEventListener("mousedown", getPosition, false);

        getPosition(event) {
            var x = event.x;
            var y = event.y;
            //alert(y);
            //alert(x);
            var canvas = document.getElementById("myCanvas");
            var div_can = document.getElementById("canvasesdiv");
            x -= div_can.offsetLeft;
            y -= div_can.offsetTop;
            //alert(div_can.offsetTop);
            var div = 0;
            var color = '';
            var accion = '';
            var seleccion = $("input[name='accion']:checked").val();
            if (seleccion == 'fractura') {
                color = 'red';
                accion = 'seccion';
            } else if (seleccion == 'restauracion') {
                color = 'blue';
                accion = 'seccion';
            } else if (seleccion == 'extraccion') {
                color = 'black';
                accion = 'marcar';
            } else if (seleccion == 'puente') {
                accion = 'puente';
            } else if (seleccion == 'borrar') {
                accion = 'borrar';
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
                if (accion == 'seccion') {
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
                } else if (accion == 'marcar') {
                    var cod = diente + '-0-' + '3';
                    if (cod && !localStorage.getItem(cod)) {
                        var new_array = [diente, 0, 3, Date.now(), 0];
                        var guardar = new_array.toLocaleString();
                        localStorage.setItem(cod, guardar);
                        marcar_extraccion(this.ctx2, diente, 'black')
                    } else {
                        alert("Ya fue marcado");
                    }
                } else if (accion == 'puente') {
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
                            this.marcar_puente(this.ctx4, this.diente1, this.diente2, 'red');
                        } else {
                            this.ctx4.clearRect(0, 0, 810, 70);
                            this.ctx4.clearRect(0, 135, 810, 70);
                        }

                        this.diente1 = 0;
                        this.diente2 = 0;
                    }
                } else if (accion == 'borrar') {
                    this.borrar_diente(this.ctx2, diente);
                    //cargar el ultimo pintado
                    var seccion_chk = $("input[name='seccion']:checked").val();
                    if (seccion_chk == 'seccion') {
                        x = x - ((div * 40) + (10 * div) + 10);
                        y = y - 20;
                        if (diente > 16) {
                            y = y - 120;
                        }
                        var seccion_b = this.ubica_seccion(x, y);
                        if (seccion_b) {
                            ultimo = '';
                            key_cod = '';
                            for (var i = 0; i < localStorage.length; i++) {
                                var key_name = localStorage.key(i);
                                var item = localStorage.getItem(key_name);
                                item = item.split(',');
                                var diente_comp = parseInt(item[0], 10);
                                var seccion_comp = parseInt(item[1], 10);
                                accion_comp = parseInt(item[2], 10);
                                if (diente_comp == diente && seccion_b == seccion_comp && (accion_comp == 1 || accion_comp == 2)) {
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
                            if (key_cod != '') {
                                //console.log(key_cod);
                                localStorage.removeItem(key_cod);
                            }
                        }

                    } else if (seccion_chk == 'diente') {
                        ultimo = '';
                        key_cod = '';
                        for (var i = 0; i < localStorage.length; i++) {
                            var key_name = localStorage.key(i);
                            item = localStorage.getItem(key_name);
                            item = item.split(',');
                            diente_comp = parseInt(item[0], 10);
                            accion_comp = parseInt(item[2], 10);
                            if (diente_comp == diente && accion_comp == 3) {
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
                        if (key_cod != '') {
                            //console.log(key_cod);
                            localStorage.removeItem(key_cod);
                        }
                    }
                    //alert('a');
                    this.pinta_datos();
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
                    this.dibuja_seccion(this.ctx2, diente, seccion, color);
                } else {
                    alert("ya fue marcado");
                }

            }
            if ('borrar' == $("input[name='accion']:checked").val()) {
                //alert("x-> "+x+" y-> "+y);
                //ctx4.clearRect(0, 0, 810, 300);

                if (x >= 30 && x <= 780 && ((y > 78 && y < 82) || (y > 198 && y < 202))) {
                    //alert(x);
                    div = parseInt(x / 50, 10);
                    //alert(div);
                    ultimo = '';
                    key_cod = '';
                    for (var i = 0; i < localStorage.length; i++) {
                        var key_name = localStorage.key(i);
                        item = localStorage.getItem(key_name);
                        item = item.split(',');
                        diente1_comp = parseInt(item[0], 10);
                        diente2_comp = parseInt(item[4], 10);
                        accion_comp = parseInt(item[2], 10);
                        if (accion_comp == 4) {
                            if (diente1_comp > 16) {
                                diente1_comp = diente1_comp - 17;
                                diente2_comp = diente2_comp - 17;
                            } else {
                                diente1_comp = diente1_comp - 1;
                                diente2_comp = diente2_comp - 1;
                            }
                            inicio_x = (diente1_comp * 40) + (10 * diente1_comp) + 10 + 20;
                            fin_X = (diente2_comp * 40) + (10 * diente2_comp) + 10 + 20;
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
                        console.log(key_cod);
                        if (parseInt(ultimo[0], 10) < 16) {
                            seccion_p = 1;
                            this.ctx4.clearRect(0, 0, 810, 130);
                        } else {
                            this.ctx4.clearRect(0, 130, 810, 150);
                            seccion_p = 2;
                        }
                        localStorage.removeItem(key_cod);
                        this.pinta_puentes(seccion_p);
                    }
                }

            }

        },

        //dibuja_seccion(x, y, 5, 5);
        //dibuja_seccion(context, num_diente, seccion, color)

        Marcar(event) {
            var x = event.x;
            var y = event.y;
            var canvas2 = document.getElementById("myCanvas2");
            var div_can = document.getElementById("canvasesdiv");
            x -= div_can.offsetLeft;
            y -= div_can.offsetTop;
            //alert(x);
            var diente = 0;
            var seccion = 0;
            var div = 0;

            if (y >= 20 && y <= 60) {
                //alert(x);
                if (x >= 10 && x <= 50) {
                    diente = 1;
                    //alert("1");
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
                    ini = (div * 40) + (10 * div) + 10;
                    fin = ini + 40;
                    if (x >= ini && x <= fin) {
                        diente = div + 17;
                    }
                }
            }
            //alert(diente);
            if (diente) {
                var accion = $("input[name='accion']:checked").val();
                var seleccion = '';
                if (accion == 'fractura') {
                    seleccion = 'seccion';
                } else if (accion == 'restauracion') {
                    seleccion = 'seccion';
                } else if (accion == 'extraccion') {
                    seleccion = 'diente';
                } else if (accion == 'puente') {
                    seleccion = 'diente';
                } else if (accion == 'borrar') {
                    var seccion_chk = $("input[name='seccion']:checked").val();
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
                        this.ctx3.clearRect(0, 0, 810, 300);
                        this.marcar_seccion(this.ctx3, diente, seccion, color);
                        //alert(seccion);
                    } else {
                        //ctx2.fillStyle = "white";
                        //ctx2.fillRect(0, 0, 810, 300);
                        this.ctx3.clearRect(0, 0, 810, 300);
                    }
                } else if (seleccion == 'diente') {
                    this.ctx3.clearRect(0, 0, 810, 300);
                    this.marcar_diente(this.ctx3, diente, 'yellow');
                }
            } else {
                this.ctx3.clearRect(0, 0, 810, 300);
            }

            //dibuja_contorno(canvas, inicio_x, inicio_y, med, separacion_x, separacion_y)
        },
        pinta_datos() {
            array_local = [];
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
            array_local = [];
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
            devolver_seccion = 0;
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
        }

    },
};
</script>

<style lang:"scss" scoped>
body, a, a:hover {cursor:  url(cur438.cur),  progress;}
</style>
