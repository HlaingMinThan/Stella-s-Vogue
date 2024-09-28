<template>
    <Modal :open="open" @closeModal="$emit('closeModal')"  can-close-backdrop>
        <form class="text-black space-y-2 p-4" @submit.prevent="submit">
            <h1 class="text-xl font-bold">Request a Consultation</h1>
            <div class="mt-8 ">
                <Label label="Inquiry Type" required />
                <SelectBox
                    v-model="form.category"
                    name="category"
                    :options="categories"
                    required
                />
                <ValidationError :message="form.errors?.category" />
            </div>
            <div>
                <Label label="Summary of Your Inquiry" required />
                <span class="text-sm  block mb-1"
                      :class="[
                          form.details && form.details.length >= wordCountLimit ? 'text-red-500' : 'text-black/40'
                      ]"
                >Words {{wordCountLimit}} in {{form.details ? form.details.length : 0}}</span>
                <Textarea
                    data-cy="email-input"
                    :value="form.details"
                    @input="textLimit"
                    placeholder="Summary of Your Inquiry"
                    required
                />
                <ValidationError :message="form.errors?.details" />
            </div>
            <div>
                <Label label="Call Us Weekdays: 9 AM - 4 PM" />
                <Datepicker enable-time-picker :min-date="new Date()"  :is-24="false" v-model="form.preferred_date_time" placeholder="Select your preferred date and time" />
                <ValidationError :message="form.errors?.preferred_date_time" />
            </div>
            <div>
                <Label label="Intake Number (if any)" />
                <InputField
                    v-model="form.intake_number"
                    placeholder="Please enter your intake number"
                />
                <ValidationError :message="form.errors?.intake_number" />
            </div>
            <div>
                <FormButton  :processing="form.processing" type="submit"  class="w-full bg-primary text-white"  >
                    submit
                </FormButton>
            </div>
        </form>
    </Modal>
</template>

<script>
import Modal from '@/Components/Atoms/Modal.vue';
import Label from '@/Components/Atoms/Label.vue';
import Textarea from '@/Components/Atoms/Textarea.vue';
import InputField from '@/Components/Atoms/InputField.vue';
import SelectBox from '@/Components/Atoms/SelectBox.vue';
import Datepicker from '@/Components/Atoms/Datepicker.vue';
import FormButton from '@/Components/Atoms/FormButton.vue';
import ValidationError from '../Atoms/ValidationError.vue';


export default {
    components : {
        Modal,
        InputField,
        Textarea,
        SelectBox,
        Label,
        Datepicker,
        FormButton,
        ValidationError
    },
    props : {
        open: {
            type : Boolean
        }
    },
    data(){
        return{
            wordCountLimit: 300,
            personalCategories : [
                { label: 'Visa and Immigration Issues', value: 'Visa and Immigration Issues' },
                { label: 'Estate Planning and Wills', value: 'Estate Planning and Wills' },
                { label: 'Rental and Property Disputes', value: 'Rental and Property Disputes' },
                { label: 'Expat Support Services', value: 'Expat Support Services' },
                { label: 'Document Review & Advice', value: 'Document Review & Advice' },
                { label: 'Employment Issues', value: 'Employment Issues' },
                { label: 'Family Law Matters', value: 'Family Law Matters' },
                { label: 'Criminal Law Issues', value: 'Criminal Law Issues' },
                { label: 'Traffic Accident', value: 'Traffic Accident' },
            ],
            BusinessCategories : [
                { label: 'Company Registration', value: 'Company Registration' },
                { label: 'Visa & Work Permit', value: 'Visa & Work Permit' },
                { label: 'Debt Collection', value: 'Debt Collection' },
                { label: 'Labor Laws', value: 'Labor Laws' },
                { label: 'Licenses and Permits', value: 'Licenses and Permits' },
                { label: 'Civil Litigation', value: 'Civil Litigation' },
                { label: 'Taxation & Accounting', value: 'Taxation & Accounting' },
                { label: 'Banking & Financial Services', value: 'Banking & Financial Services' },
                { label: 'Intellectual Property Protection', value: 'Intellectual Property Protection' },
                { label: 'Dispute Resolution > Mediation Services', value: 'Dispute Resolution > Mediation Services' },
            ],
            form : this.$inertia.form({
                category: null,
                details: null,
                intake_number: null,
                preferred_date_time: null,
            })
        };
    },
    computed : {
        categories() {
            let customerInquiry = { label: 'Customer Inquiry', value: 'Customer Inquiry' };
            let other = { label: 'Other', value: 'Other' };
            let emergency = { label:'Emergency', value: 'Emergency' };
            let livingAndLast={label:'Living and Last Will',value: 'Living and Last Will' };
            if(this.$page.props.auth?.user.current_plans?.length === 2) {
                let categories = [...this.personalCategories, ...this.BusinessCategories, customerInquiry, other];
                if (this.$page.props.auth?.user.request_emergency_card==false) {
                    categories.push(emergency);
                }
                if (this.$page.props.auth?.user.request_living_will_last_will_card==false) {
                    categories.push(livingAndLast);
                }
                return categories;
            }

            if(this.$page.props.auth?.user.current_plans?.some((plan) => plan.name === 'Business')) {
                let categories = [...this.BusinessCategories, customerInquiry, other];
                if (this.$page.props.auth?.user.request_emergency_card==false) {
                    categories.push(emergency);
                }
                if (this.$page.props.auth?.user.request_living_will_last_will_card==false) {
                    categories.push(livingAndLast);
                }
                return categories;
            }
            if(this.$page.props.auth?.user.current_plans?.some((plan) => plan.name === 'Personal' || this.$page.props.auth?.is_free_member)) {
                let categories = [...this.personalCategories, customerInquiry, other];
                if (this.$page.props.auth?.user.request_emergency_card==false) {
                    categories.push(emergency);
                }
                if (this.$page.props.auth?.user.request_living_will_last_will_card==false) {
                    categories.push(livingAndLast);
                }
                return categories;
            }
            return [];
            // if(this.$page.props.auth?.user.current_plans.length === 2) {
            //     return [...this.personalCategories, ...this.BusinessCategories,customerInquiry,other];
            // }
            // if(this.$page.props.auth?.user.current_plans?.some((plan) => plan.name === 'Business')) {
            //     return [...this.BusinessCategories,customerInquiry,other];
            // }
            // if(this.$page.props.auth?.user.current_plans?.some((plan) => plan.name === 'Personal')) {
            //     return [...this.personalCategories,customerInquiry,other];
            // }
            // return [];
        },
    },
    methods : {
        submit() {
            this.form.post(this.route('consultant.store'), {
                onSuccess: () => {
                    this.form.reset();
                    this.$emit('closeModal');
                },
            });
        },
        textLimit(e){
            if(e.target.value.length > this.wordCountLimit){
                this.form.details = e.target.value.slice(0,this.wordCountLimit);
                e.target.value = this.form.details;
                return;
            }else{
                this.form.details = e.target.value;
            }
        }
    }
};
</script>

<style>

</style>
