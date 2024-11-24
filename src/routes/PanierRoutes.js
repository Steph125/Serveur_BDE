// routes/panierRoutes.js
const express = require('express');
const router = express.Router();
const panierController = require('../controllers/PanierController');
// const authMiddleware = require('../middlewares/authMiddleware');

router.get('/',  panierController.getPanier);
router.post('/add',  panierController.addProductToPanier);
router.post('/remove',  panierController.removeProductFromPanier);
router.post('/finalize',  panierController.finalizeOrder);

module.exports = router;
