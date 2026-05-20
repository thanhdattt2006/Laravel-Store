/**
 * apiService.js
 * Centralized AJAX utility to handle API requests.
 * Extracts redundant headers, CSRF token, and response parsing.
 */
const ApiService = {
    /**
     * Get the CSRF token from the meta tag
     */
    getCSRFToken() {
        const tokenMeta = document.querySelector('meta[name="csrf-token"]');
        return tokenMeta ? tokenMeta.getAttribute('content') : '';
    },

    /**
     * Generic fetch wrapper
     */
    async request(url, options = {}) {
        const headers = {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': this.getCSRFToken(),
            ...(options.headers || {})
        };

        // If body is an object and not FormData, stringify it
        if (options.body && typeof options.body === 'object' && !(options.body instanceof FormData)) {
            options.body = JSON.stringify(options.body);
            headers['Content-Type'] = 'application/json';
        }

        const config = {
            ...options,
            headers
        };

        try {
            const response = await fetch(url, config);
            const data = await response.json();
            
            // Add status to data so we can check if it's not ok
            if (!response.ok) {
                data._status = response.status;
                throw data;
            }
            
            return data;
        } catch (error) {
            console.error('[ApiService Error]', error);
            throw error; // Rethrow to let caller handle if needed
        }
    },

    get(url, options = {}) {
        return this.request(url, { ...options, method: 'GET' });
    },

    post(url, body, options = {}) {
        return this.request(url, { ...options, method: 'POST', body });
    },

    put(url, body, options = {}) {
        return this.request(url, { ...options, method: 'PUT', body });
    },

    delete(url, options = {}) {
        return this.request(url, { ...options, method: 'DELETE' });
    }
};

window.ApiService = ApiService;
