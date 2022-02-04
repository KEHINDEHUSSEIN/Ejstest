let utility = require("../utility/uility")
let qs = require('qs');

let Baseurl = "http://localhost:3000"


module.exports = class Auth {

    static postLogin(data) {
        return new Promise((resolve, reject) => {

            let body = qs.stringify({
                'user': data.user,
                'password': data.password
            });

            let config = {
                method: 'post',
                url: Baseurl + '/v1/client/auth/login',
                data: body
            };

            utility.httpCall(config).then(result => {
                resolve({data: result})
            }).catch(error => {
                console.log(error)
                reject({data: error.message})
            });
        })
    }

}