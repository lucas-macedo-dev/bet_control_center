<script>
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>
<template>
  <AuthenticatedLayout>
    <div class="p-6 max-w-2xl mx-auto">
      <h1 class="text-2xl font-bold mb-6">Cadastrar Nova Aposta</h1>

      <form @submit.prevent="submit" class="space-y-6">
        <div>
          <label class="block mb-1 font-semibold" for="valor_apostado">Valor Apostado (R$)</label>
          <input type="number" id="valor_apostado" v-model.number="form.valor_apostado"
            class="w-full border-gray-300 rounded-xl shadow" step="0.01" required />
        </div>

        <div>
          <label class="block mb-1 font-semibold" for="valor_retorno">Valor Recebido (R$)</label>
          <input type="number" id="valor_retorno" v-model.number="form.valor_retorno"
            class="w-full border-gray-300 rounded-xl shadow" step="0.01" required />
        </div>

        <div>
          <label class="block mb-1 font-semibold" for="descricao">Descrição (opcional)</label>
          <input type="text" id="descricao" v-model="form.descricao" class="w-full border-gray-300 rounded-xl shadow"
            maxlength="255" />
        </div>

        <div>
          <button type="submit" class="btn btn-primary">Salvar Aposta</button>
        </div>
      </form>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

const form = useForm({
  valor_apostado: null,
  valor_retorno: null,
  descricao: '',
});

const submit = () => {
  form.post(route('bets.store'), {
    onSuccess: () => {
      form.reset();
      router.visit(route('dashboard'));
    },
  });
};
</script>

<style scoped>
.btn-primary {
  @apply bg-green-600 text-white px-4 py-2 rounded-xl hover:bg-green-700 transition;
}
</style>