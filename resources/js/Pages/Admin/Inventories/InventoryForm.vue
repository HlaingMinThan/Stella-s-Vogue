<template>
    <div class="my-3 bg-gray-100 p-5 rounded-xl">
        <h1 class=" text-xl font-semibold">{{ inventory.collection_detail.collection.name }} ({{ inventory.collection_detail.color }} / {{ inventory.collection_detail.size }})</h1>
        <p class="text-sm font-semibold pt-1">Created At - {{ $formatDate(inventory.createdAt) }} </p>
        <form @submit.prevent="submitForm" class="mt-5">
            <div class="flex flex-col ">
                <div  
                class="grid grid-cols-1 sm:grid-cols-4 gap-6  relative">
                        <div 
                        >
                            <label  class="block text-sm font-medium text-gray-700">Stocks</label>
                            <input
                                v-model="form.stocks"
                                type="tel"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                :required="true"
                            />
                            <p class="text-xs pt-1 font-medium text-red-500" v-if="form.errors.stocks">{{ form.errors.stocks }}</p>
                        </div>
                    </div>
            </div>
            <div class="mt-6">
                <button type="submit" :disabled="isLoading"  class="inline-flex disabled:cursor-not-allowed justify-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    {{ isEditMode ? 'Update Inventory' : 'Create Collection' }}
                </button>
            </div>
        </form>
    </div>
</template>
  
<script>
export default {
    props: {
        inventory:{
            type : Object
        },
        isEditMode: {
            type: Boolean,
            default: false,
        },
    },
    inject: ['$formatDate'],
    data() {
        return {
            form : this.$inertia.form({
                stocks : this.inventory?.stocks,
            }),
            isLoading : false,
        };
    },
    methods: {
        submitForm() {
            this.isLoading = true;
            const routeName = this.isEditMode ? 'admin.inventories.update' : 'admin.inventories.store';
            const method = this.isEditMode ? 'put' : 'post';
            this.form[method](route(routeName,{inventory : this.inventory.id}),{
                onSuccess : () => {
                    this.isLoading = false
                },
                onError : () => {
                    this.isLoading = false;
                }
            })
        },
        addNewCollectionDetail(){
            let collectionDetailField = {
                color : {label : 'Color', type : 'text',required : false ,value : ''},
                size : {label : 'Size', type : 'text',required : true ,value : ''},
                price : {label : 'Price', type : 'text',required : true ,value : ''},
                stock: { label: this.isEditMode ? 'Total Stock(Refill included)' : 'Total Stock', type: 'number', required: true ,value : ''},
            }
            this.collection_details = [...this.collection_details,collectionDetailField]
        },
        removeCollectionDetail(index){
            this.collection_details.splice(index,1)
        },
        validateCollectionDetails() {
            const seen = new Set();
            this.duplicates = []
            for (let i = 0 ; i <  this.collection_details.length ; i++) {
                const key = `${this.collection_details[i].color.value}-${this.collection_details[i].size.value}`;
                const duplicateKey = `${this.collection_details[i].color.value}-${this.collection_details[i].size.value}-${i}`;;
                if (seen.has(key)) {
                    this.duplicates.push(duplicateKey);
                } else {
                    seen.add(key);
                }
            }
            
            if (this.duplicates.length > 0) {
                this.duplicateError = `${this.collection_name} ${this.duplicates[0].split('-').slice(0,this.duplicates[0].split('-').length - 1).join('/')} is already exists.`;
            } else {
                this.duplicateError = null;
            }
        }
    },
};
</script>
  
  <style scoped>
  /* Add custom styles here */
  </style>
  