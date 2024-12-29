<template>
    <div class="my-3 bg-gray-100 p-5 rounded-xl">
        <form @submit.prevent="submitForm">
            <div class="flex flex-col ">
                <div>
                    <label  class="block text-sm font-medium text-gray-700">Collection Name</label>
                    <input
                        v-model="collection.name"
                        type="text"
                        disabled
                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        :required="true"
                    />
                </div>
                <div v-for="(collection_detail,index) in collection_details" v-key="index" 
                :class="[index !== collection_details.length - 1 ? 'border-b-[1px] border-black/20' :'']"
                class="grid grid-cols-1 sm:grid-cols-4 gap-6 py-10 relative">
                        <div v-for="(field, key) in collection_detail" v-show="key !== 'id'" :key="key"
                        >
                            <label :for="key" class="block text-sm font-medium text-gray-700">{{ field.label }}</label>
                            <input
                                v-model="field.value"
                                :type="field.type"
                                :id="key"
                                :disabled="field.disabled"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                :required="field.required"
                            />
                        </div>
                    </div>
            </div>
            <div class="mt-6">
                <button type="submit" :disabled="isLoading" class="inline-flex disabled:cursor-not-allowed justify-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    Refill
                </button>
            </div>
        </form>
    </div>
</template>
  
<script>
export default {
    props: {
        collection:{
            type : Object
        },
        collection_details_prop : {
            type : Object
        }
    },
    data() {
        return {
            collection_details : [],
            isLoading : false,
        };
    },
    methods: {
        submitForm() {
            this.isLoading = true;
            this.$inertia.put(route('admin.refill.update', { collection: this.collection?.id }), {collection_details : this.collection_details},{
                onSuccess : () => {
                    this.isLoading = false
                },
                onError : () => {
                    this.isLoading = false
                }
            });
        },
    },
    mounted(){
            this.collection_details = this.collection_details_prop.map(collectionDetail => {
                return {
                    id : collectionDetail.id,
                    color : {label : 'Color', type : 'text',required : true ,value : collectionDetail.color,disabled : true},
                    size : {label : 'Size', type : 'text',required : true ,value : collectionDetail.size,disabled : true},
                    price : {label : 'Price', type : 'text',required : true ,value : collectionDetail.price,disabled : true},
                    refill: { label: 'Refill Stock', type: 'tel', required: true ,value : 0,disabled : false},
                }
            });
            console.log(this.collection_details);
    }
};
</script>
  
  <style scoped>
  /* Add custom styles here */
  </style>
  