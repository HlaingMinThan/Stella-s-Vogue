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
            processing.value = true;
            if(url === route('login')) {
                const socialErrorMessages = [
                    'This email is associated with Google login. Please use your Google login method.',
                    'This email is associated with Facebook login. Please use your Facebook login method.',
                    'This email is associated with Line login. Please use your Line login method.',
                ];

                router.post(url,
                    {
                        ...values
                    },
                    {
                        preserveState: true,
                        preserveScroll: true,
                        onSuccess: () => {
                            processing.value = false;
                        },
                        onError: (errors) => {
                            processing.value = false;
                            if (socialErrorMessages.includes(errors.email)) {
                                form.reset();
                            }

                            backendErrors.value = errors;
                        }
                    }
                );

            } else {
                const socialErrorMessages = [
                    'This email is already registered via Google. Please use Google login or use another email address.',
                    'This email is already registered via Facebook. Please use Facebook login or use another email address.',
                    'This email is already registered via Line. Please use Line login or use another email address.'
                ];

                router.post(url,
                    {
                        ...values
                    },
                    {
                        preserveState: true,
                        preserveScroll: true,
                        onSuccess: () => {
                            processing.value = false;
                        },
                        onError: (errors) => {
                            processing.value = false;
                            if (socialErrorMessages.includes(errors.email)) {
                                console.log('Social error:', errors.email);
                            }
                            backendErrors.value = errors;
                        }
                    }
                );
            }


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
