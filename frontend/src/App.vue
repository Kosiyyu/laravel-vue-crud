<script setup>
import SideBar from "./components/SideBar.vue"
import DataTable from "./components/DataTable.vue"
</script>

<template>
  <v-card>
    <v-layout>
      <!-- sidebar -->
      <SideBar />
      <!-- table -->
      <v-main>
        <DataTable />
      </v-main>
    </v-layout>
  </v-card>
</template>