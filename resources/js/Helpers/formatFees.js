import Cleave from 'cleave.js';

export default function formatFees(fees)
{
    return new Cleave(fees, {
        numeral: true,
    });
}