<template>
    <h1 class="text-2xl my-4">{{isEditMode ? 'Update' : 'Create'}} order for <span class="text-blue-500">{{ collection.name }}</span></h1>
    <div class="my-3 bg-gray-100 p-5 rounded-xl">
      <form @submit.prevent="submitForm">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700"
              >Customer Name</label
            >
            <input
              v-model="form.name"
              type="text"
              id="name"
              class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
            />
            <InputError class="mt-2" :message="form.errors?.name" />
          </div>
          <div>
            <label for="color" class="block text-sm font-medium text-gray-700"
              >Color</label
            >
            <input
              v-model="form.color"
              type="text"
              id="color"
              class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
            />
            <InputError class="mt-2" :message="form.errors?.color" />
          </div>
          <div>
            <label for="size" class="block text-sm font-medium text-gray-700"
              >Size</label
            >
            <input
              v-model="form.size"
              type="text"
              id="size"
              class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
            />
            <InputError class="mt-2" :message="form.errors?.size" />
          </div>
          <div>
            <label for="pcs" class="block text-sm font-medium text-gray-700"
              >Pcs</label
            >
            <input
              v-model="form.pcs"
              type="text"
              id="pcs"
              class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
            />
            <InputError class="mt-2" :message="form.errors?.pcs" />
          </div>
          <div>
            <label for="price" class="block text-sm font-medium text-gray-700"
              >Price (1pc price)</label
            >
            <input
              v-model="form.amount"
              type="text"
              id="price"
              class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
            />
            <InputError class="mt-2" :message="form.errors?.amount" />
          </div>
        </div>
  
        <div class="mt-6">
          <button
            type="submit"
            class="inline-flex justify-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700"
          >
            Update Order
          </button>
          <InertiaLinkButton
              :href="route('admin.order_details.index', { collection: collection.id })"
              class="border-2 border-blue-700 !text-xs !font-semibold ml-4"
          >
              cancel
          </InertiaLinkButton>
        </div>
      </form>
    </div>
  </template>
  
  <script>
  import SelectBox from "@/Components/Atoms/SelectBox.vue";
  import InputError from "@/Components/InputError.vue";
  import Datepicker from "@/Components/Atoms/Datepicker.vue";
import InertiaLinkButton from "@/Components/Atoms/InertiaLinkButton.vue";
  
  export default {
    components: {Datepicker, SelectBox ,InputError,InertiaLinkButton },
    props: {
      initialForm: {
        type: Object,
        default: () => ({
          name: "",
          color: "",
          size: "",
          pcs: "",
          amount: "",
        }),
      },
      collection: Object,
      isEditMode: {
        type: Boolean,
        default: false,
      },
    },
    data() {
      return {
        form: this.$inertia.form({
          name: this.initialForm?.order?.name,
          color: this.initialForm?.color,
          size: this.initialForm?.size,
          pcs: this.initialForm?.pcs,
          amount: this.initialForm?.amount,
        }),
      };
    },
    methods: {
      async submitForm() {
        this.form.clearErrors();
        //upload screenshot left
        const routeName = this.isEditMode
          ? "admin.order_details.update"
          : "admin.order_details.store";
        await this.form.post(
          route(routeName, {
            orderDetail: this.isEditMode ? this.initialForm.id : null,
            collection : this.collection.id
          })
        );
      },
      handleAddCollection(){
        this.form.collections.push({
            collection_id : "",
            color : "",
            size : '',
            amount : 0,
            notes : ''
          })
      },
      handleDateChange(e){
              const formattedDate = new Date(e.target.value).toLocaleDateString('en-GB', {
                                      day: '2-digit',
                                      month: '2-digit',
                                      year: '2-digit'
                                  }).replace(/\//g, '-');
              this.form.created_at = formattedDate
          },
      handleDeleteOrderItem(i){
        this.form.collections.splice(i,1)
      }
    },
    mounted(){
      console.log(this.initialForm.created_at)
    }
  };
  </script>
  
  <style scoped>
  /* Add custom styles here */
  </style>
  