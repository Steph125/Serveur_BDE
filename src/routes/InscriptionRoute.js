const express = require('express');
const router = express.Router();
const inscriptionController = require('../controllers/InscriptionController');

router.post('/inscription', inscriptionController.inscription);

module.exports = router;
