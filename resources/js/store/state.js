export default {
    cart: JSON.parse(localStorage.getItem('cart')) ?? [],
    isCartOpen : false,
    isSideNavOpen : false,
    isRegionModalBoxOpen : !localStorage.getItem('region'),
    nationality : localStorage.getItem('region') ?? '',
    verifyCountDown : null,
    emailVerifyTimerInterval : null
};
