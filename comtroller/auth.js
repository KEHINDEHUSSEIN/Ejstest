let service = require("../service/auth")

exports.getLogin = (req, res) => {
    //  let data = req.body;
    res.render('login');
}

exports.postLogin = (req, res) => {
     let data = req.body;
    service.postLogin(data).then(result => {
        if (result.error){
            res.render('login');
        } else  {
            res.render('index');
        }
    }).catch(error => {
        res.render('login');
    })
}