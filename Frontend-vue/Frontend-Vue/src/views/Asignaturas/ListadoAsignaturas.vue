<template>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center">
                <h2>Asignaturas registrados</h2>
            </div>
            <div class="card-boy">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Creditos</th>
                            <th>Area de conocimiento</th>
                            <th>Participacion</th>
                        </tr>
                    </thead>
                    <tbody v-if="this.asignaturas.length > 0">
                        <tr v-for="(asignatura, index) in this.asignaturas" :key="index">
                            <td>{{ asignatura.nombre }}</td>
                            <td>{{ asignatura.descripcion }}</td>
                            <td>{{ asignatura.creditos }}</td>
                            <td>{{ asignatura.area }}</td>
                            <td>{{ asignatura.participacion }}</td>
                            <td>
                                <RouterLink :to="{ path: 'asignaturas/'+asignatura.id+'/edit' }" class="btn btn-success">Editar</RouterLink>
                                <button type="button" @click="deleteAsignatura(asignatura.id)" class="btn btn-danger">Borrar</button>
                            </td>
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr>
                            <td colspan="7">...cargando</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
  
<script>
import axios from 'axios';

export default {
    name: 'asignaturas',
    data() {
        return {
            asignaturas: []
        }
    },
    mounted() {
        this.getAsignaturas()
    },
    methods: {
        getAsignaturas() {
            axios.get('http://127.0.0.1:8000/api/asignaturas')
                .then(res => {
                    this.asignaturas = res.data.asignaturas
                })
        },

        deleteAsignatura(asignatura_id){
            if(confirm('¿Estás seguro que quieres borrar este asignatura?')){
                axios.delete(`http://127.0.0.1:8000/api/asignaturas/${asignatura_id}/delete`).
                then(res => {
                    alert(res.data.message)
                    this.getAsignaturas()
                })          
                .catch(function (error) {
                    if (error.response) {
                        if (error.response.status = 404) {
                            alert(error.response.data.message)
                        }
                    }
                })
            }
        }
    }
}
</script>
  