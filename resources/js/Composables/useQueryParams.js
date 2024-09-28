// export function useQueryParams()
// {

//     const getActiveFilterQueryCount = () => {
//         const query = new URLSearchParams(window.location.search);
//         let filterCount = 0;
//         query.forEach((value, key) => {
//             if (key !== 'sort' && key !== 'direction' && key !== 'page' && key !== 'search') {
//                 filterCount++;
//             }
//         });
//         return filterCount;
//     };


//     return {
//         getActiveFilterQueryCount
//     };
// }


export function useQueryParams() {
    const getActiveFilterQueryCount = () => {
        const query = new URLSearchParams(window.location.search);
        let filterCount = 0;
        const uniqueKeys = new Set();

        query.forEach((value, key) => {
            // Get base key for parameters like range[0] and range[1]
            const baseKey = key.split('[')[0];
            if (baseKey !== 'sort' && baseKey !== 'direction' && baseKey !== 'page' && baseKey !== 'search') {
                uniqueKeys.add(baseKey); // Add base key to Set to avoid duplicate count
            }
        });

        filterCount = uniqueKeys.size; // Set automatically handles duplicates
        return filterCount;
    };

    return {
        getActiveFilterQueryCount
    };
}
