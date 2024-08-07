<template>
  <header class='border-b shadow-md p-4 sm:px-10 bg-white font-sans min-h-[65px] z-50 top-0 sticky dark:bg-black dark:text-white'>
    <div class='flex flex-wrap items-center justify-between gap-2'>
      <ApplicationLogo class="block size-8 text-blue-700 dark:fill-current text-white"/> 
      <div class='flex items-center max-sm:ml-auto lg:order-1'>
        <div class="space-x-4 flex flex-row">
          <div v-if="!authUser && canLogin">
            <Link :href="route('login')">
              <PrimaryButtonTwo class="bg-red-500 hover:bg-red-800 -my-2 dark:bg-stone-800 rounded-full">
                Login
              </PrimaryButtonTwo>
            </Link>
          </div>
          <div v-if="!authUser && canRegister">
            <Link :href="route('register')">
              <PrimaryButtonTwo class="bg-red-500 hover:bg-red-800 -my-2 dark:bg-stone-800 rounded-full">
                Register
              </PrimaryButtonTwo>
            </Link>
          </div>
          <div v-if="authUser">
            <Link :href="route('logout')" @click="refresh" method="post" as="button"><PrimaryButtonTwo>Logout</PrimaryButtonTwo></Link>
          </div>
        </div>
        <button @click="showingNavigationDropdown = !showingNavigationDropdown" class='lg:hidden ml-7'>
          <svg class="w-7 h-7 fill-current dark:text-white" fill="#000" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
              clip-rule="evenodd"></path>
          </svg>
        </button>
      </div>
      <ul :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }" class='lg:!flex lg:space-x-4 max-lg:space-y-2 sm:hidden max-lg:w-full'>
        <li class='max-lg:border-b max-lg:py-2 px-3'>
          <Link :href="route('home')" class='hover:text-[#007bff] text-[#007bff] font-bold block text-[15px] dark:text-white'>Home</Link>
        </li>
        <li class='max-lg:border-b max-lg:py-2 px-3'>
          <Link :href="route('about.us')" class='hover:text-[#007bff] text-gray-600 font-bold block text-[15px dark:text-white'> 
              About
          </Link>
        </li>
        <li class='max-lg:border-b max-lg:py-2 px-3'>
          <Link :href="route('contact.us')" class='hover:text-[#007bff] text-gray-600 font-bold block text-[15px] dark:text-white'>Contact</Link>
        </li>
        <li class='max-lg:border-b max-lg:py-2 px-3'>
          <Link :href="route('blog')" class='hover:text-[#007bff] text-gray-600 font-bold block text-[15px] dark:text-white'>Blog</Link>
        </li>
        <li class='max-lg:border-b max-lg:py-2 px-3'>
          <Link :href="route('private.policy')" class='hover:text-[#007bff] text-gray-600 font-bold block text-[15px] dark:text-white'>Policy</Link>
        </li>
        <li class='max-lg:border-b max-lg:py-2 px-3'><a href='javascript:void(0)'
            class='hover:text-[#007bff] text-gray-600 font-bold block text-[15px] dark:text-white'>Other</a>
        </li>
        <li class='max-lg:border-b max-lg:py-2 px-3'><a href='javascript:void(0)'
            class='hover:text-[#007bff] text-gray-600 font-bold block text-[15px]'><DarkModeToggle/></a>
        </li>
        <li class='max-lg:border-b max-lg:py-2 px-3'><a href='javascript:void(0)'
            class='hover:text-[#007bff] text-gray-600 font-bold block text-[15px] dark:text-white'>{{ newtime }}</a>
        </li>
      </ul>
    </div>
  </header>
</template>

<script setup>
import DarkModeToggle from '@/Partials/CustomButtons/DarkModeToggle.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButtonTwo from '@/Partials/CustomButtons/PrimaryButtonTwo.vue';
import { Head, Link, usePage } from "@inertiajs/vue3";
const page = usePage();
import { computed } from 'vue';
const canLogin = computed(() => page.props.canLogin);
const canRegister = computed(() => page.props.canRegister);
const laravelVersion = computed(() => page.props.laravelVersion);
const phpVersion = computed(() => page.props.phpVersion);
const authUser = computed(() => page.props.auth.user);
const appName = computed(() => page.props.appName);
import { ref,reactive,watchEffect,watch } from 'vue';

const showingNavigationDropdown = ref(false);

const refresh = async() => {
    await location.reload();
};

const date = new Date();
const hours = date.getHours();
const minutes = date.getMinutes();
const seconds = date.getSeconds();

const time = `${hours}:${minutes}:${seconds}`;

const mytime = ref(time);

const newtime = `Time:${mytime.value}`;

</script>