import Decimal from 'decimal.js';
function getTotalPrice(items)
{
    let total = items.reduce((initialValue, item) => {
        let currentPriceWithDecimal = new Decimal(item.price.amount);
        return  initialValue.plus(currentPriceWithDecimal);
    }, new Decimal(0));
    return total;
}

export default getTotalPrice;