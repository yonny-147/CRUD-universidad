<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark  bg-dark">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <RouterLink class="nav-link" aria-current="page" to="/">Registrar Vinculo</RouterLink>
            </li>
            <li class="nav-item">
              <RouterLink class="nav-link" aria-current="page" to="/estudiantes">Estudiantes</RouterLink>
            </li>
            <li class="nav-item">
              <RouterLink class="nav-link" aria-current="page" to="/profesores">Profesores</RouterLink>
            </li>
             <li class="nav-item">
              <RouterLink class="nav-link" aria-current="page" to="/asignaturas">Asignaturas</RouterLink>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <RouterView />
</template>

<style scoped>

</style>
