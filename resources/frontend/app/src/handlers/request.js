import axios from "axios";

export function post(url, data) {

    if(parseInt(localStorage.tokenExpired) <= Date.now()) {
        refreshToken();
    }

    let config = {
        method: 'post',
        url: url,
        data: data,
        headers: {'Authorization': 'Bearer ' + localStorage.token}
    };

    return axios.request(config);
}

async function refreshToken() {
    let config = {
        method: 'post',
        url: '/api/auth/refresh',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + localStorage.token
        }
    };

    let token = await axios.request(config);

    if(token) {
        localStorage.token = token.data.access_token;
        localStorage.tokenExpired = Date.now() + 3600 * 1000;
    }
}
