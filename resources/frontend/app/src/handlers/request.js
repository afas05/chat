import axios from "axios";

export function post(url, data) {
    let config = {
        method: 'post',
        url: url,
        data: data,
        headers: {'Authorization': 'Bearer ' + localStorage.token}
    };

    return axios.request(config);
}
