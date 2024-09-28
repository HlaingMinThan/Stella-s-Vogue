import { computed, ref,reactive } from 'vue';
import { router } from '@inertiajs/vue3';
import { useField, useForm } from 'vee-validate';

export function useHandleSubmit(initialFormFields = {}, validationSchema = {}) {
    const processing = ref(false);
    const backendErrors = ref(null);

    // Initialize Form and Fields For Frontend Validation
    const { handleSubmit, errors:frontendErrors } = useForm({
        validationSchema: validationSchema ?? undefined,
        initialValues: initialFormFields,
    });

    // Define individual fields using useField from vee validate
    const form = reactive({});
    Object.keys(initialFormFields).forEach((key) => form[key] = useField(key).value);


    const setFormField = (key, value) => {
        if (form[key] !== undefined) {
            form[key] = value;
        }
    };


    // Create Action
    const submit = (url) => {
        handleSubmit((values)=>{
            console.log('usesubmit');

            processing.value = true;
            router.post(url,
                {
                    ...values
                },
                {
                    preserveState: true,
                    onFinish: () => (processing.value = false),
                    onError: (errors) => {
                        backendErrors.value = errors;
                    }
                }
            );
        })();
    };

    const errors = computed(() => ({ ...frontendErrors?.value, ...backendErrors?.value }));
    const isFormValid = computed(() => Object.values(form).every(field => field.value !== undefined && field.value !== ''));

    return {
        form,
        errors,
        processing,
        submit,
        setFormField,
        isFormValid
    };
}
