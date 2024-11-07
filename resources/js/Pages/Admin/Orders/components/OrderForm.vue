<template>
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
          <label for="address" class="block text-sm font-medium text-gray-700"
            >Address</label
          >
          <input
            v-model="form.address"
            type="text"
            id="address"
            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
          />
          <InputError class="mt-2" :message="form.errors?.address" />
        </div>
        <div>
          <label for="phone" class="block text-sm font-medium text-gray-700"
            >Phone Number</label
          >
          <input
            v-model="form.phone"
            type="text"
            id="phone"
            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
          />
          <InputError class="mt-2" :message="form.errors?.phone" />
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <div>
            <label for="payment" class="block text-sm font-medium text-gray-700"
              >Payment Option</label
            >
            <SelectBox
              class="w-full bg-white"
              v-model="form.payment"
              placeholder="Choose payment"
              :options="payments"
              :reduce="(payment) => payment"
              :get-option-label="(option) => `${option}`"
            />
            <InputError class="mt-2" :message="form.errors?.payment" />
          </div>
          <div>
            <label
              for="delivery_id"
              class="block text-sm font-medium text-gray-700"
              >Deliveries</label
            >
            <SelectBox
              class="w-full bg-white"
              v-model="form.delivery_id"
              placeholder="Choose delivery"
              :options="deliveries"
              :reduce="(delivery) => delivery.id"
              :get-option-label="(option) => `${option.name}`"
            />
            <InputError class="mt-2" :message="form.errors?.delivery_id" />
          </div>
        </div>

        <div>
          <label
            for="screenshot"
            class="block text-sm font-medium text-gray-700"
            >Screenshot (Optional)</label
          >
          <input
            @change="form.screenshot = $event.target.files[0]"
            type="file"
            id="screenshot"
            class="mt-1 block w-full shadow-sm sm:text-sm border-[1px] border-gray-300 rounded-md p-2 bg-white"
          />
          <InputError class="mt-2" :message="form.errors?.screenshot" />
        </div>
        <div>
          <label for="deli_amount" class="block text-sm font-medium text-gray-700"
            >Deli Amount</label
          >
          <input
            v-model="form.deli_amount"
            type="number"
            id="deli_amount"
            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
          />
          <InputError class="mt-2" :message="form.errors?.deli_amount" />
        </div>
        <div>
          <label for="deli_amount" class="block text-sm font-medium text-gray-700"
            >Order Date</label
          >
          <input
            v-model="form.created_at"
            type="date"
            id="order_date"
            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
          />
          <InputError class="mt-2" :message="form.errors?.created_at" />
        </div>

        
      </div>

      <div class="mt-10">
        <div class="flex justify-end">
          <button
          @click="handleAddCollection"
          type="button"
          class="inline-flex justify-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700"
          >
          Add Another Collection
          </button>
        </div>
        <div class="flex flex-col gap-5">
          <div v-for="(collection,index) in form.collections "  :key="index">
            <div class="flex items-center gap-3 mb-2">
              <h1 class="text-lg font-bold ">Order Item {{ index + 1 }}</h1>
              <button @click="() => handleDeleteOrderItem(index)" class="bg-red-500 text-white text-sm py-1 rounded-lg px-2" v-if="!isEditMode">Delete</button>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
              <div>
              <label for="name" class="block text-sm font-medium text-gray-700"
                >Collection Name</label
              >
              <SelectBox
                class="w-full bg-white"
                v-model="collection.collection_id"
                placeholder="Choose collection"
                :options="collections"
                :reduce="(collection) => collection.id"
                :get-option-label="(option) => `${option.name}`"
              />
              <InputError class="mt-2" :message="form.errors['collections.' + index + '.collection_id']" />
            </div>

            <div>
              <label for="color" class="block text-sm font-medium text-gray-700"
                >Color</label
              >
              <input
                v-model="collection.color"
                type="text"
                id="color"
                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
              />
              <InputError class="mt-2" :message="form.errors['collections.' + index + '.color']" />
            </div>
            <div>
              <label for="size" class="block text-sm font-medium text-gray-700"
                >Size</label
              >
              <input
                v-model="collection.size"
                type="text"
                id="size"
                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
              />
              <InputError class="mt-2" :message="form.errors['collections.' + index + '.size']" />
            </div>


            


            <div>
              <label for="amount" class="block text-sm font-medium text-gray-700"
                >Amount</label
              >
              <input
                v-model="collection.amount"
                type="number"
                id="amount"
                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
              />
              <InputError class="mt-2" :message="form.errors['collections.' + index + '.amount']" />
            </div>
            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700"
                  >Notes</label
                >
                <textarea
                  v-model="collection.notes"
                  type="text"
                  rows="5"
                  id="notes"
                  class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                />
                <InputError class="mt-2" :message="form.errors['collections.' + index + '.notes']" />
            </div>
            </div>
          </div>
        </div>
      </div>

      <div class="mt-6">
        <button
          type="submit"
          class="inline-flex justify-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700"
        >
          {{ isEditMode ? "Update Order" : "Create Order" }}
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import SelectBox from "@/Components/Atoms/SelectBox.vue";
import InputError from "@/Components/InputError.vue";

export default {
  components: { SelectBox ,InputError },
  props: {
    deliveries: Array,
    payments: Array,
    initialForm: {
      type: Object,
      default: () => ({
        name: "",
        address: "",
        phone: "",
        created_at : null,
        payment: "",
        screenshot: null,
        delivery_id: null,
        deli_amount: 0,
        collections : []
      }),
    },
    collections: Array,
    isEditMode: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      form: this.$inertia.form({
        name: this.initialForm.name,
        address: this.initialForm.address,
        phone: this.initialForm.phone,
        payment: this.initialForm.payment,
        created_at : this.initialForm.created_at,
        screenshot: this.initialForm.screenshot,
        delivery_id: this.initialForm.delivery_id,
        deli_amount: this.initialForm.deli_amount,
        collections : this.isEditMode ? this.initialForm?.order_details.map(detail => {
          return {
            id : detail.id,
            collection_id : detail.collection_id,
            color : detail.color,
            amount : detail.amount,
            size : detail.size,
            notes : detail.notes
          }
        }) : [{
          collection_id : "",
          color : "",
          size : '',
          amount : 0,
          notes : ''
        }]
      }),
    };
  },
  methods: {
    async submitForm() {
      this.form.clearErrors();
      //upload screenshot left
      const routeName = this.isEditMode
        ? "admin.orders.update"
        : "admin.orders.store";
      await this.form.post(
        route(routeName, {
          order: this.isEditMode ? this.initialForm.id : null,
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
    handleDeleteOrderItem(i){
      this.form.collections.splice(i,1)
    }
  }
};
</script>

<style scoped>
/* Add custom styles here */
</style>
