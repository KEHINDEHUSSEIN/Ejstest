let axios = require('axios');

// pattern for email address
exports.emailRegexp = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;

/**
 *   HTTP Call
 */

exports.httpCall = (config) => {
    return new Promise((resolve, reject) => {
        axios(config).then(function (response) {
            resolve(response.data);
        }).catch(function (error) {
            reject(error);
        });
    })
}

/**
 * Hash Password
 */

exports.hashPassword = (password) => {
    return new Promise(resolve => {
        bcrypt.genSalt(10, (err, salt) => {
            bcrypt.hash(password, salt, (err, hash) => {
                resolve(hash);
            });
        });
    });
}

exports.is18orOlder = (dateString) => {
    return new Promise(resolve => {
        const dob = new Date(dateString);
        const dobPlus18 = new Date(dob.getFullYear() + 18, dob.getMonth(), dob.getDate());
        resolve(dobPlus18.valueOf() <= Date.now())
    });
}