<template>
        <div>
                <div class="card card-warning">
                        <div class="card-header">
                                <h5 class="card-title">Estadísticas</h5>
                        </div>
                        <div class="card-body">
                                <div class="row">
                                        <label class="col-lg-3">Locales Premium: {{ cantLocalPremium }}</label>
                                        <label class="col-lg-3">Locales Free: {{ cantLocalFree }}</label>
                                        <label class="col-lg-3">Locales Activos: {{ cantLocalActivos }}</label>
                                        <label class="col-lg-3">Locales Bloqueados: {{ cantLocalBloqueados }}</label>
                                </div>
                                <hr>
                                <div class="row">
                                        <label class="col-lg-3">Usuario Premium: {{ cantUserPremium }}</label>
                                        <label class="col-lg-3">Usuario Free: {{ cantUserFree }}</label>
                                        <label class="col-lg-3">Empaques Activos: {{ cantUserTotal }}</label>
                                        <label class="col-lg-3">Locales Registrados: {{ cantLocalRegistrados }}</label>
                                </div>
                                <hr>
                                <div class="row">
                                        <div class="col-lg-12 text-center">
                                                <form  @submit.prevent="search()">
                                                        <input type="text" v-model="dato"  placeholder="Buscar por: nombre - cuenta - estado" class="form-control">
                                                </form>
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="card card-primary">
                        <div class="card-header">
                                <h5 class="card-title">Listado</h5>
                        </div>
                        <div class="card-body">


                                <div class="row hidden-md-down text-center">
                                        <label class="col-lg-1">ID</label>
                                        <label class="col-lg-2">Cadena</label>
                                        <label class="col-lg-2">Nombre</label>
                                        <label class="col-lg-1">Cuenta</label>
                                        <label class="col-lg-1">Estado</label>
                                        <label class="col-lg-1">Visible</label>
                                        <label class="col-lg-1">Resp. Pago</label>
                                        <label class="col-lg-1">Precio</label>
                                        <label class="col-lg-1">Empaques</label>
                                        <label class="col-lg-1">Configurar</label>

                                </div>
                                <hr class="hidden-md-down">
                                <div class="row text-center" v-for="local in locales">

                                        <label class="col-6 hidden-lg-up">ID :</label>
                                        <div class="col-6 col-lg-1 text-center">{{ local.id }}</div>

                                        <label class="col-6 hidden-lg-up">Cadena :</label>
                                        <div class="col-6 col-lg-2 text-center">{{ local.nombreCadena }}</div>

                                        <label class="col-6 hidden-lg-up">Local :</label>
                                        <div class="col-6 col-lg-2 text-center">{{ local.nombre }}</div>

                                        <label class="col-6 hidden-lg-up">Cuenta :</label>
                                        <div class="col-6 col-lg-1 text-center">
                                                <i v-if="local.cuenta == 'Premium'" class="fa fa-star text-warning" aria-hidden="true" data-toggle="tooltip" title="Premium"></i>
                                                <i v-else class="fa fa-star-half-o" aria-hidden="true" data-toggle="tooltip" title="Free"></i>
                                        </div>

                                        <label class="col-6 hidden-lg-up">Estado :</label>
                                        <div class="col-6 col-lg-1 text-center">
                                                <i v-if="local.estado == 'Activo'" class="fa fa-circle text-success" aria-hidden="true" data-toggle="tooltip" title="Activo"></i>
                                                <i v-else class="fa fa-circle text-danger" aria-hidden="true" data-toggle="tooltip" title="Bloqueado"></i>
                                        </div>

                                        <label class="col-6 hidden-lg-up">Visible :</label>
                                        <div class="col-6 col-lg-1 text-center">
                                                <i v-if="local.visible == 'Si'" class="fa fa-check text-success" aria-hidden="true" data-toggle="tooltip" title="Si"></i>
                                                <i v-else class="fa fa-close text-danger" aria-hidden="true" data-toggle="tooltip" title="No"></i>
                                        </div>

                                        <label class="col-6 hidden-lg-up">Resp. Pago :</label>
                                        <div class="col-6 col-lg-1 text-center">
                                                <i v-if="local.responsablePago == 'Encargado'" class="fa fa-user-circle text-info" aria-hidden="true" data-toggle="tooltip" title="Encargado"></i>
                                                <i v-else class="fa fa-users text-warning" aria-hidden="true" data-toggle="tooltip" title="Empaques"></i>
                                        </div>

                                        <label class="col-6 hidden-lg-up">Precio :</label>
                                        <div class="col-6 col-lg-1 text-center">{{ local.precioMensual }}</div>

                                        <label class="col-6 hidden-lg-up">Empaques :</label>
                                        <div class="col-6 col-lg-1 text-center">{{ local.cantEmpaques }}</div>

                                        <div class="p-t-40 hidden-lg-up"></div>
                                        <label class="col-6 hidden-lg-up">Configurar :</label>
                                        <div class="col-6 col-lg-1 text-center">
                                                <a :href="local.id+'/opciones'" class="btn btn-primary  btn-xs"  data-toggle="tooltip" title="Configurar"><i class="fa fa-list" aria-hidden="true"></i></a>
                                        </div>
                                        <hr>
                                </div>
                        </div>
                </div>
        </div>
</template>

<script>
    export default {


        data() {
                return {
                        locales: [],
                        dato: ''
                }
        },

        mounted() {
                axios.get('/admin/local/listado').then((response) => {
                        this.locales = response.data.locales
                        this.cantLocalRegistrados = response.data.cantLocalRegistrados
                        this.cantLocalActivos = response.data.cantLocalActivos
                        this.cantLocalBloqueados = response.data.cantLocalBloqueados
                        this.cantLocalPremium = response.data.cantLocalPremium
                        this.cantLocalFree = response.data.cantLocalFree
                        this.cantUserTotal = response.data.cantUserTotal
                        this.cantUserPremium = response.data.cantUserPremium
                        this.cantUserFree = response.data.cantUserFree
                })
        },

        methods: {
                search: function () {
                        axios.get('/admin/local/listado?nombre='+this.dato).then((response) => {
                                this.locales = response.data.locales
                        })
                        .catch(e => {
                                // Capturamos los errores
                        })
                }
        }
    }
</script>
