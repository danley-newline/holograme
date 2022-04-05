import axios from 'axios'
const getUrl = window.location.origin;
export default axios.create({
    baseURL: `${getUrl}`,
});

export const headers = { 
    'Accept': "json",
    "Content-Type": "application/json",
    'Authorization': 'Basic YWRtaW46YWRtaW4=',
    "X-CSRF-Token": "0XEzDwR07AFJ3-ikDrETpRVm6N0OqUlhSgwugUHrW3s"
}
