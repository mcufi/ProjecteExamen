<script setup>
import { Link } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import { ref } from 'vue';
import axios from 'axios';

const props = defineProps({
  users: Array,
});

const category = ref();

category.value = "Name"; //Posar el valor Totes Les Pàgines default

const filteredUsers = ref(props.users);

const filter = () => {
    axios.get('/Users/Filter'+category.value).then((response) => {
      filteredUsers.value = response.data; //Canviar totes les pàgines per les seleccionables
    });
};

const submitSearch = () => {
  axios.get('/SearchUser', {
    params: {
      search: search.value
    }
  }).then((response)=>{
    filteredUsers.value = response.data
    console.log(filteredUsers)
  });
}

const search = ref();

console.log(filteredUsers);

// const navigateToEdit = (userId) => {
//     window.location.href = route('UserId.edit', userId);
// };

const cookiesAccepted = ref(false);

if (localStorage.getItem("cookies") === "true") {
    cookiesAccepted.value = true;
}

const acceptCookies = () => {
    cookiesAccepted.value = true;
    localStorage.setItem("cookies", "true");
}
</script>

<template>
  <div class="min-h-screen flex items-center justify-center bg-white">
    <div class="bg-gray-700 shadow-2xl rounded-2xl p-8 w-full max-w-5xl border border-gray-300">
      <h2 class="text-3xl font-semibold text-center text-white mb-6">Llista d'Usuaris</h2>
      <form>
        <select @change="filter()" aria-label="Filter Select" class="rounded-lg" name="Filter" id="Filter" v-model="category">
          <option value="Name">Nom</option>
          <option value="Surname">Cognom</option>
          <option value="Age">Edat</option>
        </select>
        <button aria-label="Submit Button" type="submit"></button>
      </form>
      <form @submit.prevent="submitSearch" class="flex flex-row justify-start">
        <input class="rounded-s-lg" type="text" v-model="search">
        <button class="bg-blue-400 rounded-e-lg">Buscar</button>
      </form>
      <button class="bg-green-900 text-white p-1 rounded mr-4 my-1"><Link :href="'/AddUser/'">Crear Usuari</Link></button>
      <div class="mt-5 overflow-x-auto">
        <table id="User_Table" class="text-title min-w-full rounded-lg overflow-hidden">
          <tbody>
            <tr class="bg-gray-800 w-full rounded-lg">
              <th class="w-1/5 rounded-l-lg px-6 py-2 text-sm font-semibold text-white uppercase tracking-wider">
                Usuari</th>
              <th class="w-1/5 px-6 py-2 text-sm font-semibold text-white uppercase tracking-wider">
                Cognom</th>
              <th class="w-1/5 px-6 py-5 text-sm font-semibold text-white uppercase tracking-wider">
                Email</th>
                <th class="w-1/5 px-6 py-5 text-sm font-semibold text-white uppercase tracking-wider">
                  Edat</th>
              <th class="w-1/5 rounded-r-lg px-6 py-5 text-sm font-semibold text-white uppercase tracking-wider">
              </th>
            </tr>
            <tr v-for="user in filteredUsers" class="bg-blue-100 text-center p-y-4 rounded-3xl">
              <td class="w-1/5 rounded-l-lg py-2">{{ user.name }}</td>
              <td class="py-3 px-4 border-b border-blue-100">{{ user.surname }}</td>
              <td class="w-1/5 py-2">{{ user.email }}</td>
              <td class="py-3 px-4 border-b border-blue-100">{{ user.age }}</td>
              <td class="w-1/5 rounded-r-lg py-2">
                <Link :href="'/EditUser/' + user.id" aria-label="Modify Button" class="bg-blue-600 text-white p-1 rounded-lg mr-4 my-1"><i class="pi pi-user-edit mx-1"></i>Modificar</Link>
                <Link :href="'/DeleteUser/' + user.id" aria-label="Delete Button" class="bg-red-600 text-white p-1 rounded-lg"><i class="pi pi-trash mx-1"></i>Eliminar</Link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div v-if="!cookiesAccepted" class="bg-black/80 absolute min-w-full min-h-full z-40 start-0 top-0 flex justify-center items-center">
        <div class="w-1/2 min-h-[180px] bg-blue-200 border-b-4 rounded-lg shadow-md border-b-blue-800 p-4">
            <h2 class="text-blue-800 text-4xl font-extrabold">Avís de cookies</h2>
            <br>
            <p>Aquest és un avís de cookies</p>
            <div class="inline-flex justify-end w-full">
                <Button @click="acceptCookies">Ok</Button>
            </div>
        </div>
    </div>
</template>