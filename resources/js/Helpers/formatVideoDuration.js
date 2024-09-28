import moment from 'moment';

export const formatVideoDuration = (milliseconds, humanReadable = false) => {

    if (!milliseconds) {
        return (humanReadable ? '' : '00:00');
    }

    const duration = moment.duration(milliseconds,'milliseconds');
    const hours = duration.hours() < 10 ? '0' + duration.hours() : duration.hours();
    const minutes = duration.minutes() < 10 ? '0' + duration.minutes() : duration.minutes();
    const seconds = duration.seconds() < 10 ? '0' + duration.seconds() : duration.seconds();

    if (duration.hours() == 0 && duration.minutes() == 0 && duration.seconds() != 0) {
        return (humanReadable ? `${duration.seconds()}s` : `${minutes} : ${seconds}`);
    }

    if (duration.hours() == 0 && duration.minutes() != 0) {
        return (humanReadable ? `${duration.minutes()}m` : `${minutes} : ${seconds}`);
    }

    if (duration.hours() != 0 && duration.minutes() == 0) {
        return (humanReadable ? `${parseInt(duration.asHours())}h` : `${hours} : ${minutes} : ${seconds}`);
    }

    return (humanReadable ? `${parseInt(duration.asHours())}h ${duration.minutes()}m` : `${hours} : ${minutes} : ${seconds}`);
};
