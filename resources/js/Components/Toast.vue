<script setup>
import { ref, watch } from 'vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage();

const show = ref(false);
const message = ref('');
const type = ref('success');

watch(
  () => page.props.flash,
  (newFlash) => {
    if (newFlash.success) {
      message.value = newFlash.success;
      type.value = 'success';
      triggerToast();
    } else if (newFlash.error) {
      message.value = newFlash.error;
      type.value = 'error';
      triggerToast();
    }
  },
  { immediate: true }
);

function triggerToast() {
  show.value = true;
  setTimeout(() => {
    show.value = false;
  }, 5000);
}
</script>

<template>
  <transition name="fade">
    <div
      v-if="show"
      class="fixed top-4 right-4 z-50 rounded-md px-4 py-2 shadow text-white"
      :class="type === 'success' ? 'bg-green-500' : 'bg-red-500'"
    >
      {{ message }}
    </div>
  </transition>
</template>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 5s;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
