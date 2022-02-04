var express = require('express');
var router = express.Router();

let authController = require("../comtroller/auth")

/* GET home page. */
router.get('/', authController.getLogin);
router.post('/login', authController.postLogin);

module.exports = router;
