import { usePage } from '@inertiajs/inertia-vue3';

const getRankImage = (currentXP , allCertificatesCount,type) => {
    if (currentXP >= 0 && currentXP < 500) {
        return type === 'image' ? usePage().props.value.APP_ENV === 'production' ?  'https://d27v83ov1up738.cloudfront.net/public/warrior.png' : 'https://creativecodertesting.s3.ap-southeast-1.amazonaws.com/public/warrior.png' : 'Warrior';
    }
    if (currentXP >= 500 && currentXP < 800) {
        return type === 'image' ? usePage().props.value.APP_ENV === 'production' ?  'https://d27v83ov1up738.cloudfront.net/public/elite.png' : 'https://creativecodertesting.s3.ap-southeast-1.amazonaws.com/public/elite.png' : 'Elite';
    }
    if (currentXP >= 800 && currentXP < 1100) {
        return type === 'image' ? usePage().props.value.APP_ENV === 'production' ?  'https://d27v83ov1up738.cloudfront.net/public/pro.png' : 'https://creativecodertesting.s3.ap-southeast-1.amazonaws.com/public/pro.png' : 'Pro';
    }
    if (currentXP >= 1100 && currentXP < allCertificatesCount * 100) {
        return type === 'image' ? usePage().props.value.APP_ENV === 'production' ?  'https://d27v83ov1up738.cloudfront.net/public/master.png' : 'https://creativecodertesting.s3.ap-southeast-1.amazonaws.com/public/master.png' : 'Master';
    }
    return type === 'image' ? usePage().props.value.APP_ENV === 'production' ?  'https://d27v83ov1up738.cloudfront.net/public/lengendary.png' : 'https://creativecodertesting.s3.ap-southeast-1.amazonaws.com/public/lengendary.png' : 'Legendary';

};

export default getRankImage;