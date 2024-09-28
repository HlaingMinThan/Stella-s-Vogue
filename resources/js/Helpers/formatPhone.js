import Cleave from 'cleave.js';

export default function formatPhone(phone)
{
    return new Cleave(phone, {
        numeral: true,
        blocks: [2,3,4,6],
        stripLeadingZeroes: false,
        delimiter: ' '
    });
}