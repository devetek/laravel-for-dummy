<template>
  <breeze-authenticated-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Ubah Mahasiswa
      </h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <form @submit.prevent="update">
              <iput type="hidden" v-model="form.id" />
              <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                <div class="form-group">
                  <div>NIS</div>
                  <input type="text" v-model="form.nis" />
                  <div>{{ errors.nis }}</div>
                </div>
                <div class="form-group">
                  <div>Nama Lengkap</div>
                  <input type="text" v-model="form.fullname" />
                  <div>{{ errors.fullname }}</div>
                </div>
                <div class="form-group">
                  <div>Jurusan</div>
                  <input type="text" v-model="form.major" />
                  <div>{{ errors.major }}</div>
                </div>
                <div class="form-group">
                  <div>Alamat</div>
                  <textarea v-model="form.address" />
                  <div>
                    {{ errors.address }}
                  </div>
                </div>
              </div>
              <div
                class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center"
              >
                <loading-button
                  :loading="form.processing"
                  class="btn-indigo"
                  type="submit"
                  >Simpan</loading-button
                > &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                <button
                  v-if="form.id"
                  class="text-red-600 hover:underline"
                  tabindex="-1"
                  type="button"
                  @click="destroy"
                >
                  Hapus
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
    mahasiswa: Object,
    errors: Object,
  },
  methods: {
    update() {
      Inertia.put(`/mahasiswa/${this.form.id}`, {
        nis: parseInt(this.form.nis, 10),
        fullname: this.form.fullname,
        major: this.form.major,
        address: this.form.address,
      });
    },
    destroy() {
      if (confirm("Are you sure you want to delete this mahasiswa?")) {
        Inertia.delete(`/mahasiswa/${this.form.id}`);
      }
    },
  },
  setup(props) {
    const form = useForm({
      id: props.mahasiswa.id,
      nis: props.mahasiswa.nis,
      fullname: props.mahasiswa.fullname,
      major: props.mahasiswa.major,
      address: props.mahasiswa.address,
      errors: props.errors,
    });

    return { form };
  },
};
</script>
