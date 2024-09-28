export default {
    install(app) {
        app.config.globalProperties.$checkMaintenanceMode = () => {
            // Check if the custom header is set by making a request to the current URL
            fetch(window.location.href, { method: 'HEAD' })
                .then(response => {
                    // Check if the custom header is present
                    if (response.headers.get('X-Maintenance-Mode') === 'true') {
                        // Reload the page
                        window.location.reload();
                    }
                })
                .catch(error => console.error('Error checking maintenance mode:', error));
        };
    }
};
