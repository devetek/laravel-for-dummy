<template>
  <breeze-authenticated-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Edit Product
      </h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <form @submit.prevent="update">
              <iput type="hidden" v-model="form.id" />
              <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                <div>
                  <div>Nama</div>
                  <input type="text" v-model="form.name" />
                  <div v-if="form.errors.name">{{ form.errors.name }}</div>
                </div>
                <div style="width: 100%">
                  <div>Deskripsi</div>
                  <textarea v-model="form.description" />
                  <div v-if="form.errors.description">
                    {{ form.errors.description }}
                  </div>
                </div>
                <div>
                  <div>Harga</div>
                  <input type="text" v-model="form.price" />
                  <div v-if="form.errors.price">{{ form.errors.price }}</div>
                </div>
              </div>
              <div
                class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center"
              >
                <loading-button
                  :loading="form.processing"
                  class="btn-indigo"
                  type="submit"
                  >Update Product</loading-button
                > &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                <button
                  v-if="form.id"
                  class="text-red-600 hover:underline"
                  tabindex="-1"
                  type="button"
                  @click="destroy"
                >
                  Delete Product
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </breeze-authenticated-layout>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/inertia-vue3";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated";
import TextInput from "@/Shared/TextInput";
import LoadingButton from "@/Shared/LoadingButton";

export default {
  components: {
    BreezeAuthenticatedLayout,
    LoadingButton,
    TextInput,
  },
  remember: "form",
  props: {
    product: Object,
  },
  methods: {
    update() {
      Inertia.put(`/products/${this.form.id}`, {
        name: this.form.name,
        description: this.form.description,
        price: parseInt(this.form.price, 10),
      });
    },
    destroy() {
      if (confirm("Are you sure you want to delete this product?")) {
        Inertia.delete(`/products/${this.form.id}`);
      }
    },
  },
  setup(props) {
    const form = useForm({
      id: props.product.id,
      name: props.product.name,
      description: props.product.description,
      price: props.product.price,
    });

    return { form };
  },
};
</script>
