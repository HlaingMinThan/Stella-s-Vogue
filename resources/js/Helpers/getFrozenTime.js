export default function getFrozenTime(daysFromToday, time = null) {
    let date = new Date();
    date.setDate(date.getDate() + daysFromToday);

    // If time is provided, set hours and minutes accordingly
    if (time) {
        let [hours, minutes] = time.split(':');
        let period = minutes.slice(-2);  // AM or PM
        minutes = minutes.slice(0, -2);  // remove AM/PM from minutes

        // Adjust hours for 12-hour format
        if (period.toUpperCase() === 'PM' && hours !== '12') {
            hours = parseInt(hours) + 12;
        } else if (period.toUpperCase() === 'AM' && hours === '12') {
            hours = 0;  // Midnight case
        }

        // Set the hours and minutes
        date.setHours(hours);
        date.setMinutes(minutes);
        date.setSeconds(0); // Optional: clear seconds
    }

    // Get date components without commas
    const datePart = date.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
    }).replace(/,/g, '');

    const timePart = date.toLocaleTimeString('en-US', {
        hour: 'numeric',
        minute: 'numeric',
        hour12: true,
    });

    return `${datePart} ${timePart}`;
}
