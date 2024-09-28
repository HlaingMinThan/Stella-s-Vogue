export default function getTotalSaved(currentPlanPrice, monthlyPlanPrice) {
    if (!currentPlanPrice || !monthlyPlanPrice) {
        return 0;
    }

    const totalSaved = (monthlyPlanPrice * 12) - currentPlanPrice;

    return totalSaved > 0 ? totalSaved : 0;
}
