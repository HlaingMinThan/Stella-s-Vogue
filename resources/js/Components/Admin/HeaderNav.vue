<script setup>
import UserDropdown from "@/Components/Organisms/UserDropdown.vue";
import { useStore } from "vuex";
import { computed } from "vue";
// import {Link} from '@inertiajs/vue3';

const store = useStore();

const isSideNavOpen = computed(() => store.state.isSideNavOpen);

const toggle = () => {
  store.commit("toggleSideNav", !isSideNavOpen.value);
};
</script>

<template>
  <header class="sticky top-0 z-50 flex w-full bg-white drop-shadow-1">
    <div
      class="flex flex-grow items-center justify-between py-4 px-4 shadow-2 md:px-6 2xl:px-11"
    >
      <div class="flex items-center gap-2 sm:gap-4 lg:hidden">
        <!-- Start Hamburger Toggle BTN -->
        <button
          @click="toggle"
          type="button"
          class="bg-gray-50 border border-gray-300 px-4 py-2 rounded-md text-darkGray hover:bg-gray-100 transition-all"
          :class="{ 'text-primary border-primary': isSideNavOpen }"
        >
          <svg
            width="20px"
            height="20px"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <g clip-path="url(#clip0_429_11066)">
              <path
                d="M3 6.00092H21M3 12.0009H21M3 18.0009H21"
                stroke="#292929"
                stroke-width="2.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </g>
            <defs>
              <clipPath id="clip0_429_11066">
                <rect
                  width="24"
                  height="24"
                  fill="white"
                  transform="translate(0 0.000915527)"
                />
              </clipPath>
            </defs>
          </svg>
        </button>
      </div>
      <!-- <div class="hidden sm:block">
        <form action="https://formbold.com/s/unique_form_id" method="POST">
          <div class="relative">
            <button class="absolute top-1/2 left-0 -translate-y-1/2">
              <svg
                class="fill-body hover:fill-primary dark:fill-bodydark dark:hover:fill-primary"
                width="20"
                height="20"
                viewBox="0 0 20 20"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M9.16666 3.33332C5.945 3.33332 3.33332 5.945 3.33332 9.16666C3.33332 12.3883 5.945 15 9.16666 15C12.3883 15 15 12.3883 15 9.16666C15 5.945 12.3883 3.33332 9.16666 3.33332ZM1.66666 9.16666C1.66666 5.02452 5.02452 1.66666 9.16666 1.66666C13.3088 1.66666 16.6667 5.02452 16.6667 9.16666C16.6667 13.3088 13.3088 16.6667 9.16666 16.6667C5.02452 16.6667 1.66666 13.3088 1.66666 9.16666Z"
                  fill=""
                />
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M13.2857 13.2857C13.6112 12.9603 14.1388 12.9603 14.4642 13.2857L18.0892 16.9107C18.4147 17.2362 18.4147 17.7638 18.0892 18.0892C17.7638 18.4147 17.2362 18.4147 16.9107 18.0892L13.2857 14.4642C12.9603 14.1388 12.9603 13.6112 13.2857 13.2857Z"
                  fill=""
                />
              </svg>
            </button>

            <input
              type="text"
              placeholder="Type to search..."
              class="w-full xl:w-125 bg-transparent pr-4 pl-9 focus:outline-none border-none focus:ring-0"
            />
          </div>
        </form>
      </div> -->

      <div class="flex items-center gap-3 2xsm:gap-7 ml-auto">
        <ul class="flex items-center gap-2 2xsm:gap-4">
          <!-- Notification Menu Area -->
          <!-- <DropdownNotification /> -->
          <!-- Notification Menu Area -->

          <!-- Chat Notification Area -->
          <!-- <DropdownMessage /> -->
          <!-- Chat Notification Area -->
        </ul>

        <!-- User Area -->
        <UserDropdown />
      </div>
    </div>
  </header>
</template>
