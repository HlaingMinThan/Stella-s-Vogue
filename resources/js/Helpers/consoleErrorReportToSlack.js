import axios from 'axios';

let consoleErrorReportToSlack = () => {
    window.addEventListener('unhandledrejection', (event) => {
        const title = document.title;
        if (event.reason && event.reason.message && !title) {
            let errorMessage = event.reason;
            let stackTrace = event.reason.stack;

            let fileName = 'unknown';
            let lineNumber = 'unknown';

            if (stackTrace) {
                let stackLines = stackTrace.split('\n');
                if (stackLines.length > 1) {
                    let match = stackLines[1].match(/at\s+(.*):(\d+):\d+/);
                    if (match) {
                        fileName = match[1];
                        lineNumber = match[2];
                    }
                }
            }

            var errorData = {
                line: lineNumber,
                fileName: fileName,
                description: `⚠️  ${errorMessage}`,
            };
            axios.post('/console-error-report', errorData)
                .then(response => {
                    console.log('Console Error reported successfully:', response);
                })
                .catch(error => {
                    console.log('Console Error reporting failed:', error);
                });
        }
    });
};
export {
    consoleErrorReportToSlack
};
