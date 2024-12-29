<template>
    <div class="my-3 bg-gray-100 p-5 rounded-xl">
        <form @submit.prevent="submitForm">
            <div class="flex flex-col ">
                <div>
                    <label  class="block text-sm font-medium text-gray-700">Collection Name</label>
                    <input
                        v-model="collection_name"
                        type="text"
                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        :required="true"
                    />
                    <p class="text-xs pt-1 font-medium text-red-500" v-if="errors && errors['collection_name']">{{ errors[`collection_name`] }}</p>
                </div>
                <div v-for="(collection_detail,index) in collection_details" v-key="index" 
                :class="[index !== collection_details.length - 1 ? 'border-b-[1px] border-black/20' :'']"
                class="grid grid-cols-1 sm:grid-cols-4 gap-6 py-10 relative">
                <div v-if="collection_details.length > 1" @click="removeCollectionDetail(index)" class="absolute top-[10px] right-0 text-red-500 w-[30px] h-[30px] border-[1px] border-red-500 flex items-center justify-center rounded-md hover:bg-red-500 hover:text-white cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><path fill="currentColor" d="M18 12.998H6a1 1 0 0 1 0-2h12a1 1 0 0 1 0 2"/></svg></div>
                <div v-for="(field, key) in collection_detail" v-show="key !== 'id'" :key="key"
                >
                            <label :for="key" class="block text-sm font-medium text-gray-700">{{ field.label }}</label>
                            <input
                                v-model="field.value"
                                :type="field.type"
                                :id="key"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                :class="[duplicates.includes(`${collection_detail.color.value}-${collection_detail.size.value}-${index}`) ? 'border-[1px] border-red-500' :'border-gray-300']"
                                :required="field.required"
                            />
                            <p v-if="key == 'stock' && collection_detail.id" class="sm:col-span-4 text-sm mt-2 text-green-500 text-semibold">You already sold {{collection_details_prop.find(cd => cd.id == collection_detail.id)?.total_stock - collection_details_prop.find(cd => cd.id == collection_detail.id)?.in_stock}} items.</p>
                            <p class="text-xs pt-1 font-medium text-red-500" v-if="errors && errors[`collection_details.${index}.${key}.value`]">{{ errors[`collection_details.${index}.${key}.value`] }}</p>
                        </div>
                        <p v-if="duplicateError && duplicates.includes(`${collection_detail.color.value}-${collection_detail.size.value}-${index}`)" class="text-sm font-medium text-red-500">{{ duplicateError }}</p>
                    </div>
            </div>
            <div @click="addNewCollectionDetail" class="w-[30px] h-[30px] border-[1px] flex items-center justify-center rounded-sm mt-5 cursor-pointer  hover:bg-primary hover:border-transparent hover:text-white border-black/20">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><path fill="currentColor" d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2z"/></svg>
            </div>
            <div class="mt-6">
                <button type="submit" :disabled="duplicates.length > 0 || isLoading" class="inline-flex disabled:cursor-not-allowed justify-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    {{ isEditMode ? 'Update Collection' : 'Create Collection' }}
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
        isEditMode: {
            type: Boolean,
            default: false,
        },
        collection_details_prop : {
            type : Object
        }
    },
    watch : {
        'collection_details':{
        handler() {
            this.validateCollectionDetails()
            console.log(this.duplicates)
        },
        deep: true
    }
    },
    data() {
        return {
            fields: {
                name: { label: 'Collection Name', type: 'text', required: true },
                // fabric: { label: 'Fabric Cost', type: 'number', required: true },
                // under: { label: 'Under Cost', type: 'number', required: true },
                // sample_pattern: { label: 'Sample Pattern', type: 'number', required: true },
                // sew_fees: { label: 'Sew Fees', type: 'number', required: true },
                // model_fees: { label: 'Model Fees', type: 'number', required: true },
                // model_deli_fees: { label: 'Model Delivery Fees', type: 'number', required: true },
                // boosting: { label: 'Boosting Cost', type: 'number', required: true },
                // phone_bill: { label: 'Phone Bill', type: 'number', required: true },
                // packing_fees: { label: 'Packing Fees', type: 'number', required: true },
                // extra_charges: { label: 'Extra Charges', type: 'number', required: true },
                // taxi_charges: { label: 'Taxi Charges', type: 'number', required: true },
                // ga__vlog_charges: { label: 'GA/Vlog Charges', type: 'number', required: true },
                stock: { label: 'Stock', type: 'tel', required: true },
            },
            collection_name : '',
            collection_details : [{
                color : {label : 'Color', type : 'text',required : true , value : ''},
                size : {label : 'Size', type : 'text',required : true,value :''},
                price : {label : 'Price', type : 'text',required : true,value : ''},
                stock: { label: this.isEditMode ? 'Total Stock(Refill Included)' : 'Total Stock', type: 'tel', required: true,value : '' },
            }],
            duplicateError : null,
            duplicates : [],
            errors : null,
            isLoading : false,
        };
    },
    methods: {
        submitForm() {
            if(this.duplicates.length > 0) return;
            this.isLoading = true;
            const routeName = this.isEditMode ? 'admin.collections.update' : 'admin.collections.store';
            const method = this.isEditMode ? 'put' : 'post';
            this.$inertia[method](route(routeName, { collection: this.collection?.id }), {collection_details : this.collection_details,collection_name : this.collection_name},{
                onError : (e) => {
                    this.errors = e
                    this.isLoading = false
                },
                onSuccess : () => {
                    this.isLoading = false
                }
            });
        },
        addNewCollectionDetail(){
            let collectionDetailField = {
                color : {label : 'Color', type : 'text',required : false ,value : ''},
                size : {label : 'Size', type : 'text',required : true ,value : ''},
                price : {label : 'Price', type : 'text',required : true ,value : ''},
                stock: { label: this.isEditMode ? 'Total Stock(Refill included)' : 'Total Stock', type: 'tel', required: true ,value : ''},
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
    mounted(){
        if(this.isEditMode){
            this.collection_name = this.collection.name
            this.collection_details = this.collection_details_prop.map(collectionDetail => {
                return {
                    id : collectionDetail.id,
                    color : {label : 'Color', type : 'text',required : true ,value : collectionDetail.color},
                    size : {label : 'Size', type : 'text',required : true ,value : collectionDetail.size},
                    price : {label : 'Price', type : 'text',required : true ,value : collectionDetail.price},
                    stock: { label: this.isEditMode ? 'Total Stock(Refill included)' : 'Total Stock', type: 'tel', required: true ,value : collectionDetail.total_stock},
                }
            });
        }
    }
};
</script>
  
  <style scoped>
  /* Add custom styles here */
  </style>
  