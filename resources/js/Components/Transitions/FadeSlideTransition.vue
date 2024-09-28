<script setup>
import { computed, ref, onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';

const path = computed(() => usePage().url.split('?')[0]);
const fadeContent = ref(null);

// Delay transition for Safari using requestAnimationFrame for smoother transitions
onMounted(() => {
    requestAnimationFrame(() => {
        if (fadeContent.value) {
            fadeContent.value.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        }
    });
});
</script>

<template>
    <transition name="fade-slide" mode="out-in">
        <div :key="path" ref="fadeContent">
            <slot />
        </div>
    </transition>
</template>

<style scoped>
.fade-slide-enter-active,
.fade-slide-leave-active {
  transition: opacity 0.5s ease, transform 0.5s ease;
  will-change: opacity, transform;
}

.fade-slide-enter-from,
.fade-slide-leave-to {
  opacity: 0;
  transform: translateY(-10px);
}

@media not all and (min-resolution: 0.001dpcm) {
  @supports (-webkit-overflow-scrolling: touch) {
    .fade-slide-enter-from,
    .fade-slide-leave-to {
      opacity: 0;
      transform: none;
    }
  }
}
</style>
