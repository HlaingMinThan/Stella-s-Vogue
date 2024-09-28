export default function filterWithNationality(user,prices,nationality)
{
    return prices.filter(price => {
        if (user) {
            return true;
        }
        // if(nationality == 'Thailand' || nationality == 'Myanmar'){
        if (nationality == 'Myanmar') {
            return price.country_code == 'myanmar';
        } else {
            return price.country_code == null;
        }
    });
}
