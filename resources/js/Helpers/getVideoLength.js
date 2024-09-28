export const getVideoDuration = (url) => {
    return new Promise((resolve,reject) => {
        try {
            var video = document.createElement('video');

            const source = document.createElement('source');

            source.src = url;

            video.appendChild(source);
            video.preload = 'metadata';
            video.addEventListener('durationchange', () => {
                resolve(video.duration);

            });
        } catch (error) {
            reject(error);
        }

    });

};